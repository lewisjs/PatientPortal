<?php
App::uses('AppController', 'Controller');
/**
 * QuestionsResponses Controller
 *
 * @property QuestionsResponse $QuestionsResponse
 */
class QuestionsResponsesController extends AppController {
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
		$this->QuestionsResponse->recursive = 0;
		$this->set('questionsResponses', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->QuestionsResponse->id = $id;
		if (!$this->QuestionsResponse->exists()) {
			throw new NotFoundException(__('Invalid questions response'));
		}
		$this->set('questionsResponse', $this->QuestionsResponse->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			if (isset($this->request->data['QuestionsResponse']['Response'])) {			
				$data = array();
				$item = array(
					'QuestionsResponse' => array('question_id' => $this->request->data['QuestionsResponse']['question_id'], )
				);
				
				foreach ($this->request->data['QuestionsResponse']['Response'] as $index => $response) {
					$item['QuestionsResponse']['response_id'] = $response['id'];
					$item['QuestionsResponse']['number'] = $this->request->data['QuestionsResponse'][$index]['number'];
					
					$data[] = $item;
				}
				
				$this->QuestionsResponse->create();
				if ($this->QuestionsResponse->saveAll($data)) {
					$this->Session->setFlash(__('The questions response has been saved'));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The questions response could not be saved. Please, try again.'));
				}
			}
			else {
				$this->Session->setFlash(__('At least one response must be given.'));	
			}
		}

		$responses = $this->QuestionsResponse->Response->find('all', array('recursive' => -1));
		$questions = $this->QuestionsResponse->Question->find('list', array(
			'recursive' => -1,
			'fields' => 'short_text',
			'conditions' => array('Question.type LIKE \'Single\' OR Question.type LIKE \'Multiple\''),
		));
		$this->set(compact('questions', 'responses'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->QuestionsResponse->id = $id;
		if (!$this->QuestionsResponse->exists()) {
			throw new NotFoundException(__('Invalid questions response'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->QuestionsResponse->save($this->request->data)) {
				$this->Session->setFlash(__('The questions response has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The questions response could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->QuestionsResponse->read(null, $id);
		}
		$questions = $this->QuestionsResponse->Question->find('list');
		$responses = $this->QuestionsResponse->Response->find('list');
		$patients = $this->QuestionsResponse->Patient->find('list');
		$this->set(compact('questions', 'responses', 'patients'));
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
		$this->QuestionsResponse->id = $id;
		if (!$this->QuestionsResponse->exists()) {
			throw new NotFoundException(__('Invalid questions response'));
		}
		if ($this->QuestionsResponse->delete()) {
			$this->Session->setFlash(__('Questions response deleted'));
			$this->redirect($this->referer());
		}
		$this->Session->setFlash(__('Questions response was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
	
/**
 * Pagination rules
 * @var array
 */

    public $paginate = array(
        'limit' => 25,
        'order' => array(
            'QuestionsResponse.question_id' => 'asc',
            'QuestionsResponse.number' => 'asc',
        )
    );
}
