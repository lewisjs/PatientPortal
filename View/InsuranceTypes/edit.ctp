<div class="insuranceTypes form">
<?php echo $this->Form->create('InsuranceType'); ?>
	<fieldset>
		<legend><?php echo __('Edit Insurance Type'); ?></legend>
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

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('InsuranceType.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('InsuranceType.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Insurance Types'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Insurance Patient Relationships'), array('controller' => 'insurance_patient_relationships', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Insurance Patient Relationship'), array('controller' => 'insurance_patient_relationships', 'action' => 'add')); ?> </li>
	</ul>
</div>
