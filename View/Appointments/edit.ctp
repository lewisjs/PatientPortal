<div class="appointments form">
<?php echo $this->Form->create('Appointment'); ?>
	<fieldset>
		<legend><?php echo __('Edit Appointment'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('patient_id');
		echo $this->Form->input('provider_id');
		echo $this->Form->input('location_id');
		echo $this->Form->input('practice_id');
		echo $this->Form->input('appointment_status_id');
		echo $this->Form->input('code');
		echo $this->Form->input('type');
		echo $this->Form->input('start_time');
		echo $this->Form->input('end_time');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Appointment.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Appointment.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Appointments'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Patients'), array('controller' => 'patients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Patient'), array('controller' => 'patients', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Providers'), array('controller' => 'providers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Provider'), array('controller' => 'providers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Locations'), array('controller' => 'locations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Location'), array('controller' => 'locations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Practices'), array('controller' => 'practices', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Practice'), array('controller' => 'practices', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Appointment Statuses'), array('controller' => 'appointment_statuses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Appointment Status'), array('controller' => 'appointment_statuses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Appointment Transmits'), array('controller' => 'appointment_transmits', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Appointment Transmit'), array('controller' => 'appointment_transmits', 'action' => 'add')); ?> </li>
	</ul>
</div>
