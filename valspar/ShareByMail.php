
<?php 
	if(isset($_POST['From']))
    {
		require 'PHPMailer/class.phpmailer.php';
		
		try {
			$mail = new PHPMailer(true); //New instance, with exceptions enabled
		
			$body             = file_get_contents('MailerContent.html');
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
		
			$mail->From       = $_POST['From'];
			$mail->FromName   = "Valspar Love Your Color Guarantee Project";
			
			//$to = "polarbear0902@gmail.com";
			//if(isset($_POST['To']))
			$to = $_POST['To'];
			$mail->AddAddress( $to );
		
			$mail->Subject  = "Valspar Love Your Color Guarantee Project";
		
			$mail->AddAttachment("c:\\wamp\\www\\Valspar\\img\\sample00".$_POST['ID'].".jpg","sample00".$_POST['ID'].".jpg");
			
			$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
			$mail->WordWrap   = 80; // set word wrap
		
			$mail->MsgHTML($body);
		
			$mail->IsHTML(true); // send as HTML
		
			$mail->Send();
//			echo 'Message has been sent.';
//			echo $to;
			
			session_start();
			$_SESSION['Name'] = $_POST['Name'];
			$_SESSION['Email'] = $_POST['From'];
			$_SESSION['PictureSelect'] = $_POST['ID'];
			require( "SQL.php");

		} catch (phpmailerException $e) {
			echo $e->errorMessage();
		}
		exit;
	}
    
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>

<form action="ShareByMail.php" method="post">
From: <br/><input type="email" name="From" value="<?php if( isset($_GET['Email'])) echo $_GET['Email']; ?>" /><br/>
To: <br/><input type="email" name="To" /><br/>
<input type="hidden" name="ID" value="<?php if( isset($_GET['ID'])) echo $_GET['ID']; ?>" />
<input type="hidden" name="Name" value="<?php if( isset($_GET['Name'])) echo $_GET['Name']; ?>" />
<input type="submit" value="Send" /><br/>
</form>

</body>
</html>
