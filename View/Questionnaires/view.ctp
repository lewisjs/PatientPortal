<div class="questionnaires view">
<h2><?php  echo __('Questionnaire'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($questionnaire['Questionnaire']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($questionnaire['Questionnaire']['title']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Questionnaire'), array('action' => 'edit', $questionnaire['Questionnaire']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Questionnaire'), array('action' => 'delete', $questionnaire['Questionnaire']['id']), null, __('Are you sure you want to delete # %s?', $questionnaire['Questionnaire']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Questionnaires'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Questionnaire'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Questionnaire Groups'), array('controller' => 'questionnaire_groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Questionnaire Group'), array('controller' => 'questionnaire_groups', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Questionnaire Groups'); ?></h3>
	<?php if (!empty($questionnaire['QuestionnaireGroup'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Questionnaire Id'); ?></th>
		<th><?php echo __('Page'); ?></th>
		<th><?php echo __('Order'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($questionnaire['QuestionnaireGroup'] as $questionnaireGroup): ?>
		<tr>
			<td><?php echo $questionnaireGroup['id']; ?></td>
			<td><?php echo $questionnaireGroup['questionnaire_id']; ?></td>
			<td><?php echo $questionnaireGroup['page']; ?></td>
			<td><?php echo $questionnaireGroup['order']; ?></td>
			<td><?php echo $questionnaireGroup['title']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'questionnaire_groups', 'action' => 'view', $questionnaireGroup['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'questionnaire_groups', 'action' => 'edit', $questionnaireGroup['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'questionnaire_groups', 'action' => 'delete', $questionnaireGroup['id']), null, __('Are you sure you want to delete # %s?', $questionnaireGroup['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Questionnaire Group'), array('controller' => 'questionnaire_groups', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
