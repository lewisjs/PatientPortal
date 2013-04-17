<?php
App::uses('AppController', 'Controller');
/**
 * PatientQuestionsResponses Controller
 *
 * @property PatientQuestionsResponse $PatientQuestionsResponse
 */
class PatientQuestionsResponsesController extends AppController {
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
		//$this->PatientQuestionsResponse->recursive = 0;
		//$this->set('patientQuestionsResponses', $this->paginate());
	}
	
	
	public function complete($questionnaireId) {	
		try {	
			// retrieve array of page numbers
			$pageNumbers = $this->PatientQuestionsResponse->
							QuestionsResponse->
							Question->
							QuestionnairePage->
							Questionnaire->get_page_numbers($questionnaireId);
		} catch (NotFoundException $nfe) {
			$this->Session->setFlash(__($nfe->getMessage()));
			$this->redirect(array('action' => '/'));	
		}
		
		foreach ($pageNumbers as $index => $number) {
			if (!$this->PatientQuestionsResponse->is_page_complete(
				$questionnaireId,
				$number,
				$this->Session->read('Auth.User.Patient.id')
			)) {
				$this->redirect(array('action' => 'add', $questionnaireId, $index));
			}
		}

		$this->redirect(array('action' => '/'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->PatientQuestionsResponse->id = $id;
		if (!$this->PatientQuestionsResponse->exists()) {
			throw new NotFoundException(__('Invalid patient questions response'));
		}
		$this->set('patientQuestionsResponse', $this->PatientQuestionsResponse->read(null, $id));
	}
	

/**
 * add method
 * 
 * @param int $questionnaireId
 * @param int $pageIndex
 */
	public function add($questionnaireId, $pageIndex=0) {
		$patientId = $this->Session->read('Auth.User.Patient.id');
		
		if ($this->request->is('post')) {
			try {
				if ($this->PatientQuestionsResponse->save_page($patientId, $this->request->data)) {
					// clean up data array for next page
					unset($this->request->data);

					$this->Session->setFlash(__('The patient questions response has been saved'));
				} else {
					$pageIndex--;
					$this->Session->setFlash(__('The patient questions response could not be saved. Please, try again.'));
				}
			} catch(Exception $e) {
				$pageIndex--;
				$this->Session->setFlash(__($e->getMessage()));
			}
		}

		
		// retrieve array of page numbers
		$pageNumbers = $this->PatientQuestionsResponse->
						QuestionsResponse->
						Question->
						QuestionnairePage->
						Questionnaire->get_page_numbers($questionnaireId);
		
		// this is one past the last page in the questionnaire
		if (count($pageNumbers) <= $pageIndex) {
			$this->redirect(array('controller' => 'PatientQuestionsResponses', 'action' => '/'));
		}

		$questionnaire = $this->PatientQuestionsResponse->build_page(
			$questionnaireId,
			$pageNumbers[$pageIndex],
			$patientId
		);
		$this->set(compact('questionnaireId', 'patientId', 'pageIndex', 'pageNumbers', 'questionnaire'));
	}
	

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->PatientQuestionsResponse->id = $id;
		if (!$this->PatientQuestionsResponse->exists()) {
			throw new NotFoundException(__('Invalid patient questions response'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->PatientQuestionsResponse->save($this->request->data)) {
				$this->Session->setFlash(__('The patient questions response has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The patient questions response could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->PatientQuestionsResponse->read(null, $id);
		}
		$patients = $this->PatientQuestionsResponse->Patient->find('list');
		$questionsResponses = $this->PatientQuestionsResponse->QuestionsResponse->find('list');
		$this->set(compact('patients', 'questionsResponses'));
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
		$this->PatientQuestionsResponse->id = $id;
		if (!$this->PatientQuestionsResponse->exists()) {
			throw new NotFoundException(__('Invalid patient questions response'));
		}
		if ($this->PatientQuestionsResponse->delete()) {
			$this->Session->setFlash(__('Patient questions response deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Patient questions response was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
