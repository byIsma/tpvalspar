<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" type="text/css" href="CSS/admin.css" />
        <script src="js/jquery-latest.js"></script>
        <script src="js/jquery.lightbox_me.js"></script>
        <script type="text/javascript">
		
			$(document).ready(function(e)
			{
				$('#SaveToCSV').click(function(evnt)
				{
					location.href = 'http://valspar.thetigerparty.com/Valspar/Report.php';
				});
			});
		</script>
<title>Valspar</title>
</head>

<body>

<div>

<?php
	session_start();
	
	if( isset($_SESSION['login']) && $_SESSION['login'] == "login")
	{
		echo '<div id="Reportanvas">';

		include("mysql_connect.php");
			
		echo '<div id="Counter">';
		for ( $i = 1 ; $i <= 5 ; $i++ )
		{
			$strSqlCommand = 'SELECT COUNT(*) FROM submitlist WHERE PictureSelect = "'. $i . '"';
		
			if (! $result = mysql_query($strSqlCommand))
			{
				echo "<div> Connection Database Failed, Please Try again later. </div>";
			}
			else
			{
				$row = @mysql_fetch_array($result);
				echo ' Image '.$i.' Total Shared: '.$row[0].'<br/><br/>';
			}
		}
		echo '</div>';
		echo '<br/><input type="button" value="Export To CSV File" id="SaveToCSV"/><br/><br/>';
		
		$strSqlCommand = 'SELECT * FROM submitlist WHERE 1';
		
		if (! $result = mysql_query($strSqlCommand))
		{
			echo "<div> Connection Database Failed, Please Try again later. </div>";
		}
		else
		{
			echo "<table border='1' id='table' align='center'>
					<tr bgcolor='#CCCCCC'>
						<td>Name</td>
						<td>Email</td>
						<td align='center'>Selected Pictures</td>
						<td>Submit Date</td>
						<td align='center'>Facebook Shared</td>
						<td align='center'>Twitter Shared</td>
					</tr>";
							
			while( $row = @mysql_fetch_array($result) )
			{
				echo "<tr>";
				echo '	<td>'.$row['Name'].'</td>
						<td>'.$row['Email'].'</td>
						<td>'.$row['PictureSelect'].'</td>
						<td>'.$row['Date'].'</td>
						<td>'.$row['Facebook'].'</td>
						<td>'.$row['Twitter'].'</td>';
				echo "</tr>";
			}
			echo "</table>";
		}
		
		echo '</div>';
	}
	else if( isset($_POST['User']) && isset($_POST['Pass']) )
	{
		include("mysql_connect.php");
		$strSqlCommand = '	SELECT * FROM account 
							WHERE Account = "'. $_POST['User'] . '"
							AND Password = "'.$_POST['Pass'].'"';
	
		if (! $result = mysql_query($strSqlCommand))
		{
			LoginCanvas("Connection Database Failed,<br/>Please Try again later.");
		}
		else if( mysql_num_rows($result) > 0 )
		{
			$_SESSION['login'] = "login";
			header( "Location: admin.php" );
		}
		else
		{
			LoginCanvas("The account or password<br/>you entered is incorrect.");
		}
	}
	else
	{
		LoginCanvas("");
	}
	
	function LoginCanvas( $strSession )
	{
		echo '
<div class="objinside" id="LoginCanvas">
	<div id="Session">'.$strSession.'</div>
	<form id="LoginForm" action="" method="post">
		<div id="LbUser">Account:</div>
		<div id="InUser"><input type="text" name="User" id="User"/></div>
		<div id="LbPass">Password:</div>
		<div id="InPass"><input type="password" name="Pass" id="Pass"/></div>
		<input type="submit" value="Login" id="BtLogin"/>
	</form>
</div>
';
		echo "<script type='text/javascript'>
				$('#LoginCanvas').lightbox_me({centered: true, closeClick: false});
				</script>";
	}
?>

</div>

</body>
</html>