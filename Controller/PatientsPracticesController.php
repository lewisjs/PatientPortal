<?php
App::uses('AppController', 'Controller');
/**
 * PatientsPractices Controller
 *
 * @property PatientsPractice $PatientsPractice
 */
class PatientsPracticesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->PatientsPractice->recursive = 0;
		$this->set('patientsPractices', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->PatientsPractice->id = $id;
		if (!$this->PatientsPractice->exists()) {
			throw new NotFoundException(__('Invalid patients practice'));
		}
		$this->set('patientsPractice', $this->PatientsPractice->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->PatientsPractice->create();
			if ($this->PatientsPractice->save($this->request->data)) {
				$this->Session->setFlash(__('The patients practice has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The patients practice could not be saved. Please, try again.'));
			}
		}
		$patients = $this->PatientsPractice->Patient->find('list');
		$practices = $this->PatientsPractice->Practice->find('list');
		$this->set(compact('patients', 'practices'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->PatientsPractice->id = $id;
		if (!$this->PatientsPractice->exists()) {
			throw new NotFoundException(__('Invalid patients practice'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->PatientsPractice->save($this->request->data)) {
				$this->Session->setFlash(__('The patients practice has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The patients practice could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->PatientsPractice->read(null, $id);
		}
		$patients = $this->PatientsPractice->Patient->find('list');
		$practices = $this->PatientsPractice->Practice->find('list');
		$this->set(compact('patients', 'practices'));
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
		$this->PatientsPractice->id = $id;
		if (!$this->PatientsPractice->exists()) {
			throw new NotFoundException(__('Invalid patients practice'));
		}
		if ($this->PatientsPractice->delete()) {
			$this->Session->setFlash(__('Patients practice deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Patients practice was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
