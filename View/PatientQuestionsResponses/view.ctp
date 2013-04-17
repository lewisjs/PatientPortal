<div class="patientQuestionsResponses view">
<h2><?php  echo __('Patient Questions Response'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($patientQuestionsResponse['PatientQuestionsResponse']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Patient'); ?></dt>
		<dd>
			<?php echo $this->Html->link($patientQuestionsResponse['Patient']['id'], array('controller' => 'patients', 'action' => 'view', $patientQuestionsResponse['Patient']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Questions Response'); ?></dt>
		<dd>
			<?php echo $this->Html->link($patientQuestionsResponse['QuestionsResponse']['id'], array('controller' => 'questions_responses', 'action' => 'view', $patientQuestionsResponse['QuestionsResponse']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($patientQuestionsResponse['PatientQuestionsResponse']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Patient Questions Response'), array('action' => 'edit', $patientQuestionsResponse['PatientQuestionsResponse']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Patient Questions Response'), array('action' => 'delete', $patientQuestionsResponse['PatientQuestionsResponse']['id']), null, __('Are you sure you want to delete # %s?', $patientQuestionsResponse['PatientQuestionsResponse']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Patient Questions Responses'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Patient Questions Response'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Patients'), array('controller' => 'patients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Patient'), array('controller' => 'patients', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Questions Responses'), array('controller' => 'questions_responses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Questions Response'), array('controller' => 'questions_responses', 'action' => 'add')); ?> </li>
	</ul>
</div>
