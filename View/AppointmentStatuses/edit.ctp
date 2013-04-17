<div class="appointmentStatuses form">
<?php echo $this->Form->create('AppointmentStatus'); ?>
	<fieldset>
		<legend><?php echo __('Edit Appointment Status'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('AppointmentStatus.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('AppointmentStatus.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Appointment Statuses'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Appointments'), array('controller' => 'appointments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Appointment'), array('controller' => 'appointments', 'action' => 'add')); ?> </li>
	</ul>
</div>
