<?php
$options = array('index' => array(), 'add' => array());
$options[$this->action] = array('class' => 'selected');

$this->extend('/Menus/patient_main');
$this->start('viewMenu') ?>
<ul>
	<li style="width:21%"><?php
		echo $this->Html->link(
			__('view'),
			array('controller' => 'referralFiles', 'action' => 'index', $this->Session->read('Auth.User.patient_id')),
			$options['index']
		);
	?></li>
	<li style="width:21%"><?php
		echo $this->Html->link(
			__('add'),
			array('controller' => 'referralFiles', 'action' => 'add', $this->Session->read('Auth.User.patient_id')),
			$options['add']
		);
	?></li>
</ul>
<?php $this->end(); ?>