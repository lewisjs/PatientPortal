<?php
if ($this->Session->read('Auth.User')) {
	switch($this->Session->read('Auth.User.group_id')) {
		case Configure::read('PatientPortal.group_id.Patient'):
			$this->extend('/Menus/patient_referralFile');
			break;
			
		case Configure::read('PatientPortal.group_id.Clinician'):
		case Configure::read('PatientPortal.group_id.Coordinator'):
		case Configure::read('PatientPortal.group_id.Administrator'):
			break;
			
		default:
			throw new InternalErrorException('Your user account\'s group membership has been corrupted.');
	}
}
else {
	$this->extend('/Menu/login');
}

$this->start('viewContent');
?>

<div class="referralFiles form viewContent">
<h3><?php //echo $patient['Patient']['first_name'] . ' ' . $patient['Patient']['last_name']; ?></h3>

<?php echo $this->Form->create('ReferralFile', array('enctype' => 'multipart/form-data'));?>
	<fieldset>
		<legend>Upload Medical Record</legend>
	<?php
		//echo $this->Form->hidden('patient_id', array('value' => $patient['Patient']['id']));
		echo $this->Form->input('upload', array('type' => 'file'));
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>

<?php $this->end(); ?>

<div class="referralFiles form">
<?php echo $this->Form->create('ReferralFile'); ?>
	<fieldset>
		<legend><?php echo __('Add Referral File'); ?></legend>
	<?php
		echo $this->Form->input('provider_id');
		echo $this->Form->input('referral_id');
		echo $this->Form->input('name');
		echo $this->Form->input('type');
		echo $this->Form->input('size');
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Referral Files'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Providers'), array('controller' => 'providers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Provider'), array('controller' => 'providers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Referrals'), array('controller' => 'referrals', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Referral'), array('controller' => 'referrals', 'action' => 'add')); ?> </li>
	</ul>
</div>

<?php $this->end(); ?>