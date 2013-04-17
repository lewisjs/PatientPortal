<div class="referralStatuses view">
<h2><?php  echo __('Referral Status'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($referralStatus['ReferralStatus']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($referralStatus['ReferralStatus']['description']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Referral Status'), array('action' => 'edit', $referralStatus['ReferralStatus']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Referral Status'), array('action' => 'delete', $referralStatus['ReferralStatus']['id']), null, __('Are you sure you want to delete # %s?', $referralStatus['ReferralStatus']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Referral Statuses'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Referral Status'), array('action' => 'add')); ?> </li>
	</ul>
</div>
