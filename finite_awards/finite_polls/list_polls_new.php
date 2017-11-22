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
        $sql = "SELECT  COUNT(sp.poll_id) AS number, bc.category AS category, m.quest, m.id FROM mobile_poll m, ultimate_categories bc, splitz_poll_ans sp WHERE sp.poll_name = bc.category AND bc.category_code = m.quest GROUP BY sp.poll_name ";
       // $sql = " SELECT msisdn, message, date_time from temp_marquee where company='$company'  and status='1'";
       // echo $sql;
        
        $result=mysql_query($sql) or die('Unable to select from cell_poll');
            
          $num_record = mysql_num_rows($result);
          
          if ($num_record == 0){
                echo " Sorry no poll create for this company ".$company;
            }else{
                echo "<tr><td class='helpHed' colspan='3'>Finite (WO MEN) Award Votes tracker</td></tr>";
                echo "<TR> <td class='helpHed'>Poll #</td><td class='helpHed'>Poll Name</td><td class='helpHed'>View</td><td class='helpHed'></td><td class='helpHed'>Total Votes</td>";                
                echo "</TR>";
                $total = 0;
               while (list($number, $category,$quest, $id) = mysql_fetch_row($result)) {
                   $total = $total + $number;
                  echo "<TR> <td>".$id." .... </td><td>".$category."</td><td><a href='pie-chart-3d.php?poll_id=".$id."'>View Pie 3d </a><td> <td>".$number."</td>";                
                echo "</TR>";   

                }
                
            }
        ?>
           
            <tr><td> Total Aggregated Votes </td><td></td><td> </td><td> </td><td><?php echo $total; ?> </td> </tr> 
       </table>
       
               
 <button onclick="goBack()">Go Back</button>

<script>
function goBack() {
    window.history.back();
}
</script>  
    </body>
</html>
