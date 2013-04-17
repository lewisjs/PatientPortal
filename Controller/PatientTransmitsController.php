<?php
App::uses('AppController', 'Controller');
/**
 * PatientTransmits Controller
 *
 * @property PatientTransmit $PatientTransmit
 */
class PatientTransmitsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->PatientTransmit->recursive = 0;
		$this->set('patientTransmits', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->PatientTransmit->id = $id;
		if (!$this->PatientTransmit->exists()) {
			throw new NotFoundException(__('Invalid patient transmit'));
		}
		$this->set('patientTransmit', $this->PatientTransmit->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->PatientTransmit->create();
			if ($this->PatientTransmit->save($this->request->data)) {
				$this->Session->setFlash(__('The patient transmit has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The patient transmit could not be saved. Please, try again.'));
			}
		}
		$patients = $this->PatientTransmit->Patient->find('list');
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
		$this->PatientTransmit->id = $id;
		if (!$this->PatientTransmit->exists()) {
			throw new NotFoundException(__('Invalid patient transmit'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->PatientTransmit->save($this->request->data)) {
				$this->Session->setFlash(__('The patient transmit has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The patient transmit could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->PatientTransmit->read(null, $id);
		}
		$patients = $this->PatientTransmit->Patient->find('list');
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
		$this->PatientTransmit->id = $id;
		if (!$this->PatientTransmit->exists()) {
			throw new NotFoundException(__('Invalid patient transmit'));
		}
		if ($this->PatientTransmit->delete()) {
			$this->Session->setFlash(__('Patient transmit deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Patient transmit was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
