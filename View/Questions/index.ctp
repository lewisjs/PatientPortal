<div class="questions index">
	<h2><?php echo __('Questions'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('questionnaire_page_id'); ?></th>
			<th><?php echo $this->Paginator->sort('type'); ?></th>
			<th><?php echo $this->Paginator->sort('text'); ?></th>
			<th><?php echo $this->Paginator->sort('number'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($questions as $question): ?>
	<tr>
		<td><?php echo h($question['Question']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($question['QuestionnairePage']['title'], array('controller' => 'questionnaire_pages', 'action' => 'view', $question['QuestionnairePage']['id'])); ?>
		</td>
		<td><?php echo h($question['Question']['type']); ?>&nbsp;</td>
		<td><?php echo h($question['Question']['text']); ?>&nbsp;</td>
		<td><?php echo h($question['Question']['number']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $question['Question']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $question['Question']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $question['Question']['id']), null, __('Are you sure you want to delete # %s?', $question['Question']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

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
		<li><?php echo $this->Html->link(__('New Question'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Questionnaire Pages'), array('controller' => 'questionnaire_pages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Questionnaire Page'), array('controller' => 'questionnaire_pages', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Questions Responses'), array('controller' => 'questions_responses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Questions Response'), array('controller' => 'questions_responses', 'action' => 'add')); ?> </li>
	</ul>
</div>
