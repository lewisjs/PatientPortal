<?php 
$this->extend('/Menus/login');

$this->assign('title', __('Create New User'));

$this->start('viewContent');
?>
<div class="users form viewContent">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Create New User'); ?></legend>
		
		<?php echo $this->Form->input('username'); ?>
		<?php echo $this->Form->input('email'); ?>
		<?php echo $this->Form->input('password'); ?>
		<?php echo $this->Form->input('confirm_password',
			array('type' => 'password', )
		); ?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<?php $this->end(); ?>
