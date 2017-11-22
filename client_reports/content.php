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
        <title></title>
    </head>
    <body>
        <h2>Client Reports for <?php echo $company; ?> </h2>
        
        <ul>
            <li>Raw data</li>
            <li>Traffic Reports</li>
            <li>Random Draw </li>
        </ul>
    </body>
</html>
