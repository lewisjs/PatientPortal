<div class="appointmentTransmits form">
<?php echo $this->Form->create('AppointmentTransmit'); ?>
	<fieldset>
		<legend><?php echo __('Add Appointment Transmit'); ?></legend>
	<?php
		echo $this->Form->input('appointment_id');
		echo $this->Form->input('sent');
		echo $this->Form->input('date_sent');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Appointment Transmits'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Appointments'), array('controller' => 'appointments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Appointment'), array('controller' => 'appointments', 'action' => 'add')); ?> </li>
	</ul>
</div>
