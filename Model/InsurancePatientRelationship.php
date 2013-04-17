<?php
App::uses('AppModel', 'Model');
/**
 * InsurancePatientRelationship Model
 *
 * @property Patient $Patient
 * @property Patient $Policyholder
 * @property PatientRelationship $PatientRelationship
 * @property Insurance $Insurance
 * @property InsuranceType $InsuranceType
 */
class InsurancePatientRelationship extends AppModel {
	public $actsAs = array('Containable');

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'patient_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
		'policyholder_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			),
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
		'patient_relationship_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			),
		),
		'insurance_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			),
			'uuid' => array(
				'rule' => array('uuid'),
			),
		),
		'insurance_no' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			),
			'isUnique' => array(
				'rule' => array('isUnique'),
			),
		),
		'insurance_type_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
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
		),
		'Policyholder' => array(
			'className' => 'Patient',
			'foreignKey' => 'policyholder_id',
		),
		'PatientRelationship' => array(
			'className' => 'PatientRelationship',
			'foreignKey' => 'patient_relationship_id',
		),
		'Insurance' => array(
			'className' => 'Insurance',
			'foreignKey' => 'insurance_id',
			'order' => 'Insurance.name ASC',
		),
		'InsuranceType' => array(
			'className' => 'InsuranceType',
			'foreignKey' => 'insurance_type_id',
		),
	);
}
