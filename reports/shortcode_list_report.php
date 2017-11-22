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
        <title>Shortcode List Report</title>
    </head>
    <body>        <
       <div align="center">
        <table cellspacing="0">
        <?php
              include "connect.php";
                $sql = " SELECT shortcode, cost_inclusive from shortcoces where shortcodetype='premium'" ;
                   $result=mysql_query($sql) or die('Unable to select from temp_marquee');
            
              $num_record = mysql_num_rows($result);
              if ($num_record == 0){
                echo " No shortcodes ".$company;
            }else{
                echo "<tr><td class='helpHed' colspan='2'>Shortcodes</td></tr>";
                echo "<TR> <td class='helpHed'>Shortcode</td><td class='helpHed'>Price</td>td class='helpHed'>ViewAll</td>";                
                echo "</TR>";
                while (list($shortcode, $cost_inclusive) = mysql_fetch_row($result)) {
                  echo "<TR> <td>".$shortcode."</td><td>".$cost_inclusive."</td><td><a href'shortcode_report.php?'>ViewAll</a></td> ";                
                echo "</TR>";   
                }
            }
        ?>
        ?>
        </table>
       </div>    
    </body>
</html>
