<?php	
include("mysql_connect.php");
if(isset($_POST['Name']) && isset($_POST['Email']) && isset($_POST['PictureSelect']))
{
	$strSqlCommand = 'INSERT INTO SubmitList ( Name, Email, PictureSelect) VALUES ( "'.$_POST['Name'].'", "'.$_POST['Email'].'", '.$_POST['PictureSelect'].')';

	if (!mysql_query($strSqlCommand))
	{
		echo "<Error Message=\"".mysql_error()."\" Domain=\"CreateGroup\" />";
		echo "<Error Message=\"".$strSqlCommand."\" Domain=\"CreateGroup\" />";
		exit;
	}
}
?>