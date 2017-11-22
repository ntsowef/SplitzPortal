<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="tablestyle.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
     


   <?php
        include 'connect.php';
        echo " something is nice";
        
            
            
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
                
                $select = " SELECT user_id, team, cash_received, date_loggedin from cup_transaction where team='$keyword'  and  (date_loggedin >= '$dateFrom' and date_loggedin<='$dateto')";
              
              $result = mysql_query($select);
             // $arr = mysql_fetch_array($result); 
              $nr = mysql_num_rows($result);
              if (isset($_GET['pn'])) { 
                  
                  $pn = preg_replace('#[^0-9]#i', '', $_GET['pn']);
                  
                  
              } else { // If the pn URL variable is not present force it to be value of page number 1
                    $pn = 1;
              } 
              
              $itemsPerPage = 10;
                // Get the value of the last page in the pagination result set
                $lastPage = ceil($nr / $itemsPerPage);
                // Be sure URL variable $pn(page number) is no lower than page 1 and no higher than $lastpage
                if ($pn < 1) { // If it is less than 1
                    $pn = 1; // force if to be 1
                } else if ($pn > $lastPage) { // if it is greater than $lastpage
                    $pn = $lastPage; // force it to be $lastpage's value
                } 
                
                
                $centerPages = "";
                $sub1 = $pn - 1;
                $sub2 = $pn - 2;
                $add1 = $pn + 1;
                $add2 = $pn + 2;
                
                if ($pn == 1) {
                    $centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
                    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add1 . '">' . $add1 . '</a> &nbsp;';
                } else if ($pn == $lastPage) {
                    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub1 . '">' . $sub1 . '</a> &nbsp;';
                    $centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
                } else if ($pn > 2 && $pn < ($lastPage - 1)) {
                    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub2 . '">' . $sub2 . '</a> &nbsp;';
                    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub1 . '">' . $sub1 . '</a> &nbsp;';
                    $centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
                    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add1 . '">' . $add1 . '</a> &nbsp;';
                    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add2 . '">' . $add2 . '</a> &nbsp;';
                } else if ($pn > 1 && $pn < $lastPage) {
                    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub1 . '">' . $sub1 . '</a> &nbsp;';
                    $centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
                    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add1 . '">' . $add1 . '</a> &nbsp;';
                }
              ?>
        
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
                     echo '<td>'.$tr['cash_received'].'</td>';
                        echo '<td>'.$tr['date_loggedin'].'</td>';
                  echo '</tr> <br>';
                  
              }
         ?>
         </table></div>
        <?php
              
             }
             
        
        ?>
 
 </body>
</html>