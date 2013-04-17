<div class="patientTransmits index">
	<h2><?php echo __('Patient Transmits'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('patient_id'); ?></th>
			<th><?php echo $this->Paginator->sort('sent'); ?></th>
			<th><?php echo $this->Paginator->sort('date_sent'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($patientTransmits as $patientTransmit): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($patientTransmit['Patient']['id'], array('controller' => 'patients', 'action' => 'view', $patientTransmit['Patient']['id'])); ?>
		</td>
		<td><?php echo h($patientTransmit['PatientTransmit']['sent']); ?>&nbsp;</td>
		<td><?php echo h($patientTransmit['PatientTransmit']['date_sent']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $patientTransmit['PatientTransmit']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $patientTransmit['PatientTransmit']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $patientTransmit['PatientTransmit']['id']), null, __('Are you sure you want to delete # %s?', $patientTransmit['PatientTransmit']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Patient Transmit'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Patients'), array('controller' => 'patients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Patient'), array('controller' => 'patients', 'action' => 'add')); ?> </li>
	</ul>
</div>
