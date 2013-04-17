<?php
$this->extend('/Common/questionnaires_view');

$this->start('mainContent');
?>

<div class="questionnaires form">
<?php echo $this->Form->create('Questionnaire'); ?>
	<fieldset>
		<legend><?php echo __('Add Questionnaire'); ?></legend>
	<?php
		echo $this->Form->input('title');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Questionnaires'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Questionnaire Groups'), array('controller' => 'questionnaire_groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Questionnaire Group'), array('controller' => 'questionnaire_groups', 'action' => 'add')); ?> </li>
	</ul>
</div>

<?php $this->end(); ?>