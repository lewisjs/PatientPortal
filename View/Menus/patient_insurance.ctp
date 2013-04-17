<?php
$options = array('index' => array(), 'add_policyholder' => array());
$options[$this->action] = array('class' => 'selected');

$this->extend('/Menus/patient_main');
$this->start('viewMenu') ?>
<ul>
	<li><?php
		echo $this->Html->link(
			__('view'),
			array(
				'controller' => 'insurancePatientRelationships',
				'action' => 'index',
				$this->Session->read('Auth.User.patient_id')),
			$options['index']
		);
	?></li>
	<li><?php
		echo $this->Html->link(
			__('add'),
			array(
				'controller' => 'insurancePatientRelationships',
				'action' => 'add',
				$this->Session->read('Auth.User.patient_id')),
			$options['add_policyholder']
		);
	?></li>
</ul>
<?php $this->end(); ?>