<?php
App::uses('AppController', 'Controller');
/**
 * AppointmentStatuses Controller
 *
 * @property AppointmentStatus $AppointmentStatus
 */
class AppointmentStatusesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->AppointmentStatus->recursive = 0;
		$this->set('appointmentStatuses', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->AppointmentStatus->id = $id;
		if (!$this->AppointmentStatus->exists()) {
			throw new NotFoundException(__('Invalid appointment status'));
		}
		$this->set('appointmentStatus', $this->AppointmentStatus->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->AppointmentStatus->create();
			if ($this->AppointmentStatus->save($this->request->data)) {
				$this->Session->setFlash(__('The appointment status has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The appointment status could not be saved. Please, try again.'));
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
		$this->AppointmentStatus->id = $id;
		if (!$this->AppointmentStatus->exists()) {
			throw new NotFoundException(__('Invalid appointment status'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->AppointmentStatus->save($this->request->data)) {
				$this->Session->setFlash(__('The appointment status has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The appointment status could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->AppointmentStatus->read(null, $id);
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
		$this->AppointmentStatus->id = $id;
		if (!$this->AppointmentStatus->exists()) {
			throw new NotFoundException(__('Invalid appointment status'));
		}
		if ($this->AppointmentStatus->delete()) {
			$this->Session->setFlash(__('Appointment status deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Appointment status was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
