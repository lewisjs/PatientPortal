<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head></head>
<body style="margin:auto;width:800px;font-family:\'sans serif\'">
	<h2>Confirm New User: <?php echo $userName; ?></h2>
	<hr style="margin:2px auto 0 5px;	width:450px;height:3px"/>
	<br />
	<p style="margin:auto;width:650px">
		Please click the following link to confirm your new user account: 
		<a style="color:#000;font-weight:900" href="<?php echo $url; ?>">Confirm User Email</a>
	</p>
	<div style="position:relative;margin:auto;height:140px">
	<p style="text-align:center;font-size:30px">- OR -</p>
	<p style="margin:auto;width:650px">
		Please paste the following link bar of your browser
	</p>
	<br />
	<input type="text" disabled="disabled" name="confirmationId" 
		style="width:780px;margin:auto 10px auto 10px;font-weight:900;font-size:20px;text-align:center"
		value="<?php echo $url; ?>" />
	</div>
</body>
</html>