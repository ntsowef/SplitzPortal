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
        
            
            
             $network= trim($_POST['network']);
             $dateFrom = trim($_POST['date_from']);
             $dateto = trim($_POST['to_date']);  
             $status="Ok";
              if($network == 'Select Network'){
                 $msg=$msg."Select the Network of choice<br>";
		  $status="False";
                  echo $msg;
                  header("Location:network_raw_filter.php");
                  
             } 
               if ($dateFrom=='' &&$dateto==''){
                     $status = false;
                     $msg = "  Please select between dates";
                     header("Location:network_raw_filter.php");
                 }
             if ($status == "Ok"){
                
                $select = " SELECT network_id, sender, receiver,keyword, created from smsmo where network_id like'$network%'  and  (created >= '$dateFrom' and created <='$dateto')";
              
              $result = mysql_query($select);
              $num_rows = mysql_num_rows($result);
             // $arr = mysql_fetch_array($result); 
              
              ?>
        <h3> Returned <?php echo $num_rows;?> </h3>
        <a href="export_excel.php?type=<?php echo $network;?>&sql=<?php echo $select;?>"><span><img src="icons/microsoft_office_2003_excel.png" width="24" height="24"alt="" /></span></a>
        <div class="CSSTableGenerator">
         <table >
                    <tr>
                        <td>
                          Network ID
                        </td>
                        <td >
                            MSISDN
                        </td>
                         <td >
                            Shortcode
                        </td>
                       <td >
                            Keyword
                        </td>
                        <td >
                            Date Logged
                        </td>
                    </tr>
        <?php
              while($tr=mysql_fetch_array($result))
	      {
                  echo '<tr>';
                     echo '<td>'.$tr['network_id'].'</td>';
                  echo '<td>'.$tr['sender'].'</td>';
                   echo "<td>".$tr['receiver']."</td>";
                     echo '<td>'.$tr['keyword'].'</td>';
                        echo '<td>'.$tr['created'].'</td>';
                  echo '</tr> <p>';
                  
              }
         ?>
         </table></div>
        <?php
              
             }
             
        
        ?>
 
 </body>
</html>