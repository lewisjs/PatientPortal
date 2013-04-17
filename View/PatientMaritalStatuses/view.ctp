<div class="patientMaritalStatuses view">
<h2><?php  echo __('Patient Marital Status'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($patientMaritalStatus['PatientMaritalStatus']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($patientMaritalStatus['PatientMaritalStatus']['description']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Patient Marital Status'), array('action' => 'edit', $patientMaritalStatus['PatientMaritalStatus']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Patient Marital Status'), array('action' => 'delete', $patientMaritalStatus['PatientMaritalStatus']['id']), null, __('Are you sure you want to delete # %s?', $patientMaritalStatus['PatientMaritalStatus']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Patient Marital Statuses'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Patient Marital Status'), array('action' => 'add')); ?> </li>
	</ul>
</div>
