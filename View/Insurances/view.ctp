<div class="insurances view">
<h2><?php  echo __('Insurance'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($insurance['Insurance']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($insurance['Insurance']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Street1'); ?></dt>
		<dd>
			<?php echo h($insurance['Insurance']['street1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Street2'); ?></dt>
		<dd>
			<?php echo h($insurance['Insurance']['street2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('City'); ?></dt>
		<dd>
			<?php echo h($insurance['Insurance']['city']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('State'); ?></dt>
		<dd>
			<?php echo h($insurance['Insurance']['state']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Zip'); ?></dt>
		<dd>
			<?php echo h($insurance['Insurance']['zip']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Insurance'), array('action' => 'edit', $insurance['Insurance']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Insurance'), array('action' => 'delete', $insurance['Insurance']['id']), null, __('Are you sure you want to delete # %s?', $insurance['Insurance']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Insurances'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Insurance'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Insurance Patient Relationships'), array('controller' => 'insurance_patient_relationships', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Insurance Patient Relationship'), array('controller' => 'insurance_patient_relationships', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Insurance Patient Relationships'); ?></h3>
	<?php if (!empty($insurance['InsurancePatientRelationship'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Insuree Id'); ?></th>
		<th><?php echo __('Insurer Id'); ?></th>
		<th><?php echo __('Relationship Id'); ?></th>
		<th><?php echo __('Insurance Id'); ?></th>
		<th><?php echo __('Insurance No'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($insurance['InsurancePatientRelationship'] as $insurancePatientRelationship): ?>
		<tr>
			<td><?php echo $insurancePatientRelationship['id']; ?></td>
			<td><?php echo $insurancePatientRelationship['insuree_id']; ?></td>
			<td><?php echo $insurancePatientRelationship['insurer_id']; ?></td>
			<td><?php echo $insurancePatientRelationship['relationship_id']; ?></td>
			<td><?php echo $insurancePatientRelationship['insurance_id']; ?></td>
			<td><?php echo $insurancePatientRelationship['insurance_no']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'insurance_patient_relationships', 'action' => 'view', $insurancePatientRelationship['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'insurance_patient_relationships', 'action' => 'edit', $insurancePatientRelationship['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'insurance_patient_relationships', 'action' => 'delete', $insurancePatientRelationship['id']), null, __('Are you sure you want to delete # %s?', $insurancePatientRelationship['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Insurance Patient Relationship'), array('controller' => 'insurance_patient_relationships', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
