<?php
$hostname='196.37.186.21'; //// specify host, i.e. 'localhost'
$user='root'; //// specify username
$pass='n4u2cc'; //// specify password
$dbase='sms_data'; //// specify database name
$connection = mysql_connect($hostname , $user , $pass) 
or die ("Can't connect to MySQL");
$db = mysql_select_db($dbase , $connection) or die ("Can't select database.");
?>