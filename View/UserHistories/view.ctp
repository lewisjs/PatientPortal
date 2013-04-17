<div class="userHistories view">
<h2><?php  echo __('User History'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($userHistory['UserHistory']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userHistory['User']['id'], array('controller' => 'users', 'action' => 'view', $userHistory['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified By'); ?></dt>
		<dd>
			<?php echo h($userHistory['UserHistory']['modified_by']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Username'); ?></dt>
		<dd>
			<?php echo h($userHistory['UserHistory']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($userHistory['UserHistory']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($userHistory['UserHistory']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Group'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userHistory['Group']['name'], array('controller' => 'groups', 'action' => 'view', $userHistory['Group']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($userHistory['UserHistory']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User History'), array('action' => 'edit', $userHistory['UserHistory']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User History'), array('action' => 'delete', $userHistory['UserHistory']['id']), null, __('Are you sure you want to delete # %s?', $userHistory['UserHistory']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List User Histories'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User History'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Groups'), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group'), array('controller' => 'groups', 'action' => 'add')); ?> </li>
	</ul>
</div>
