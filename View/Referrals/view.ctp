<div class="referrals view">
<h2><?php  echo __('Referral'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($referral['Referral']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Patient'); ?></dt>
		<dd>
			<?php echo $this->Html->link($referral['Patient']['id'], array('controller' => 'patients', 'action' => 'view', $referral['Patient']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Practice'); ?></dt>
		<dd>
			<?php echo $this->Html->link($referral['Practice']['id'], array('controller' => 'practices', 'action' => 'view', $referral['Practice']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Referral Status'); ?></dt>
		<dd>
			<?php echo $this->Html->link($referral['ReferralStatus']['id'], array('controller' => 'referral_statuses', 'action' => 'view', $referral['ReferralStatus']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Asap'); ?></dt>
		<dd>
			<?php echo h($referral['Referral']['asap']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Referral'), array('action' => 'edit', $referral['Referral']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Referral'), array('action' => 'delete', $referral['Referral']['id']), null, __('Are you sure you want to delete # %s?', $referral['Referral']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Referrals'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Referral'), array('action' => 'add')); ?> </li>
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
<div class="related">
	<h3><?php echo __('Related Referral Files'); ?></h3>
	<?php if (!empty($referral['ReferralFile'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Provider Id'); ?></th>
		<th><?php echo __('Referral Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Type'); ?></th>
		<th><?php echo __('Size'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($referral['ReferralFile'] as $referralFile): ?>
		<tr>
			<td><?php echo $referralFile['id']; ?></td>
			<td><?php echo $referralFile['provider_id']; ?></td>
			<td><?php echo $referralFile['referral_id']; ?></td>
			<td><?php echo $referralFile['name']; ?></td>
			<td><?php echo $referralFile['type']; ?></td>
			<td><?php echo $referralFile['size']; ?></td>
			<td><?php echo $referralFile['description']; ?></td>
			<td><?php echo $referralFile['modified']; ?></td>
			<td><?php echo $referralFile['created']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'referral_files', 'action' => 'view', $referralFile['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'referral_files', 'action' => 'edit', $referralFile['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'referral_files', 'action' => 'delete', $referralFile['id']), null, __('Are you sure you want to delete # %s?', $referralFile['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Referral File'), array('controller' => 'referral_files', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
