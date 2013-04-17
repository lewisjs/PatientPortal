<div class="patientMaritalStatuses form">
<?php echo $this->Form->create('PatientMaritalStatus'); ?>
	<fieldset>
		<legend><?php echo __('Add Patient Marital Status'); ?></legend>
	<?php
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Patient Marital Statuses'), array('action' => 'index')); ?></li>
	</ul>
</div>
