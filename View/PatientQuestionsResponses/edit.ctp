<div class="patientQuestionsResponses form">
<?php echo $this->Form->create('PatientQuestionsResponse'); ?>
	<fieldset>
		<legend><?php echo __('Edit Patient Questions Response'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('patient_id');
		echo $this->Form->input('questions_response_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('PatientQuestionsResponse.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('PatientQuestionsResponse.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Patient Questions Responses'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Patients'), array('controller' => 'patients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Patient'), array('controller' => 'patients', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Questions Responses'), array('controller' => 'questions_responses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Questions Response'), array('controller' => 'questions_responses', 'action' => 'add')); ?> </li>
	</ul>
</div>
