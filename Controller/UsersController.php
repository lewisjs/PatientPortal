<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {
/**
 * Temporarily allow access to everything.
 */
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('*', 'initDB', 'login', 'create', 'confirm_add', 'confirm_email');
	}
	
	public function initDB() {
		$group = $this->User->Group;
		
		// Allow admins access to everything
		$group->id = Configure::read('PatientPortal.group_id.Administrator');
		$this->Acl->allow($group, 'controllers');
		
		$group->id = Configure::read('PatientPortal.group_id.Patient');
		$this->Acl->deny($group, 'controllers');
		$this->Acl->allow($group, 'controllers/InsurancePatientRelationships/add');
		$this->Acl->allow($group, 'controllers/InsurancePatientRelationships/add_policyholder');
		$this->Acl->allow($group, 'controllers/InsurancePatientRelationships/edit');
		$this->Acl->allow($group, 'controllers/InsurancePatientRelationships/index');
		$this->Acl->allow($group, 'controllers/InsurancePatientRelationships/view');
		$this->Acl->allow($group, 'controllers/Pages/display');
		$this->Acl->allow($group, 'controllers/Patients/add');
		$this->Acl->allow($group, 'controllers/Patients/edit');
		$this->Acl->allow($group, 'controllers/Patients/view');
		$this->Acl->allow($group, 'controllers/PatientQuestionsResponses/add');
		$this->Acl->allow($group, 'controllers/PatientQuestionsResponses/index');
		$this->Acl->allow($group, 'controllers/Users/view');
		$this->Acl->allow($group, 'controllers/Users/edit_email');
		$this->Acl->allow($group, 'controllers/Users/edit_password');
		$this->Acl->allow($group, 'controllers/Users/logout');
		$this->Acl->allow($group, 'controllers/ReferralFiles/index');
		$this->Acl->allow($group, 'controllers/ReferralFiles/add');
		
		echo "All done!";
		exit();
	}

/**
 * @var array $components
 */
    public $components = array(
        'Acl',
        'Auth' => array(
            'authorize' => array(
                'Actions' => array('actionPath' => 'controllers'),
            ),
        ),
        'Session',
    );
    
	
/**
 * login method (finished)
 */
	public function login() {
		if ($this->Session->read('Auth.User')) {
			$this->Session->setFlash(__('You are logged in!'));
			
            $this->redirect($this->Auth->redirect($this->get_referer()));
		}
		
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
			// ensure user has validated their account/email address
				if (false == $this->Session->read('Auth.User.validated')) {
				// create ticket to confirm email
					$this->add_edit_email_ticket(
						$this->Session->read('Auth.User.id'),
						$this->Session->read('Auth.User.email')
					);
		
					$this->Session->setFlash(
						__("Your user account email has not been validated. An email has been sent to your listed email
							address, {$this->Session->read('Auth.User.email')}. Please use the link to confirm your
							email address.")
					);

					$this->redirect($this->Auth->logout());
				}
				
            	$this->redirect($this->Auth->redirect($this->get_referer()));
			}
			else {
				$this->Session->setFlash(__('Your username or password was incorrect.'));
			}
		}
	}
	
	
/**
 * logout method (finished)
 */
	public function logout($msg=NULL) {
		if ($msg) {
			$this->Session->setFlash(__($msg));
		} else {
			$this->Session->setFlash('Good-Bye');
		}
		
		$this->delete_history();
		
		$this->redirect($this->Auth->logout());
	}
	

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}


/**
 * view method
 *
 * @throws NotFoundException
 * @param int $id
 * @return void
 */
	public function view($id = NULL) {
		if (NULL == $id) {			
			if ($this->Session->check('Auth.User.id')) {
				$id = $this->Session->read('Auth.User.id');
			} else {
				$this->redirect(array('action' => 'login'));
			}
		}
		
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		
		$this->set('user', $this->User->read(null, $id));
	}
	
	
	public function create() {
		if ($this->request->is('post')) {
		// ensure a user is logged out before new user create is attempted
			$this->Auth->logout();
			
		// assign to Patient group
			$this->request->data['User']['group_id'] = Configure::read('PatientPortal.group_id.Patient');
			$this->request->data['User']['validated'] = false;
			
		// create/save new user
			$this->User->create();
			if ($this->User->save($this->request->data)) {
			// create ticket to confirm email update
				$this->add_edit_email_ticket($this->User->id, $this->request->data['User']['email']);
				
				$this->Session->setFlash(__("An email has been sent to your updated email address, {$this->request->data['User']['email']}. Please use the link to confirm your new email address."));
				
				$this->delete_history();
				$this->redirect(array('action' => 'login'));
			}
			else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}		
	}


