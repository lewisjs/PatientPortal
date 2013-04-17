<?php
if($this->Session->read('Auth.User')) {
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

<div class="insurancePatientRelationships form">
<?php echo $this->Form->create('InsurancePatientRelationship'); ?>
	<fieldset>
		<legend><?php echo __('Edit Insurance Patient Relationship'); ?></legend>
		<div class="input larger">
			<span class="larger required">Policyholder: </span>
			<span class="larger"><?php echo $policyholder; ?></span>
		</div>
	<?php
		echo $this->Form->input('patient_relationship_id');
		echo $this->Form->input('insurance_id');
		echo $this->Form->input('insurance_no');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

<?php $this->end(); ?>