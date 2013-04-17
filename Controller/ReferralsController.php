<?php
App::uses('AppController', 'Controller');
/**
 * Referrals Controller
 *
 * @property Referral $Referral
 */
class ReferralsController extends AppController {
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
		$this->Referral->recursive = 0;
		$this->set('referrals', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Referral->id = $id;
		if (!$this->Referral->exists()) {
			throw new NotFoundException(__('Invalid referral'));
		}
		$this->set('referral', $this->Referral->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Referral->create();
			if ($this->Referral->save($this->request->data)) {
				$this->Session->setFlash(__('The referral has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The referral could not be saved. Please, try again.'));
			}
		}
		$patients = $this->Referral->Patient->find('list');
		$practices = $this->Referral->Practice->find('list');
		$referralStatuses = $this->Referral->ReferralStatus->find('list');
		$this->set(compact('patients', 'practices', 'referralStatuses'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Referral->id = $id;
		if (!$this->Referral->exists()) {
			throw new NotFoundException(__('Invalid referral'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Referral->save($this->request->data)) {
				$this->Session->setFlash(__('The referral has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The referral could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Referral->read(null, $id);
		}
		$patients = $this->Referral->Patient->find('list');
		$practices = $this->Referral->Practice->find('list');
		$referralStatuses = $this->Referral->ReferralStatus->find('list');
		$this->set(compact('patients', 'practices', 'referralStatuses'));
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
		$this->Referral->id = $id;
		if (!$this->Referral->exists()) {
			throw new NotFoundException(__('Invalid referral'));
		}
		if ($this->Referral->delete()) {
			$this->Session->setFlash(__('Referral deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Referral was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
