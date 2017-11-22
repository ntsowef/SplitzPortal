
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
        <meta charset="UTF-8">
        <title></title>
        <style type="text/css">
body {
	background-color: #75889b;
}
</style>
    </head>
    <body marginheight="0px">
        <div align="center">
            <p><a href="consolidated.php"> View consolidated nominations</a></p> 
            <p><a href="nomination_wire_view.php">View Nominations</a> </p>
         
            
     
        </div>
      
    </body>
</html>
