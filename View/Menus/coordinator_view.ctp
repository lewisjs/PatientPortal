<?php
$this->extend('/Common/view');

$this->start('actions') ?>
	<ul>
	<!-- BEGIN PATIENT MENU -->
		<li><h4><?php echo _('Manage Patients'); ?></h4></li>
		<li><hr /></li>
		<li><?php echo $this->Html->link(__('List Patients'), array('controller' => 'patients', 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('Edit Patient'), array('controller' => 'patients', 'action' => 'edit')); ?></li>
		<li><?php echo $this->Html->link(__('Add Patient'), array('controller' => 'patients', 'action' => 'search', 'patients', 'view')); ?></li>
	<!-- END PATIENT MENU -->
	
		<br />
		
	<!-- BEGIN PATIENT FILES MENU -->
		<li><h4><?php echo _('Manage Patient Referrals'); ?></h4></li>
		<li><hr /></li>
		<li><?php echo $this->Html->link(__('Add Patient Referral'), array('controller' => 'patientFiles', 'action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('View Patient Referrals'), array('controller' => 'patientFiles', 'action' => 'index')); ?></li>
	<!-- END PATIENT MENU -->
		<br />
		
	<!-- BEGIN USER MENU -->
	<li><h4><?php echo _('Manage Users'); ?></h4></li>
		<li><hr /></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'coordinator_index')); ?> </li>
		<li><?php echo $this->Html->link(__('Add User'), array('controller' => 'users', 'action' => 'coordinator_add')); ?> </li>
		<li><?php echo $this->Html->link(__('Log Out'), array('controller' => 'users', 'action' => 'logout')); ?> </li>
	<!-- END USER MENU -->
	</ul>
<?php $this->end(); ?>