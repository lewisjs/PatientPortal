<div class="appointmentTransmits index">
	<h2><?php echo __('Appointment Transmits'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('appointment_id'); ?></th>
			<th><?php echo $this->Paginator->sort('sent'); ?></th>
			<th><?php echo $this->Paginator->sort('date_sent'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($appointmentTransmits as $appointmentTransmit): ?>
	<tr>
		<td><?php echo h($appointmentTransmit['AppointmentTransmit']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($appointmentTransmit['Appointment']['id'], array('controller' => 'appointments', 'action' => 'view', $appointmentTransmit['Appointment']['id'])); ?>
		</td>
		<td><?php echo h($appointmentTransmit['AppointmentTransmit']['sent']); ?>&nbsp;</td>
		<td><?php echo h($appointmentTransmit['AppointmentTransmit']['date_sent']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $appointmentTransmit['AppointmentTransmit']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $appointmentTransmit['AppointmentTransmit']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $appointmentTransmit['AppointmentTransmit']['id']), null, __('Are you sure you want to delete # %s?', $appointmentTransmit['AppointmentTransmit']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Appointment Transmit'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Appointments'), array('controller' => 'appointments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Appointment'), array('controller' => 'appointments', 'action' => 'add')); ?> </li>
	</ul>
</div>
