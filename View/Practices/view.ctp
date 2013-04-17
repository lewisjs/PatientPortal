<div class="practices view">
<h2><?php  echo __('Practice'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($practice['Practice']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($practice['Practice']['description']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Practice'), array('action' => 'edit', $practice['Practice']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Practice'), array('action' => 'delete', $practice['Practice']['id']), null, __('Are you sure you want to delete # %s?', $practice['Practice']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Practices'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Practice'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Appointments'), array('controller' => 'appointments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Appointment'), array('controller' => 'appointments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Providers'), array('controller' => 'providers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Provider'), array('controller' => 'providers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Referrals'), array('controller' => 'referrals', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Referral'), array('controller' => 'referrals', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Patients'), array('controller' => 'patients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Patient'), array('controller' => 'patients', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Appointments'); ?></h3>
	<?php if (!empty($practice['Appointment'])): ?>
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
		foreach ($practice['Appointment'] as $appointment): ?>
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
	<h3><?php echo __('Related Providers'); ?></h3>
	<?php if (!empty($practice['Provider'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Practice Id'); ?></th>
		<th><?php echo __('Last Name'); ?></th>
		<th><?php echo __('First Name'); ?></th>
		<th><?php echo __('Middle Name'); ?></th>
		<th><?php echo __('Degree'); ?></th>
		<th><?php echo __('Phone'); ?></th>
		<th><?php echo __('Fax'); ?></th>
		<th><?php echo __('Street1'); ?></th>
		<th><?php echo __('Street2'); ?></th>
		<th><?php echo __('City'); ?></th>
		<th><?php echo __('State'); ?></th>
		<th><?php echo __('Zip'); ?></th>
		<th><?php echo __('Npi'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($practice['Provider'] as $provider): ?>
		<tr>
			<td><?php echo $provider['id']; ?></td>
			<td><?php echo $provider['practice_id']; ?></td>
			<td><?php echo $provider['last_name']; ?></td>
			<td><?php echo $provider['first_name']; ?></td>
			<td><?php echo $provider['middle_name']; ?></td>
			<td><?php echo $provider['degree']; ?></td>
			<td><?php echo $provider['phone']; ?></td>
			<td><?php echo $provider['fax']; ?></td>
			<td><?php echo $provider['street1']; ?></td>
			<td><?php echo $provider['street2']; ?></td>
			<td><?php echo $provider['city']; ?></td>
			<td><?php echo $provider['state']; ?></td>
			<td><?php echo $provider['zip']; ?></td>
			<td><?php echo $provider['npi']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'providers', 'action' => 'view', $provider['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'providers', 'action' => 'edit', $provider['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'providers', 'action' => 'delete', $provider['id']), null, __('Are you sure you want to delete # %s?', $provider['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Provider'), array('controller' => 'providers', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Referrals'); ?></h3>
	<?php if (!empty($practice['Referral'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Patient Id'); ?></th>
		<th><?php echo __('Practice Id'); ?></th>
		<th><?php echo __('Referral Status Id'); ?></th>
		<th><?php echo __('Asap'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($practice['Referral'] as $referral): ?>
		<tr>
			<td><?php echo $referral['id']; ?></td>
			<td><?php echo $referral['patient_id']; ?></td>
			<td><?php echo $referral['practice_id']; ?></td>
			<td><?php echo $referral['referral_status_id']; ?></td>
			<td><?php echo $referral['asap']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'referrals', 'action' => 'view', $referral['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'referrals', 'action' => 'edit', $referral['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'referrals', 'action' => 'delete', $referral['id']), null, __('Are you sure you want to delete # %s?', $referral['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Referral'), array('controller' => 'referrals', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Users'); ?></h3>
	<?php if (!empty($practice['User'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Group Id'); ?></th>
		<th><?php echo __('Practice Id'); ?></th>
		<th><?php echo __('Username'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('Password'); ?></th>
		<th><?php echo __('Validated'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($practice['User'] as $user): ?>
		<tr>
			<td><?php echo $user['id']; ?></td>
			<td><?php echo $user['group_id']; ?></td>
			<td><?php echo $user['practice_id']; ?></td>
			<td><?php echo $user['username']; ?></td>
			<td><?php echo $user['email']; ?></td>
			<td><?php echo $user['password']; ?></td>
			<td><?php echo $user['validated']; ?></td>
			<td><?php echo $user['modified']; ?></td>
			<td><?php echo $user['created']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'users', 'action' => 'edit', $user['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'users', 'action' => 'delete', $user['id']), null, __('Are you sure you want to delete # %s?', $user['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Patients'); ?></h3>
	<?php if (!empty($practice['Patient'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
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
		foreach ($practice['Patient'] as $patient): ?>
		<tr>
			<td><?php echo $patient['id']; ?></td>
			<td><?php echo $patient['user_id']; ?></td>
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
