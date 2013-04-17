<div class="appointments index">
	<h2><?php echo __('Appointments'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('patient_id'); ?></th>
			<th><?php echo $this->Paginator->sort('provider_id'); ?></th>
			<th><?php echo $this->Paginator->sort('location_id'); ?></th>
			<th><?php echo $this->Paginator->sort('practice_id'); ?></th>
			<th><?php echo $this->Paginator->sort('appointment_status_id'); ?></th>
			<th><?php echo $this->Paginator->sort('code'); ?></th>
			<th><?php echo $this->Paginator->sort('type'); ?></th>
			<th><?php echo $this->Paginator->sort('start_time'); ?></th>
			<th><?php echo $this->Paginator->sort('end_time'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($appointments as $appointment): ?>
	<tr>
		<td><?php echo h($appointment['Appointment']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($appointment['Patient']['id'], array('controller' => 'patients', 'action' => 'view', $appointment['Patient']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($appointment['Provider']['id'], array('controller' => 'providers', 'action' => 'view', $appointment['Provider']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($appointment['Location']['id'], array('controller' => 'locations', 'action' => 'view', $appointment['Location']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($appointment['Practice']['id'], array('controller' => 'practices', 'action' => 'view', $appointment['Practice']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($appointment['AppointmentStatus']['id'], array('controller' => 'appointment_statuses', 'action' => 'view', $appointment['AppointmentStatus']['id'])); ?>
		</td>
		<td><?php echo h($appointment['Appointment']['code']); ?>&nbsp;</td>
		<td><?php echo h($appointment['Appointment']['type']); ?>&nbsp;</td>
		<td><?php echo h($appointment['Appointment']['start_time']); ?>&nbsp;</td>
		<td><?php echo h($appointment['Appointment']['end_time']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $appointment['Appointment']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $appointment['Appointment']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $appointment['Appointment']['id']), null, __('Are you sure you want to delete # %s?', $appointment['Appointment']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Appointment'), array('action' => 'add')); ?></li>
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
