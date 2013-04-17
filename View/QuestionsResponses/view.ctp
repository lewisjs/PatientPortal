<div class="questionsResponses view">
<h2><?php  echo __('Questions Response'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($questionsResponse['QuestionsResponse']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Question'); ?></dt>
		<dd>
			<?php echo $this->Html->link($questionsResponse['Question']['id'], array('controller' => 'questions', 'action' => 'view', $questionsResponse['Question']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Response'); ?></dt>
		<dd>
			<?php echo $this->Html->link($questionsResponse['Response']['id'], array('controller' => 'responses', 'action' => 'view', $questionsResponse['Response']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Number'); ?></dt>
		<dd>
			<?php echo h($questionsResponse['QuestionsResponse']['number']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Questions Response'), array('action' => 'edit', $questionsResponse['QuestionsResponse']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Questions Response'), array('action' => 'delete', $questionsResponse['QuestionsResponse']['id']), null, __('Are you sure you want to delete # %s?', $questionsResponse['QuestionsResponse']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Questions Responses'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Questions Response'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Questions'), array('controller' => 'questions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question'), array('controller' => 'questions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Responses'), array('controller' => 'responses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Response'), array('controller' => 'responses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Patients'), array('controller' => 'patients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Patient'), array('controller' => 'patients', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Patients'); ?></h3>
	<?php if (!empty($questionsResponse['Patient'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Last Name'); ?></th>
		<th><?php echo __('First Name'); ?></th>
		<th><?php echo __('Middle Name'); ?></th>
		<th><?php echo __('Maiden Name'); ?></th>
		<th><?php echo __('Date Of Birth'); ?></th>
		<th><?php echo __('Patient Gender Id'); ?></th>
		<th><?php echo __('Street1'); ?></th>
		<th><?php echo __('Street2'); ?></th>
		<th><?php echo __('City'); ?></th>
		<th><?php echo __('State'); ?></th>
		<th><?php echo __('Zip'); ?></th>
		<th><?php echo __('Home Phone'); ?></th>
		<th><?php echo __('Mobile Phone'); ?></th>
		<th><?php echo __('Work Phone'); ?></th>
		<th><?php echo __('Patient Marital Status Id'); ?></th>
		<th><?php echo __('Location Id'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($questionsResponse['Patient'] as $patient): ?>
		<tr>
			<td><?php echo $patient['id']; ?></td>
			<td><?php echo $patient['last_name']; ?></td>
			<td><?php echo $patient['first_name']; ?></td>
			<td><?php echo $patient['middle_name']; ?></td>
			<td><?php echo $patient['maiden_name']; ?></td>
			<td><?php echo $patient['date_of_birth']; ?></td>
			<td><?php echo $patient['patient_gender_id']; ?></td>
			<td><?php echo $patient['street1']; ?></td>
			<td><?php echo $patient['street2']; ?></td>
			<td><?php echo $patient['city']; ?></td>
			<td><?php echo $patient['state']; ?></td>
			<td><?php echo $patient['zip']; ?></td>
			<td><?php echo $patient['home_phone']; ?></td>
			<td><?php echo $patient['mobile_phone']; ?></td>
			<td><?php echo $patient['work_phone']; ?></td>
			<td><?php echo $patient['patient_marital_status_id']; ?></td>
			<td><?php echo $patient['location_id']; ?></td>
			<td><?php echo $patient['modified']; ?></td>
			<td><?php echo $patient['created']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'patients', 'action' => 'view', $patient['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'patients', 'action' => 'edit', $patient['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'patients', 'action' => 'delete', $patient['id']), null, __('Are you sure you want to delete # %s?', $patient['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Patient'), array('controller' => 'patients', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
