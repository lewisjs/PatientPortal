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

<div class="patients form viewContent">
	<h2><?php echo __('Select Policyholder'); ?></h2>
	
	<?php if (isset($policyholders)): ?>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th>Name</th>
			<th>Date of Birth</th>
			<th>Select</th>
	</tr>
	<tr>
		<td>
			<?php echo h(
				"{$this->Session->read('Auth.User.Patient.first_name')} 
					{$this->Session->read('Auth.User.Patient.last_name')} (self)"
			);?>
		</td>
		<td><?php echo h($this->Session->read('Auth.User.Patient.date_of_birth')); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Select'), array('action' => 'add', $patientId, $patientId)); ?>
		</td>
	</tr>
	<?php foreach ($policyholders as $policyholder): ?>
		<?php 
			if ($this->Session->read('Auth.User.Patient.id') == $policyholder['Policyholder']['id']) {
				continue;
			}
		?>
	<tr>
		<td>
			<?php echo h("{$policyholder['Policyholder']['first_name']} {$policyholder['Policyholder']['last_name']}"); ?>
		</td>
		<td>
			<?php echo h($policyholder['Policyholder']['date_of_birth']); ?>
		</td>
		<td class="actions">
			 <?php echo $this->Html->link(__('Select'), array('action' => 'add', $patientId, $policyholder['Policyholder']['id'])); ?>
		</td>
	</tr>
	<?php endforeach; ?>
	</table>
	<?php endif; ?>

	<h3>Note:</h3>
	<p class="larger">You do not have any policyholders associated with your account. If you (the patient) are the
policyholder for your insurance, please <?php echo $this->HTML->link('click here', array('action' => 'add', $patientId)); ?>.
Otherwise, use the form below to enter the information for the policyholder of your insurance account.
	</p>
	<br />
	<hr />
	<br />
<?php echo $this->Form->create('Patient'); ?>
	<fieldset>
		<legend><?php echo __('Add Policyholder'); ?></legend>
	<?php
		echo $this->Form->input('first_name');
		echo $this->Form->input('middle_name');
		echo $this->Form->input('last_name');
		echo $this->Form->input('maiden_name');
		echo $this->Form->input(
			'date_of_birth',
			array(
				'label' => 'Date of birth',
				'dateFormat' => 'MDY',
				'minYear' => date('Y') - Configure::read('PatientPortal.patient.max_age'),
				'maxYear' => date('Y') - Configure::read('PatientPortal.patient.min_age'),
			)
		);
		echo $this->Form->input(
			'patient_gender_id',
			array(
				'label' => 'Gender',
				'empty' => 'Choose One',
			)
		);
		echo $this->Form->input('street1');
		echo $this->Form->input('street2');
		echo $this->Form->input('city');
		echo $this->Form->input('state');
		echo $this->Form->input('zip');
		echo $this->Form->input('home_phone');
		echo $this->Form->input('mobile_phone');
		echo $this->Form->input('work_phone');
		echo $this->Form->input(
			'patient_marital_status_id',
			array(
				'label' => 'Marital Status',
				'empty' => 'Choose One',
			)
		);
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

<?php $this->end(); ?>