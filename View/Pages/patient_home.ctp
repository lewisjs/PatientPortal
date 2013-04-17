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
 * @package       Cake.View.Pages
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Debugger', 'Utility');

$this->extend('/Menus/patient_main');

$this->start('viewContent');
?>

<div class="viewContent">
<?php if ($this->viewVars['Actions']): ?>
	<div class="actions">
		<h3><?php echo __('Actions'); ?></h3>
		<ul>
			<?php foreach ($this->viewVars['Actions'] as $action): ?>
				<li><?php echo $this->HTML->link($action['msg'], $action['url']); ?></li>
			<?php endforeach; ?>
		</ul>
	</div>
<?php endif; ?>
</div>

<?php $this->end(); ?>
