<div class="questionnaires form">
<?php echo $this->Form->create('Questionnaire'); ?>
	<fieldset>
		<legend><?php echo __('Edit Questionnaire'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Questionnaire.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Questionnaire.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Questionnaires'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Questionnaire Groups'), array('controller' => 'questionnaire_groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Questionnaire Group'), array('controller' => 'questionnaire_groups', 'action' => 'add')); ?> </li>
	</ul>
</div>
