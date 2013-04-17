<?php
App::uses('AppController', 'Controller');
/**
 * InsuranceTypes Controller
 *
 * @property InsuranceType $InsuranceType
 */
class InsuranceTypesController extends AppController {
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
		$this->InsuranceType->recursive = 0;
		$this->set('insuranceTypes', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param int $id
 * @return void
 */
	public function view($id = null) {
		$this->InsuranceType->id = $id;
		if (!$this->InsuranceType->exists()) {
			throw new NotFoundException(__('Invalid insurance type'));
		}
		$this->set('insuranceType', $this->InsuranceType->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->InsuranceType->create();
			if ($this->InsuranceType->save($this->request->data)) {
				$this->Session->setFlash(__('The insurance type has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The insurance type could not be saved. Please, try again.'));
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
		$this->InsuranceType->id = $id;
		if (!$this->InsuranceType->exists()) {
			throw new NotFoundException(__('Invalid insurance type'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->InsuranceType->save($this->request->data)) {
				$this->Session->setFlash(__('The insurance type has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The insurance type could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->InsuranceType->read(null, $id);
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
		$this->InsuranceType->id = $id;
		if (!$this->InsuranceType->exists()) {
			throw new NotFoundException(__('Invalid insurance type'));
		}
		if ($this->InsuranceType->delete()) {
			$this->Session->setFlash(__('Insurance type deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Insurance type was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
