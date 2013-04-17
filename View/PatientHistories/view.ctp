<div class="patientHistories view">
<h2><?php  echo __('Patient History'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($patientHistory['PatientHistory']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Patient'); ?></dt>
		<dd>
			<?php echo $this->Html->link($patientHistory['Patient']['id'], array('controller' => 'patients', 'action' => 'view', $patientHistory['Patient']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified By'); ?></dt>
		<dd>
			<?php echo h($patientHistory['PatientHistory']['modified_by']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Name'); ?></dt>
		<dd>
			<?php echo h($patientHistory['PatientHistory']['last_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('First Name'); ?></dt>
		<dd>
			<?php echo h($patientHistory['PatientHistory']['first_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Middle Name'); ?></dt>
		<dd>
			<?php echo h($patientHistory['PatientHistory']['middle_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Maiden Name'); ?></dt>
		<dd>
			<?php echo h($patientHistory['PatientHistory']['maiden_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Of Birth'); ?></dt>
		<dd>
			<?php echo h($patientHistory['PatientHistory']['date_of_birth']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Gender'); ?></dt>
		<dd>
			<?php echo h($patientHistory['PatientHistory']['gender']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Home Phone'); ?></dt>
		<dd>
			<?php echo h($patientHistory['PatientHistory']['home_phone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mobile Phone'); ?></dt>
		<dd>
			<?php echo h($patientHistory['PatientHistory']['mobile_phone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Work Phone'); ?></dt>
		<dd>
			<?php echo h($patientHistory['PatientHistory']['work_phone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Street1'); ?></dt>
		<dd>
			<?php echo h($patientHistory['PatientHistory']['street1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Street2'); ?></dt>
		<dd>
			<?php echo h($patientHistory['PatientHistory']['street2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('City'); ?></dt>
		<dd>
			<?php echo h($patientHistory['PatientHistory']['city']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('State'); ?></dt>
		<dd>
			<?php echo h($patientHistory['PatientHistory']['state']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Zip'); ?></dt>
		<dd>
			<?php echo h($patientHistory['PatientHistory']['zip']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($patientHistory['PatientHistory']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Patient History'), array('action' => 'edit', $patientHistory['PatientHistory']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Patient History'), array('action' => 'delete', $patientHistory['PatientHistory']['id']), null, __('Are you sure you want to delete # %s?', $patientHistory['PatientHistory']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Patient Histories'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Patient History'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Patients'), array('controller' => 'patients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Patient'), array('controller' => 'patients', 'action' => 'add')); ?> </li>
	</ul>
</div>
