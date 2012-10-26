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
//	session_start();
	
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
				switch ( $i )
				{
					case 1:
						echo ' Cool Rain Total Shared: '.$row[0].'<br/><br/>';
						break;
					case 2:
						echo ' Martian Total Shared: '.$row[0].'<br/><br/>';
						break;
					case 3:
						echo ' Pool Party Total Shared: '.$row[0].'<br/><br/>';
						break;
					case 4:
						echo ' Sonic Plum Total Shared: '.$row[0].'<br/><br/>';
						break;
					case 5:
						echo ' Raspberry Sorbet Total Shared: '.$row[0].'<br/><br/>';
						break;
				}
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
						<td width='10%' align='center'>Id</td> 
						<td width='25%' align='center'>Selected Pictures</td>
						<td width='25%' align='center'>Submit Date</td>
						<td width='20%' align='center'>Facebook Shared</td>
						<td width='20%' align='center'>Twitter Shared</td>
					</tr>";
							
			while( $row = @mysql_fetch_array($result) )
			{
				echo "<tr>";
				echo '	<td>'.$row['idSubmitList'].'</td> ';
				
				switch ( $row['PictureSelect'] )
				{
					case 1:
						echo '<td>Cool Rain</td>';
						break;
					case 2:
						echo '<td>Martian</td>';
						break;
					case 3:
						echo '<td>Pool Party</td>';
						break;
					case 4:
						echo '<td>Sonic Plum</td>';
						break;
					case 5:
						echo '<td>Raspberry Sorbet</td>';
						break;
				}
				echo '	<td>'.$row['Date'].'</td>
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
			ob_start();
			header( "Location: admin.php" );
			ob_end_flush();
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