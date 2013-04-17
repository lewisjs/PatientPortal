<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 * 
 * Properties:
 *	@property User $User
 *	@property InsurancePatientRelationship $InsurancePatientRelationship
 *	@property Referral $Referral
 *	@property Questionnaire $Questionnaire
 *	@property PatientQuestionsResponse $PatientQuestionsResponse
 * 
 */
class PagesController extends AppController {
/**
 * Temporarily allow access to everything.
 */
	public function beforeFilter() {
		parent::beforeFilter();
	}

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Pages';

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array('User', 'InsurancePatientRelationship', 'Referral', 'Questionnaire', 'PatientQuestionsResponse');

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 */
	public function display() {
		$viewVars = array();
		
	// ensure data exists for currently accessing user
		if (!$this->Session->read('Auth.User')) {
			$this->Session->setFlash(__('Please log in to access this information.'));
			$this->redirect(array('controller' => 'Users', 'action' => 'login'), 500, true);
		}
		
		$page = $this->get_homepage($this->Session->read('Auth.User.group_id'));
		
	// get notification variables and add to view variables
		$notificationArray = $this->get_notifications($this->Session->read('Auth.User'));
		foreach (array_keys($notificationArray) as $key) {
			$viewVars[$key] = $notificationArray[$key];
		}
				
		$this->set($viewVars);
		$this->render($page);
	}
	
	
/**
 * 
 * @param int $groupId
 * @throws InternalErrorException
 * @return string
 */
	private function get_homepage(&$user) {		
		switch($user['group_id']) {
			case Configure::read('PatientPortal.group_id.Patient'):
				return 'patient_home';
			case Configure::read('PatientPortal.group_id.Clinician'):
				return $page = 'clinician_home';
			case Configure::read('PatientPortal.group_id.Coordinator'):
				return $page = 'coordinator_home';
			case Configure::read('PatientPortal.group_id.Administrator'):
				return $page = 'administrator_home';
			default:
				throw new InternalErrorException(__('Your authentication credentials have been corrupted.'));
		}
	}
	
	
	private function get_notifications(&$user) {
		$notes = array('notifications' => null);
		
		switch($user['group_id']) {
		/***  PATIENT USER  ***/
			case Configure::read('PatientPortal.group_id.Patient'):
				if (null == $user['patient_id']) {
					$notes['notifications'] = array('NO_PATIENT');

					$notes['practices'] = $this->paginate($this->User->Practice);
					$notes['Actions'][] = array(
						'url' => array('controller' => 'Patients', 'action' => 'add'),
						'msg' => 'Please enter your patient demographics.'
					);
					
					// Cannot go further until patient is created for this user
					break;
				}
				
			// ensure patient has uploaded insurance information
				if (NULL == $this->InsurancePatientRelationship->find('first',
					array(
						'conditions' => array('patient_id' => $user['patient_id']),
						'recursive' => -1
					)
				)) {
					$notes['Actions'][] = array(
						'url' => array(
							'controller' => 'InsurancePatientRelationships',
							'action' => 'add',
							$user['patient_id']),
						'msg' => 'Please enter your insurance information.'
					);
				}
				
			// ensure patient has uploaded referral documentation
				//$this->Model->unbindModel(array('belongsTo' => array('Practice')));
				if (NULL == $this->Referral->find('first',
					array('conditions' => array('patient_id' => $user['patient_id']), 'recursive' => -1)
				)) {
					$notes['Actions'][] = array(
						'url' => array('controller' => 'ReferralFiles', 'action' => 'add', $user['patient_id']),
						'msg' => 'Please upload any medical records you have at your disposal'
					);
				}

			// ensure patient has completed all questionnaires at least once
				$data = $this->Questionnaire->find('list', array('fields' => 'id'));
				if ($data) {
					foreach ($data as $id) {
						$numbers = $this->Questionnaire->get_page_numbers($id);
						$found = false;
		
						foreach ($numbers as $index => $number) {
							if (!$this->PatientQuestionsResponse->is_page_complete(
								$id,
								$number,
								$user['patient_id']
							)) {
								$notes['Actions'][] = array(
									'url' => array(
										'controller' => 'PatientQuestionsResponses',
										'action' => 'add',
										$id, $index),
									'msg' => 'Please complete the following questionnaire.'
								);
								
								$found = true;
								break;
							}
						}
						
						if ($found) {
							break;
						}
					}
				}
				
				
				break;
			case Configure::read('PatientPortal.group_id.Clinician'):
				break;
			case Configure::read('PatientPortal.group_id.Coordinator'):
				break;
			case Configure::read('PatientPortal.group_id.Administrator'):
				break;
			default:
				throw new InternalErrorException(__('Your authentication credentials have been corrupted.'));
		}
		
		return $notes;
	}
}
