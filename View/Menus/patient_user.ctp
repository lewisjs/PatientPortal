<?php
$options = array('edit_password' => array(), 'edit_email' => array(), 'logout' => array());
$options[$this->action] = array('class' => 'selected');

$this->extend('/Menus/patient_main');
$this->start('viewMenu') ?>
<ul>
	<li><?php
		echo $this->Html->link(
			__('Change Password'),
			array('controller' => 'users', 'action' => 'edit_password', $this->Session->read('Auth.User.id')),
			$options['edit_password']
		);
	?></li>
	<li><?php
		echo $this->Html->link(
			__('Change Email'),
			array('controller' => 'users', 'action' => 'edit_email', $this->Session->read('Auth.User.id')),
			$options['edit_email']
		);
	?></li>
	<li><?php
		echo $this->Html->link(
			__('Logout'),
			array('controller' => 'users', 'action' => 'logout'),
			$options['logout']
		);
	?></li>
</ul>
<?php $this->end(); ?>