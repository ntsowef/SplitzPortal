<?php
session_start();
$username = $_SESSION["username"];
$company = $_SESSION["company"];
$id = $_SESSION["user_id"];
$admin = $_SESSION["admin"];
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="css/table.css" rel="stylesheet" type="text/css" />
        <title>Shortcode Report</title>
    </head>
    <body>
        <?php
            include "connect.php";
             $sql = "SELECT keyword, shortcode, price from premium_services where company ='$company'";
           
        ?>
    </body>
</html>
