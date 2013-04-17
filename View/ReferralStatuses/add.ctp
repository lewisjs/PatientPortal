<div class="referralStatuses form">
<?php echo $this->Form->create('ReferralStatus'); ?>
	<fieldset>
		<legend><?php echo __('Add Referral Status'); ?></legend>
	<?php
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Referral Statuses'), array('action' => 'index')); ?></li>
	</ul>
</div>
