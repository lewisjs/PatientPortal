<?php

if($this->Session->read('Auth.User')) {
	if( Configure::read('PatientPortal.group_id.Patient') == $this->Session->read('Auth.User.group_id') ) {
		$this->extend('/Menus/patient_main');	
	}
	elseif( Configure::read('PatientPortal.group_id.Clinician') == $this->Session->read('Auth.User.group_id') ) {
		$this->extend('/Menus/clinician_main');
	
	}
	elseif( Configure::read('PatientPortal.group_id.Coordinator') == $this->Session->read('Auth.User.group_id') ) {
		$this->extend('/Menus/coordinator_main');
	
	}
	elseif( Configure::read('PatientPortal.group_id.Administrator') == $this->Session->read('Auth.User.group_id') ) {
		$this->extend('/Menus/administrator_main');
	}
}
else {
	$this->extend('/Menus/none_main');
}
?>