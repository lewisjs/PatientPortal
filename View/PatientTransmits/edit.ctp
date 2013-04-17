<div class="patientTransmits form">
<?php echo $this->Form->create('PatientTransmit'); ?>
	<fieldset>
		<legend><?php echo __('Edit Patient Transmit'); ?></legend>
	<?php
		echo $this->Form->input('patient_id');
		echo $this->Form->input('sent');
		echo $this->Form->input('date_sent');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('PatientTransmit.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('PatientTransmit.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Patient Transmits'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Patients'), array('controller' => 'patients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Patient'), array('controller' => 'patients', 'action' => 'add')); ?> </li>
	</ul>
</div>
