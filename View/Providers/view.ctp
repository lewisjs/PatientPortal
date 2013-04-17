<div class="providers view">
<h2><?php  echo __('Provider'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($provider['Provider']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Practice'); ?></dt>
		<dd>
			<?php echo $this->Html->link($provider['Practice']['id'], array('controller' => 'practices', 'action' => 'view', $provider['Practice']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Name'); ?></dt>
		<dd>
			<?php echo h($provider['Provider']['last_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('First Name'); ?></dt>
		<dd>
			<?php echo h($provider['Provider']['first_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Middle Name'); ?></dt>
		<dd>
			<?php echo h($provider['Provider']['middle_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Degree'); ?></dt>
		<dd>
			<?php echo h($provider['Provider']['degree']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Phone'); ?></dt>
		<dd>
			<?php echo h($provider['Provider']['phone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fax'); ?></dt>
		<dd>
			<?php echo h($provider['Provider']['fax']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Street1'); ?></dt>
		<dd>
			<?php echo h($provider['Provider']['street1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Street2'); ?></dt>
		<dd>
			<?php echo h($provider['Provider']['street2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('City'); ?></dt>
		<dd>
			<?php echo h($provider['Provider']['city']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('State'); ?></dt>
		<dd>
			<?php echo h($provider['Provider']['state']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Zip'); ?></dt>
		<dd>
			<?php echo h($provider['Provider']['zip']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Npi'); ?></dt>
		<dd>
			<?php echo h($provider['Provider']['npi']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Provider'), array('action' => 'edit', $provider['Provider']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Provider'), array('action' => 'delete', $provider['Provider']['id']), null, __('Are you sure you want to delete # %s?', $provider['Provider']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Providers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Provider'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Practices'), array('controller' => 'practices', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Practice'), array('controller' => 'practices', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Appointments'), array('controller' => 'appointments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Appointment'), array('controller' => 'appointments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Referral Files'), array('controller' => 'referral_files', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Referral File'), array('controller' => 'referral_files', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Appointments'); ?></h3>
	<?php if (!empty($provider['Appointment'])): ?>
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
		foreach ($provider['Appointment'] as $appointment): ?>
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
	<h3><?php echo __('Related Referral Files'); ?></h3>
	<?php if (!empty($provider['ReferralFile'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Provider Id'); ?></th>
		<th><?php echo __('Referral Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Type'); ?></th>
		<th><?php echo __('Size'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($provider['ReferralFile'] as $referralFile): ?>
		<tr>
			<td><?php echo $referralFile['id']; ?></td>
			<td><?php echo $referralFile['provider_id']; ?></td>
			<td><?php echo $referralFile['referral_id']; ?></td>
			<td><?php echo $referralFile['name']; ?></td>
			<td><?php echo $referralFile['type']; ?></td>
			<td><?php echo $referralFile['size']; ?></td>
			<td><?php echo $referralFile['description']; ?></td>
			<td><?php echo $referralFile['modified']; ?></td>
			<td><?php echo $referralFile['created']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'referral_files', 'action' => 'view', $referralFile['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'referral_files', 'action' => 'edit', $referralFile['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'referral_files', 'action' => 'delete', $referralFile['id']), null, __('Are you sure you want to delete # %s?', $referralFile['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Referral File'), array('controller' => 'referral_files', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
