<div class="insurances form">
<?php echo $this->Form->create('Insurance'); ?>
	<fieldset>
		<legend><?php echo __('Add Insurance'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('street1');
		echo $this->Form->input('street2');
		echo $this->Form->input('city');
		echo $this->Form->input('state');
		echo $this->Form->input('zip');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Insurances'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Insurance Patient Relationships'), array('controller' => 'insurance_patient_relationships', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Insurance Patient Relationship'), array('controller' => 'insurance_patient_relationships', 'action' => 'add')); ?> </li>
	</ul>
</div>
