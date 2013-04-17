<div class="insuranceTypes view">
<h2><?php  echo __('Insurance Type'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($insuranceType['InsuranceType']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($insuranceType['InsuranceType']['description']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Insurance Type'), array('action' => 'edit', $insuranceType['InsuranceType']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Insurance Type'), array('action' => 'delete', $insuranceType['InsuranceType']['id']), null, __('Are you sure you want to delete # %s?', $insuranceType['InsuranceType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Insurance Types'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Insurance Type'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Insurance Patient Relationships'), array('controller' => 'insurance_patient_relationships', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Insurance Patient Relationship'), array('controller' => 'insurance_patient_relationships', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Insurance Patient Relationships'); ?></h3>
	<?php if (!empty($insuranceType['InsurancePatientRelationship'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Patient Id'); ?></th>
		<th><?php echo __('Policyholder Id'); ?></th>
		<th><?php echo __('Patient Relationship Id'); ?></th>
		<th><?php echo __('Insurance Id'); ?></th>
		<th><?php echo __('Insurance Type Id'); ?></th>
		<th><?php echo __('Insurance No'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($insuranceType['InsurancePatientRelationship'] as $insurancePatientRelationship): ?>
		<tr>
			<td><?php echo $insurancePatientRelationship['id']; ?></td>
			<td><?php echo $insurancePatientRelationship['patient_id']; ?></td>
			<td><?php echo $insurancePatientRelationship['policyholder_id']; ?></td>
			<td><?php echo $insurancePatientRelationship['patient_relationship_id']; ?></td>
			<td><?php echo $insurancePatientRelationship['insurance_id']; ?></td>
			<td><?php echo $insurancePatientRelationship['insurance_type_id']; ?></td>
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
