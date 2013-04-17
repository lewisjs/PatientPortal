<?php
App::uses('AppController', 'Controller');
/**
 * QuestionnairePages Controller
 *
 * @property QuestionnairePage $QuestionnairePage
 */
class QuestionnairePagesController extends AppController {
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
	public function index() {
		$this->QuestionnairePage->recursive = 0;
		$this->set('questionnairePages', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->QuestionnairePage->id = $id;
		if (!$this->QuestionnairePage->exists()) {
			throw new NotFoundException(__('Invalid questionnaire page'));
		}
		$this->set('questionnairePage', $this->QuestionnairePage->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->QuestionnairePage->create();
			if ($this->QuestionnairePage->save($this->request->data)) {
				$this->Session->setFlash(__('The questionnaire page has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The questionnaire page could not be saved. Please, try again.'));
			}
		}
		$questionnaires = $this->QuestionnairePage->Questionnaire->find('list');
		$this->set(compact('questionnaires'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->QuestionnairePage->id = $id;
		if (!$this->QuestionnairePage->exists()) {
			throw new NotFoundException(__('Invalid questionnaire page'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->QuestionnairePage->save($this->request->data)) {
				$this->Session->setFlash(__('The questionnaire page has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The questionnaire page could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->QuestionnairePage->read(null, $id);
		}
		$questionnaires = $this->QuestionnairePage->Questionnaire->find('list');
		$this->set(compact('questionnaires'));
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
		$this->QuestionnairePage->id = $id;
		if (!$this->QuestionnairePage->exists()) {
			throw new NotFoundException(__('Invalid questionnaire page'));
		}
		if ($this->QuestionnairePage->delete()) {
			$this->Session->setFlash(__('Questionnaire page deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Questionnaire page was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
