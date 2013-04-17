<?php
$this->extend('/Common/questionnaire_questions_responses_view');

$this->start('mainContent');
?>

<div class="questionsResponses index">
	<h2><?php echo __('Questions Responses'); ?></h2>
	
	<table cellpadding="0" cellspacing="0">
	
		<tr>
			<th><?php echo $this->Paginator->sort('Question.text', 'Question'); ?></th>
			<th><?php echo $this->Paginator->sort('Response.text', 'Response'); ?></th>
			<th><?php echo $this->Paginator->sort('number'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
	
		<?php foreach ($questionsResponses as $questionsResponse): ?>
		<tr>
			<td>
				<?php echo $this->Html->link($questionsResponse['Question']['text'], array('controller' => 'questions', 'action' => 'view', $questionsResponse['Question']['id'])); ?>
			</td>
			<td>
				<?php echo $this->Html->link($questionsResponse['Response']['text'], array('controller' => 'responses', 'action' => 'view', $questionsResponse['Response']['id'])); ?>
			</td>
			<td><?php echo h($questionsResponse['QuestionsResponse']['number']); ?>&nbsp;</td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('action' => 'view', $questionsResponse['QuestionsResponse']['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $questionsResponse['QuestionsResponse']['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $questionsResponse['QuestionsResponse']['id']), null, __('Are you sure you want to delete # %s?', $questionsResponse['QuestionsResponse']['id'])); ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>
	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Questions Response'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Questions'), array('controller' => 'questions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question'), array('controller' => 'questions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Responses'), array('controller' => 'responses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Response'), array('controller' => 'responses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Patients'), array('controller' => 'patients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Patient'), array('controller' => 'patients', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php $this->end(); ?>