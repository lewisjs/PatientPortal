<?php

// if (Configure::read('debug') == 0):
// 	throw new NotFoundException();
// endif;
App::uses('Debugger', 'Utility');

if (Configure::read('debug') > 0):
	Debugger::checkSecurityKeys();
endif;
?>

<?php if ($this->fetch('contentMenu')): ?>
	<div class="contentMenu"><?php echo $this->fetch('contentMenu'); ?></div>
<?php endif; ?>

<div class="view">
	<?php if ($this->fetch('viewMenu')): ?>
		<div class="viewMenu"><?php echo $this->fetch('viewMenu'); ?></div>
	<?php endif; ?>
	
	<?php
	if ($this->fetch('viewContent')) {
		echo $this->fetch('viewContent');
	}
	?>
</div>