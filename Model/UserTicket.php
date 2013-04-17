<?php
App::uses('AppModel', 'Model');
App::uses('CakeEmail', 'Network/Email');


/**
 * UserTicket Model
 * 
 * usage
 *	The user ticket takes a data array, serializes it, and returns it as an array.
 *
 * @property User $User
 */
class UserTicket extends AppModel {
	
/**
 * method open_ticket
 *	Serializes array parameter and writes to database.
 * 
 * @param string $userId
 * @param mixed $data
 * @return string
 * @throws InternalErrorException
 */
	public function open_ticket($userId, array $data) {
		$this->delete_old_tickets();
		
		$data = serialize($data);
		$modelData = array('UserTicket' => array('user_id' => $userId, 'data' => $data));
		
		if ($modelData = $this->save($modelData)) {
			return $modelData['UserTicket']['id'];
		}

		throw new InternalErrorException('Failure to create new ticket. Please try your task again later.');
	}
	

/**
 * close_ticket method
 * 
 * @param string $id
 * @param string $userId
 * @throws NotFoundException
 * @throws InternalErrorException
 * @return mixed
 */
	public function close_ticket($id) {
		if(!$this->exists($id)) {
			throw new NotFoundException(__('Ticket not found.'));
		}
		if (!$this->delete($id)) {
			throw new InternalErrorException(__('Failed to delete ticket.'));
		}
	}
	
	
/**
 * method read_ticket
 *	Finds a ticket by id(hash) and user id and returns the ticket's data store.
 * 
 * @param string $id
 * @return mixed $userId
 * @throws InternalErrorException
 * @throws NotFoundException
 * @return mixed
 */
	public function read_ticket($id, $userId) {
		try {
			$this->delete_old_tickets();
		}
		catch (InternalErrorException $e) {
			throw $e;
		}
		
		$this->recursive = -1;
		$modelData = $this->findByIdAndUserId($id, $userId);
		
		if ($modelData) {			
			return unserialize($modelData['UserTicket']['data']);
		}
		else {
			throw new NotFoundException(__('There is no matching ticket.'));
		}
		
	}
	
	
/**
 * method delete_old_tickets
 *	Deletes all tickets older than a system configuration time-to-live.
 * 
 * @return void
 * @throws InternalErrorException
 */
	private function delete_old_tickets() {
		$deadline = date('Y-m-d H:i:s', time() - 3600 * Configure::read('PatientPortal.ticket.timeToLive'));
	
		$conditions = array(
			'UserTicket.modified <' => $deadline,
		);
	
		if (!$this->deleteAll($conditions)) {
			throw InternalErrorException(_('Unable to delete tickets. Please try your task again later.'));
		}
	}
    
    
/**
 * 
 * @param string $to
 * @param string $subject
 * @param string $template
 * @param mixed $viewVars
 * @param mixed $from=NULL only provide if a you want to change from the default sender address
 * 
 * @throws InternalErrorException
 */
    public function email($to, $subject, $template, $viewVars, $from=NULL) {
    	// email user new ticket
    	$emailer = new CakeEmail('default'); // defined in app/Config/email.php

//     	$emailer = new CakeEmail(array( // defined in app/Config/email.php
//     		'host' => 'mail.lowcountryrheumatology.com',
//     		'port' => '25',
//     		'username' => 'patientportal',
//    			'password' => '06pRa12',
//    			'transport' => 'Smtp'
//     	));
    	

    	$emailer->to($to)
    		->from($from ? $from :
    			array(Configure::read('PatientPortal.email.fromAddress') => Configure::read('PatientPortal.email.fromName'))
    		)
	    	->subject($subject)
	    	->emailFormat('html')
	    	->template($template)
	    	->viewVars($viewVars);
    	
    	if (false == $emailer->send()) {
    		throw new InternalErrorException('Email could not be sent. Please try again later.');
    	}
    }
	

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
