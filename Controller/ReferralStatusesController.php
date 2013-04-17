<?php
App::uses('AppController', 'Controller');
/**
 * ReferralStatuses Controller
 *
 * @property ReferralStatus $ReferralStatus
 */
class ReferralStatusesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->ReferralStatus->recursive = 0;
		$this->set('referralStatuses', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->ReferralStatus->id = $id;
		if (!$this->ReferralStatus->exists()) {
			throw new NotFoundException(__('Invalid referral status'));
		}
		$this->set('referralStatus', $this->ReferralStatus->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ReferralStatus->create();
			if ($this->ReferralStatus->save($this->request->data)) {
				$this->Session->setFlash(__('The referral status has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The referral status could not be saved. Please, try again.'));
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
		$this->ReferralStatus->id = $id;
		if (!$this->ReferralStatus->exists()) {
			throw new NotFoundException(__('Invalid referral status'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ReferralStatus->save($this->request->data)) {
				$this->Session->setFlash(__('The referral status has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The referral status could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->ReferralStatus->read(null, $id);
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
		$this->ReferralStatus->id = $id;
		if (!$this->ReferralStatus->exists()) {
			throw new NotFoundException(__('Invalid referral status'));
		}
		if ($this->ReferralStatus->delete()) {
			$this->Session->setFlash(__('Referral status deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Referral status was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
