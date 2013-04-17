<?php
App::uses('AppModel', 'Model');
/**
 * Response Model
 *
 * @property PatientQuestion $PatientQuestion
 * @property Question $Question
 */
class Response extends AppModel {
	
	public function beforeSave($options = array()) {
		$this->data['Response']['text'] = trim($this->data['Response']['text']);
		
		return true;
	}
	

/**
 * save method
 * 	This overloaded method first determines if a value & text-matching record exits. If so it returns that record, otherwise it creates a new one.
 * 
 * (non-PHPdoc)
 * @see Model::save()
 */
	public function save($data, $options=array()) {
		$search = $this->find('first', array(
			'conditions' => array(
				'Response.value' => $data['Response']['value'],
				'Response.text' => $data['Response']['text'],
			),
			'recursive' => -1,
		));
		
		if ($search) {
			$this->id = $search['Response']['id'];
			return $search;
		}
		else {
			return parent::save($data, $options);			
		}
	}
	

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
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
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'QuestionsResponse' => array(
			'className' => 'QuestionsResponse',
			'foreignKey' => 'response_id',
		),
	);

}
