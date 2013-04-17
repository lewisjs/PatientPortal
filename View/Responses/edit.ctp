<div class="responses form">
<?php echo $this->Form->create('Response'); ?>
	<fieldset>
		<legend><?php echo __('Edit Response'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('value');
		echo $this->Form->input('text');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Response.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Response.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Responses'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Questions Responses'), array('controller' => 'questions_responses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Questions Response'), array('controller' => 'questions_responses', 'action' => 'add')); ?> </li>
	</ul>
</div>
