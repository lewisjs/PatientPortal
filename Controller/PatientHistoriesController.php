<?php
App::uses('AppController', 'Controller');
/**
 * PatientHistories Controller
 *
 * @property PatientHistory $PatientHistory
 */
class PatientHistoriesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->PatientHistory->recursive = 0;
		$this->set('patientHistories', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->PatientHistory->id = $id;
		if (!$this->PatientHistory->exists()) {
			throw new NotFoundException(__('Invalid patient history'));
		}
		$this->set('patientHistory', $this->PatientHistory->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->PatientHistory->create();
			if ($this->PatientHistory->save($this->request->data)) {
				$this->Session->setFlash(__('The patient history has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The patient history could not be saved. Please, try again.'));
			}
		}
		$patients = $this->PatientHistory->Patient->find('list');
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
		$this->PatientHistory->id = $id;
		if (!$this->PatientHistory->exists()) {
			throw new NotFoundException(__('Invalid patient history'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->PatientHistory->save($this->request->data)) {
				$this->Session->setFlash(__('The patient history has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The patient history could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->PatientHistory->read(null, $id);
		}
		$patients = $this->PatientHistory->Patient->find('list');
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
		$this->PatientHistory->id = $id;
		if (!$this->PatientHistory->exists()) {
			throw new NotFoundException(__('Invalid patient history'));
		}
		if ($this->PatientHistory->delete()) {
			$this->Session->setFlash(__('Patient history deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Patient history was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
