<?php
App::uses('AppController', 'Controller');
/**
 * PatientGenders Controller
 *
 * @property PatientGender $PatientGender
 */
class PatientGendersController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->PatientGender->recursive = 0;
		$this->set('patientGenders', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->PatientGender->id = $id;
		if (!$this->PatientGender->exists()) {
			throw new NotFoundException(__('Invalid patient gender'));
		}
		$this->set('patientGender', $this->PatientGender->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->PatientGender->create();
			if ($this->PatientGender->save($this->request->data)) {
				$this->Session->setFlash(__('The patient gender has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The patient gender could not be saved. Please, try again.'));
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
		$this->PatientGender->id = $id;
		if (!$this->PatientGender->exists()) {
			throw new NotFoundException(__('Invalid patient gender'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->PatientGender->save($this->request->data)) {
				$this->Session->setFlash(__('The patient gender has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The patient gender could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->PatientGender->read(null, $id);
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
		$this->PatientGender->id = $id;
		if (!$this->PatientGender->exists()) {
			throw new NotFoundException(__('Invalid patient gender'));
		}
		if ($this->PatientGender->delete()) {
			$this->Session->setFlash(__('Patient gender deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Patient gender was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
