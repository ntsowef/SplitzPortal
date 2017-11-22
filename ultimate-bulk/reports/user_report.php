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
                     
                       $select = "SELECT ut.user_id, uc.category, ut.cash_received, ut.msisdn, ut.nominee, ut.date_loggedin from uma_votes_transaction ut, ultimate_categories uc where ut.user_id='$agent'  and  (ut.date_loggedin >= '$dateFrom' and ut.date_loggedin<='$dateto') and uc.id = ut.category";
          //   echo $select;
                       $result = mysql_query($select);
                       
                       
              
        
              echo "<div class='CSSTableGenerator'>
                         <table>
                                    <tr>
                                        <td>
                                          User Id
                                        </td>
                                        <td >
                                            Category
                                        </td>
                                         <td >
                                            Nominee:
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
                  echo "<td>".$tr['category']."</td>";
                  echo "<td>".$tr['nominee']."</td>";
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
