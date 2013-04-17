<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

//$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$description = Configure::read('PatientPortal.site.description')
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $description ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css(array('default', 'action_containers', 'action_buttons'));

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		
		echo $this->Html->script(Configure::read('PatientPortal.jquery.url')); // Include jQuery library
	?>
</head>
<body>
	<div id="container">
 		<div id="header"><h2 style="text-align: center;">If you encounter problems, please click: 
 			<?php echo $this->Html->link(
 				'this link',
 				'https://docs.google.com/forms/d/1pIQULY3lbZhMbhkib-5kRMaqoRKvUzccqdblbJrLmps/viewform',
 				array('target' => 'blank')
 			); ?>
 			 </h2>
 			<!-- <h1><?php //echo "Patient Portal: $description"; ?></h1> -->
 		</div>
	
		<div id="content">
			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		
<!-- 	<div id="footer"><?php //echo '<br />'; echo $this->Html->image('practice.footer.jpg', array('alt' => '', 'border' => '0')); ?></div> -->
	</div>
	<?php echo $this->element('sql_dump'); ?>
	<?php echo $this->Js->writeBuffer(); // Write cached scripts ?>
</body>
</html>
