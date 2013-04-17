<?php
$this->extend('/Common/view');

$this->start('menu') ?>
<div>
	<ul>
		<li><?php
			echo $this->Html->link(
				__('Questionnaires'),
				array('controller' => 'Questionnaires', 'action' => 'index')
			);
		?></li>
		<li><?php
			echo $this->Html->link(
				__('Questionnaire Pages'),
				array('controller' => 'QuestionnairePages', 'action' => 'index')
			);
		?></li>
		<li><?php
			echo $this->Html->link(
				__('Questions'),
				array('controller' => 'Questions', 'action' => 'index')
			);
		?></li>
		<li><?php
			echo $this->Html->link(
				__('Question Response Pairs'),
				array('controller' => 'QuestionsResponses', 'action' => 'index')
			);
		?></li>
		<li><?php
			echo $this->Html->link(
				__('Responses'),
				array('controller' => 'Responses', 'action' => 'index')
			);
		?></li>
	</ul>
</div>
<?php $this->end(); ?>