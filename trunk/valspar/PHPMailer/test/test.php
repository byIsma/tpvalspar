<?php
/**
* Simple example script using PHPMailer with exceptions enabled
* @package phpmailer
* @version $Id$
*/

require '../class.phpmailer.php';

try {
	$mail = new PHPMailer(true); //New instance, with exceptions enabled

	$body             = file_get_contents('test.html');
	$body             = preg_replace('/\\\\/','', $body); //Strip backslashes

	$mail->IsSMTP();                           // tell the class to use SMTP
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	
	$mail->SMTPSecure = "ssl";
	$mail->Port       = 465;                    // set the SMTP server port
	$mail->Host       = "smtp.gmail.com"; // SMTP server
	$mail->Username   = "polarbear0902@gmail.com";     // SMTP server username
	$mail->Password   = "myqvksvgvrdhdcmq";            // SMTP server password

	//$mail->IsSendmail();  // tell the class to use Sendmail

	//$mail->AddReplyTo("name@domain.com","First Last");

	$mail->From       = "amay@thetigerparty.com";
	$mail->FromName   = "First Last";

	$to = "amay@thetigerparty.com";

	$mail->AddAddress($to);

	$mail->Subject  = "First PHPMailer Message";
$mail->AddAttachment("c:\\wamp\\www\\Valspar\\img\\sample001.jpg","sample001.jpg");
	$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
	$mail->WordWrap   = 80; // set word wrap

	$mail->MsgHTML($body);

	$mail->IsHTML(true); // send as HTML

	$mail->Send();
	echo 'Message has been sent.';
} catch (phpmailerException $e) {
	echo $e->errorMessage();
}
?>