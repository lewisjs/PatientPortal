<div class="patients index">
	<h2><?php echo __('Patients'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('last_name'); ?></th>
			<th><?php echo $this->Paginator->sort('first_name'); ?></th>
			<th><?php echo $this->Paginator->sort('middle_name'); ?></th>
			<th><?php echo $this->Paginator->sort('maiden_name'); ?></th>
			<th><?php echo $this->Paginator->sort('date_of_birth'); ?></th>
			<th><?php echo $this->Paginator->sort('patient_gender_id'); ?></th>
			<th><?php echo $this->Paginator->sort('street1'); ?></th>
			<th><?php echo $this->Paginator->sort('street2'); ?></th>
			<th><?php echo $this->Paginator->sort('city'); ?></th>
			<th><?php echo $this->Paginator->sort('state'); ?></th>
			<th><?php echo $this->Paginator->sort('zip'); ?></th>
			<th><?php echo $this->Paginator->sort('home_phone'); ?></th>
			<th><?php echo $this->Paginator->sort('mobile_phone'); ?></th>
			<th><?php echo $this->Paginator->sort('work_phone'); ?></th>
			<th><?php echo $this->Paginator->sort('patient_marital_status_id'); ?></th>
			<th><?php echo $this->Paginator->sort('location_id'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($patients as $patient): ?>
	<tr>
		<td><?php echo h($patient['Patient']['id']); ?>&nbsp;</td>
		<td><?php echo h($patient['Patient']['last_name']); ?>&nbsp;</td>
		<td><?php echo h($patient['Patient']['first_name']); ?>&nbsp;</td>
		<td><?php echo h($patient['Patient']['middle_name']); ?>&nbsp;</td>
		<td><?php echo h($patient['Patient']['maiden_name']); ?>&nbsp;</td>
		<td><?php echo h($patient['Patient']['date_of_birth']); ?>&nbsp;</td>
		<td><?php echo h($patient['Patient']['patient_gender_id']); ?>&nbsp;</td>
		<td><?php echo h($patient['Patient']['street1']); ?>&nbsp;</td>
		<td><?php echo h($patient['Patient']['street2']); ?>&nbsp;</td>
		<td><?php echo h($patient['Patient']['city']); ?>&nbsp;</td>
		<td><?php echo h($patient['Patient']['state']); ?>&nbsp;</td>
		<td><?php echo h($patient['Patient']['zip']); ?>&nbsp;</td>
		<td><?php echo h($patient['Patient']['home_phone']); ?>&nbsp;</td>
		<td><?php echo h($patient['Patient']['mobile_phone']); ?>&nbsp;</td>
		<td><?php echo h($patient['Patient']['work_phone']); ?>&nbsp;</td>
		<td><?php echo h($patient['Patient']['patient_marital_status_id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($patient['Location']['id'], array('controller' => 'locations', 'action' => 'view', $patient['Location']['id'])); ?>
		</td>
		<td><?php echo h($patient['Patient']['modified']); ?>&nbsp;</td>
		<td><?php echo h($patient['Patient']['created']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $patient['Patient']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $patient['Patient']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $patient['Patient']['id']), null, __('Are you sure you want to delete # %s?', $patient['Patient']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Patient'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Locations'), array('controller' => 'locations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Location'), array('controller' => 'locations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Appointments'), array('controller' => 'appointments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Appointment'), array('controller' => 'appointments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Insurance Patient Relationships'), array('controller' => 'insurance_patient_relationships', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Insurance Patient Relationship'), array('controller' => 'insurance_patient_relationships', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Patient Histories'), array('controller' => 'patient_histories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Patient History'), array('controller' => 'patient_histories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Patient Question Choices'), array('controller' => 'patient_question_choices', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Patient Question Choice'), array('controller' => 'patient_question_choices', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Patient Transmits'), array('controller' => 'patient_transmits', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Patient Transmit'), array('controller' => 'patient_transmits', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Referrals'), array('controller' => 'referrals', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Referral'), array('controller' => 'referrals', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Practices'), array('controller' => 'practices', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Practice'), array('controller' => 'practices', 'action' => 'add')); ?> </li>
	</ul>
</div>
