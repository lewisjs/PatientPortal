<?php

if($this->Session->read('Auth.User')) {
	switch($this->Session->read('Auth.User.group_id')) {
		case Configure::read('PatientPortal.group_id.Patient'):
			$this->extend('/Menus/patient_patient');
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

$this->start('viewContent');
?>
<div class="patients form viewContent">
<?php echo $this->Form->create('Patient'); ?>
	<fieldset>
		<legend><?php echo __('Add Patient'); ?></legend>
	<?php
		echo $this->Form->input('first_name');
		echo $this->Form->input('middle_name');
		echo $this->Form->input('last_name');
		echo $this->Form->input('maiden_name');
		echo $this->Form->input(
			'date_of_birth',
			array(
				'label' => 'Date of birth',
				'dateFormat' => 'MDY',
				'minYear' => date('Y') - Configure::read('PatientPortal.patient.max_age'),
				'maxYear' => date('Y') - Configure::read('PatientPortal.patient.min_age'),
			)
		);
		echo $this->Form->input(
			'patient_gender_id',
			array(
				'label' => 'Gender',
				'empty' => 'Choose One',
			)
		);
		echo $this->Form->input('street1');
		echo $this->Form->input('street2');
		echo $this->Form->input('city');
		echo $this->Form->input('state');
		echo $this->Form->input('zip');
		echo '<div class="telephoneInput">';
			echo $this->Form->input('home_phone_area', array(
				'div' => false,
				'label' => 'Home Phone:',
				'maxlength' => 3,
				'size' => 3,
				'between' => '<span class="large_font">(</span>',
				'after' => '<span class="large_font">) </span>'
			));
			echo $this->Form->input('home_phone_prefix', array(
				'div' => false,
				'label' => false,
				'maxlength' => 3,
				'size' => 3,
				'after' => '<span class="large_font"> - </span>'
			));
			echo $this->Form->input('home_phone_suffix', array(
				'div' => false,
				'label' => false,
				'maxlength' => 4,
				'size' => 4
			));
		echo '</div>';
		echo '<div class="telephoneInput">';
			echo $this->Form->input('mobile_phone_area', array(
				'div' => false,
				'label' => 'Mobile Phone:',
				'maxlength' => 3,
				'size' => 3,
				'between' => '<span class="large_font">(</span>',
				'after' => '<span class="large_font">) </span>'
			));
			echo $this->Form->input('mobile_phone_prefix', array(
				'div' => false,
				'label' => false,
				'maxlength' => 3,
				'size' => 3,
				'after' => '<span class="large_font"> - </span>'
			));
			echo $this->Form->input('mobile_phone_suffix', array(
				'div' => false,
				'label' => false,
				'maxlength' => 4,
				'size' => 4
			));
		echo '</div>';
		echo '<div class="telephoneInput">';
			echo $this->Form->input('work_phone_area', array(
				'div' => false,
				'label' => 'Work Phone:',
				'maxlength' => 3,
				'size' => 3,
				'between' => '<span class="large_font">(</span>',
				'after' => '<span class="large_font">) </span>'
			));
			echo $this->Form->input('work_phone_prefix', array(
				'div' => false,
				'label' => false,
				'maxlength' => 3,
				'size' => 3,
				'after' => '<span class="large_font"> - </span>'
			));
			echo $this->Form->input('work_phone_suffix', array(
				'div' => false,
				'label' => false,
				'maxlength' => 4,
				'size' => 4
			));
		echo '</div>';
		echo $this->Form->input(
			'patient_marital_status_id',
			array(
				'label' => 'Marital Status',
				'empty' => 'Choose One',
			)
		);
		echo $this->Form->input(
				'location_id',
				array(
					'label' => 'Preferred Location',
					'empty' => 'Choose One',
				)
		);
	?>
	</fieldset>
<?php echo $this->Form->end(__('Next')); ?>
</div>

<?php $this->end(); ?>