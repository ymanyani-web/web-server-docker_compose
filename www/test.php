<?php
ini_set( 'display_errors', 1 );
error_reporting( E_ALL );
$from = "emailtest@YOURDOMAIN";
$to = "yazid.mn2000@gmail.com";
$subject = "PHP Mail Test script1";
$message = "This is a test to check the PHP Mail functionality";
$headers = "From:" . $from;
	if(mail($to,$subject,$message, $headers))
	{
		echo "Test email sent";
	}
	else
	{
		echo "no";
	}
?>
