<?php
$this->extend('/Common/view');

$this->start('actions') ?>
	<ul>
	<!-- BEGIN PATIENT MENU -->
		<li><h4><?php echo _('Manage Patient Referrals'); ?></h4></li>
		<li><hr /></li>
		<li><?php echo $this->Html->link(__('Add Patient Referral'), array('controller' => 'patientFiles', 'action' => 'clinician_add')); ?></li>
		<li><?php echo $this->Html->link(__('View Patient Referral'), array('controller' => 'patientFiles', 'action' => 'clinician_index')); ?></li>
	<!-- END PATIENT MENU -->
		<br />
	<!-- BEGIN USER MENU -->
	<li><h4><?php echo _('Manage User'); ?></h4></li>
		<li><hr /></li>
		<li><?php echo $this->Html->link(__('Log Out'), array('controller' => 'users', 'action' => 'logout')); ?> </li>
	<!-- END USER MENU -->
	</ul>
<?php $this->end(); ?>