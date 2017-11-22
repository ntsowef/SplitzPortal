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
        $sql = " SELECT bc.category as category, m.quest, m.id from mobile_poll m, bam_categories bc where bc.id = m.id";
       // $sql = " SELECT msisdn, message, date_time from temp_marquee where company='$company'  and status='1'";
       // echo $sql;
        
        $result=mysql_query($sql) or die('Unable to select from cell_poll');
            
          $num_record = mysql_num_rows($result);
          
          if ($num_record == 0){
                echo " Sorry no poll create for this company ".$company;
            }else{
                echo "<tr><td class='helpHed' colspan='3'>Finite Women Category Votes</td></tr>";
                echo "<TR> <td class='helpHed'>Poll #</td><td class='helpHed'>Poll Name</td><td class='helpHed'>View</td>";                
                echo "</TR>";
                while (list($category,$quest, $id) = mysql_fetch_row($result)) {
                  echo "<TR> <td>".$id." .... </td><td>".$category."</td><td><a href='view_poll_result.php?poll_id=".$id."'>View</a>|<a href='pie-chart-3d.php?poll_id=".$id."'>View Pie 3d </a>|<a href='list_table_polls.php?poll_id=".$id."'>View Table</a><td>";                
                echo "</TR>";   
                }
            }
        ?>
           
            <!--tr><td> <a href="create_poll.php"> Create New Voting poll</a></td> </tr--> 
       </table>
       
               
 <button onclick="goBack()">Go Back</button>

<script>
function goBack() {
    window.history.back();
}
</script>  
    </body>
</html>
