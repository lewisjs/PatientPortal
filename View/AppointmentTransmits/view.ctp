<div class="appointmentTransmits view">
<h2><?php  echo __('Appointment Transmit'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($appointmentTransmit['AppointmentTransmit']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Appointment'); ?></dt>
		<dd>
			<?php echo $this->Html->link($appointmentTransmit['Appointment']['id'], array('controller' => 'appointments', 'action' => 'view', $appointmentTransmit['Appointment']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sent'); ?></dt>
		<dd>
			<?php echo h($appointmentTransmit['AppointmentTransmit']['sent']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Sent'); ?></dt>
		<dd>
			<?php echo h($appointmentTransmit['AppointmentTransmit']['date_sent']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Appointment Transmit'), array('action' => 'edit', $appointmentTransmit['AppointmentTransmit']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Appointment Transmit'), array('action' => 'delete', $appointmentTransmit['AppointmentTransmit']['id']), null, __('Are you sure you want to delete # %s?', $appointmentTransmit['AppointmentTransmit']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Appointment Transmits'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Appointment Transmit'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Appointments'), array('controller' => 'appointments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Appointment'), array('controller' => 'appointments', 'action' => 'add')); ?> </li>
	</ul>
</div>
