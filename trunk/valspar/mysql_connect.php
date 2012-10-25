<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	//----------------------------------------------------------
	// Sample for Link To MySQL
	// Author  : Lance Kuo
	// Created : 2012/07/13
	// Version : V1.0.0.0
	// Note    : My Model for mySQL Connect  
	// History : 2012/07/13 Created by Lance Version 1.
	//----------------------------------------------------------


//MySQL Setting

//SQL Server Address
//$db_server = "107.22.182.14";
//Test Server Address
//$db_server = "127.0.0.1";
$db_server = "23.21.84.9";

//Database Name
$db_name = "valspar";

//Administrator Account And password
$db_user = "admin";
$db_passwd = "admin";
//$db_passwd = "";

//connect my_sql
if(!@mysql_connect($db_server, $db_user, $db_passwd))
    die("Can't Link to Database Server!");

//setting for UTF8
mysql_query("SET NAMES utf8");

//select Database
if(!@mysql_select_db($db_name))
        die("Can't select this database!");
?> 
