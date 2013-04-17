<div class="patientHistories index">
	<h2><?php echo __('Patient Histories'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('patient_id'); ?></th>
			<th><?php echo $this->Paginator->sort('modified_by'); ?></th>
			<th><?php echo $this->Paginator->sort('last_name'); ?></th>
			<th><?php echo $this->Paginator->sort('first_name'); ?></th>
			<th><?php echo $this->Paginator->sort('middle_name'); ?></th>
			<th><?php echo $this->Paginator->sort('maiden_name'); ?></th>
			<th><?php echo $this->Paginator->sort('date_of_birth'); ?></th>
			<th><?php echo $this->Paginator->sort('gender'); ?></th>
			<th><?php echo $this->Paginator->sort('home_phone'); ?></th>
			<th><?php echo $this->Paginator->sort('mobile_phone'); ?></th>
			<th><?php echo $this->Paginator->sort('work_phone'); ?></th>
			<th><?php echo $this->Paginator->sort('street1'); ?></th>
			<th><?php echo $this->Paginator->sort('street2'); ?></th>
			<th><?php echo $this->Paginator->sort('city'); ?></th>
			<th><?php echo $this->Paginator->sort('state'); ?></th>
			<th><?php echo $this->Paginator->sort('zip'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($patientHistories as $patientHistory): ?>
	<tr>
		<td><?php echo h($patientHistory['PatientHistory']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($patientHistory['Patient']['id'], array('controller' => 'patients', 'action' => 'view', $patientHistory['Patient']['id'])); ?>
		</td>
		<td><?php echo h($patientHistory['PatientHistory']['modified_by']); ?>&nbsp;</td>
		<td><?php echo h($patientHistory['PatientHistory']['last_name']); ?>&nbsp;</td>
		<td><?php echo h($patientHistory['PatientHistory']['first_name']); ?>&nbsp;</td>
		<td><?php echo h($patientHistory['PatientHistory']['middle_name']); ?>&nbsp;</td>
		<td><?php echo h($patientHistory['PatientHistory']['maiden_name']); ?>&nbsp;</td>
		<td><?php echo h($patientHistory['PatientHistory']['date_of_birth']); ?>&nbsp;</td>
		<td><?php echo h($patientHistory['PatientHistory']['gender']); ?>&nbsp;</td>
		<td><?php echo h($patientHistory['PatientHistory']['home_phone']); ?>&nbsp;</td>
		<td><?php echo h($patientHistory['PatientHistory']['mobile_phone']); ?>&nbsp;</td>
		<td><?php echo h($patientHistory['PatientHistory']['work_phone']); ?>&nbsp;</td>
		<td><?php echo h($patientHistory['PatientHistory']['street1']); ?>&nbsp;</td>
		<td><?php echo h($patientHistory['PatientHistory']['street2']); ?>&nbsp;</td>
		<td><?php echo h($patientHistory['PatientHistory']['city']); ?>&nbsp;</td>
		<td><?php echo h($patientHistory['PatientHistory']['state']); ?>&nbsp;</td>
		<td><?php echo h($patientHistory['PatientHistory']['zip']); ?>&nbsp;</td>
		<td><?php echo h($patientHistory['PatientHistory']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $patientHistory['PatientHistory']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $patientHistory['PatientHistory']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $patientHistory['PatientHistory']['id']), null, __('Are you sure you want to delete # %s?', $patientHistory['PatientHistory']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Patient History'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Patients'), array('controller' => 'patients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Patient'), array('controller' => 'patients', 'action' => 'add')); ?> </li>
	</ul>
</div>
