<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property Group $Group
 * @property UserHistory $UserHistory
 * @property UserTicket $UserTicket
 * @property Patient $Patient
 * @property Practice $Practice
 */
class User extends AppModel {
    public $name = 'User';
	
	
/**
 * (non-PHPdoc)
 * @see Model::beforeSave()
 */
	public function beforeSave($options = array()) {
		if (isset($this->data['User']['password'])) {
			$this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
		}

		return true;
	}
	
	
	public function get_password($userId = null) {		
		$this->recursive = -1;
		
		$data = $this->find(
			'first',
			array(
			// search by $userId if provided, otherwise by model's id
				'conditions' => array('User.id' => (null == $userId) ? $this->id : $userId, ),
				'recursive' => -1, 'fields' => array('User.password', ),
			)
		);
		
		return $data['User']['password'];
	}
	
	
	public function set_search_state($username, $email) {
	// must allow non-unique emails and usernames for searches
		$this->validator()->remove('username', 'unique');
		$this->validator()->remove('email', 'unique');
	// if username is provided, email is not needed and vice versa
		if ($username) {
			$this->validator()->remove('email', 'notempty');
		}

		if ($email) {
			$this->validator()->remove('username', 'notempty');
		} else {
			$this->validator()->remove('email', 'email');
		}
	}

	
	public function set_edit_password_state($userId) {
		$this->id = $userId;

	// ensure a user with this id exists in database
		if (!$this->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		
	// set one-time validation rule to ensure user enters old password before attempting to save.
		$this->validator()->add('old_password', 'required',
			array(
    			'rule' => 'notEmpty',
    			'required' => 'update',
				'message' => 'Please enter your current password',
			)
		);
	}
	
	
	public function set_edit_email_state($userId) {
		$this->id = $userId;

		// ensure a user with this id exists in database
		if (!$this->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		
		// set one-time validation rule to ensure user may enter only the current password before attempting update
		$this->validator()->getField('password')->removeRule('passwordConfirmed');
	}
	
	
/**
 * 
 * @param array $check
 * @param string $field
 * @return boolean
 */
	public function match_fields($check, $field) {
		$match = 0 < count($check);
	
		foreach($check as $item) {
			$match = $match && ($item == $this->data['User'][$field]);
		}
	
		return $match;
	}
	

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'group_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'username' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'A user name is required.',
				//'allowEmpty' => false,
				//'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		    'unique' => array(
		        'rule' => 'isUnique',
		    	'message' => 'This username is already taken. Please try another.',
		    ),
		),
		'email' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'An email address is required.',
				//'allowEmpty' => false,
				//'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'email' => array(
				'rule' => array('email'),
				'message' => 'Please enter a valid email address.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		    'unique' => array(
		        'rule' => 'isUnique',
		    	'message' => 'This email address is already taken. Please try another.',
		    ),
		),
		'password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'A password must be supplied for security purposes.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'passwordConfirmed' => array(
				'rule' => array('match_fields', 'confirm_password'),
				'message' => 'Password does not match confirmation password. Please check your spellings and try again.'
			),
		),
		'confirm_password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please reenter the password from above.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'passwordConfirmed' => array(
				'rule' => array('match_fields', 'password'),
				'message' => 'Password does not match confirmation password. Please check your spellings and try again.'
			),
		),
		'validated' => array(
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
		'Group' => array(
			'className' => 'Group',
			'foreignKey' => 'group_id',
			'dependent' => false,
		),
		'Patient' => array(
			'className' => 'Patient',
			'foreignKey' => 'patient_id',
			'dependent' => false,
		),
		'Practice' => array(
			'className' => 'Practice',
			'foreignKey' => 'practice_id',
			'dependent' => false,
		),
	);

/**
 * hasOne associations
 *
 * @var array
 */
/* 	public $hasOne = array(
		'Patient' => array(
			'className' => 'Patient',
			'foreignKey' => 'id',
			'dependent' => false,
		),
	); */

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'UserHistory' => array(
			'className' => 'UserHistory',
			'foreignKey' => 'user_id',
			'dependent' => false,
		),
		'CreatedHistory' => array(
			'className' => 'UserHistory',
			'foreignKey' => 'modified_by',
			'dependent' => false,
		),
		'UserTicket' => array(
			'className' => 'UserTicket',
			'foreignKey' => 'user_id',
			'dependent' => false,
		),
		'PatientHistory' => array(
			'className' => 'PatientHistory',
			'foreignKey' => 'modified_by',
			'dependent' => false,
		)
	);


/**
 * For Auth and Acl to work properly we need to associate our users and groups to rows in the Acl
 * tables. In order to do this we will use the AclBehavior. The AclBehavior allows for the automagic
 * connection of models with the Acl tables. Its use requires an implementation of parentNode() on
 * your model.
 */
	public $actsAs = array(
		'Acl' => array(
			'type' => 'requester',
			'enabled' => false
		),
	);
	
	
/**
 * To implement per-group only permissions, we need to implement bindNode()
 */
	public function bindNode($user) {
	    return array('model' => 'Group', 'foreign_key' => $user['User']['group_id']);
	}
	
	public function parentNode() {
		if (!$this->id && empty($this->data)) {
			return null;
		}
		if (isset($this->data['User']['group_id'])) {
			$groupId = $this->data['User']['group_id'];
		} else {
			$groupId = $this->field('group_id');
		}
		if (!$groupId) {
			return null;
		} else {
			return array('Group' => array('id' => $groupId));
		}
	}

}
