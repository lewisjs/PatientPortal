<?php
App::uses('AppController', 'Controller');
/**
 * UserTickets Controller
 *
 * @property UserTicket $UserTicket
 */
class UserTicketsController extends AppController {
/**
 * Temporarily allow access to everything.
 */
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('*');
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->UserTicket->recursive = 0;
		$this->set('userTickets', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->UserTicket->id = $id;
		if (!$this->UserTicket->exists()) {
			throw new NotFoundException(__('Invalid user ticket'));
		}
		$this->set('userTicket', $this->UserTicket->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		echo serialize(array(
				'controller' => 'user',
				'action' => 'confirm_add',
		));
		if ($this->request->is('post')) {
			$this->UserTicket->create();
			if ($this->UserTicket->save($this->request->data)) {
				$this->Session->setFlash(__('The user ticket has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user ticket could not be saved. Please, try again.'));
			}
		}
		$users = $this->UserTicket->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->UserTicket->id = $id;
		if (!$this->UserTicket->exists()) {
			throw new NotFoundException(__('Invalid user ticket'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->UserTicket->save($this->request->data)) {
				$this->Session->setFlash(__('The user ticket has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user ticket could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->UserTicket->read(null, $id);
		}
		$users = $this->UserTicket->User->find('list');
		$this->set(compact('users'));
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
		$this->UserTicket->id = $id;
		if (!$this->UserTicket->exists()) {
			throw new NotFoundException(__('Invalid user ticket'));
		}
		if ($this->UserTicket->delete()) {
			$this->Session->setFlash(__('User ticket deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User ticket was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
