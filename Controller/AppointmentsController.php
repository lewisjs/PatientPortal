<?php
App::uses('AppController', 'Controller');
/**
 * Appointments Controller
 *
 * @property Appointment $Appointment
 */
class AppointmentsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Appointment->recursive = 0;
		$this->set('appointments', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Appointment->id = $id;
		if (!$this->Appointment->exists()) {
			throw new NotFoundException(__('Invalid appointment'));
		}
		$this->set('appointment', $this->Appointment->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Appointment->create();
			if ($this->Appointment->save($this->request->data)) {
				$this->Session->setFlash(__('The appointment has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The appointment could not be saved. Please, try again.'));
			}
		}
		$patients = $this->Appointment->Patient->find('list');
		$providers = $this->Appointment->Provider->find('list');
		$locations = $this->Appointment->Location->find('list');
		$practices = $this->Appointment->Practice->find('list');
		$appointmentStatuses = $this->Appointment->AppointmentStatus->find('list');
		$this->set(compact('patients', 'providers', 'locations', 'practices', 'appointmentStatuses'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Appointment->id = $id;
		if (!$this->Appointment->exists()) {
			throw new NotFoundException(__('Invalid appointment'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Appointment->save($this->request->data)) {
				$this->Session->setFlash(__('The appointment has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The appointment could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Appointment->read(null, $id);
		}
		$patients = $this->Appointment->Patient->find('list');
		$providers = $this->Appointment->Provider->find('list');
		$locations = $this->Appointment->Location->find('list');
		$practices = $this->Appointment->Practice->find('list');
		$appointmentStatuses = $this->Appointment->AppointmentStatus->find('list');
		$this->set(compact('patients', 'providers', 'locations', 'practices', 'appointmentStatuses'));
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
		$this->Appointment->id = $id;
		if (!$this->Appointment->exists()) {
			throw new NotFoundException(__('Invalid appointment'));
		}
		if ($this->Appointment->delete()) {
			$this->Session->setFlash(__('Appointment deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Appointment was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
