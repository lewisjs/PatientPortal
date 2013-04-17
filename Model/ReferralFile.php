<?php
App::uses('AppModel', 'Model');
/**
 * ReferralFile Model
 *
 * @property Provider $Provider
 * @property Referral $Referral
 */
class ReferralFile extends AppModel {

/**
 * save method
 * 	Method attempts to copy, rename, and, if necessary, convert a file into a pdf. Assuming this is successful
 * 	the method then calls the parent's save method and returns the result.
 * 
 * @param mixed $data
 * @param int $referralId
 * @param int $providerId
 * @see Model::save()
 * @return mixed|boolean
 */
	public function save($referralId, $providerId, &$data) {
	// Begin building resource for database update
		$data['ReferralFile']['referral_id'] = $referralId;
		$data['ReferralFile']['provider_id'] = $providerId;
		$data['ReferralFile']['upload_name'] = urlencode($data['ReferralFile']['upload']['name']);
		$data['ReferralFile']['type'] = $data['ReferralFile']['upload']['type'];
		$data['ReferralFile']['size'] = $data['ReferralFile']['upload']['size'];

	// attempt to move file to files directory
		try {
			$data['ReferralFile']['internal_name'] = $this->move_file(
				$data['ReferralFile']['upload_name'],
				$data['ReferralFile']['type'],
				$data['ReferralFile']['upload']['tmp_name']
			);
		}
		catch (InternalErrorException $iee) {
			throw $iee;
		}

	// file move/conversion successful. attempt save
		$this->validator()->remove('upload');
		$saveData =  parent::save($data);
		if ($saveData) {
			return $saveData;
		}
		else {
		// if save fails, delete file
			unlink($data['ReferralFile']['internal_name']);
			return false;
		}
	}
	

/**
 * move_file method
 * 
 * @param string $uploadName
 * @param string $uploadType
 * @param string $tmpName
 * @throws InternalErrorException
 * @return string
 */
	public function move_file($uploadName, $uploadType, $tmpName) {
	// get extension
		$fileExt = pathinfo($uploadName, PATHINFO_EXTENSION);
		
	// find unique name in files directory and reserve name
		$unqName = tempnam(Configure::read('PatientPortal.referral_file.path'), '');
		$internalName = substr(strrchr("$unqName.pdf", '/'), 1);
			
	//move file to new location with extension of upload name
		if(move_uploaded_file($tmpName, "$unqName.$fileExt")) {
		// Only pdf files may be stored directly. Everything else must be converted.
			if ('application/pdf' == $uploadType) {
				rename("$unqName.$fileExt", "$unqName.pdf");
			}
			else {
			// convert file and delete temporary file
				$rtnMsg = system("python /var/www/PatientPortal/app/Lib/pyodconverter.py $unqName.$fileExt $unqName.pdf ");
				unlink("$unqName.$fileExt");
				
			// ensure conversion was successful---$myString should be empty
				if ($rtnMsg) {
					unlink($unqName);
					throw new InternalErrorException($rtnString);
				}
			}
			
		// delete temporary file and return new internal name
			unlink($unqName);
			return $internalName;
		}
		else {
			unlink($unqName);
			throw new InternalErrorException('An error occurred during file upload. Please try again later.');
		}		
	}
	
	
	public function beforeDelete($cascade = true) {
		$data = $this->findById($this->id);
		
		return unlink(Configure::read('PatientPortal.referral_file.path') . $data['ReferralFile']['internal_name']);
	}


/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'provider_id' => array(
			'uuid' => array(
				'rule' => array('uuid'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'referral_id' => array(
			'uuid' => array(
				'rule' => array('uuid'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'upload_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'internal_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'type' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'size' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'upload' => array(
			'uploadNotEmpty' => array(
				'rule' => array('upload_not_empty'),
				'message' => 'Please select a medical file to upload.',
			),
			'validUploadType' => array(
				//'rule' => array('valid_upload_type',),
				'rule' => array(
					'mimeType',
					array(
						'application/msword',
						'application/pdf',
						'application/postscript',
						'application/rtf',
						'application/txt',
						'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
						'application/zip',
						'image/bmp',
						'image/gif',
						'image/jpeg',
						'text/plain',
						'text/rtf',
					)
				),
				'message' => "This file type is not supported."
			),
		),
	);
	
	public function upload_not_empty($check) {
		return null != $check['upload']['name'];
	}
	
	public function valid_upload_type($check) {
		$types = array(
			'application/msword',
			'application/pdf',
			'application/postscript',
			'application/rtf',
			'application/txt',
			'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
			'application/zip',
			'image/bmp',
			'image/gif',
			'image/jpeg',
			'text/plain',
		);
		
		return array_search($check['upload']['type'], $types);
	}

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Provider' => array(
			'className' => 'Provider',
			'foreignKey' => 'provider_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Referral' => array(
			'className' => 'Referral',
			'foreignKey' => 'referral_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
