<div class="providers index">
	<h2><?php echo __('Providers'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('practice_id'); ?></th>
			<th><?php echo $this->Paginator->sort('last_name'); ?></th>
			<th><?php echo $this->Paginator->sort('first_name'); ?></th>
			<th><?php echo $this->Paginator->sort('middle_name'); ?></th>
			<th><?php echo $this->Paginator->sort('degree'); ?></th>
			<th><?php echo $this->Paginator->sort('phone'); ?></th>
			<th><?php echo $this->Paginator->sort('fax'); ?></th>
			<th><?php echo $this->Paginator->sort('street1'); ?></th>
			<th><?php echo $this->Paginator->sort('street2'); ?></th>
			<th><?php echo $this->Paginator->sort('city'); ?></th>
			<th><?php echo $this->Paginator->sort('state'); ?></th>
			<th><?php echo $this->Paginator->sort('zip'); ?></th>
			<th><?php echo $this->Paginator->sort('npi'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($providers as $provider): ?>
	<tr>
		<td><?php echo h($provider['Provider']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($provider['Practice']['id'], array('controller' => 'practices', 'action' => 'view', $provider['Practice']['id'])); ?>
		</td>
		<td><?php echo h($provider['Provider']['last_name']); ?>&nbsp;</td>
		<td><?php echo h($provider['Provider']['first_name']); ?>&nbsp;</td>
		<td><?php echo h($provider['Provider']['middle_name']); ?>&nbsp;</td>
		<td><?php echo h($provider['Provider']['degree']); ?>&nbsp;</td>
		<td><?php echo h($provider['Provider']['phone']); ?>&nbsp;</td>
		<td><?php echo h($provider['Provider']['fax']); ?>&nbsp;</td>
		<td><?php echo h($provider['Provider']['street1']); ?>&nbsp;</td>
		<td><?php echo h($provider['Provider']['street2']); ?>&nbsp;</td>
		<td><?php echo h($provider['Provider']['city']); ?>&nbsp;</td>
		<td><?php echo h($provider['Provider']['state']); ?>&nbsp;</td>
		<td><?php echo h($provider['Provider']['zip']); ?>&nbsp;</td>
		<td><?php echo h($provider['Provider']['npi']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $provider['Provider']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $provider['Provider']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $provider['Provider']['id']), null, __('Are you sure you want to delete # %s?', $provider['Provider']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Provider'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Practices'), array('controller' => 'practices', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Practice'), array('controller' => 'practices', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Appointments'), array('controller' => 'appointments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Appointment'), array('controller' => 'appointments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Referral Files'), array('controller' => 'referral_files', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Referral File'), array('controller' => 'referral_files', 'action' => 'add')); ?> </li>
	</ul>
</div>
