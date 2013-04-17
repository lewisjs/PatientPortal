<?php 

$this->extend('/Common/all_view');

$this->assign('title', __('Managing Users'));

$this->start('mainContent');

?>

<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Add New User'); ?></legend>
	<?php
		echo $this->Form->input('username');
		echo $this->Form->input('email');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

<?php $this->end(); ?>
