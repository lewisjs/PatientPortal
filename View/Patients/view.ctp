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
	$this->extend('/Menus/login_view');
}

$this->start('viewContent');
?>

<div class="patients viewContent">
	<h2><?php  echo __('Patient'); ?></h2>
	<dl>
		<dt><?php echo __('First Name'); ?></dt>
		<dd><?php echo h($patient['Patient']['first_name']); ?>&nbsp;</dd>
		
		<dt><?php echo __('Middle Name'); ?></dt>
		<dd><?php echo h($patient['Patient']['middle_name']); ?>&nbsp;</dd>
		
		<dt><?php echo __('Last Name'); ?></dt>
		<dd><?php echo h($patient['Patient']['last_name']); ?>&nbsp;</dd>
		
		<dt><?php echo __('Maiden Name'); ?></dt>
		<dd><?php echo h($patient['Patient']['maiden_name']); ?>&nbsp;</dd>
		
		<dt><?php echo __('Date Of Birth'); ?></dt>
		<dd><?php echo h($patient['Patient']['date_of_birth']); ?>&nbsp;</dd>
		
		<dt><?php echo __('Gender'); ?></dt>
		<dd><?php echo h($patient['PatientGender']['description']); ?>&nbsp;</dd>
		
		<dt><?php echo __('Street1'); ?></dt>
		<dd><?php echo h($patient['Patient']['street1']); ?>&nbsp;</dd>
		
		<dt><?php echo __('Street2'); ?></dt>
		<dd><?php echo h($patient['Patient']['street2']); ?>&nbsp;</dd>
		
		<dt><?php echo __('City'); ?></dt>
		<dd><?php echo h($patient['Patient']['city']); ?>&nbsp;</dd>
		
		<dt><?php echo __('State'); ?></dt>
		<dd><?php echo h($patient['Patient']['state']); ?>&nbsp;</dd>
		
		<dt><?php echo __('Zip'); ?></dt>
		<dd><?php echo h($patient['Patient']['zip']); ?>&nbsp;</dd>
		
		<dt><?php echo __('Home Phone'); ?></dt>
		<dd><?php echo h($patient['Patient']['home_phone']); ?>&nbsp;</dd>
		
		<dt><?php echo __('Mobile Phone'); ?></dt>
		<dd><?php echo h($patient['Patient']['mobile_phone']); ?>&nbsp;</dd>
		
		<dt><?php echo __('Work Phone'); ?></dt>
		<dd><?php echo h($patient['Patient']['work_phone']); ?>&nbsp;</dd>
		
		<dt><?php echo __('Marital Status'); ?></dt>
		<dd><?php echo h($patient['PatientMaritalStatus']['description']); ?>&nbsp;</dd>
		
		<dt><?php echo __('Preferred Location'); ?></dt>
		<dd><?php echo h($patient['Location']['description']); ?></dd>
	</dl>
</div>

<?php $this->end(); ?>
