<?php
App::uses('AppModel', 'Model');
/**
 * PatientQuestionsResponse Model
 *
 * @property Patient $Patient
 * @property QuestionsResponse $QuestionsResponse
 */
class PatientQuestionsResponse extends AppModel {    

/**
 * is_page_complete method: Returns true if for a 
 * @param int $questionnaireId
 * @param int $pageNumber
 * @param int $patientId
 * @return boolean
 */
    public function is_page_complete($questionnaireId, $pageNumber, $patientId) {
    	$questionnairePageId = $this->QuestionsResponse->Question->QuestionnairePage->fetch_id($questionnaireId, $pageNumber);
    	
		$pageQuestions = $this->QuestionsResponse->Question->fetch_id_map(
			array('Question.questionnaire_page_id' => $questionnairePageId)
		);
		
		// get map of date-to-answers
    	$pageResponses = $this->build_page_response($questionnaireId, $pageNumber, $patientId);    	
    	if (!$pageResponses) {
    		return false;
    	}
    	
    	foreach ($pageQuestions as $questionId => $question) {
    		if ($question['required']) {
    			$complete = false;
	    		foreach ($pageResponses as $datedResponse) {
	    			if (isset($datedResponse['Question'][$questionId]['PatientQuestionsResponse'])) {
	    				$complete = true;
	    				break;
	    			}
	    		}
	    		if (false == $complete) {
	    			return false;
	    		}
    		}
    	}
    	
    	return true;
    }
    
    
/**
 * 
 * @param int $questionnaireId
 * @param int $patientId
 * @param int $pageNumber
 * @return array|NULL
 */
    public function build_page_response($questionnaireId, $pageNumber, $patientId) {
    	$datedResponses = NULL;    	
    	$page = $this->build_page($questionnaireId, $pageNumber, $patientId, true);
    	
    	foreach ($page['Question'] as $qData) {
    		foreach ($qData['QuestionsResponse'] as $qrData) {
    			if ($qrData['PatientQuestionsResponse']) {
	    			foreach ($qrData['PatientQuestionsResponse'] as $pqrData) {
	    				$datedResponses[$pqrData['created']]['Question'][$qData['id']] = array(
	    					'text' => $qData['text'],
	    					'days_to_reset' => $qData['days_to_reset'],
	    					'QuestionsResponse' => array('id' => $qrData['id']),
	    					'Response' => $qrData['Response'],
	    					'PatientQuestionsResponse' => array('id' => $pqrData['id'])
	    				);
	    			}
    			}
    		}
    	}
    	
    	return $datedResponses;
    }
    
    
/**
 * 
 * @param int $userId
 * @param int $pageNumber
 * @return NULL | mixed
 */
	public function build_page($questionnaireId, $pageNumber, $patientId, $cutResponses=true) {
		$questionnairePageId = $this->QuestionsResponse->Question->QuestionnairePage->fetch_id($questionnaireId, $pageNumber);
		
		// build a page of questions, possible responses, and patient responses (if any)
		$page = $this->QuestionsResponse->Question->build_page($questionnairePageId, $patientId);
		
		// To remove older answers or not. That is the question.
		if (!$cutResponses) {
			return $page;
		}
		
		// Remove all patient responses older than the cutoff date
		foreach ($page['Question'] as $qId => $question) {
			if (0 == $question['days_to_reset']) {
				continue;
			}
			$cutDate = date("Y-m-d", strtotime("-{$question['days_to_reset']} days"));
			
			foreach ($question['QuestionsResponse'] as $qrId => $questionsResponse) {
				foreach ($questionsResponse['PatientQuestionsResponse'] as $pqrId => $patientQuestionsResponse) {
					if ($cutDate > $patientQuestionsResponse['created']) {
						unset($page['Question'][$qId]['QuestionsResponse'][$qrId]['PatientQuestionsResponse'][$pqrId]);
					}
				}
			}
		}
		
		return $page;
	}
	
	
/**
 * 
 * @param array $data
 * @throws Exception
 * @return boolean
 */
	public function save_page($patientId, &$data) {
		$saved = true;
		foreach ($data['PatientQuestionsResponse'] as $response) {
			switch ($response['Question']['question_type_id']) {
				case 'single':
					if (null == $response['questions_response_id']) {
						throw new Exception('Please leave no answer blank.');
					}
					else {
						$saved = $saved && (bool)$this->save_single_response($patientId, $response);
					}
					break;
					
				case 'multiple': //currently no way to uncheck all boxes. either need a none box or different logic
					if (isset($response['QuestionsResponse'])) {
						$saved = $saved && (bool)$this->save_multiple_response($patientId, $response);
					}
					break;
					
				case 'number':
					if (0 == strlen($response['QuestionsResponse']['Response']['value'])) {
					// ensure some value was input, before continuing
						break;
					}
					
					$response['QuestionsResponse']['Response']['text'] = (string)$response['QuestionsResponse']['Response']['value'];
					$saved = $saved && (bool)$this->save_entry_response($patientId, $response);
					
					break;
					
				case 'text':
					if (0 == strlen($response['QuestionsResponse']['Response']['text'])) {
					// ensure some text was input, before continuing
						break;
					}
					
					$response['QuestionsResponse']['Response']['value'] = 0.0;
					$saved = $saved && (bool)$this->save_entry_response($patientId, $response);
					
					break;

			}
		}
		
		return $saved;
	}
	
	
	private function save_single_response($patientId, &$response) {
		$record = array('PatientQuestionsResponse' => array(
			'patient_id' => $patientId,
			'questions_response_id' => $response['questions_response_id']
		));

	// Create new record if question hasn't been answered today, update otherwise.
		$pqrData = $this->get_current_patientQuestionsResponses(
			$response['Question']['id'],
			$response['Question']['days_to_reset']
		);		

		if ($pqrData) {
		// A record created within the cutoff was found. Do not create new record, overwrite.
			if (1 == count($pqrData)) {		
				$record['PatientQuestionsResponse']['id'] = $pqrData[0]['PatientQuestionsResponse']['id'];
				$options['fieldList'] = array('questions_response_id');				
				return $this->save($record, $options);
			}
			else {
			// Multiple submissions found within a single submission cut-off. Delete all and create new record
				$conditions = array();
				foreach ($pqrData as $datum) {
					$conditions[] = $datum['PatientQuestionsResponse']['id'];
				}

				$this->deleteAll(array('PatientQuestionsResponse.id' => $conditions), false);
			}
		}
		
		// No record within cutoff date found. Create new.
 		$this->create();		
		$options['fieldList'] = array(true);		
		return $this->save($record, $options);
	}
	
	
/**
 * 
 * @param unknown_type $response
 * @return Ambigous <mixed, boolean, multitype:boolean >
 */
	private function save_multiple_response($patientId, &$response) {
		$multiData = array();
	
	// Create new record if question hasn't been answered within cutoff date, update otherwise.
		$pqrData = $this->get_current_patientQuestionsResponses(
			$response['Question']['id'],
			$response['Question']['days_to_reset']
		);
		
		if($pqrData) {
			$conditions = array();
			foreach($pqrData as $pqrDatum) {
				$conditions[] = $pqrDatum['PatientQuestionsResponse']['id'];
			}
			
			$this->deleteAll(array('PatientQuestionsResponse.id' => $conditions), false);
		}

		foreach($response['QuestionsResponse'] as $multiResponse) {
			$multiData[] = array('PatientQuestionsResponse' => array(
				'patient_id' => $patientId,
				'questions_response_id' => $multiResponse['id']
			));
		}
		return $this->saveMany($multiData);
	}
	
	
	private function save_entry_response($patientId, &$response) {	
		// create or retrieve a record for patient Response entry
			$this->QuestionsResponse->Response->create();
			if ($this->QuestionsResponse->Response->save($response['QuestionsResponse'])) {
				// build a QuestionsResponse record
				$qrRecord = array('QuestionsResponse' => array(
					'question_id' => $response['Question']['id'],
					'response_id' => $this->QuestionsResponse->Response->id
				));						
	
			// create or retrieve a record for QuestionsResponse
				$this->QuestionsResponse->create();
				if ($data = $this->QuestionsResponse->save($qrRecord)) {
					$response['questions_response_id'] = $this->QuestionsResponse->id;
					return $this->save_single_response($patientId, $response);							
				}
				else {
					throw new Exception('QuestionsResponse Record Save Failed.');
				}						
			}
			else {
				throw new Exception('Response Record Save Failed.');
			}
			
			break;		
	}
	

/**
 * get_current_patientQuestionsResponses method determines all PatientQuestionsResponses for a given question answered on or after the cutoff date calculated from $daysToReset and returns the results---NULL if none are found.
 * 
 * @param int $questionId
 * @param int $daysToReset
 * @return array | NULL
 */
	private function get_current_patientQuestionsResponses($questionId, $daysToReset) {
		$conditions = array('QuestionsResponse.question_id' => $questionId);
				
		if (0 != $daysToReset) {
		// this question can be answered 1 / unit time
			$date = date('Y-m-d', strtotime("-$daysToReset days")); // calculate cut off date
			$conditions['PatientQuestionsResponse.created >='] = $date;
		}

		// keep QuestionsResponse, but no need to get patient data
		$this->unbindModel(array('belongsTo' => array('Patient')));
		// find any questions answered after reset date
		$pqrData = $this->find('all', array(
			'fields' => array('PatientQuestionsResponse.id'),
			'conditions' => $conditions
		));
		
		return $pqrData;
	}
	
/**
 * Acts As Rules
 * 
 * @var array
 */
	public $actsAs = array('Containable');

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
		'questions_response_id' => array(
			'uuid' => array(
				'rule' => array('uuid'),
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
 * Belongs To associations
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
		'QuestionsResponse' => array(
			'className' => 'QuestionsResponse',
			'foreignKey' => 'questions_response_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
// 		$page = $this->QuestionsResponse->Question->QuestionnairePage->find('first',
// 			array(
// 				'conditions' => array('questionnaire_id' => $questionnaireId, 'number' => $pageNumber),
// 				'fields' => array('id', 'title'),
// 				'recursive' => -1
// 			)
// 		);

// 		$page['Question'] = $this->QuestionsResponse->Question->fetch_id_map(
// 			array('questionnaire_page_id' => $page['QuestionnairePage']['id'])
// 		);

// 		foreach ($page['Question'] as $questionId => &$question) {
// 			$question['QuestionsResponse'] = $this->QuestionsResponse->fetch_id_map(array('question_id' => $questionId));
// 			foreach ($question['QuestionsResponse'] as &$questionsResponse) {
// 				$questionsResponse['Response'] = $this->QuestionsResponse->Response->find('first',
// 					array('conditions' => array('id' => $questionsResponse['response_id']), 'recursive' => -1)
// 				);
// 			}
// 		}

// 		print_r($page);
// 		return $page;