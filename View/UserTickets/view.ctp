<div class="userTickets view">
<h2><?php  echo __('User Ticket'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($userTicket['UserTicket']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userTicket['User']['id'], array('controller' => 'users', 'action' => 'view', $userTicket['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Data'); ?></dt>
		<dd>
			<?php echo h($userTicket['UserTicket']['data']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($userTicket['UserTicket']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($userTicket['UserTicket']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User Ticket'), array('action' => 'edit', $userTicket['UserTicket']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User Ticket'), array('action' => 'delete', $userTicket['UserTicket']['id']), null, __('Are you sure you want to delete # %s?', $userTicket['UserTicket']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List User Tickets'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Ticket'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
