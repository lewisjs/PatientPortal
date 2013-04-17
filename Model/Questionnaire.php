<?php
App::uses('AppModel', 'Model');
/**
 * Questionnaire Model
 *
 * @property QuestionnairePage $QuestionnairePage
 */
class Questionnaire extends AppModel {
    public $actsAs = array('Containable');

/**
 * get_questionnaire_pages method returns all page numbers, in order, associated with a given questionnaire
 * 	referenced by id.
 * 
 * @param int $id
 * @throws NotFoundException
 * @return Ambigous <multitype:, NULL, mixed>
 */
    public function get_page_numbers($id) {
    	if ($this->exists($id)) {
	    	$data = $this->QuestionnairePage->find('list', array(
	    		'recursive' => -1,
				'conditions' => array('QuestionnairePage.questionnaire_id' => $id),
	    		'fields' => array('QuestionnairePage.number'),
	    		'order' => array('QuestionnairePage.number ASC'),
	    	));
	    	
	    	return array_values($data);
    	}
    	else {
    		throw new NotFoundException("Questionnaire $id does not exist in our records.");
    	}
    }

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'title' => array(
			'notempty' => array(
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'QuestionnairePage' => array(
			'className' => 'QuestionnairePage',
			'foreignKey' => 'questionnaire_id',
			'dependent' => false,
		)
	);

}
