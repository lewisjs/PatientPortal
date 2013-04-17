<div class="questionnairePages view">
<h2><?php  echo __('Questionnaire Page'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($questionnairePage['QuestionnairePage']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Questionnaire'); ?></dt>
		<dd>
			<?php echo $this->Html->link($questionnairePage['Questionnaire']['title'], array('controller' => 'questionnaires', 'action' => 'view', $questionnairePage['Questionnaire']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Number'); ?></dt>
		<dd>
			<?php echo h($questionnairePage['QuestionnairePage']['number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($questionnairePage['QuestionnairePage']['title']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Questionnaire Page'), array('action' => 'edit', $questionnairePage['QuestionnairePage']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Questionnaire Page'), array('action' => 'delete', $questionnairePage['QuestionnairePage']['id']), null, __('Are you sure you want to delete # %s?', $questionnairePage['QuestionnairePage']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Questionnaire Pages'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Questionnaire Page'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Questionnaires'), array('controller' => 'questionnaires', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Questionnaire'), array('controller' => 'questionnaires', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Questions'), array('controller' => 'questions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question'), array('controller' => 'questions', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Questions'); ?></h3>
	<?php if (!empty($questionnairePage['Question'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Questionnaire Page Id'); ?></th>
		<th><?php echo __('Type'); ?></th>
		<th><?php echo __('Text'); ?></th>
		<th><?php echo __('Number'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($questionnairePage['Question'] as $question): ?>
		<tr>
			<td><?php echo $question['id']; ?></td>
			<td><?php echo $question['questionnaire_page_id']; ?></td>
			<td><?php echo $question['type']; ?></td>
			<td><?php echo $question['text']; ?></td>
			<td><?php echo $question['number']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'questions', 'action' => 'view', $question['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'questions', 'action' => 'edit', $question['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'questions', 'action' => 'delete', $question['id']), null, __('Are you sure you want to delete # %s?', $question['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Question'), array('controller' => 'questions', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
