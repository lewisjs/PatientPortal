<?php
App::uses('AppController', 'Controller');
/**
 * PatientMaritalStatuses Controller
 *
 * @property PatientMaritalStatus $PatientMaritalStatus
 */
class PatientMaritalStatusesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->PatientMaritalStatus->recursive = 0;
		$this->set('patientMaritalStatuses', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->PatientMaritalStatus->id = $id;
		if (!$this->PatientMaritalStatus->exists()) {
			throw new NotFoundException(__('Invalid patient marital status'));
		}
		$this->set('patientMaritalStatus', $this->PatientMaritalStatus->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->PatientMaritalStatus->create();
			if ($this->PatientMaritalStatus->save($this->request->data)) {
				$this->Session->setFlash(__('The patient marital status has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The patient marital status could not be saved. Please, try again.'));
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
		$this->PatientMaritalStatus->id = $id;
		if (!$this->PatientMaritalStatus->exists()) {
			throw new NotFoundException(__('Invalid patient marital status'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->PatientMaritalStatus->save($this->request->data)) {
				$this->Session->setFlash(__('The patient marital status has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The patient marital status could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->PatientMaritalStatus->read(null, $id);
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
		$this->PatientMaritalStatus->id = $id;
		if (!$this->PatientMaritalStatus->exists()) {
			throw new NotFoundException(__('Invalid patient marital status'));
		}
		if ($this->PatientMaritalStatus->delete()) {
			$this->Session->setFlash(__('Patient marital status deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Patient marital status was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
