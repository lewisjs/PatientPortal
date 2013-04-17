<div class="appointmentStatuses view">
<h2><?php  echo __('Appointment Status'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($appointmentStatus['AppointmentStatus']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($appointmentStatus['AppointmentStatus']['description']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Appointment Status'), array('action' => 'edit', $appointmentStatus['AppointmentStatus']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Appointment Status'), array('action' => 'delete', $appointmentStatus['AppointmentStatus']['id']), null, __('Are you sure you want to delete # %s?', $appointmentStatus['AppointmentStatus']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Appointment Statuses'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Appointment Status'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Appointments'), array('controller' => 'appointments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Appointment'), array('controller' => 'appointments', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Appointments'); ?></h3>
	<?php if (!empty($appointmentStatus['Appointment'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Patient Id'); ?></th>
		<th><?php echo __('Provider Id'); ?></th>
		<th><?php echo __('Location Id'); ?></th>
		<th><?php echo __('Practice Id'); ?></th>
		<th><?php echo __('Appointment Status Id'); ?></th>
		<th><?php echo __('Code'); ?></th>
		<th><?php echo __('Type'); ?></th>
		<th><?php echo __('Start Time'); ?></th>
		<th><?php echo __('End Time'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($appointmentStatus['Appointment'] as $appointment): ?>
		<tr>
			<td><?php echo $appointment['id']; ?></td>
			<td><?php echo $appointment['patient_id']; ?></td>
			<td><?php echo $appointment['provider_id']; ?></td>
			<td><?php echo $appointment['location_id']; ?></td>
			<td><?php echo $appointment['practice_id']; ?></td>
			<td><?php echo $appointment['appointment_status_id']; ?></td>
			<td><?php echo $appointment['code']; ?></td>
			<td><?php echo $appointment['type']; ?></td>
			<td><?php echo $appointment['start_time']; ?></td>
			<td><?php echo $appointment['end_time']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'appointments', 'action' => 'view', $appointment['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'appointments', 'action' => 'edit', $appointment['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'appointments', 'action' => 'delete', $appointment['id']), null, __('Are you sure you want to delete # %s?', $appointment['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Appointment'), array('controller' => 'appointments', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
