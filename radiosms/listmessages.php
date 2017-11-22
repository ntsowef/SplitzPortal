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
 <link href="tablestyle.css" rel="stylesheet" type="text/css" />
        <title></title>
    </head>
    <body>
       
        <?php
        include "connect.php";
        $current_date = date('Y-m-d');
        $sql = " SELECT msisdn, message, date_time from temp_marquee where company='$company' and (date_time BETWEEN  DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW()) and status='1' order by date_time desc";
       // $sql = " SELECT msisdn, message, date_time from temp_marquee where company='$company'  and status='1'";
       // echo $sql;
        
        $result=mysql_query($sql) or die('Unable to select from temp_marquee');
            
          $num_record = mysql_num_rows($result);
          
          if ($num_record == 0){
                echo " Sorry no messages sent to this DJ for this company ".$company;
            }else{
              
                echo "<div class='CSSTableGenerator'>";
                echo " <table>";
                echo "<tr><td>MESSAGES</td>";
                echo " <td>Cellphone No:</td><td>DateTime</td>";                
                echo "</TR>";
                while (list($msisdn, $message,  $date_time) = mysql_fetch_row($result)) {
                  echo "<TR> <td>".$message."</td> <td>".$msisdn." </td><td>".$date_time."</td>";                
                echo "</TR>";   
                }
                  echo " </table>";
               echo "</div>"; 
            }
        ?>
            
      
    </body>
</html>
