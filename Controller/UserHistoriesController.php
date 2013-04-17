<?php
App::uses('AppController', 'Controller');
/**
 * UserHistories Controller
 *
 * @property UserHistory $UserHistory
 */
class UserHistoriesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->UserHistory->recursive = 0;
		$this->set('userHistories', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->UserHistory->id = $id;
		if (!$this->UserHistory->exists()) {
			throw new NotFoundException(__('Invalid user history'));
		}
		$this->set('userHistory', $this->UserHistory->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->UserHistory->create();
			if ($this->UserHistory->save($this->request->data)) {
				$this->Session->setFlash(__('The user history has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user history could not be saved. Please, try again.'));
			}
		}
		$users = $this->UserHistory->User->find('list');
		$groups = $this->UserHistory->Group->find('list');
		$this->set(compact('users', 'groups'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->UserHistory->id = $id;
		if (!$this->UserHistory->exists()) {
			throw new NotFoundException(__('Invalid user history'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->UserHistory->save($this->request->data)) {
				$this->Session->setFlash(__('The user history has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user history could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->UserHistory->read(null, $id);
		}
		$users = $this->UserHistory->User->find('list');
		$groups = $this->UserHistory->Group->find('list');
		$this->set(compact('users', 'groups'));
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
		$this->UserHistory->id = $id;
		if (!$this->UserHistory->exists()) {
			throw new NotFoundException(__('Invalid user history'));
		}
		if ($this->UserHistory->delete()) {
			$this->Session->setFlash(__('User history deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User history was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
