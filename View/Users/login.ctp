<?php 
$this->extend('/Menus/login');

$this->assign('title', __('Login'));

$this->start('viewContent');
?>
	<div class = "users form viewContent">
		<?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'login'))); ?>
		
		<?php echo $this->Form->input('User.username'); ?>
		<?php echo $this->Form->input('User.password'); ?>
		
		<?php echo $this->Form->end('Login'); ?>
	</div>

<?php $this->end(); ?>