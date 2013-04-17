<div class="questions view">
<h2><?php  echo __('Question'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($question['Question']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Questionnaire Page'); ?></dt>
		<dd>
			<?php echo $this->Html->link($question['QuestionnairePage']['title'], array('controller' => 'questionnaire_pages', 'action' => 'view', $question['QuestionnairePage']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($question['Question']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Text'); ?></dt>
		<dd>
			<?php echo h($question['Question']['text']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Number'); ?></dt>
		<dd>
			<?php echo h($question['Question']['number']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Question'), array('action' => 'edit', $question['Question']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Question'), array('action' => 'delete', $question['Question']['id']), null, __('Are you sure you want to delete # %s?', $question['Question']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Questions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Questionnaire Pages'), array('controller' => 'questionnaire_pages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Questionnaire Page'), array('controller' => 'questionnaire_pages', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Questions Responses'), array('controller' => 'questions_responses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Questions Response'), array('controller' => 'questions_responses', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Questions Responses'); ?></h3>
	<?php if (!empty($question['QuestionsResponse'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Question Id'); ?></th>
		<th><?php echo __('Response Id'); ?></th>
		<th><?php echo __('Number'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($question['QuestionsResponse'] as $questionsResponse): ?>
		<tr>
			<td><?php echo $questionsResponse['id']; ?></td>
			<td><?php echo $questionsResponse['question_id']; ?></td>
			<td><?php echo $questionsResponse['response_id']; ?></td>
			<td><?php echo $questionsResponse['number']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'questions_responses', 'action' => 'view', $questionsResponse['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'questions_responses', 'action' => 'edit', $questionsResponse['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'questions_responses', 'action' => 'delete', $questionsResponse['id']), null, __('Are you sure you want to delete # %s?', $questionsResponse['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Questions Response'), array('controller' => 'questions_responses', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