/**
 * add method (finished)
 * 
 * groups: Administrator, Coordinator, Clinician, <none>
 *
 * business rules:
 * 	- Will be created in Patient group.
 *	- Will be given random passwords to be deleted immediately upon confirmation.
 *	- Will be confirmed using confirm_add via an email sent to email address provided.
 *
 * @param string $username = null
 * @param string $email = null
 * @return void
 * @uses users_confirm_add
 */
	public function add($username = null, $email = null) {
		if ($this->request->is('post')) {
			// assign to Patient group
			$this->request->data['User']['group_id'] = Configure::read('PatientPortal.group_id.Patient');
			// assign random password
			$this->request->data['User']['password'] = $this->request->data['User']['confirm_password'] = md5(time());

			// create/save new user
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
																
				// create a new ticket for user account confirmation from email
				$data = array(
					'controller' => 'user',
					'action' => 'confirm_add',
					'email' => $this->request->data['User']['email'],
				);
				$userTicketId = $this->User->UserTicket->open_ticket($this->User->id, $data);
					
				// build a URL to confirm new user account
				$confirm_add_url = Router::url(
					array(
						'controller' => 'users', 'action' => 'confirm_add', // target
						$userTicketId, // user_ticket PK
						$this->User->id, // user to whom this ticket is assigned as owner
						$this->request->data['User']['email'], // email to which user email will be changed
					),
					true // true: create absolute path to controller action
				);
					
				// store email variables
				$viewVars = array(
					'creator' => $this->Session->read('Auth.User.id'),
					'username'=> $this->request->data['User']['username'],
					'url'=> $confirm_add_url,
				);
				
				//send email to new user
				$this->User->UserTicket->email(
					$this->request->data['User']['email'],
					'Patient Portal New User Confirmation',
					'usersConfirmAdd',
					$viewVars
				);
				
				$this->redirect(array('action' => '/'));
			}
			else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
		else {
			$this->request->data['User']['username'] = $username;
			$this->request->data['User']['email'] = $email;
		}
	}
	
	
/**
 * confirm_add method (finished)
 * 
 * business rules
 *	- Will update User's username, email, password, and validated.
 *	- Will set validated attribute true if user does not update email address, false otherwise.
 *	- Will initiate validation if user updates email address.
 *	- Will delete ticket after successful confirmation.
 * 
 * @param string $userTicketId
 * @param int $userId
 * @param string $confirmEmail
 * @throws NotFoundException
 * @throws ForbiddenException
 */
	public function confirm_add($userTicketId, $userId, $confirmEmail) {
		$this->User->id = $userId;
	// get ticket data
		try {
			$data = $this->User->UserTicket->read_ticket($userTicketId, $userId);
		}
		catch (NotFoundException $e) {
			$this->Session->setFlash(__('Ticket is missing or expired.'));
					
			throw new NotFoundException(__('There is no ticket created by this user with this identification.'));
		}
	// ensure this is the correct ticket type for this method
		if ('user' != $data['controller'] || 'confirm_add' != $data['action']) {
			throw new ForbiddenException(__('This functionality cannot be accessed with this ticket.'));			
		}

		if ($this->request->is('put') || $this->request->is('post')) {
		// will update username and password
			$fieldlist = array('username', 'password');
		// if user did not change email, user account is validated
			if ($data['email'] == $confirmEmail && $data['email'] == $this->request->data['User']['email']) {
				$this->request->data['User']['validated'] = true;
				$fieldlist[] = 'validated';
			}
		// only attempt to save username, password, and validated attributes (if email was unchanged)
			if ($this->User->save($this->request->data, array('fieldlist' => $fieldlist, ))) {
			// email must be validated if user updated
				if (isset($this->request->data['User']['validated'])) {
					$this->Session->setFlash(__('User account is confirmed. Please login.'));
				}
				else {
				// create ticket to confirm email update
					$this->add_edit_email_ticket($userId, $this->request->data['User']['email']);
					
					$this->Session->setFlash(__("An email has been sent to your updated email address, {$this->request->data['User']['email']}. Please use the link therein to confirm your new email address."));
				}
			// user has successfully confirmed new user, delete ticket
				$this->User->UserTicket->close_ticket($userTicketId);
				
				$this->redirect(array('controller' => 'users', 'action' => 'login'));
			}
			else {
				$this->Session->setFlash(__('Unable to confirm user account. Please try again.'));
			}
		}
		else {			
			if ($this->User->exists()) {
				$this->User->recursive = -1;
				$this->request->data = $this->User->read(null, $userId);
			// password must be updated			
				unset($this->request->data['User']['password']);				
			}
			else {
				$this->Session->setFlash(__('There is no User account matching this ticket.'));				
				throw new NotFoundException(__('Invalid user'));
			}
		}
	}
	

