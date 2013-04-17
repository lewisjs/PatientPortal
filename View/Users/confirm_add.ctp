<?php 

$this->extend('/Common/all_view');

$this->assign('title', __('Manage User'));

$this->start('viewContent');

?>

<div class="users viewContent">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Confirm User Account'); ?></legend>
	<?php
		echo $this->Form->input('username');
		echo $this->Form->input('email');
		echo $this->Form->input('password');
		echo $this->Form->input('confirm_password', array('type' => 'password'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

<?php $this->end(); ?>
