<?php

require_once('../Lib/view_utils.php');

function write_multiple_input(&$obj, &$question, $questionIt, $params) {
	echo $obj->Form->input(
		$params['parentIt'] . ".ChoicesQuestion.$questionIt.id",
		array(
			'label' => $question[$questionIt]['Choice']['text'],
			'type' => 'checkbox',
			'value' => array($question[$questionIt]['id']),
			'hiddenField' => false,
		)
	);
}

function write_choices_questions(&$obj, &$questionGroup, $groupIt) {
	$attribs = array();
	
	echo $obj->Form->hidden(
		$groupIt . '.Question.id',
		array('value' => $questionGroup[$groupIt]['Question']['id'])
	);
	echo $obj->Form->hidden(
		$groupIt . '.Question.type',
		array('value' => $questionGroup[$groupIt]['Question']['type'])
	);

	$attribs['hiddenField'] = true;
	
	switch($questionGroup[$groupIt]['Question']['type']) {
		case 'single': {
		// create question with option to provide a single answer (radio button)
			$attribs['options'] = array();
			foreach($questionGroup[$groupIt]['Question']['ChoicesQuestion'] as $choice) {
				$attribs['options'][$choice['id']] = $choice['Choice']['text'];
			}
	
			// uses radio buttons if less than 6, select otherwise
			if (6 > count($attribs['options'])) {
				$attribs['type'] = 'radio';
				$attribs['legend'] = $questionGroup[$groupIt]['Question']['text'];
			}
			else {
				$attribs['type'] = 'select';
				$attribs['label'] = $questionGroup[$groupIt]['Question']['text'];
			}
			echo $obj->Form->input($groupIt . '.ChoicesQuestion.id', $attribs);
			
			break;
		}
		case 'multiple':
		// create a question with option to provide more than one response
			echo "<label>{$questionGroup[$groupIt]['Question']['text']}</label>";
			columnize(
				$questionGroup[$groupIt]['Question']['ChoicesQuestion'],
				'write_multiple_input',
				$obj,
				array('parentIt' => $groupIt)
			);
	
			break;
			
		case 'numeric':
		// create a question to allow user a numeric answer (i.e. this is stored in value).
			echo $obj->Form->input(
				$groupIt . '.ChoicesQuestion.Choice.value',
				array(
					'type' => 'number',
					'label' => $questionGroup[$groupIt]['Question']['text'],
				)
			);
			
			break;
		
		case 'text':
		// create a question to allow a user text entry
			echo $obj->Form->input(
				$groupIt . '.ChoicesQuestion.Choice.text',
				array(
					'type' => 'text',
					'label' => $questionGroup[$groupIt]['Question']['text'],
				)
			);

			break;
	}
}

$this->extend('/Common/questionnaires_view');

$this->start('mainContent');
?>

<div class="questionnaires form">
	<?php
	$pageCount = count($pages);
	$nextIndex = 1 + $pageIndex;
	echo $this->Form->create('Questionnaire', array('action' => "answer/$id/$nextIndex"));
	?>
	
	<h2><?php echo "{$questionnairePage['title']} (Page $nextIndex of $pageCount)"; ?></h2><br />
	<?php
	$columnCount = columnize(
		$questionnairePage['QuestionnaireGroupsQuestion'],
		'write_choices_questions',
		$this,
		array('first' => 7, 'second' => 15)
	);
	?>
	
	<?php
	$options = array();
	$options['label'] = ((1 + $pageIndex) < count($pages)) ? __('Next') : __('Submit');
	
	if (1 < $columnCount) {
		$options['div'] = array('class' => 'clear_both submit');
	}
	
	echo $this->Form->end($options);
	?>
	
	<ul class="horizontal">
	<?php for($i=0; $i<count($pages); ++$i):?>
		<li style="padding-right: <?php echo 70/count($pages); ?>%;">
			<?php
			if($pageIndex != $i) {
				echo $this->HTML->link($pages[$i], array('action' => 'answer', $id, $i));
			} else {
				echo $this->HTML->link($pages[$i], "#content");
			}
			?>
		</li>
	<?php endfor;?>
	</ul>
</div>

<?php $this->end(); ?>