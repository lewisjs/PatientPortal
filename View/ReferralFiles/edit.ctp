<div class="referralFiles form">
<?php echo $this->Form->create('ReferralFile'); ?>
	<fieldset>
		<legend><?php echo __('Edit Referral File'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('provider_id');
		echo $this->Form->input('referral_id');
		echo $this->Form->input('name');
		echo $this->Form->input('type');
		echo $this->Form->input('size');
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ReferralFile.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('ReferralFile.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Referral Files'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Providers'), array('controller' => 'providers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Provider'), array('controller' => 'providers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Referrals'), array('controller' => 'referrals', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Referral'), array('controller' => 'referrals', 'action' => 'add')); ?> </li>
	</ul>
</div>
