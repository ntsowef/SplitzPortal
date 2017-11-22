<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
           <h1> WASCO CUSTOM REPORT </h1>
   <?php
        include 'connect.php';
         ///echo " something is nice";
        
            
            
            
             $dateFrom = trim($_POST['date_from']);
             $dateto = trim($_POST['to_date']);  
             $status="Ok";
            
               if ($dateFrom=='' &&$dateto==''){
                     $status = false;
                     $msg = "  Please select between dates";
                     header("Location:wasco_report.php");
                 }
             if ($status == "Ok"){
                $succ_count ="SELECT count(*) as num_success from wasco_data WHERE reasons_status REGEXP '^Success' and  (date_processed >= '$dateFrom' and date_processed<='$dateto')  ";
                $fail_count ="SELECT count(*) as num_failed from wasco_data WHERE reasons_status REGEXP '^Fail' and  (date_processed >= '$dateFrom' and date_processed<='$dateto')  ";
                $succ_select ="SELECT * from wasco_data WHERE reasons_status REGEXP '^Success' and  (date_processed >= '$dateFrom' and date_processed<='$dateto') ";
                $failed_select ="SELECT * from wasco_data WHERE reasons_status REGEXP '^Fail' and  (date_processed >= '$dateFrom' and date_processed<='$dateto') ";
         
                
             //   $select = " SELECT user_id, team, msisdn, cash_received, date_loggedin from cup_transaction where team='$keyword'  and  (date_loggedin >= '$dateFrom' and date_loggedin<='$dateto')";
              
              $result_succ_count = mysql_query($succ_count);
              $count_succ = mysql_fetch_assoc($result_succ_count);
              $number_success = $count_succ['num_success'];
              $result_fail_count = mysql_query($fail_count);
              $count_fail = mysql_fetch_assoc($result_fail_count);
              $number_failed = $count_fail['num_failed'];
              $result_success = mysql_query($succ_select);
              $result_fail = mysql_query($failed_select);
              $num_rows = mysql_num_rows($result_success);
             // $arr = mysql_fetch_array($result); 
              $total_sent = $number_success + $number_failed;
              ?>
        <a href="export_excel.php?type=team&sql=<?php echo $select;?>"><span><img src="icons/microsoft_office_2003_excel.png" width="24" height="24"alt="" /></span></a> 
        
        <div class="CSSTableGenerator">
         <table >
                    <tr>
                        <td>
                          Name:
                        </td>
                        <td >
                            Account no:
                        </td>
                         <td >
                            Contact:
                        </td>
                     
                        <td >
                            Status
                        </td>
                    </tr>
        <?php
              while($succ=mysql_fetch_array($result_success))
	      {
                  echo '<tr>';
                     echo '<td>'.$succ['name'].'</td>';
                  echo '<td>'.$succ['account_no'].'</td>';
                   echo "<td>".$succ['contact']."</td>";
                  
                        echo '<td>'.$succ['reasons_status'].'</td>';
                  echo '</tr> <p>';
                  
              }
         ?>
                    
                    <tr><td>Total Successful: </td><td><?php echo $number_success; ?></td> </tr> 
                    <tr></tr> 
                      <tr></tr>
          <?php
              while($fail=mysql_fetch_array($result_fail))
	      {
                  echo '<tr>';
                     echo '<td>'.$fail['name'].'</td>';
                  echo '<td>'.$fail['account_no'].'</td>';
                   echo "<td>".$fail['contact']."</td>";
                  
                        echo '<td>'.$fail['reasons_status'].'</td>';
                  echo '</tr> <p>';
                  
              }
         ?>
                    
                    <tr><td>Total Failed: </td><td><?php echo $number_failed; ?></td> </tr>   
                      <tr></tr> 
                      <tr></tr>
                    <tr><td>Total sent smses(failed+successful): </td><td><?php echo $total_sent; ?></td> </tr> 
         </table></div>
        <?php
              
             }
             
        
        ?>
 <a href="export_excel.php?sql=<?php echo $select;?>">Download XLS</a> 
 </body>
</html>
