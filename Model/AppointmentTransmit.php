<?php
App::uses('AppModel', 'Model');
/**
 * AppointmentTransmit Model
 *
 * @property Appointment $Appointment
 */
class AppointmentTransmit extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'appointment_id' => array(
			'uuid' => array(
				'rule' => array('uuid'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'sent' => array(
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
		'Appointment' => array(
			'className' => 'Appointment',
			'foreignKey' => 'appointment_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
