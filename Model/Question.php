<?php
App::uses('AppModel', 'Model');
/**
 * Question Model
 *
 * @property QuestionnairePage $QuestionnairePage
 * @property EstionsResponse $EstionsResponse
 * @property Response $Response
 */
class Question extends AppModel {
	public function build_page($questionnairePageId, $patientId) {
		return $this->QuestionnairePage->find('first',
			array(
				'conditions' => array('QuestionnairePage.id' => $questionnairePageId),
				'fields' => array('QuestionnairePage.id', 'QuestionnairePage.title'),
				'contain' => array(
						'Question' => array(
								'fields' => array('id', 'text', 'question_type_id', 'required', 'days_to_reset'),
								'order' => array('number'),
								'QuestionsResponse' => array(
										'fields' => array('response_id', 'number'),
										'order' => array('number'),
										'Response' => array('fields' => array('id', 'value', 'text')),
										'PatientQuestionsResponse' => array(
												'conditions' => array('PatientQuestionsResponse.patient_id' => $patientId),
												'order' => array('created DESC')
										)
								)
						)
				)
			)
		);
	}
	
	
/**
 * fetch_id_map method: Accepts a set of conditions and returns an array mapping id to a set of all fields.
 * 
 * @param array $conditions
 * @param string $errorMsg
 * @throws NotFoundException
 * @return array
 */
	public function fetch_id_map($conditions, $errorMsg=NULL) {
		$questions = $this->find('all',
			array(
				'conditions' => $conditions,
				'fields' => array('id', 'questionnaire_page_id', 'question_type_id', 'text', 'number', 'required', 'days_to_reset'),
				'order' => array('number'),
				'recursive' => -1
			)
		);
		
		if ($questions) {
			$formatted = array();
			foreach ($questions as &$question) {
				$formatted[$question['Question']['id']] = array(
					'questionnaire_page_id' => $question['Question']['questionnaire_page_id'],
					'question_type_id' => $question['Question']['question_type_id'],
					'text' => $question['Question']['text'],
					'number' => $question['Question']['number'],
					'required' => $question['Question']['required'],
					'days_to_reset' => $question['Question']['days_to_reset'],
				);
			}
			
			return $formatted;
		} else {
			throw new NotFoundException(($errorMsg) ? $errorMsg : 'No questions found with this criteria.');
		}
	}

/**
 * Virtual Fields
 * 
 * @var array
 */
	public $virtualFields = array(
		'short_text' => 'LEFT(Question.text, 100)',	
	);

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'questionnaire_page_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'question_type_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'text' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'number' => array(
			'numeric' => array(
				'rule' => array('numeric'),
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
		'QuestionnairePage' => array(
			'className' => 'QuestionnairePage',
			'foreignKey' => 'questionnaire_page_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);


	/**
	 * hasMany associations
	 *
	 * @var array
	 */
	public $hasMany = array(
		'QuestionsResponse' => array(
			'className' => 'QuestionsResponse',
			'foreignKey' => 'question_id',
			'dependent' => false,
		),
	);

}
