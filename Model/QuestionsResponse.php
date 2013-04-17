<?php
App::uses('AppModel', 'Model');
/**
 * QuestionsResponse Model
 *
 * @property Question $Question
 * @property Response $Response
 * @property Patient $Patient
 */
class QuestionsResponse extends AppModel {
	
	public function fetch_id_map($conditions, $errorMsg=NULL) {
		$questionsResponses = $this->find('all',
			array(
				'conditions' => $conditions,
				'fields' => array('id', 'question_id', 'response_id', 'number'),
				'order' => array('number'),
				'recursive' => -1
			)
		);
		
		if ($questionsResponses) {
			$formatted = array();
			foreach ($questionsResponses as &$questionsResponse) {
				$formatted[$questionsResponse['QuestionsResponse']['id']] = array(
					'question_id' => $questionsResponse['QuestionsResponse']['question_id'],
					'response_id' => $questionsResponse['QuestionsResponse']['response_id'],
					'number' => $questionsResponse['QuestionsResponse']['number'],
				);
			}
			
			return $formatted;
		} else {
			throw new NotFoundException(($errorMsg) ? $errorMsg : 'No questions found with this criteria.');
		}
	}
	

/**
 * save method first determines if a value & text-matching record exits. If so it returns that record, otherwise it creates a new one.
 * 
 * (non-PHPdoc)
 * @see Model::save()
 */
	public function save($record, $options=array()) {
		$search = $this->find('first', array(
			'conditions' => array(
				'QuestionsResponse.question_id' => $record['QuestionsResponse']['question_id'],
				'QuestionsResponse.response_id' => $record['QuestionsResponse']['response_id'],
			),
			'recursive' => -1,
		));
		
		if ($search) {
			$this->id = $search['QuestionsResponse']['id'];
			return $search;
		}
		else {
			return parent::save($record, $options);			
		}
	}
	

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'question_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'response_id' => array(
			'uuid' => array(
				'rule' => array('uuid'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Question' => array(
			'className' => 'Question',
			'foreignKey' => 'question_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Response' => array(
			'className' => 'Response',
			'foreignKey' => 'response_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'PatientQuestionsResponse' => array(
			'className' => 'PatientQuestionsResponse',
			'foreignKey' => 'questions_response_id',
		)
	);

}
