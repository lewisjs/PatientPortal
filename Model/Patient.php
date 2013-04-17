<?php
App::uses('AppModel', 'Model');
/**
 * Patient Model
 *
 * @property PatientGender $PatientGender
 * @property PatientMaritalStatus $PatientMaritalStatus
 * @property Location $Location
 * @property Appointment $Appointment
 * @property InsurancePatientRelationship $InsurancePatientRelationship
 * @property PatientHistory $PatientHistory
 * @property PatientQuestionsResponse $PatientQuestionsResponse
 * @property PatientTransmit $PatientTransmit
 * @property Referral $Referral
 * @property User $User
 * @property Practice $Practice
 */
class Patient extends AppModel {
	
	public function __construct($id = false, $table = null, $ds = null) {
		parent::__construct($id, $table, $ds);
		
	// this model will be aliased as insurance policy holder.
		$this->virtualFields['home_phone_area'] = sprintf('SUBSTR(%s.home_phone, 1, 3)', $this->alias);
 		$this->virtualFields['home_phone_prefix'] = sprintf('SUBSTR(%s.home_phone, 4, 3)', $this->alias);
 		$this->virtualFields['home_phone_suffix'] = sprintf('SUBSTR(%s.home_phone, 7, 4)', $this->alias);
 		$this->virtualFields['mobile_phone_area'] = sprintf('SUBSTR(%s.mobile_phone, 1, 3)', $this->alias);
 		$this->virtualFields['mobile_phone_prefix'] = sprintf('SUBSTR(%s.mobile_phone, 4, 3)', $this->alias);
 		$this->virtualFields['mobile_phone_suffix'] = sprintf('SUBSTR(%s.mobile_phone, 7, 4)', $this->alias);
 		$this->virtualFields['work_phone_area'] = sprintf('SUBSTR(%s.work_phone, 1, 3)', $this->alias);
 		$this->virtualFields['work_phone_prefix'] = sprintf('SUBSTR(%s.work_phone, 4, 3)', $this->alias);
 		$this->virtualFields['work_phone_suffix'] = sprintf('SUBSTR(%s.work_phone, 7, 4)', $this->alias);
	}
	
	public function beforeSave($options=NULL) {
	// build up phone numbers from components
		$this->data['Patient']['home_phone'] =
			$this->data['Patient']['home_phone_area'] .
			$this->data['Patient']['home_phone_prefix'] .
			$this->data['Patient']['home_phone_suffix'];
		$this->data['Patient']['mobile_phone'] =
			$this->data['Patient']['mobile_phone_area'] .
			$this->data['Patient']['mobile_phone_prefix'] .
			$this->data['Patient']['mobile_phone_suffix'];
		$this->data['Patient']['work_phone'] =
			$this->data['Patient']['work_phone_area'] .
			$this->data['Patient']['work_phone_prefix'] .
			$this->data['Patient']['work_phone_suffix'];
		
	// unset any columns not entered
		foreach ($this->data['Patient'] as $column => $value) {
			if (0 == strlen($value)) {
				unset($this->data['Patient'][$column]);
			}
		}
		
		return true;
	}
	
	
/**
 * (non-PHPdoc)
 * afterSave overloaded function updates the patient_transmit table if no transmit data exists for the given patient.
 * 
 * @see Model::afterSave()
 * @throws Exception
 */
	public function afterSave($created) {
		if (NULL == $this->PatientTransmit->findByPatientId($this->id)) {
			$this->PatientTransmit->create();
			if (NULL == $this->PatientTransmit->save(array('PatientTransmit' => array('patient_id' => $this->id)))) {
				throw new Exception('Transmit update was not successful.');
			}
		}
	}

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'last_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'first_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'date_of_birth' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'patient_gender_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'street1' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'city' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'state' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'zip' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'patient_marital_status_id' => array(
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
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'PatientGender' => array(
			'className' => 'PatientGender',
			'foreignKey' => 'patient_gender_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'PatientMaritalStatus' => array(
			'className' => 'PatientMaritalStatus',
			'foreignKey' => 'patient_marital_status_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Location' => array(
			'className' => 'Location',
			'foreignKey' => 'location_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasOne associations
 * 
 * @var array
 */
	public $hasOne = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'patient_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => '',
		)
	);
	
/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Appointment' => array(
			'className' => 'Appointment',
			'foreignKey' => 'patient_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => '',
		),
		'InsurancePatientRelationshipPatient' => array(
			'className' => 'InsurancePatientRelationship',
			'foreignKey' => 'patient_id',
			'dependent' => false,
		),
		'InsurancePatientRelationshipPolicyholder' => array(
			'className' => 'InsurancePatientRelationship',
			'foreignKey' => 'policyholder_id',
			'dependent' => false,
		),
		'PatientHistory' => array(
			'className' => 'PatientHistory',
			'foreignKey' => 'patient_id',
			'dependent' => false,
		),
		'PatientQuestionsResponse' => array(
			'className' => 'PatientQuestionsResponse',
			'foreignKey' => 'patient_id',
			'dependent' => false,
		),
		'PatientTransmit' => array(
			'className' => 'PatientTransmit',
			'foreignKey' => 'patient_id',
			'dependent' => false,
		),
		'Referral' => array(
			'className' => 'Referral',
			'foreignKey' => 'patient_id',
			'dependent' => false,
		),
	);


/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Practice' => array(
			'className' => 'Practice',
			'joinTable' => 'patients_practices',
			'foreignKey' => 'patient_id',
			'associationForeignKey' => 'practice_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => '',
		)
	);

}
