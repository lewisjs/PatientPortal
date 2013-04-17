<div class="patientGenders view">
<h2><?php  echo __('Patient Gender'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($patientGender['PatientGender']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($patientGender['PatientGender']['description']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Patient Gender'), array('action' => 'edit', $patientGender['PatientGender']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Patient Gender'), array('action' => 'delete', $patientGender['PatientGender']['id']), null, __('Are you sure you want to delete # %s?', $patientGender['PatientGender']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Patient Genders'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Patient Gender'), array('action' => 'add')); ?> </li>
	</ul>
</div>
