<?php
$options = array('login' => array(), 'create' => array());
$options[$this->action] = array('class' => 'selected');

$this->extend('/Common/view');
$this->start('contentMenu'); ?>
	<ul><li>
		<?php
			echo $this->Html->link(
				__('Log In'),
				array('controller' => 'users', 'action' => 'login'),
				$options['login']
			);
		?>
	</li><li>
		<?php
// 			echo $this->Html->link(
// 				__('Forgot Username'),
// 				array('controller' => 'users', 'action' => 'request_username')
// 			);
		?>
	</li><li>
		<?php
// 			echo $this->Html->link(
// 				__('Forgot Email'),
// 				array('controller' => 'users', 'action' => 'request_email')
// 			);
		?>
	</li><li>
		<?php
// 			echo $this->Html->link(
// 				__('Forgot Password'),
// 				array('controller' => 'users', 'action' => 'request_password')
// 			);
		?>
	</li><li>
		<?php
			echo $this->Html->link(
				__('Create Account'),
				array('controller' => 'users', 'action' => 'create'),
				$options['create']
			);
		?>
	</li></ul>
<?php $this->end(); ?>