<?php
App::uses('AppController', 'Controller');
/**
 * Questionnaires Controller
 *
 * @property Questionnaire $Questionnaire
 */
class QuestionnairesController extends AppController {
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
		$this->Questionnaire->recursive = 0;
		$this->set('questionnaires', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Questionnaire->id = $id;
		if (!$this->Questionnaire->exists()) {
			throw new NotFoundException(__('Invalid questionnaire'));
		}
		$this->set('questionnaire', $this->Questionnaire->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Questionnaire->create();
			if ($this->Questionnaire->save($this->request->data)) {
				$this->Session->setFlash(__('The questionnaire has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The questionnaire could not be saved. Please, try again.'));
			}
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
		$this->Questionnaire->id = $id;
		if (!$this->Questionnaire->exists()) {
			throw new NotFoundException(__('Invalid questionnaire'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Questionnaire->save($this->request->data)) {
				$this->Session->setFlash(__('The questionnaire has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The questionnaire could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Questionnaire->read(null, $id);
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
		$this->Questionnaire->id = $id;
		if (!$this->Questionnaire->exists()) {
			throw new NotFoundException(__('Invalid questionnaire'));
		}
		if ($this->Questionnaire->delete()) {
			$this->Session->setFlash(__('Questionnaire deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Questionnaire was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
