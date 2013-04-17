<div class="appointments view">
<h2><?php  echo __('Appointment'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($appointment['Appointment']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Patient'); ?></dt>
		<dd>
			<?php echo $this->Html->link($appointment['Patient']['id'], array('controller' => 'patients', 'action' => 'view', $appointment['Patient']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Provider'); ?></dt>
		<dd>
			<?php echo $this->Html->link($appointment['Provider']['id'], array('controller' => 'providers', 'action' => 'view', $appointment['Provider']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Location'); ?></dt>
		<dd>
			<?php echo $this->Html->link($appointment['Location']['id'], array('controller' => 'locations', 'action' => 'view', $appointment['Location']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Practice'); ?></dt>
		<dd>
			<?php echo $this->Html->link($appointment['Practice']['id'], array('controller' => 'practices', 'action' => 'view', $appointment['Practice']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Appointment Status'); ?></dt>
		<dd>
			<?php echo $this->Html->link($appointment['AppointmentStatus']['id'], array('controller' => 'appointment_statuses', 'action' => 'view', $appointment['AppointmentStatus']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Code'); ?></dt>
		<dd>
			<?php echo h($appointment['Appointment']['code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($appointment['Appointment']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Start Time'); ?></dt>
		<dd>
			<?php echo h($appointment['Appointment']['start_time']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('End Time'); ?></dt>
		<dd>
			<?php echo h($appointment['Appointment']['end_time']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Appointment'), array('action' => 'edit', $appointment['Appointment']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Appointment'), array('action' => 'delete', $appointment['Appointment']['id']), null, __('Are you sure you want to delete # %s?', $appointment['Appointment']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Appointments'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Appointment'), array('action' => 'add')); ?> </li>
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
<div class="related">
	<h3><?php echo __('Related Appointment Transmits'); ?></h3>
	<?php if (!empty($appointment['AppointmentTransmit'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Appointment Id'); ?></th>
		<th><?php echo __('Sent'); ?></th>
		<th><?php echo __('Date Sent'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($appointment['AppointmentTransmit'] as $appointmentTransmit): ?>
		<tr>
			<td><?php echo $appointmentTransmit['id']; ?></td>
			<td><?php echo $appointmentTransmit['appointment_id']; ?></td>
			<td><?php echo $appointmentTransmit['sent']; ?></td>
			<td><?php echo $appointmentTransmit['date_sent']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'appointment_transmits', 'action' => 'view', $appointmentTransmit['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'appointment_transmits', 'action' => 'edit', $appointmentTransmit['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'appointment_transmits', 'action' => 'delete', $appointmentTransmit['id']), null, __('Are you sure you want to delete # %s?', $appointmentTransmit['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Appointment Transmit'), array('controller' => 'appointment_transmits', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
