<?php
App::uses('AppController', 'Controller');
/**
 * Practices Controller
 *
 * @property Practice $Practice
 */
class PracticesController extends AppController {
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
		$this->Practice->recursive = 0;
		$this->set('practices', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Practice->id = $id;
		if (!$this->Practice->exists()) {
			throw new NotFoundException(__('Invalid practice'));
		}
		$this->set('practice', $this->Practice->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Practice->create();
			if ($this->Practice->save($this->request->data)) {
				$this->Session->setFlash(__('The practice has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The practice could not be saved. Please, try again.'));
			}
		}
		$patients = $this->Practice->Patient->find('list');
		$this->set(compact('patients'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Practice->id = $id;
		if (!$this->Practice->exists()) {
			throw new NotFoundException(__('Invalid practice'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Practice->save($this->request->data)) {
				$this->Session->setFlash(__('The practice has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The practice could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Practice->read(null, $id);
		}
		$patients = $this->Practice->Patient->find('list');
		$this->set(compact('patients'));
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
		$this->Practice->id = $id;
		if (!$this->Practice->exists()) {
			throw new NotFoundException(__('Invalid practice'));
		}
		if ($this->Practice->delete()) {
			$this->Session->setFlash(__('Practice deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Practice was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
