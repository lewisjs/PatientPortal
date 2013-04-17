<?php
if($this->Session->read('Auth.User')) {
	switch($this->Session->read('Auth.User.group_id')) {
		case Configure::read('PatientPortal.group_id.Patient'):
			$this->extend('/Menus/patient_questionnaire');
			break;
			
		case Configure::read('PatientPortal.group_id.Clinician'):
		case Configure::read('PatientPortal.group_id.Coordinator'):
		case Configure::read('PatientPortal.group_id.Administrator'):
			break;
			
		default:
			throw new InternalErrorException('There is no group of this type.');
	}
}
else {
	$this->extend('/Menus/login');
}

$this->start('mainContent');
?>
<div class="patientQuestionsResponses index">

</div>

<?php $this->end(); ?>