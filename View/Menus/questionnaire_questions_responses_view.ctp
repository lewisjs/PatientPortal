<?php
$this->extend('/Common/questionnaire_view');

$this->start('contentMenu') ?>
<div>
	<ul>
		<li><?php
			echo $this->Html->link(
				__('List Question Response Pairs'),
				array('controller' => 'QuestionsResponses', 'action' => 'index')
			);
		?></li>
		<li><?php
			echo $this->Html->link(
				__('New Question Response Pair'),
				array('controller' => 'QuestionsResponses', 'action' => 'add')
			);
		?></li>
	</ul>
</div>
<?php $this->end(); ?>