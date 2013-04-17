<?php
App::uses('AppController', 'Controller');
/**
 * Insurances Controller
 *
 * @property Insurance $Insurance
 */
class InsurancesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Insurance->recursive = 0;
		$this->set('insurances', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Insurance->id = $id;
		if (!$this->Insurance->exists()) {
			throw new NotFoundException(__('Invalid insurance'));
		}
		$this->set('insurance', $this->Insurance->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Insurance->create();
			if ($this->Insurance->save($this->request->data)) {
				$this->Session->setFlash(__('The insurance has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The insurance could not be saved. Please, try again.'));
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
		$this->Insurance->id = $id;
		if (!$this->Insurance->exists()) {
			throw new NotFoundException(__('Invalid insurance'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Insurance->save($this->request->data)) {
				$this->Session->setFlash(__('The insurance has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The insurance could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Insurance->read(null, $id);
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
		$this->Insurance->id = $id;
		if (!$this->Insurance->exists()) {
			throw new NotFoundException(__('Invalid insurance'));
		}
		if ($this->Insurance->delete()) {
			$this->Session->setFlash(__('Insurance deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Insurance was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
