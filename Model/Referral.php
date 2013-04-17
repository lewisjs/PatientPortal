<?php
App::uses('AppModel', 'Model');
/**
 * Referral Model
 *
 * @property Patient $Patient
 * @property Practice $Practice
 * @property ReferralStatus $ReferralStatus
 * @property ReferralFile $ReferralFile
 */
class Referral extends AppModel {

/**
 * patient_create method
 *	Called when a patient needs to create a self-referral. This method first attempts to find any other self-referral 
 *	the patient may currently own and if found, returns the necessary data. If not, it creates a new referral and returns. * 
 * 
 * @param int $patientId
 * @return mixed|boolean
 */
	public function patient_create($patientId) {
	// attempt to find a referral that has this patient_id and no(none) practice
		$this->recursive = -1;
		$data = $this->findByPatientIdAndPracticeId($patientId, 1);
		if ($data) {
			return $data;
		}
		
		$this->ReferralFile->Referral->create();
		return $this->ReferralFile->Referral->save(
			array(
				'Referral' => array(
					'patient_id' => $patientId,
					'practice_id' => 1,	// patient is not allowed to pick practice
					'referral_status_id' => 1, // patient is not allowed to pick referral status
				),
			)
		);
	}
	
	
	public function find_patient_referral($patientId) {
	// attempt to find a referral that has this patient_id and no(none) practice
		$this->recursive = -1;
		return $this->findByPatientIdAndPracticeId($patientId, 1);
	}

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'patient_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'practice_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'referral_status_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'asap' => array(
			'boolean' => array(
				'rule' => array('boolean'),
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
		'Patient' => array(
			'className' => 'Patient',
			'foreignKey' => 'patient_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Practice' => array(
			'className' => 'Practice',
			'foreignKey' => 'practice_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ReferralStatus' => array(
			'className' => 'ReferralStatus',
			'foreignKey' => 'referral_status_id',
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
		'ReferralFile' => array(
			'className' => 'ReferralFile',
			'foreignKey' => 'referral_id',
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
