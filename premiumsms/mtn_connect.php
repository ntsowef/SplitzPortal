<?php
	
	$host = "localhost";
        $user = "mtn";
        $pswd = "mtn";
        $database = "mtn"; 
	
	/*
	$host = "localhost";
        $user = "computekmtn";
        $pswd = "mtncomputek";
        $database = "computek_mtn"; 
	*/
	@mysql_pconnect($host, $user, $pswd) or die("Couldn't connect to server, the is a problem with your internet ".mysql_error());
        @mysql_select_db($database) or die("Couldn't select $database database! ".mysql_error());
	
	/*
	$myServer = 'wasp';
	$myUser = 'sa';
	$myPass = '*1waspadm';
	$myDB = 'computek';  
	
	$conn = new COM ('ADODB.Connection')  or die('Cannot start ADO'); 
	$connStr = 'PROVIDER=SQLOLEDB;SERVER='.$myServer.';UID='.$myUser.';PWD='.$myPass.';DATABASE='.$myDB; 
	$conn->open($connStr); //Open the connection to the database 
	
	if($conn)
	{echo "fine";}
	else
	{echo "failed";}
	//mssql_close($conn);
	*/
?>