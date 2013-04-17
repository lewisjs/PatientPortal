<?php
$options = array('view' => array(), 'edit' => array());
$options[$this->action] = array('class' => 'selected');

$this->extend('/Menus/patient_main');
$this->start('viewMenu');
?>
<ul>
	<li><?php
		echo $this->Html->link(
			__('view'),
			array('controller' => 'patients', 'action' => 'view', $this->Session->read('Auth.User.patient_id')),
			$options['view']
		);
	?></li>
	<li><?php
		echo $this->Html->link(
			__('update'),
			array('controller' => 'patients', 'action' => 'edit', $this->Session->read('Auth.User.patient_id')),
			$options['edit']
		);
	?></li>
</ul>
<?php $this->end(); ?>