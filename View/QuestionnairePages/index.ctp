<div class="questionnairePages index">
	<h2><?php echo __('Questionnaire Pages'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('questionnaire_id'); ?></th>
			<th><?php echo $this->Paginator->sort('number'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($questionnairePages as $questionnairePage): ?>
	<tr>
		<td><?php echo h($questionnairePage['QuestionnairePage']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($questionnairePage['Questionnaire']['title'], array('controller' => 'questionnaires', 'action' => 'view', $questionnairePage['Questionnaire']['id'])); ?>
		</td>
		<td><?php echo h($questionnairePage['QuestionnairePage']['number']); ?>&nbsp;</td>
		<td><?php echo h($questionnairePage['QuestionnairePage']['title']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $questionnairePage['QuestionnairePage']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $questionnairePage['QuestionnairePage']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $questionnairePage['QuestionnairePage']['id']), null, __('Are you sure you want to delete # %s?', $questionnairePage['QuestionnairePage']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Questionnaire Page'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Questionnaires'), array('controller' => 'questionnaires', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Questionnaire'), array('controller' => 'questionnaires', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Questions'), array('controller' => 'questions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question'), array('controller' => 'questions', 'action' => 'add')); ?> </li>
	</ul>
</div>
