<?php
include "remote_connect.php";
$count = "SELECT sender,operator from premium_smses"; 
$res = mssql_query($count) or die("Couldn't select infor ".mssql_get_last_message());
while(list($celnumber,$operator)=mssql_fetch_row($res))
{
	//echo"<br>Cel: ".$celnumber."  ".$operator;
	$query = "update premium_transactions set operator='$operator' where celnumber='$celnumber'";        
	$result = mssql_query($query) or die("Couldn't select infor ".mssql_get_last_message());
}
?>