/**
 * edit method (unused, see individual edits)
 *
 * @throws NotFoundException
 * @param int $id
 * @return void
 */
	public function edit($id = null) {
		if (NULL == $id) {			
			if ($this->Session->check('Auth.User.id')) {
				$id = $this->Session->read('Auth.User.id');
			} else {
				$this->redirect(array('action' => 'login'));
			}
		}
		
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->User->read(null, $id);
		}
		$groups = $this->User->Group->find('list');
		$patients = $this->User->Patient->find('list');
		$practices = $this->User->Practice->find('list');
		$this->set(compact('groups', 'patients', 'practices'));
	}
	
/**
 * search method
 *	Receiving an action, this method passes on the corresponding user's id to said action, if a single user is found
 *	or returns a list of users if multiple are found. If no user is found, then the 
 * @param string $action
 */
	public function search($action = null) {
		if (null == $action) {
			throw new NotFoundException();
		}
		
		$set = array('action' => $action);
		$conditions = array();
		
		if ($this->request->is('post')) {
		// ensure model will validate for a search.
			$this->User->set_search_state($this->request->data['User']['username'], $this->request->data['User']['email']);
			$this->User->set($this->request->data);
			if ($this->User->validates()) {
				if ($this->request->data['User']['username']) {
					$conditions['User.username LIKE'] = '%' . $this->request->data['User']['username']. '%';
				}
				if ($this->request->data['User']['email']) {
					$conditions['User.email LIKE'] = '%' . $this->request->data['User']['email']. '%';
				}
				
				$this->paginate = array(
        			'conditions' => $conditions,
					'fields' => array('User.id', 'User.username', 'User.email'),
        			'limit' => 10,
					'recursive' => -1,
    			);

				$set['users'] = $this->paginate();
				if (0 == count($set['users'])) {
					$this->Session->setFlash(__('No similar user(s) found. Create a new one?'));
					
					$this->redirect(
						array(
							'action' => add,
							$this->request->data['User']['username'],
							$this->request->data['User']['email'],
						)
					);
				}
			}
		}
		
		$this->set($set);
	}
	
	
/**
 * edit_password method (finished)
 * 
 * business rules:
 *	- ACL: Adinistrators, Coordinators, Clinicians, Patients
 *	- Only an Administrator may update other users' passwords.
 *
 * @param int $userId
 * @throws NotFoundException
 */
	public function edit_password($userId = null) {
	// only Administrator users can use the userId parameter to update a user password other than their own.
		$id = $this->get_admin_edit_userId($userId);
	// prepare model for password edit
		$this->User->set_edit_password_state($id);
		if ($this->request->is('post') || $this->request->is('put')) {
		// if old password is correct, update to newly provided password
			if (AuthComponent::password($this->request->data['User']['old_password']) == $this->User->get_password()) {
			// for security, restrict save to password.
				if ($this->User->save($this->request->data, array('fieldList' => array('password')))) {					
					unset($this->request->data);
					
					$this->redirect(array('action' => 'logout', 'Password has been updated. Please log in.'));
				} else {
					$this->Session->setFlash(__('The password could not be updated. Please, try again.'));
				}
				
			}
			else {
				$this->Session->setFlash(__('The password you entered does not match your existing password.'));
			}
		}
	}
	

