<?php
if ($this->Session->read('Auth.User')) {
	switch($this->Session->read('Auth.User.group_id')) {
		case Configure::read('PatientPortal.group_id.Patient'):
			$this->extend('/Common/patient_referralFile_view');
			break;
		case Configure::read('PatientPortal.group_id.Clinician'):
		case Configure::read('PatientPortal.group_id.Coordinator'):
		case Configure::read('PatientPortal.group_id.Administrator'):
		default:
			throw new InternalErrorException('WTF happened here???');
	}
}
else {
	$this->extend('/Common/login_view');
}

$this->start('mainContent');
?>
<div class="referrals index">
	<h2><?php echo __('Referrals'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('patient_id'); ?></th>
			<th><?php echo $this->Paginator->sort('practice_id'); ?></th>
			<th><?php echo $this->Paginator->sort('referral_status_id'); ?></th>
			<th><?php echo $this->Paginator->sort('asap'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($referrals as $referral): ?>
	<tr>
		<td><?php echo h($referral['Referral']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($referral['Patient']['id'], array('controller' => 'patients', 'action' => 'view', $referral['Patient']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($referral['Practice']['id'], array('controller' => 'practices', 'action' => 'view', $referral['Practice']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($referral['ReferralStatus']['id'], array('controller' => 'referral_statuses', 'action' => 'view', $referral['ReferralStatus']['id'])); ?>
		</td>
		<td><?php echo h($referral['Referral']['asap']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $referral['Referral']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $referral['Referral']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $referral['Referral']['id']), null, __('Are you sure you want to delete # %s?', $referral['Referral']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Referral'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Patients'), array('controller' => 'patients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Patient'), array('controller' => 'patients', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Practices'), array('controller' => 'practices', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Practice'), array('controller' => 'practices', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Referral Statuses'), array('controller' => 'referral_statuses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Referral Status'), array('controller' => 'referral_statuses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Referral Files'), array('controller' => 'referral_files', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Referral File'), array('controller' => 'referral_files', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php $this->end(); ?>