<?php
require_once('../Lib/view_utils.php');

function write_multiple_input(&$obj, &$responses, $responseIt, $params) {
	echo $obj->Form->input(
		"PatientQuestionsResponse.{$params['parentIt']}.QuestionsResponse.$responseIt.id",
		array(
			'label' => $responses[$responseIt]['Response']['text'],
			'type' => 'checkbox',
			'value' => array($responses[$responseIt]['id']),
			'hiddenField' => false,
			'checked' => 0 < count($responses[$responseIt]['PatientQuestionsResponse']),
		)
	);
}

function write_question_responses(&$obj, &$questions, $questionIt) {
	$attribs = array();
	
	echo $obj->Form->hidden(
		$questionIt . '.Question.id',
		array('value' => $questions[$questionIt]['id'])
	);
	echo $obj->Form->hidden(
		$questionIt . '.Question.question_type_id',
		array('value' => $questions[$questionIt]['question_type_id'])
	);
	echo $obj->Form->hidden(
		$questionIt . '.Question.required',
		array('value' => $questions[$questionIt]['required'])
	);
	echo $obj->Form->hidden(
		$questionIt . '.Question.days_to_reset',
		array('value' => $questions[$questionIt]['days_to_reset'])
	);

	$attribs['hiddenField'] = true;
	
	switch($questions[$questionIt]['question_type_id']) {
		case 'single': {
		// create question with option to provide a single answer (radio button)
			$attribs['options'] = array();
			$answer = null;
			foreach($questions[$questionIt]['QuestionsResponse'] as $response) {
				$attribs['options'][$response['id']] = $response['Response']['text'];

			// If some value already exists, set as default.
				foreach($response['PatientQuestionsResponse'] as $pqr) {
					$answer = $pqr['questions_response_id'];
				}
			}
	
			// uses radio buttons if less than 6, select otherwise
			if (6 > count($attribs['options'])) {
				$attribs['type'] = 'radio';
				$attribs['legend'] = $questions[$questionIt]['text'];
				if ($answer) $attribs['default'] = $answer;
			}
			else {
				$attribs['type'] = 'select';
				$attribs['label'] = $questions[$questionIt]['text'];
				if ($answer) $attribs['selected'] = $answer;
			}
			//print_r($attribs);
			echo $obj->Form->input($questionIt . '.questions_response_id', $attribs);
			
			break;
		}
		case 'multiple':
		// create a question with option to provide more than one response
			echo "<label>{$questions[$questionIt]['text']}</label>";
			columnize(
				$questions[$questionIt]['QuestionsResponse'],
				'write_multiple_input',
				$obj,
				array('parentIt' => $questionIt)
			);
	
			break;
			
		case 'number':
		case 'text':
			$name = "$questionIt.QuestionsResponse.Response.";
			if ('text' == $questions[$questionIt]['question_type_id']) {
				$name .= 'text';
			} else {
				$name .= 'value';
			}
			
			$options = array (
				'type' => $questions[$questionIt]['question_type_id'],
				'label' => $questions[$questionIt]['text']
			);
			
			foreach($questions[$questionIt]['QuestionsResponse'] as $qResponse) {
				if (0 < count($qResponse['PatientQuestionsResponse'])) {
					$options['value'] = $qResponse['Response']['text'];
				}
			}
			
		// create input
			echo $obj->Form->input($name, $options);

			break;
	}
}


$pageCount = count($pageNumbers);
$nextIndex = 1 + $pageIndex;

if($this->Session->read('Auth.User')) {
	switch($this->Session->read('Auth.User.group_id')) {
		case Configure::read('PatientPortal.group_id.Patient'):
			$this->extend('/Menus/patient_questionnaire');
			break;
				
		case Configure::read('PatientPortal.group_id.Clinician'):
		case Configure::read('PatientPortal.group_id.Coordinator'):
		case Configure::read('PatientPortal.group_id.Administrator'):
			break;
				
		default:
			throw new InternalErrorException('There is no group of this type.');
	}
}
else {
	$this->extend('/Menus/login');
}
?>

<?php $this->start('viewContent'); ?>
<div class="patientQuestionsResponses form viewContent">
	<?php echo $this->Form->create('PatientQuestionsResponse', array('action' => "add/$questionnaireId/$nextIndex")); ?>
	<h2><?php echo "{$questionnaire['QuestionnairePage']['title']} (Page $nextIndex of $pageCount)"; ?></h2>
	<br />
	<?php
	$columnCount = columnize(
		$questionnaire['Question'],
		'write_question_responses',
		$this,
		array('first' => 7, 'second' => 15)
	);
	?>
	
	<?php
	$options = array();
	$options['label'] = ((1 + $pageIndex) < count($pageNumbers)) ? __('Next') : __('Submit');
	
	if (1 < $columnCount) {
		$options['div'] = array('class' => 'clear_both submit');
	}
	
	echo $this->Form->end($options);
	?>
	
	<ul class="horizontal">
	<?php for($i=0; $i<count($pageNumbers); ++$i):?>
		<li style="padding-right: <?php echo 70/count($pageNumbers); ?>%;">
			<?php
			if($pageIndex != $i) {
				echo $this->HTML->link($pageNumbers[$i], array('action' => 'add', $questionnaireId, $i));
			} else {
				echo $this->HTML->link($pageNumbers[$i], "#content");
			}
			?>
		</li>
	<?php endfor;?>
	</ul>
</div>
<?php $this->end(); ?>