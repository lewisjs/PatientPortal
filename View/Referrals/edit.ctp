<div class="referrals form">
<?php echo $this->Form->create('Referral'); ?>
	<fieldset>
		<legend><?php echo __('Edit Referral'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('patient_id');
		echo $this->Form->input('practice_id');
		echo $this->Form->input('referral_status_id');
		echo $this->Form->input('asap');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Referral.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Referral.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Referrals'), array('action' => 'index')); ?></li>
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
