<div class="insurancePatientRelationships view">
<h2><?php  echo __('Insurance Patient Relationship'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($insurancePatientRelationship['InsurancePatientRelationship']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Patient'); ?></dt>
		<dd>
			<?php echo $this->Html->link($insurancePatientRelationship['Patient']['id'], array('controller' => 'patients', 'action' => 'view', $insurancePatientRelationship['Patient']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Patient Relationship'); ?></dt>
		<dd>
			<?php echo $this->Html->link($insurancePatientRelationship['PatientRelationship']['id'], array('controller' => 'patient_relationships', 'action' => 'view', $insurancePatientRelationship['PatientRelationship']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Insurance'); ?></dt>
		<dd>
			<?php echo $this->Html->link($insurancePatientRelationship['Insurance']['name'], array('controller' => 'insurances', 'action' => 'view', $insurancePatientRelationship['Insurance']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Insurance No'); ?></dt>
		<dd>
			<?php echo h($insurancePatientRelationship['InsurancePatientRelationship']['insurance_no']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Insurance Patient Relationship'), array('action' => 'edit', $insurancePatientRelationship['InsurancePatientRelationship']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Insurance Patient Relationship'), array('action' => 'delete', $insurancePatientRelationship['InsurancePatientRelationship']['id']), null, __('Are you sure you want to delete # %s?', $insurancePatientRelationship['InsurancePatientRelationship']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Insurance Patient Relationships'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Insurance Patient Relationship'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Patients'), array('controller' => 'patients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Patient'), array('controller' => 'patients', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Patient Relationships'), array('controller' => 'patient_relationships', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Patient Relationship'), array('controller' => 'patient_relationships', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Insurances'), array('controller' => 'insurances', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Insurance'), array('controller' => 'insurances', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Patients'); ?></h3>
	<?php if (!empty($insurancePatientRelationship['Patient'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Last Name'); ?></th>
		<th><?php echo __('First Name'); ?></th>
		<th><?php echo __('Middle Name'); ?></th>
		<th><?php echo __('Maiden Name'); ?></th>
		<th><?php echo __('Date Of Birth'); ?></th>
		<th><?php echo __('Gender'); ?></th>
		<th><?php echo __('Street1'); ?></th>
		<th><?php echo __('Street2'); ?></th>
		<th><?php echo __('City'); ?></th>
		<th><?php echo __('State'); ?></th>
		<th><?php echo __('Zip'); ?></th>
		<th><?php echo __('Home Phone'); ?></th>
		<th><?php echo __('Mobile Phone'); ?></th>
		<th><?php echo __('Work Phone'); ?></th>
		<th><?php echo __('Marital Status'); ?></th>
		<th><?php echo __('Location Id'); ?></th>
		<th><?php echo __('Insurance Patient Relationship Id'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($insurancePatientRelationship['Patient'] as $patient): ?>
		<tr>
			<td><?php echo $patient['id']; ?></td>
			<td><?php echo $patient['last_name']; ?></td>
			<td><?php echo $patient['first_name']; ?></td>
			<td><?php echo $patient['middle_name']; ?></td>
			<td><?php echo $patient['maiden_name']; ?></td>
			<td><?php echo $patient['date_of_birth']; ?></td>
			<td><?php echo $patient['gender']; ?></td>
			<td><?php echo $patient['street1']; ?></td>
			<td><?php echo $patient['street2']; ?></td>
			<td><?php echo $patient['city']; ?></td>
			<td><?php echo $patient['state']; ?></td>
			<td><?php echo $patient['zip']; ?></td>
			<td><?php echo $patient['home_phone']; ?></td>
			<td><?php echo $patient['mobile_phone']; ?></td>
			<td><?php echo $patient['work_phone']; ?></td>
			<td><?php echo $patient['marital_status']; ?></td>
			<td><?php echo $patient['location_id']; ?></td>
			<td><?php echo $patient['insurance_patient_relationship_id']; ?></td>
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
