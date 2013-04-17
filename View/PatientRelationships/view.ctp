<div class="patientRelationships view">
<h2><?php  echo __('Patient Relationship'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($patientRelationship['PatientRelationship']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($patientRelationship['PatientRelationship']['description']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Patient Relationship'), array('action' => 'edit', $patientRelationship['PatientRelationship']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Patient Relationship'), array('action' => 'delete', $patientRelationship['PatientRelationship']['id']), null, __('Are you sure you want to delete # %s?', $patientRelationship['PatientRelationship']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Patient Relationships'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Patient Relationship'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Insurances'), array('controller' => 'insurances', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Insurance'), array('controller' => 'insurances', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Insurances'); ?></h3>
	<?php if (!empty($patientRelationship['Insurance'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Street1'); ?></th>
		<th><?php echo __('Street2'); ?></th>
		<th><?php echo __('City'); ?></th>
		<th><?php echo __('State'); ?></th>
		<th><?php echo __('Zip'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($patientRelationship['Insurance'] as $insurance): ?>
		<tr>
			<td><?php echo $insurance['id']; ?></td>
			<td><?php echo $insurance['name']; ?></td>
			<td><?php echo $insurance['street1']; ?></td>
			<td><?php echo $insurance['street2']; ?></td>
			<td><?php echo $insurance['city']; ?></td>
			<td><?php echo $insurance['state']; ?></td>
			<td><?php echo $insurance['zip']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'insurances', 'action' => 'view', $insurance['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'insurances', 'action' => 'edit', $insurance['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'insurances', 'action' => 'delete', $insurance['id']), null, __('Are you sure you want to delete # %s?', $insurance['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Insurance'), array('controller' => 'insurances', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
