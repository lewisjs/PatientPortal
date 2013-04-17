<?php
App::uses('AppController', 'Controller');
/**
 * AppointmentTransmits Controller
 *
 * @property AppointmentTransmit $AppointmentTransmit
 */
class AppointmentTransmitsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->AppointmentTransmit->recursive = 0;
		$this->set('appointmentTransmits', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->AppointmentTransmit->id = $id;
		if (!$this->AppointmentTransmit->exists()) {
			throw new NotFoundException(__('Invalid appointment transmit'));
		}
		$this->set('appointmentTransmit', $this->AppointmentTransmit->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->AppointmentTransmit->create();
			if ($this->AppointmentTransmit->save($this->request->data)) {
				$this->Session->setFlash(__('The appointment transmit has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The appointment transmit could not be saved. Please, try again.'));
			}
		}
		$appointments = $this->AppointmentTransmit->Appointment->find('list');
		$this->set(compact('appointments'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->AppointmentTransmit->id = $id;
		if (!$this->AppointmentTransmit->exists()) {
			throw new NotFoundException(__('Invalid appointment transmit'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->AppointmentTransmit->save($this->request->data)) {
				$this->Session->setFlash(__('The appointment transmit has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The appointment transmit could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->AppointmentTransmit->read(null, $id);
		}
		$appointments = $this->AppointmentTransmit->Appointment->find('list');
		$this->set(compact('appointments'));
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
		$this->AppointmentTransmit->id = $id;
		if (!$this->AppointmentTransmit->exists()) {
			throw new NotFoundException(__('Invalid appointment transmit'));
		}
		if ($this->AppointmentTransmit->delete()) {
			$this->Session->setFlash(__('Appointment transmit deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Appointment transmit was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
