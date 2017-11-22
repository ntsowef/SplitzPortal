<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="tablestyle.css" rel="stylesheet" type="text/css" />
        <style type="text/css">
        
        .pagNumActive {
            color: #000;
            border:#060 1px solid; background-color: #D2FFD2; padding-left:3px; padding-right:3px;
        }
        .paginationNumbers a:link {
            color: #000;
            text-decoration: none;
            border:#999 1px solid; background-color:#F0F0F0; padding-left:3px; padding-right:3px;
        }
        .paginationNumbers a:visited {
            color: #000;
            text-decoration: none;
            border:#999 1px solid; background-color:#F0F0F0; padding-left:3px; padding-right:3px;
        }
        .paginationNumbers a:hover {
            color: #000;
            text-decoration: none;
            border:#060 1px solid; background-color: #D2FFD2; padding-left:3px; padding-right:3px;
        }
        .paginationNumbers a:active {
            color: #000;
            text-decoration: none;
            border:#999 1px solid; background-color:#F0F0F0; padding-left:3px; padding-right:3px;
        }
       
        </style>
    </head>
    <body>
     


   <?php
        include 'connect.php';
       // echo " something is nice";
        
            
            
             $keyword= trim($_POST['category']);
             $dateFrom = trim($_POST['date_from']);
             $dateto = trim($_POST['to_date']);  
             $status="Ok";
             
           //  echo $keyword."   Category <br>";
              if($keyword == 'Select Category'){
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
                
              //  $select = "SELECT user_id, team, cash_received, date_loggedin from cup_transaction where team='$keyword'  and  (date_loggedin >= '$dateFrom' and date_loggedin<='$dateto')";
              $select = "SELECT ut.user_id, uc.category as category, ut.cash_received, ut.date_loggedin, ut.nominee from uma_votes_transaction ut, ultimate_categories uc where ut.category=$keyword AND uc.id = ut.category";
              
            //  echo $select;
              $result = mysql_query($select);
          
                
               
           
                
       
                
                

                ?>
        
        
      <div style="margin-left:58px; margin-right:58px; padding:6px; background-color:#FFF; border:#999 1px solid;"><?php echo $paginationDisplay; ?></div>
        <div class="CSSTableGenerator">
         <table >
                    <tr>
                        <td>
                          User Id
                        </td>
                        <td >
                           Category
                        </td>
                         <td >
                           Nominee
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
                  echo '<td>'.$tr['category'].'</td>';
                  echo '<td>'.$tr['nominee'].'</td>';
                     echo '<td>'.$tr['cash_received'].'</td>';
                        echo '<td>'.$tr['date_loggedin'].'</td>';
                  echo '</tr> <br>';
                 $total = $total + $tr['cash_received']; 
              }
              echo "<tr> <td>Total CASH</td> <td> </td><td> </td><td> ".$total."</td><td> </td></tr> <p>";
         ?>
         </table></div>
        <?php
              
             }
             
        
        ?>
 
        
      
 </body>
</html>