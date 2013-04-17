<?php
App::uses('AppController', 'Controller');
/**
 * Patients Controller
 *
 * @property Patient $Patient
 */
class PatientsController extends AppController {
/**
 * Temporarily allow access to everything.
 */
	public function beforeFilter() {
		parent::beforeFilter();
	}
	

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Patient->recursive = 0;
		$this->set('patients', $this->paginate());
	}
	

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->access($id)) {
			$this->Session->setFlash(__('You are only allowed to view your own demographic information.'));			
			$this->redirect(array('action' => 'view', $this->Session->read('Auth.User.patient_id')));
		}
		
		$this->Patient->id = $id;
		if (!$this->Patient->exists()) {
			throw new NotFoundException(__('Invalid patient'));
		}
		
		$this->set('patient', $this->Patient->read(null, $id));
	}
	

/**
 * add method
 *
 * @return void
 */
	public function add() {
	// If Patient user already has demographics, redirect to edit.
		if (Configure::read('PatientPortal.group_id.Patient') == $this->Session->read('Auth.User.group_id')
		&& $this->Session->read('Auth.User.patient_id')) {
			$this->redirect(array('action' => 'edit', $this->Session->read('Auth.User.patient_id')));
		}
		
	// when a user posts data, attempt to create new Patient demographic record
		if ($this->request->is('post')) {
			$this->Patient->create();
			if ($this->Patient->save($this->request->data)) {
				$this->Session->setFlash(__('The patient has been saved'));
				
			// perform any necessary steps on creating new patient
				$this->link_new_patient();
				
			// Patient-users are a special case. They should be redirected in a "next-like" way to insurance.
				if (Configure::read('PatientPortal.group_id.Patient') == $this->Session->read('Auth.User.group_id')) {
					$this->redirect(array('controller' => 'insurancePatientRelationships', 'action' => 'add', $id));
				}
				else {
					$this->redirect(array('action' => 'index', $id));					
				}
			} else {
				$this->Session->setFlash(__('The patient could not be saved. Please, try again.'));
			}
		}
		
	// prepare lists for selection
		$patientGenders = $this->Patient->PatientGender->find('list',
			array('fields' => array('PatientGender.description'), )
		);
		$patientMaritalStatuses = $this->Patient->PatientMaritalStatus->find('list',
			array('fields' => array('PatientMaritalStatus.description'), )
		);
		$locations = $this->Patient->Location->find('list',
			array('fields' => array('Location.description'))
		);
		$this->set(compact('patientMaritalStatuses', 'patientGenders', 'locations'));
	}
	
	
	private function link_new_patient() {
		switch ($this->Session->read('Auth.User.group_id')) {
		// Patient users, have new demographic record linked to their user account
			case Configure::read('PatientPortal.group_id.Patient'):
				$this->Patient->User->id = $this->Session->read('Auth.User.id');
				
				if ($this->Patient->User->saveField('patient_id', $this->Patient->id)) {					
				// update session data to reflect new patient demographic information
					$this->Session->write('Auth.User.patient_id', $this->Patient->id);
	
				// write patient info into session
					$this->Session->write('Auth.User.Patient', $this->data['Patient']);		
				}
				else {
					$this->Patient->delete($this->Patient->id);
					
					$this->Session->setFlash(__('Your Patient data could not be saved. Please try again later.'));					
					$this->redirect(array('controller' => 'pages', 'action' => '/'));					
				}
				
				break;
				
			default:
				$this->Session->setFlash(__('Your login credentials are corrupted. Please login again.'));
				$this->redirect(array('controller' => 'users', 'action' => 'logout'));
		}

	}
	
	
	private function route_user_post_add() {
		switch (Configure::read('PatientPortal.group_id.Patient')) {
			case $this->Session->read('Auth.User.group_id'):				
				$this->redirect(array('controller' => 'insurancePatientRelationships', 'action' => 'add', $id));
				
			default:
				$this->Session->setFlash(__('Your login credentials are corrupted. Please login again.'));
				$this->redirect(array('controller' => 'users', 'action' => 'logout'));
		}		
	}
	
	

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
	// Ensure user logged in has access to patient demographics.
		if (!$this->access($id)) {
			$this->Session->setFlash(__('You are only allowed to edit your own demographic information.'));			
			$this->redirect(array('action' => 'edit', $this->Session->read('Auth.User.patient_id')));
		}
	// When a user posts data, attempt to update
		$this->Patient->id = $id;
		if (!$this->Patient->exists()) {
			throw new NotFoundException(__('Invalid patient'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Patient->save($this->request->data)) {
				$this->Session->setFlash(__('The patient has been saved'));
				$this->redirect(array('action' => 'view', $id));
			} else {
				$this->Session->setFlash(__('The patient could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Patient->read(null, $id);
		}
		
	// prepare lists for selection
		$patientGenders = $this->Patient->PatientGender->find('list',
			array('fields' => array('PatientGender.description'), )
		);
		$patientMaritalStatuses = $this->Patient->PatientMaritalStatus->find('list',
			array('fields' => array('PatientMaritalStatus.description'), )
		);
		$locations = $this->Patient->Location->find('list',
			array('fields' => array('Location.description'))
		);
		$this->set(compact('patientMaritalStatuses', 'patientGenders', 'locations'));
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
		$this->Patient->id = $id;
		if (!$this->Patient->exists()) {
			throw new NotFoundException(__('Invalid patient'));
		}
		if ($this->Patient->delete()) {
			if ($this->Session->read('Auth.User.patient_id') == $id) {
				$this->Session->write('Auth.User.patient_id', null);
			}
			
			$this->Session->setFlash(__('Patient deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Patient was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
	
/**
 * access method
 *	Returns true if the current user has rights to the patient id parameter. If $patient_id is null, will redirect
 *	accordingly.
 * 
 * @param int $patient_id
 * @throws InternalErrorException
 * @return boolean
 */
	private function access($patient_id) {
	// if $patient_id is null, a user needs to make a patient if 
		if (null == $patient_id) {
			switch ($this->Session->read('Auth.User.group_id')) {
				case Configure::read('PatientPortal.group_id.Patient'):
					if (null == $this->Session->read('Auth.User.patient_id')) {
						$this->redirect(array('action' => 'add'));
					}
					else {
						throw new InternalErrorException();						
					}
					
				case Configure::read('PatientPortal.group_id.Clinician'):
				case Configure::read('PatientPortal.group_id.Coordinator'):
				case Configure::read('PatientPortal.group_id.Administrator'):
					$this->redirect(array('action' => 'search'));
				case null:
					$this->Session->setFlash(__('Please log in to complete this action.'));
					$this->redirect(array('controller' => 'users', 'action' => 'login'));
				default:
					throw new InternalErrorException(__('Your user account has been corrupted.'));
			}
		}

	// Patient users may only access their own patient demographics.
		switch ($this->Session->read('Auth.User.group_id')) {
			case Configure::read('PatientPortal.group_id.Patient'):
				return $this->Session->read('Auth.User.patient_id') == $patient_id
					|| $this->Session->read('Auth.InsurancePatientRelationshipInsurer.policyholder_id') == $patient_id;
			case null:
				$this->Session->setFlash(__('Please log in to complete this action.'));
				$this->redirect(array('controller' => 'users', 'action' => 'login'));
			default:
				throw new InternalErrorException(__('Your user account has been corrupted.'));
		}
	}
}
