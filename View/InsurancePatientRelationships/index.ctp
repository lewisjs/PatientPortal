<?php
if ($this->Session->read('Auth.User')) {
	switch($this->Session->read('Auth.User.group_id')) {
		case Configure::read('PatientPortal.group_id.Patient'):
			$this->extend('/Menus/patient_insurance');
			break;
		case Configure::read('PatientPortal.group_id.Clinician'):
		case Configure::read('PatientPortal.group_id.Coordinator'):
		case Configure::read('PatientPortal.group_id.Administrator'):
		default:
			throw new InternalErrorException('WTF happened here???');
	}
}
else {
	$this->extend('/Common/login_view');
}

$this->start('viewContent');
?>

<div class="insurancePatientRelationships index viewContent">
	<h2><?php echo __('Insurance Policies'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('policyholder_id'); ?></th>
			<th><?php echo $this->Paginator->sort('patient_relationship_id'); ?></th>
			<th><?php echo $this->Paginator->sort('insurance_type_id'); ?></th>
			<th><?php echo $this->Paginator->sort('insurance_id'); ?></th>
			<th><?php echo $this->Paginator->sort('insurance_no'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($insurancePatientRelationships as $insurancePatientRelationship): ?>
	<tr>
		<td>
			<?php echo $this->Html->link(
				"{$insurancePatientRelationship['Policyholder']['first_name']} {$insurancePatientRelationship['Policyholder']['last_name']}",
				array('controller' => 'patients', 'action' => 'view', $insurancePatientRelationship['Policyholder']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($insurancePatientRelationship['PatientRelationship']['description'], array('controller' => 'patient_relationships', 'action' => 'view', $insurancePatientRelationship['PatientRelationship']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($insurancePatientRelationship['InsuranceType']['description'], array('controller' => 'insurance_types', 'action' => 'view', $insurancePatientRelationship['InsuranceType']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($insurancePatientRelationship['Insurance']['name'], array('controller' => 'insurances', 'action' => 'view', $insurancePatientRelationship['Insurance']['id'])); ?>
		</td>
		<td><?php echo h($insurancePatientRelationship['InsurancePatientRelationship']['insurance_no']); ?>&nbsp;</td>
		<td class="actions">
			<?php //echo $this->Html->link(__('View'), array('action' => 'view', $insurancePatientRelationship['InsurancePatientRelationship']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $insurancePatientRelationship['InsurancePatientRelationship']['id'])); ?>
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
<?php $this->end(); ?>