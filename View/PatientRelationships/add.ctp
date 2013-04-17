<div class="patientRelationships form">
<?php echo $this->Form->create('PatientRelationship'); ?>
	<fieldset>
		<legend><?php echo __('Add Patient Relationship'); ?></legend>
	<?php
		echo $this->Form->input('description');
		echo $this->Form->input('Insurance');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Patient Relationships'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Insurances'), array('controller' => 'insurances', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Insurance'), array('controller' => 'insurances', 'action' => 'add')); ?> </li>
	</ul>
</div>
