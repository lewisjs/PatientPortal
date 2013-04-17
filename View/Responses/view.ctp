<div class="responses view">
<h2><?php  echo __('Response'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($response['Response']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Value'); ?></dt>
		<dd>
			<?php echo h($response['Response']['value']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Text'); ?></dt>
		<dd>
			<?php echo h($response['Response']['text']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Response'), array('action' => 'edit', $response['Response']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Response'), array('action' => 'delete', $response['Response']['id']), null, __('Are you sure you want to delete # %s?', $response['Response']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Responses'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Response'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Questions Responses'), array('controller' => 'questions_responses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Questions Response'), array('controller' => 'questions_responses', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Questions Responses'); ?></h3>
	<?php if (!empty($response['QuestionsResponse'])): ?>
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
		foreach ($response['QuestionsResponse'] as $questionsResponse): ?>
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
