<div class="locations view">
<h2><?php  echo __('Location'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($location['Location']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($location['Location']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Street1'); ?></dt>
		<dd>
			<?php echo h($location['Location']['street1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Street2'); ?></dt>
		<dd>
			<?php echo h($location['Location']['street2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('City'); ?></dt>
		<dd>
			<?php echo h($location['Location']['city']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('State'); ?></dt>
		<dd>
			<?php echo h($location['Location']['state']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Zip'); ?></dt>
		<dd>
			<?php echo h($location['Location']['zip']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Phone'); ?></dt>
		<dd>
			<?php echo h($location['Location']['phone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Phone Ext'); ?></dt>
		<dd>
			<?php echo h($location['Location']['phone_ext']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fax'); ?></dt>
		<dd>
			<?php echo h($location['Location']['fax']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fax Ext'); ?></dt>
		<dd>
			<?php echo h($location['Location']['fax_ext']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Location'), array('action' => 'edit', $location['Location']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Location'), array('action' => 'delete', $location['Location']['id']), null, __('Are you sure you want to delete # %s?', $location['Location']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Locations'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Location'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Appointments'), array('controller' => 'appointments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Appointment'), array('controller' => 'appointments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Patients'), array('controller' => 'patients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Patient'), array('controller' => 'patients', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Appointments'); ?></h3>
	<?php if (!empty($location['Appointment'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Patient Id'); ?></th>
		<th><?php echo __('Provider Id'); ?></th>
		<th><?php echo __('Location Id'); ?></th>
		<th><?php echo __('Practice Id'); ?></th>
		<th><?php echo __('Appointment Status Id'); ?></th>
		<th><?php echo __('Code'); ?></th>
		<th><?php echo __('Type'); ?></th>
		<th><?php echo __('Start Time'); ?></th>
		<th><?php echo __('End Time'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($location['Appointment'] as $appointment): ?>
		<tr>
			<td><?php echo $appointment['id']; ?></td>
			<td><?php echo $appointment['patient_id']; ?></td>
			<td><?php echo $appointment['provider_id']; ?></td>
			<td><?php echo $appointment['location_id']; ?></td>
			<td><?php echo $appointment['practice_id']; ?></td>
			<td><?php echo $appointment['appointment_status_id']; ?></td>
			<td><?php echo $appointment['code']; ?></td>
			<td><?php echo $appointment['type']; ?></td>
			<td><?php echo $appointment['start_time']; ?></td>
			<td><?php echo $appointment['end_time']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'appointments', 'action' => 'view', $appointment['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'appointments', 'action' => 'edit', $appointment['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'appointments', 'action' => 'delete', $appointment['id']), null, __('Are you sure you want to delete # %s?', $appointment['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Appointment'), array('controller' => 'appointments', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Patients'); ?></h3>
	<?php if (!empty($location['Patient'])): ?>
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
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($location['Patient'] as $patient): ?>
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
