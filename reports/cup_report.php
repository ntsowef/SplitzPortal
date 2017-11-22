<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="tablestyle.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
     

        <h1> Summary POS Report </h1>
   <?php
        include 'connect.php';
         ///echo " something is nice";
        
            
            
            
             $dateFrom = trim($_POST['date_from']);
             $dateto = trim($_POST['to_date']);  
             $status="Ok";
               
               if ($dateFrom=='' &&$dateto==''){
                     $status = false;
                     $msg = "  Please select between dates";
                     header("Location:cup_report_filter.php");
                 }
             if ($status == "Ok"){
                
                $selectTeam = " SELECT team, SUM(cash_received) AS collected FROM cup_transaction where date_loggedin >= '$dateFrom' and date_loggedin<='$dateto' GROUP BY team";
                 $selectAgent = " SELECT user_id, SUM(cash_received) AS collected FROM cup_transaction where date_loggedin >= '$dateFrom' and date_loggedin<='$dateto' GROUP BY user_id";
              $resultAgent = mysql_query($selectAgent);
              $num_rows = mysql_num_rows($resultAgent);
             // $arr = mysql_fetch_array($result); 
              
              ?>
        
        <div class="CSSTableGenerator">
         <table>
                    <tr>
                        <td>
                          Agent
                        </td>
                        
                       <td >
                            Cash Received
                        </td>
                        
                    </tr>
        <?php
              while($tr=mysql_fetch_array($resultAgent))
	      {
                  echo '<tr>';
                     echo '<td>'.$tr['user_id'].'</td>';
                  echo '<td>'.$tr['collected'].'</td>';
                  echo '</tr> <p>';
                  
              }
         ?>
         </table></div>
        <?php
              
             }
             
        
        ?>
 
 </body>
</html>