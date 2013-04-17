<div class="referralFiles view">
<h2><?php  echo __('Referral File'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($referralFile['ReferralFile']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Provider'); ?></dt>
		<dd>
			<?php echo $this->Html->link($referralFile['Provider']['id'], array('controller' => 'providers', 'action' => 'view', $referralFile['Provider']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Referral'); ?></dt>
		<dd>
			<?php echo $this->Html->link($referralFile['Referral']['id'], array('controller' => 'referrals', 'action' => 'view', $referralFile['Referral']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($referralFile['ReferralFile']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($referralFile['ReferralFile']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Size'); ?></dt>
		<dd>
			<?php echo h($referralFile['ReferralFile']['size']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($referralFile['ReferralFile']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($referralFile['ReferralFile']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($referralFile['ReferralFile']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Referral File'), array('action' => 'edit', $referralFile['ReferralFile']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Referral File'), array('action' => 'delete', $referralFile['ReferralFile']['id']), null, __('Are you sure you want to delete # %s?', $referralFile['ReferralFile']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Referral Files'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Referral File'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Providers'), array('controller' => 'providers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Provider'), array('controller' => 'providers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Referrals'), array('controller' => 'referrals', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Referral'), array('controller' => 'referrals', 'action' => 'add')); ?> </li>
	</ul>
</div>
