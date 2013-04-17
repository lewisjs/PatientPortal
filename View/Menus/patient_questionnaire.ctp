<?php
$options = array('add' => array());
$options[$this->action] = array('class' => 'selected');

$this->extend('/Menus/patient_main');
$this->start('viewMenu');

?>
<ul>
	<li><?php
		echo $this->Html->link(
			__('Clinical Questionnaire'),
			array('controller' => 'patientQuestionsResponses', 'action' => 'add', 2),
			$options['add']
		);
	?></li>
</ul>
<?php $this->end(); ?>