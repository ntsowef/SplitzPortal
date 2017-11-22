<?php

header("Cache-Control: private, must-revalidate, max-age=0");
header("Pragma: no-cache");
 // header("Expires: Sat, 4 Jun 2016 12:00:00 GMT");
session_start();
$username = $_SESSION["username"];
$company = $_SESSION["company"];
$id = $_SESSION["user_id"];
$admin = $_SESSION["admin"];

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Progress Report</title>
         <link href="tablestyle.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        
        <h2> Progress Report for <?php echo $username; ?></h2>
        <?php
        include 'connect.php';
        
       $sql = "SELECT sum(cash_received) as cash from cup_transaction where user_id='$username'"; 
       $sql1 = "SELECT team, cash_received, msisdn, date_loggedin from cup_transaction where user_id='$username'";
       
       $result = mysql_query($sql);
       $result1 = mysql_query($sql1);
       $arr = mysql_fetch_array($result);
       
       echo "<table>";
       echo "<tr><td>Total Cash collected</td><td> M".$arr['cash']."</td></tr>";
       echo "</table><p>";
       ?>
        <?php
         echo "<div class='CSSTableGenerator'>
                         <table>
                                    <tr>
                                     
                                        <td >
                                            Team
                                        </td>
                                         <td >
                                            Cellphone no:
                                        </td>
                                       <td >
                                            Cash Received
                                        </td>
                                        <td >
                                            Date Logged
                                        </td>
                                    </tr> <p>";
          while($tr=mysql_fetch_array($result1))
	      {
                  echo "<tr>";
                
                  echo "<td>".$tr['team']."</td>";
                 echo "<td>".$tr['msisdn']."</td>";
                  echo "<td>".$tr['cash_received']."</td>";
                        echo "<td>".$tr['date_loggedin']."</td>";
                  echo '</tr> <p>';
            
              }
          echo "</table></div>";
        ?>
        <a href="../pos.php"> Transact Now </a>
    </body>
</html>
