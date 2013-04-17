<?php
$this->extend('/Common/all_view');

$this->assign('title', __('Managing Users'));

$this->start('mainContent');
?>

<div class="users">

<?php if (isset($users)): ?>
<!-- USER HAS POSTED -->
	<?php if ( 0 < count($users)): ?>
	<!-- MATCHING USERS FOUND -->
		<h3><?php echo __('Select User Below');?></h3>
		<table cellpadding="0" cellspacing="0">
		<tr>
				<th><?php echo $this->Paginator->sort('username');?></th>
				<th><?php echo $this->Paginator->sort('email');?></th>
				<th class="actions"><?php echo __('Actions');?></th>
		</tr>

		<?php foreach ($users as $user): ?>
			<tr>
				<td><?php echo h($user['User']['username']); ?>&nbsp;</td>
				<td><?php echo h($user['User']['email']); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Html->link(
						__('Select Patient'),
						array('action' => $action, $user['User']['id'] )
					); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</table>
		
		<p><?php
			echo $this->Paginator->counter(
				array(
					'format' => 
						__('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
				)
			);
		?></p>

		<div class="paging">
		<?php
			echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
			echo $this->Paginator->numbers(array('separator' => ''));
			echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
		?>
		</div>
	<?php endif; ?>
<?php else: ?>
<!-- USER HAS NOT POSTED -->

	<div>
		<?php echo $this->Form->create('User',
			array ('url' => array('controller' => 'users', 'action' => 'search', $action)));?>
	
		<fieldset>
		<legend><?php echo __('Find User'); ?></legend>
		<?php
			echo $this->Form->input('username');
			echo $this->Form->input('email');
		?>
		</fieldset>
	
		<?php echo $this->Form->end(__('Submit'));?>
	</div>
<?php endif; ?>


</div>
<?php $this->end(); ?>
