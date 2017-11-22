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
        $current_date = date('Y-m-d');
        $sql = " SELECT quest, id from cell_poll where company='$company' and status='a'";
       // $sql = " SELECT msisdn, message, date_time from temp_marquee where company='$company'  and status='1'";
       // echo $sql;
        
        $result=mysql_query($sql) or die('Unable to select from cell_poll');
            
          $num_record = mysql_num_rows($result);
          
          if ($num_record == 0){
                echo " Sorry no poll create for this company ".$company;
            }else{
                echo "<tr><td class='helpHed' colspan='4'>CREATED Polls</td></tr>";
                echo "<TR> <td class='helpHed'>Poll #</td><td class='helpHed'>Poll Name</td><td class='helpHed'>View</td><td class='helpHed'>Remove</td>";                
                echo "</TR>";
                while (list($quest, $id) = mysql_fetch_row($result)) {
                  echo "<TR> <td>".$id." .... </td><td>".$quest."</td><td><a href='poll_display.php?poll_id=".$id."'>View</a><td><a href='remove_poll.php?poll_id=".$id."'>Delete</a> </td> ";                
                echo "</TR>";   
                }
            }
        ?>
           
            <tr><td> <a href="create_poll.php"> Create New Voting poll</a></td> </tr> 
       </table>
       
    </body>
</html>
