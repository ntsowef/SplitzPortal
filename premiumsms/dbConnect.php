<?php
	/* $host = "localhost";
        $user = "tmobile";
        $pswd = "tmobile";
        $database = "tmobile"; 
	
	*/
	$host = "localhost";
	$user = "tmobiles_tmobile";
	$pswd = "tmobile";
	$database = "tmobiles_tmobile";
        @mysql_pconnect($host, $user, $pswd) or die("Couldn't connect to server, the is a problem with your internet ".mysql_error());
        @mysql_select_db($database) or die("Couldn't select $database database! ".mysql_error());
?>