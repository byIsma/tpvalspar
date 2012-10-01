<?php	
include("mysql_connect.php");

if( isset($_POST['SubmitID'] ))
{
	$strSqlCommand = 'UPDATE submitlist SET Facebook ="Yes" WHERE idSubmitList = ' . $_POST['SubmitID'];
}
else
{
	$strSqlCommand = 'UPDATE submitlist SET Twitter ="Yes" WHERE idSubmitList = ' . $_SESSION['SubmitID'];
}
/*
if(isset($_POST['Name']) && isset($_POST['Email']) && isset($_POST['PictureSelect']))
	$strSqlCommand = 'INSERT INTO sharelist ( Name, Email, PictureSelect) VALUES ( "'.$_POST['Name'].'", "'.$_POST['Email'].'", '.$_POST['PictureSelect'].')';
else
	$strSqlCommand = 'INSERT INTO sharelist ( Name, Email, PictureSelect) VALUES ( "'.$_SESSION['Name'].'", "'.$_SESSION['Email'].'", '.$_SESSION['PictureSelect'].')';
*/	
if (!mysql_query($strSqlCommand))
{
	echo "<Error Message=\"".mysql_error()."\" Domain=\"CreateGroup\" />";
	echo "<Error Message=\"".$strSqlCommand."\" Domain=\"CreateGroup\" />";
	exit;
}

?>