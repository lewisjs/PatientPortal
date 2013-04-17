<div class="questionnaires index">
	<h2><?php echo __('Questionnaires'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($questionnaires as $questionnaire): ?>
	<tr>
		<td><?php echo h($questionnaire['Questionnaire']['id']); ?>&nbsp;</td>
		<td><?php echo h($questionnaire['Questionnaire']['title']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $questionnaire['Questionnaire']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $questionnaire['Questionnaire']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $questionnaire['Questionnaire']['id']), null, __('Are you sure you want to delete # %s?', $questionnaire['Questionnaire']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Questionnaire'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Questionnaire Groups'), array('controller' => 'questionnaire_groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Questionnaire Group'), array('controller' => 'questionnaire_groups', 'action' => 'add')); ?> </li>
	</ul>
</div>
