<div class="patientMaritalStatuses form">
<?php echo $this->Form->create('PatientMaritalStatus'); ?>
	<fieldset>
		<legend><?php echo __('Edit Patient Marital Status'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('PatientMaritalStatus.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('PatientMaritalStatus.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Patient Marital Statuses'), array('action' => 'index')); ?></li>
	</ul>
</div>
