<div class="patientGenders form">
<?php echo $this->Form->create('PatientGender'); ?>
	<fieldset>
		<legend><?php echo __('Add Patient Gender'); ?></legend>
	<?php
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Patient Genders'), array('action' => 'index')); ?></li>
	</ul>
</div>
