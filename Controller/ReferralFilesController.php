<?php
App::uses('AppController', 'Controller');
/**
 * ReferralFiles Controller
 *
 * @property ReferralFile $ReferralFile
 */
class ReferralFilesController extends AppController {
/**
 * Temporarily allow access to everything.
 */
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('*');
	}

/**
 * index method
 *
 * @return void
 */
	public function index($patientId=null) {
		$conditions = null;
			
		switch ($this->Session->read('Auth.User.group_id')) {
		// different users get different results
			case Configure::read('PatientPortal.group_id.Patient'): // user is a patient
			// patientId is set or patient demographics need to be added
				if (null != $this->Session->read('Auth.User.patient_id')) {
					$patientId = $this->Session->read('Auth.User.patient_id');
				}
				else {
					$this->redirect(array('controller' => 'patients', 'action' => 'add'));
				}
				
			// find the corresponding referral
				$refData = $this->ReferralFile->Referral->find_patient_referral($patientId);
				if ($refData) {
					$conditions = array('ReferralFile.referral_id' => $refData['Referral']['id']);
				}
				else {
					$conditions = array('ReferralFile.referral_id' => null);
				}				
				break;
				
			// User is not logged in
			default:
				$this->redirect(array('controller' => 'users', 'action' => 'login'));
		}

		$this->ReferralFile->recursive = 0;
		$this->set('referralFiles', $this->paginate('ReferralFile', $conditions));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if(null == $id) {
			$this->Session->setFlash(__('No file was chosen for download.'));
			$this->redirect(array('action' => 'index'));
		}
		
		switch ($this->Session->read('Auth.User.group_id')) {
			
			case Configure::read('PatientPortal.group_id.Patient'): // user is a patient
			// patientId is set or patient demographics need to be added
				if (null != $this->Session->read('Auth.User.patient_id')) {
					$patientId = $this->Session->read('Auth.User.patient_id');
				}
				else {
					$this->redirect(array('controller' => 'patients', 'action' => 'add'));
				}
			// find the corresponding referral
				$refData = $this->ReferralFile->Referral->find_patient_referral($patientId);
				$refFileData = $this->ReferralFile->findByIdAndReferralId($id, $refData['Referral']['id']);
				if (!$refFileData) {
					throw new ForbiddenException('You are only allowed to access files you have uploaded.');
				}
				
				break;
				
			// User is not logged in
			default:
				$this->redirect(array('controller' => 'users', 'action' => 'login'));
		}
		
		$this->viewClass = 'Media';
		// Download app/outside_webroot_dir/example.zip
		$params = array(
				'id'        => $refFileData['ReferralFile']['internal_name'],
				'name'      => $this->Session->read('Auth.User.last_name'),
				'download'  => true,
				'extension' => 'pdf',
				'path'      => Configure::read('PatientPortal.referral_file.path'),
		);
		$this->set($params);
	}

/**
 * add method
 *
 * @return void
 */
	public function add($patientId=null, $referralId=null, $providerId=null) {
		if ($this->request->is('post')) {
			switch ($this->Session->read('Auth.User.group_id')) {
				// user is a patient
				case Configure::read('PatientPortal.group_id.Patient'):					
				// patientId should be set, but if user is a Patient, id can be recovered from user account.
					if (null == $patientId) {
					// patientId is set or patient demographics need to be added
						if (null != $this->Session->read('Auth.User.patient_id')) {
							$patientId = $this->Session->read('Auth.User.patient_id');
						}
						else {
							$this->redirect(array('controller' => 'patients', 'action' => 'add'));
						}
					}
					
				// upload of a file results in the patient-creation of a referral or if one exists recovery
					if (null == $referralId) {
						$referralData = $this->ReferralFile->Referral->patient_create($patientId);
						$referralId = $referralData['Referral']['id'];
						
						if (null == $referralData) {
						// something went wrong with referral creation
							throw new InternalErrorException();						
						}
					}
					break;
					
				// User is not logged in
				default:
					$this->redirect(array('controller' => 'users', 'action' => 'login'));
			}

		// ensure upload is valid before attempting further work
			$this->ReferralFile->set($this->request->data);
			if ($this->ReferralFile->validates(array('fieldlist' => 'upload'))) {
				$this->ReferralFile->create();
				if ($this->ReferralFile->save($referralId, $providerId, $this->request->data)) {
					$this->Session->setFlash(__('The referral file has been saved'));
					$this->redirect(array('action' => 'index'));
				}
				else {
					$this->Session->setFlash(__('The referral file could not be saved. Please, try again.'));
				}
			}
			else {
				$this->Session->setFlash(__('The referral file could not be saved. Please, try again.'));
			}
		}

		//$providers = $this->ReferralFile->Provider->find('list');
		//$this->set(compact('providers', 'referrals'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->ReferralFile->id = $id;
		if (!$this->ReferralFile->exists()) {
			throw new NotFoundException(__('Invalid referral file'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ReferralFile->save($this->request->data)) {
				$this->Session->setFlash(__('The referral file has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The referral file could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->ReferralFile->read(null, $id);
		}
		$providers = $this->ReferralFile->Provider->find('list');
		$referrals = $this->ReferralFile->Referral->find('list');
		$this->set(compact('providers', 'referrals'));
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
		
		$this->ReferralFile->id = $id;
		if (!$this->ReferralFile->exists()) {
			throw new NotFoundException(__('Invalid referral file'));
		}
		
		if ($this->ReferralFile->delete()) {
			$this->Session->setFlash(__('Referral file deleted'));
			$this->redirect(array('action' => 'index'));
		}
		
		$this->Session->setFlash(__('Referral file was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
