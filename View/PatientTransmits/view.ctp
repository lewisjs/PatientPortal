<div class="patientTransmits view">
<h2><?php  echo __('Patient Transmit'); ?></h2>
	<dl>
		<dt><?php echo __('Patient'); ?></dt>
		<dd>
			<?php echo $this->Html->link($patientTransmit['Patient']['id'], array('controller' => 'patients', 'action' => 'view', $patientTransmit['Patient']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sent'); ?></dt>
		<dd>
			<?php echo h($patientTransmit['PatientTransmit']['sent']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Sent'); ?></dt>
		<dd>
			<?php echo h($patientTransmit['PatientTransmit']['date_sent']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Patient Transmit'), array('action' => 'edit', $patientTransmit['PatientTransmit']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Patient Transmit'), array('action' => 'delete', $patientTransmit['PatientTransmit']['id']), null, __('Are you sure you want to delete # %s?', $patientTransmit['PatientTransmit']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Patient Transmits'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Patient Transmit'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Patients'), array('controller' => 'patients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Patient'), array('controller' => 'patients', 'action' => 'add')); ?> </li>
	</ul>
</div>
