<?php
session_start();
$username = $_SESSION["username"];
$company = $_SESSION["company"];
$id = $_SESSION["user_id"];
$admin = $_SESSION["admin"];

?>
<html>
    <head>
     <head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>SMS System</title>
<style type="text/css">
body {
	background-color: #75889b;
}
</style>
<link href="backgroundControl.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="calendar/calendar.js"></script>
<link href="calendar/calendar.css" rel="stylesheet" type="text/css">
<script language = "javascript" style = "text/javascript"> 

function checkMaxLength(e,el)
{
	document.forms(0).Count.value = document.forms(0).Message.value.length + 1; 		
}
function MoreValue()
{
	
	if (document.forms(0).EMS.checked == true)
	{
		alert(document.forms(0).EMS.checked);
		alert("Note that additional charge will be incured");
	}
}
function OpenpopUp()
{
    alert("Submited...............");
}
function disable()
{   
	//alert ("in");
	var area = document.getElementById("Phone_numbers");
	var chk = document.getElementById("check");
	var brw = document.getElementById("file");
	if (chk.checked == true)
	{
		document.getElementById("file").disabled = false;
		document.getElementById("Phone_numbers").disabled = true;
	}
	else
	{	
		document.getElementById("file").disabled = true;
		document.getElementById("Phone_numbers").disabled = false;
	}
}
-->
</script>

    </head>
    <body marginheight="0px">
        <div align="center">
         <p><a href="company/index.php"> Company </a></p> 
         <p><a href="users/index.php"> Users</a> </p>
         <p><a href="shortcodes/index.php">Short Codes </a> </p>
         <p><a href="bulkcredits/index.php">bulk SMS credits</a> </p>
         <p><a href="adverts/index.php">Adverts for Campaigns</a> </p>
        </div>
      
    </body>
</html>
