<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="tablestyle.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
     

       
   <?php
        include 'connect.php';
         ///echo " something is nice";
        
            
            
             $dateFrom = trim($_POST['date_from']);
             $dateto = trim($_POST['to_date']);  
             $status="Ok";
         
               if ($dateFrom=='' &&$dateto==''){
                     $status = false;
                     $msg = "  Please select between dates";
                     header("Location:etl_report_filter.php");
                 }
             if ($status == "Ok"){
                
                $select = "SELECT mo.receiver AS shortcode, COUNT(mo.receiver) AS transactions FROM smsmo mo WHERE  mo.created >='$dateFrom' AND mo.created <= '$dateto' AND mo.network_id LIKE 'E%' GROUP BY mo.receiver ";
              
              $result = mysql_query($select);
              $num_rows = mysql_num_rows($result);
             // $arr = mysql_fetch_array($result); 
              
              ?>
        <h2> Econet Lesotho Summary Report for period between <?php echo $dateFrom;?> and <?php echo $dateto;?> </h2>
        
        <a href="export_excel.php?type=vcl&sql=<?php echo $select;?>"><span><img src="icons/microsoft_office_2003_excel.png" width="24" height="24"alt="" /></span></a>
        <div class="CSSTableGenerator">
         <table >
                    <tr>
                        <td>
                            Shortcode
                        </td>
                         <td>
                            Transactions
                        </td>
                        <td>
                            Unit Cost
                        </td>
                         <td>
                            Total transaction
                        </td>
                    </tr> <p>
        <?php
        $total_transactions = 0;
              while($tr=mysql_fetch_array($result))
	      {           if (strlen($tr['shortcode'])>5){
                    $shorti = substr($tr['shortcode'], 4);;
                  }
           
                   $sql = "SELECT shortcode, cost_inclusive from shortcodes where shortcode='$shorti'";
               //  echo $sql;
                  $result1 = mysql_query($sql);
                  $sec = mysql_fetch_array($result1);
                  $total = $tr['transactions']*$sec['cost_inclusive'];
                  echo '<tr>';
                     echo '<td>'.$shorti.'</td>';
                  echo '<td>'.$tr['transactions'].'</td>';
                    echo '<td>'.$sec['cost_inclusive'].'</td>';
                      echo '<td>'.$total.'</td>';
                   echo '</tr> <p>';
                  $total_transactions = $total_transactions + $total;
                          
              }
               echo "<tr> <td> <b>GRAND TOTAL</b></td><td></td><td></td><td><b>".$total_transactions."</b></td> </tr>";
         ?>
         </table></div><p>
        <?php
              
             }
             
        
        ?>
 
 </body>
</html>