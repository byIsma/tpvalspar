<?php

	include("mysql_connect.php");

	$strSqlCommand = 'SELECT COUNT(*) FROM submitlist WHERE PictureSelect = "1"';
	$strSqlCommand = 'SELECT COUNT(*) FROM submitlist WHERE PictureSelect = "2"';
	$strSqlCommand = 'SELECT COUNT(*) FROM submitlist WHERE PictureSelect = "3"';
	$strSqlCommand = 'SELECT COUNT(*) FROM submitlist WHERE PictureSelect = "4"';
	$strSqlCommand = 'SELECT COUNT(*) FROM submitlist WHERE PictureSelect = "5"';
	$strSqlCommand = 'SELECT * FROM submitlist WHERE 1';

	if (! $result = mysql_query($strSqlCommand))
	{
		echo "<Error Message=\"".mysql_error()."\" Domain=\"CreateGroup\" />";
		echo "<Error Message=\"".$strSqlCommand."\" Domain=\"CreateGroup\" />";
		exit;
	}
	else
	{
		while($row = @mysql_fetch_array($result))
		{
			// echo Name Email Image Time FB TW
		}
	}

?>