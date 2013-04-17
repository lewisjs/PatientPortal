<?php
$this->extend('/Common/view');

$this->start('contentMenu');

$options = array(
	'Patients' => array(),
	'InsurancePatientRelationships' => array(),
	'ReferralFiles' => array(),
	'PatientQuestionsResponses' => array(),
	'Appointments' => array(),
	'Users' => array()
);
$options[$this->name] = array('class' => 'selected');
?>
<div>
	<ul>
		<li><?php
			echo $this->Html->link(
				__('Demographics'),
				array('controller' => 'patients', 'action' => 'view', $this->Session->read('Auth.User.patient_id')),
				$options['Patients']
			);
		?></li>
		<li><?php
			echo $this->Html->link(
				__('Insurance'),
				array('controller' => 'insurancePatientRelationships', 'action' => 'index', $this->Session->read('Auth.User.patient_id')),
				$options['InsurancePatientRelationships']
			);
		?></li>
		<li><?php
			echo $this->Html->link(
				__('Records'),
				array('controller' => 'referralFiles', 'action' => 'index', $this->Session->read('Auth.User.patient_id')),
				$options['ReferralFiles']
			);
		?></li>
		<li><?php
			echo $this->Html->link(
				__('Forms'),
				array('controller' => 'patientQuestionsResponses', 'action' => '/'),
				$options['PatientQuestionsResponses']
			);
		?></li>
		<li><?php
			//echo $this->Html->link(
			//	__('Appointments'),
			//	array('controller' => 'pages', 'action' => '/', $this->Session->read('Auth.User.patient_id')),
			//	$options['Appointments']
			//);
		?></li>
		<li><?php
			echo $this->Html->link(
				__('User Account'),
				array('controller' => 'users', 'action' => 'view', $this->Session->read('Auth.User.id')),
				$options['Users']
			);
		?></li>
	</ul>
</div>
<?php $this->end(); ?>