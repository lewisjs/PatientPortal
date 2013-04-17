<?php
/**
 * @param string $userType
 * @param string $addr
 */
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>

<head></head>

<body style="margin:auto;width:800px;font-family:'sans serif'">
	<br />
	
	<p>We would like to wish you a warm welcome from <a href=
'http://www.lowcountryrheumatology.com'> Low Country Rheumatology</a>. <?php echo $creator; ?> has invited you to
create a user account providing access to our patient portal. With this user account, you will be able to provide us
with the necessary information to schedule you an appointment with one of our physicians.</p>

	<p>Please click on the link below or copy and paste the address into your browser. Your current username is 
<?php echo $username; ?>.</p>

	<p style="margin:auto;width:650px;text-align:center">
		<a href="<?php echo $url; ?>" style="position:absolute;color:#000; font-weight:900">
			Click Here To Create a User Account
		</a>
	</p>
	<br />

	<p style="text-align:center;font-size:30px">- OR -</p>

	<div style="position:relative;margin:auto;height:140px">
		
		<p style="margin:auto;width:650px;text-align:center">
			Paste the following link into the address bar of your browser
		</p>
		<br />
		
		<input type="text" disabled="disabled" name="confirmationId" style="width:780px;margin:auto 10px auto 10px;
			font-weight:900;font-size:10px;text-align:center" value="<?php echo $url; ?>" />
			
	</div>
	
</body>

</html>

