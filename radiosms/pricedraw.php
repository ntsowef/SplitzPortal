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
        <title></title>
    </head>
    <body>
        
        <div align="center">
        <table cellspacing="0">
        <?php
        include "connect.php";
           $sql = "SELECT keyword, shortcode, price from premium_services where company ='$company'";
           
            $result=mysql_query($sql) or die('Unable to select from premium_services');
            
            $num_record = mysql_num_rows($result);
            if ($num_record == 0){
                echo " Sorry no current competition set for this company ".$company;
            }else{
                echo "<TR> <td class='helpHed'>Campaign Name </td><td class='helpHed'> Shortcode</td><td class='helpHed'>Price</td><td class='helpHed'> Operation</td>";                
                echo "</TR>";
                while (list($keyword, $shortcode,  $price) = mysql_fetch_row($result)) {
                  echo "<TR> <td>".$keyword."</td><td>".$shortcode."</td><td>".$price."</td><td> <a href='radiodraw.php?keyword=".$keyword."&shortcode=".$shortcode."&price=".$price."'>Access </a></td>";                
                echo "</TR>";   
                }
            }
        ?>
        </table>
       </div>
    </body>
</html>
