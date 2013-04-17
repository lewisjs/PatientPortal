<?php
App::uses('AppController', 'Controller');
/**
 * PatientRelationships Controller
 *
 * @property PatientRelationship $PatientRelationship
 */
class PatientRelationshipsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->PatientRelationship->recursive = 0;
		$this->set('patientRelationships', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->PatientRelationship->id = $id;
		if (!$this->PatientRelationship->exists()) {
			throw new NotFoundException(__('Invalid patient relationship'));
		}
		$this->set('patientRelationship', $this->PatientRelationship->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->PatientRelationship->create();
			if ($this->PatientRelationship->save($this->request->data)) {
				$this->Session->setFlash(__('The patient relationship has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The patient relationship could not be saved. Please, try again.'));
			}
		}
		$insurances = $this->PatientRelationship->Insurance->find('list');
		$this->set(compact('insurances'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->PatientRelationship->id = $id;
		if (!$this->PatientRelationship->exists()) {
			throw new NotFoundException(__('Invalid patient relationship'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->PatientRelationship->save($this->request->data)) {
				$this->Session->setFlash(__('The patient relationship has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The patient relationship could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->PatientRelationship->read(null, $id);
		}
		$insurances = $this->PatientRelationship->Insurance->find('list');
		$this->set(compact('insurances'));
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
		$this->PatientRelationship->id = $id;
		if (!$this->PatientRelationship->exists()) {
			throw new NotFoundException(__('Invalid patient relationship'));
		}
		if ($this->PatientRelationship->delete()) {
			$this->Session->setFlash(__('Patient relationship deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Patient relationship was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
