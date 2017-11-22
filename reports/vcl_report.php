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
                     header("Location:vcl_report_filter.php");
                 }
             if ($status == "Ok"){
                
                $select = "SELECT mo.receiver AS shortcode, COUNT(mo.receiver) AS transactions FROM smsmo mo WHERE  mo.created >='$dateFrom' AND mo.created <= '$dateto' AND mo.network_id LIKE 'Voda%' GROUP BY mo.receiver ";
              
              $result = mysql_query($select);
              $num_rows = mysql_num_rows($result);
             // $arr = mysql_fetch_array($result); 
              
              ?>
        <h1> Vodacom Lesotho Summary Report for period between <?php echo $dateFrom;?> and <?php echo $dateto;?> </h1>
          <a href="export_excel.php?type=vcl&sql=<?php echo $select;?>"><span><img src="icons/microsoft_office_2003_excel.png" width="24" height="24"alt="" /></span></a>
        <div class="CSSTableGenerator">
         <table >
                    <tr>
                        <td>
                            Shortcode
                        </td>
                         <td>
                            Count
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
	      {
                  $sql = "SELECT shortcode, cost_inclusive from shortcodes where shortcode like '%".$tr['shortcode']."'";
                 
                  $result1 = mysql_query($sql);
                  $sec = mysql_fetch_array($result1);
                  
                  $total = $tr['transactions']*$sec['cost_inclusive'];
                  echo '<tr>';
                     echo '<td>'.$tr['shortcode'].'</td>';
                  echo '<td>'.$tr['transactions'].'</td>';
                    echo '<td>'.$sec['cost_inclusive'].'</td>';
                      echo '<td>'.$total.'</td>';
                   echo '</tr> <p>';
                  $total_transactions = $total_transactions + $total;
                          
              }
              echo "<tr> <td> GRAND TOTAL</td><td></td><td></td><td>".$total_transactions."</td> </tr>";
         ?>
                        
         </table></div><p>
        <?php
              
             }
             
        
        ?>
 
 
 </body>
</html>