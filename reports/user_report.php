<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
             <link href="tablestyle.css" rel="stylesheet" type="text/css" />
        <title></title>
    </head>
    <body>
        <?php
   
        include'connect.php';
        
             $agent = trim($_POST['agent']);
             $dateFrom = trim($_POST['date_from']);
             $dateto = trim($_POST['to_date']);  
             //echo $agent;
            // echo "   from ".$dateFrom."  date to ".$dateto;
             
             $status="Ok";
            if(isset($_POST['cmdadd'])){
                 if($agent == 'Select Agent'){
                     
                     $status = false;
                     $msg=$msg."Select the agent<br>";
                      header("Location:userid_report_filter.php");
                 }
                 if ($dateFrom=='' &&$dateto==''){
                     $status = false;
                     $msg = "  Please select between dates";
                     header("Location:userid_report_filter.php");
                 }
                 
                 
                 if ($status == "Ok"){
                     
                       $select = "SELECT user_id,team,cash_received,msisdn,date_loggedin from cup_transaction where user_id='$agent' and (date_loggedin >= '$dateFrom' and date_loggedin<='$dateto')";
             // echo $select;
                       $result = mysql_query($select);
                       
                       
       ?>       
        <a href="export_excel.php?type=agent&sql=<?php echo $select; ?>"><span><img src="icons/microsoft_office_2003_excel.png" width="24" height="24"alt="" /></span>Download XLS</a>
        <?php
              echo "<div class='CSSTableGenerator'>
                         <table>
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
                                    </tr> ";
        
            $total = 0;
              while($tr=mysql_fetch_array($result))
	      {
                  echo "<tr>";
                     echo "<td>".$tr['user_id']."</td>";
                  echo "<td>".$tr['team']."</td>";
                 echo "<td>".$tr['msisdn']."</td>";
                  echo "<td>".$tr['cash_received']."</td>";
                        echo "<td>".$tr['date_loggedin']."</td>";
                  echo '</tr> <p>';
                  
                  $total = $total + $tr['cash_received'];
              }
            echo "<tr> <td>Total CASH</td> <td> </td><td> </td><td> ".$total."</td><td> </td></tr> <p>";
              
            echo "</table></div>";
                
                 }
            
           }  
        ?>
    
    </body>
</html>
