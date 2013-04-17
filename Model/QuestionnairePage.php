<?php
App::uses('AppModel', 'Model');
/**
 * QuestionnairePage Model
 *
 * @property Questionnaire $Questionnaire
 * @property Question $Question
 */
class QuestionnairePage extends AppModel {
/**
 * ActsAs Fields
 * 
 * @var array
 */
    public $actsAs = array('Containable');
    
    
/**
 * 
 * @param int $questionnaireId
 * @param int $number
 * @throws NotFoundException
 */
    public function fetch_id($questionnaireId, $number) {
    	$questionnairePage = $this->find('first',
    		array(
    			'conditions' => array(
    				'questionnaire_id' => $questionnaireId,
    				'number' => $number
    			),
    			'fields' => array('id'),
    			'recursive' => -1
    		)
    	);
    	
    	if ($questionnairePage) {
    		return $questionnairePage['QuestionnairePage']['id'];
    	} else {
    		throw new NotFoundException("No matching Page $number found for Questionnaire $questionnaireId.");
    	}
    }
    

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'questionnaire_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
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
		'Questionnaire' => array(
			'className' => 'Questionnaire',
			'foreignKey' => 'questionnaire_id',
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
		'Question' => array(
			'className' => 'Question',
			'foreignKey' => 'questionnaire_page_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
