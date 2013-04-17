<?php
$this->extend('/Common/patient_view');

$this->start('contentMenu')
?>
<div>
	<ul>
		<li style="width:21%"><?php
			echo $this->Html->link(
				__('view'),
				array('controller' => 'patients', 'action' => 'view', $this->Session->read('Auth.User.patient_id'))
			);
		?></li>
		<li style="width:21%"><?php
			echo $this->Html->link(
				__('update'),
				array('controller' => 'patients', 'action' => 'edit', $this->Session->read('Auth.User.patient_id'))
			);
		?></li>
	</ul>
</div>
<?php $this->end(); ?>