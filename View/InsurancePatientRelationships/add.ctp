<?php
if ($this->Session->read('Auth.User')) {
	switch($this->Session->read('Auth.User.group_id')) {
		case Configure::read('PatientPortal.group_id.Patient'):
			$this->extend('/Menus/patient_insurance');
			break;
		case Configure::read('PatientPortal.group_id.Clinician'):
		case Configure::read('PatientPortal.group_id.Coordinator'):
		case Configure::read('PatientPortal.group_id.Administrator'):
		default:
			throw new InternalErrorException('WTF happened here???');
	}
}
else {
	$this->extend('/Common/login_view');
}

$this->start('viewContent');
?>

<div class="insurancePatientRelationships form viewContent">
<?php echo $this->Form->create('InsurancePatientRelationship'); ?>
	<fieldset>
	
		<legend><?php echo __('Add Insurance Policy'); ?></legend>
		<div class="input"><span class="larger required">Policyholder: </span><?php echo $policyholder; ?></div>
	<?php
		if ($patientId == $policyholderId) {
			echo $this->Form->input('patient_relationship_id',
				array(
					'label' => 'Policyholder\'s Relationship to Patient',
				)
			);
		}
		else {
			echo $this->Form->input('patient_relationship_id',
				array(
					'label' => 'Policyholder\'s Relationship to Patient',
					'empty' => 'Choose One',
				)
			);
		}
		echo $this->Form->input('insurance_id', array('empty' => 'Choose One'));
		echo $this->Form->input('insurance_type_id', array('empty' => 'Choose One'));
		echo $this->Form->input('insurance_no');
	?>
	
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

<?php $this->end(); ?>