<?php 
require_once('../Lib/view_utils.php');

function write_responses_checkboxes(&$obj, &$responses, $responseIt) {
	echo '<div class="outline">';
	echo $obj->Form->input(
		'QuestionsResponse.Response.' .$responseIt . '.id',
		array(
			'label' => $responses[$responseIt]['Response']['text'],
			'type' => 'checkbox',
			'value' => array($responses[$responseIt]['Response']['id']),
			'hiddenField' => false,
		)
	);
	echo $obj->Form->input(
		'QuestionsResponse.' . $responseIt . '.number',
		array('type' => 'number', )
	);
	echo '</div>';
}

$this->extend('/Common/questionnaire_questions_responses_view');

$this->start('mainContent');
?>

<div class="questionsResponses form">
<?php echo $this->Form->create('QuestionsResponse'); ?>
	<fieldset style="width:100%">
		<legend><?php echo __('Add Questions Response'); ?></legend>
		<?php
		echo $this->Form->input('question_id');
		columnize($responses, 'write_responses_checkboxes', $this);
		?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Questions Responses'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Questions'), array('controller' => 'questions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question'), array('controller' => 'questions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Responses'), array('controller' => 'responses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Response'), array('controller' => 'responses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Patients'), array('controller' => 'patients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Patient'), array('controller' => 'patients', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php $this->end(); ?>