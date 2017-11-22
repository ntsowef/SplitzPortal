<?php
session_start();
$username = $_SESSION["username"];
$company = $_SESSION["company"];
$id = $_SESSION["user_id"];
$admin = $_SESSION["admin"];
$reseller = $_SESSION['reseller'];

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



    </head>
    <body marginheight="0px">
        <div align="center">
         <p><a href="company/index.php"> Company </a></p> 
         <p><a href="users/index.php"> Users</a> </p>
     
         <p><a href="bulkcredits/index.php">bulk SMS credits</a> </p>
        
        </div>
      
    </body>
</html>