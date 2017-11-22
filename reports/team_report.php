<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="tablestyle.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
     

        <h1> Team Report </h1>
   <?php
        include 'connect.php';
         ///echo " something is nice";
        
            
            
             $keyword= trim($_POST['keyword']);
             $dateFrom = trim($_POST['date_from']);
             $dateto = trim($_POST['to_date']);  
             $status="Ok";
              if($keyword == 'Select Team'){
                 $msg=$msg."Select the team of choice<br>";
		  $status="False";
                  echo $msg;
                  header("Location:team_report_filter.php");
                  
             } 
               if ($dateFrom=='' &&$dateto==''){
                     $status = false;
                     $msg = "  Please select between dates";
                     header("Location:team_report_filter.php");
                 }
             if ($status == "Ok"){
                
                $select = " SELECT user_id, team, msisdn, cash_received, date_loggedin from cup_transaction where team='$keyword'  and  (date_loggedin >= '$dateFrom' and date_loggedin<='$dateto')";
              
              $result = mysql_query($select);
              $num_rows = mysql_num_rows($result);
             // $arr = mysql_fetch_array($result); 
              
              ?>
        <a href="export_excel.php?type=team&sql=<?php echo $select;?>"><span><img src="icons/microsoft_office_2003_excel.png" width="24" height="24"alt="" /></span></a> 
        
        <div class="CSSTableGenerator">
         <table >
                    <tr>
                        <td>
                          User Id
                        </td>
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
                    </tr>
        <?php
              while($tr=mysql_fetch_array($result))
	      {
                  echo '<tr>';
                     echo '<td>'.$tr['user_id'].'</td>';
                  echo '<td>'.$tr['team'].'</td>';
                   echo "<td>".$tr['msisdn']."</td>";
                     echo '<td>'.$tr['cash_received'].'</td>';
                        echo '<td>'.$tr['date_loggedin'].'</td>';
                  echo '</tr> <p>';
                  
              }
         ?>
         </table></div>
        <?php
              
             }
             
        
        ?>
 <a href="export_excel.php?sql=<?php echo $select;?>">Download XLS</a> 
 </body>
</html>