/**
 * edit_email method(finished)
 * 
 * @param integer $userId
 */
	public function edit_email($userId = null) {
	// only Administrator users can use the userId parameter to update a user email other than their own.
		$userId = $this->get_admin_edit_userId($userId);
	// prepare model for email edit
		$this->User->set_edit_email_state($userId);
		
		if ($this->request->is('post') || $this->request->is('put')) {
		// prepare model to validate user input
			$this->User->set($this->request->data['User']);

			if ($this->User->validates(array('fieldlist' => array('email', 'password')))) {
			// if old password is correct, create an update email ticket
				if (AuthComponent::password($this->request->data['User']['password']) == $this->User->get_password()) {
					$this->add_edit_email_ticket($userId, $this->request->data['User']['email']);

					$this->Session->setFlash(__('An email to complete the change was sent to the indicated email address.'));
				}
				else {
					$this->Session->setFlash(__('The password is incorrect.'));
				}
			}
			else {    
				$this->Session->setFlash(__('The email could not be updated. Please, try again.'));
			}
		}
		else {
			$this->request->data = $this->User->read('email', $userId);
		}
	}
	
	
	public function request_practice($userId, $practiceId) {
		throw new NotImplementedException('This method is not yet in place. Please try back later.');
	}
	

/**
 * get_admin_edit_userId method (finished)
 *
 * Method:
 *	Accepts a userId, if the id is null or is the id of the user currently logged, the id of the user currently logged
 *	in is returned. If the id is not null or is no the id of the user currently logged in, then if the currently logged
 *	in user is an Administrator, the parameter id is returned, otherwise an exception is thrown.
 *
 * @param integer $userId
 * @throws UnauthorizedException
 * @return integer
 */
	private function get_admin_edit_userId($userId = null) {
		if (null == $userId || $this->Session->read('Auth.User.id') == $userId) {
			return $this->Session->read('Auth.User.id');
		}
		elseif (Configure::read('PatientPortal.group_id.Administrator') == $this->Session->read('Auth.User.group_id')) {
			return $userId;
		}
		else {
			throw new UnauthorizedException(__('You do not have permission to access this functionality.'));
		}
	}
	
	
/**
 * confirm_email(finished)
 * 
 * @param string $userTicketId
 * @param integer $userId
 * @param string $userEmail
 * @throws NotFoundException
 * @throws ForbiddenException
 * @throws InternalErrorException
 */
	public function confirm_email($userTicketId, $userId, $userEmail) {
		$this->User->id = $userId;
	// get ticket data
		try {
			$data = $this->User->UserTicket->read_ticket($userTicketId, $userId);
		}
		catch (NotFoundException $e) {
			$this->Session->setFlash(__('Ticket is missing or expired.'));
					
			throw new NotFoundException(__('There is no ticket created by this user with this identification.'));
		}
	// ensure this is the correct ticket type for this method
		if ('users' != $data['controller'] || 'confirm_email' != $data['action'] || $userEmail != $data['email']) {
			throw new ForbiddenException(__('This functionality cannot be accessed with this ticket.'));			
		}
		
		$modelData = array('User' => array('email' => $data['email'], 'validated' => true));
		if ($this->User->save($modelData, array('fieldList' => array('email', 'validated')))) {
			$this->Session->setFlash(__('Email update validated. Please log in.'));
			
			$this->User->UserTicket->close_ticket($userTicketId);
			
			$this->redirect(array('action' => 'login'));
		}
		else {
			$this->Session->setFlash(__('Unable to validate email. Please try again later.'));
			
			throw new InternalErrorException;
		}
	}
	

/**
 * add_edit_email_ticket method (finished)
 * 
 * @param int $userId
 * @param string $userEmail
 * @throws InternalErrorException
 * @uses users_add_edit_email.ctp
 */
	private function add_edit_email_ticket($userId, $userEmail) {
		// create a new ticket and retrieve hash of ticket.
		$data = array(
			'controller' => 'users',
			'action' => 'confirm_email',
			'email' => $userEmail,
		);
		$userTicketId = $this->User->UserTicket->open_ticket($userId, $data);	
		// build a validate_email url
		$url = Router::url(
			array(
				'controller' => 'users', 'action' => 'confirm_email',
				$userTicketId, $userId, $userEmail,
			),
			true
		);
		// build viewVars array	
		$viewVars = array('userName'=> $this->Session->read('Auth.User.id'), 'url'=> $url);
		// attempt to send user an email
		try {
			$this->User->UserTicket->email(
				$userEmail,
				'Patient Portal Email Validation',
				'usersAddEditEmail',
				$viewVars
			);
		}
		catch (InternalErrorException $e) {
			throw $e;
		}
	}
	

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
/**
 * (non-PHPdoc)
 * @see Controller::beforeRedirect()
 */
    public function beforeRedirect($url) { /* Do not call parent's function */ }
/**
 * (non-PHPdoc)
 * @see Controller::afterFilter()
 */
    public function afterFilter() { /* Do not call parent's function */ }
}
