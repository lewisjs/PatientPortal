<?php
App::uses('AppController', 'Controller');
/**
 * InsurancePatientRelationships Controller
 *
 * @property InsurancePatientRelationship $InsurancePatientRelationship
 */
class InsurancePatientRelationshipsController extends AppController {
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
	public function index($patientId=null) {
	// patientId should be set, but if user is a Patient, id can be recovered from user account.
		if (null == $patientId) {
			if (Configure::read('PatientPortal.group_id.Patient') == $this->Session->read('Auth.User.group_id')) {
			// if patientId is not set, then patient demographics need to be added before insurance
				if (null != $this->Session->read('Auth.User.patient_id')) {
					$patientId = $this->Session->read('Auth.User.patient_id');
				}
				else {
					$this->redirect(array('controller' => 'patients', 'action' => 'add'));
				}
			}
		}
		$this->InsurancePatientRelationship->recursive = 1;
		$this->set(
			'insurancePatientRelationships',
			$this->paginate($this->InsurancePatientRelationship, array('patient_id' => $patientId)));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->InsurancePatientRelationship->id = $id;
		if (!$this->InsurancePatientRelationship->exists()) {
			throw new NotFoundException(__('Invalid insurance patient relationship'));
		}
		$this->set('insurancePatientRelationship', $this->InsurancePatientRelationship->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($patientId=null, $policyholderId=null) {
	// patientId should be set, but if user is a Patient, id can be recovered from user account.
		if (null == $patientId) {
			if (Configure::read('PatientPortal.group_id.Patient') == $this->Session->read('Auth.User.group_id')) {
			// if patientId is not set, then patient demographics need to be added before insurance
				if (null != $this->Session->read('Auth.User.patient_id')) {
					$patientId = $this->Session->read('Auth.User.patient_id');
				}
				else {
					$this->Session->setFlash(__('A patient demographic record is required before insurance can be added.'));
					$this->redirect(array('controller' => 'patients', 'action' => 'add'));
				}
			}
		}
	// the policyholder must be known before insurance can be added
		if (null == $policyholderId) {
			$this->redirect(array('action' => 'add_policyholder', $patientId));
		}
	// when the user posts enough information, save new insurance policy
		if ($this->request->is('post')) {
			$this->request->data['InsurancePatientRelationship']['patient_id'] = $patientId;
			$this->request->data['InsurancePatientRelationship']['policyholder_id'] = $policyholderId;	
			$this->InsurancePatientRelationship->create();
			if ($this->InsurancePatientRelationship->save($this->request->data)) {
				$this->Session->setFlash(__('The insurance patient relationship has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The insurance patient relationship could not be saved. Please, try again.'));
			}
		}
		
		$this->set($this->load_viewVars($patientId, $policyholderId));
	}
	
	
	public function add_policyholder($patientId = null) {
	// when user posts data, attempt to create new policyholder
		if ($this->request->is('post')) {
			$this->InsurancePatientRelationship->Patient->create();
			if ($this->InsurancePatientRelationship->Patient->save($this->request->data)) {
				$this->Session->setFlash(__('New policyholder successfully created.'));
				
				$this->redirect(array('action' => 'add', $patientId, $this->InsurancePatientRelationship->Patient->id));
			}
			else {
				$this->Session->setFlash(__('The policyholder could not be saved. Please, try again.'));				
			}
		}
	// load lists
		$policyholders = $this->InsurancePatientRelationship->find(
			'all',
			array(
				'conditions' => array('patient_id' => $patientId),
				'contain' => 'Policyholder',
				'fields' => array('Policyholder.first_name', 'Policyholder.last_name', 'Policyholder.date_of_birth',)
			)
		);

		$patientGenders = $this->InsurancePatientRelationship->Patient->PatientGender->find(
			'list',
			array('fields' => array('PatientGender.description'), )
		);
		$patientMaritalStatuses = $this->InsurancePatientRelationship->Patient->PatientMaritalStatus->find(
			'list',
			array('fields' => array('PatientMaritalStatus.description'), )
		);
		$this->set(compact('patientId', 'policyholders', 'patientMaritalStatuses', 'patientGenders'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->InsurancePatientRelationship->id = $id;
		if (!$this->InsurancePatientRelationship->exists()) {
			throw new NotFoundException(__('Invalid insurance patient relationship'));
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->InsurancePatientRelationship->save($this->request->data)) {
				$this->Session->setFlash(__('The insurance patient relationship has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The insurance patient relationship could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->InsurancePatientRelationship->read(null, $id);
		}

		$data = $this->InsurancePatientRelationship->read(null, $id);
		$this->set($this->load_viewVars(
			$data['Patient']['id'],
			$data['Policyholder']['id']
		));
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
		$this->InsurancePatientRelationship->id = $id;
		if (!$this->InsurancePatientRelationship->exists()) {
			throw new NotFoundException(__('Invalid insurance patient relationship'));
		}
		if ($this->InsurancePatientRelationship->delete()) {
			$this->Session->setFlash(__('Insurance patient relationship deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Insurance patient relationship was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	

/**
 * load_viewVars method
 * 
 * @param int $patientId
 * @param int $policyholderId
 * @return mixed
 */
	private function load_viewVars($patientId=null, $policyholderId=null) {
		$relationshipOptions = array(
			'fields' => array('PatientRelationship.description'),
			'order' => array('PatientRelationship.description ASC'),
		);
		if ($patientId && $patientId == $policyholderId) {
			$relationshipOptions['conditions'] = array('id' => 99);
		}
		$patientRelationships = $this->InsurancePatientRelationship->PatientRelationship->find(
			'list',
			$relationshipOptions
		);
		
		$insurances = $this->InsurancePatientRelationship->Insurance->find(
			'list',
			array('order' => array('Insurance.name ASC'), )
		);
		
		$insuranceTypes = $this->InsurancePatientRelationship->InsuranceType->find(
			'list',
			array('fields' => array('InsuranceType.description'))
		);

		$viewVars = compact(
			'patientRelationships',
			'insurances',
			'insuranceTypes'
		);
		
		if ($patientId) {
			$viewVars['patientId'] = $patientId;
		}

		if ($policyholderId) {
			$this->InsurancePatientRelationship->Policyholder->id = $policyholderId;
			if ($this->InsurancePatientRelationship->Policyholder->exists()) {
				$policyholderData = $this->InsurancePatientRelationship->Policyholder->read(null, $policyholderId);
				$policyholder = $policyholderData['Policyholder']['first_name'] . ' ' . $policyholderData['Policyholder']['last_name'];

				$viewVars['policyholderId'] = $policyholderId;
				$viewVars['policyholder'] = $policyholder;
			}
			else {
				$this->Session->setFlash(__('There is no such policyholder in our records. Please choose another.'));
		
				$this->redirect(array('action' => 'add_policy_holder', $patientId));
			}
		}
		
		return $viewVars;
	}
}
