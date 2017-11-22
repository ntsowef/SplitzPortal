<?php
session_start();
$username = $_SESSION["username"];
$company = $_SESSION["company"];
$id = $_SESSION["user_id"];
$admin = $_SESSION["admin"];

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
       
        <h3> Competition Draw </h3>
   <?php
        include 'connect.php';
         ///echo " something is nice";
        
            
            
             $campaign= strtolower(trim($_POST['campaign']));
             $dateFrom = trim($_POST['date_from']);
             $dateto = trim($_POST['to_date']);  
             $status="Ok";
              if($campaign == 'Select Campaign'){
                 $msg=$msg."Select the Campaign of choice<br>";
		  $status="False";
                  echo $msg;
                  header("Location:competition_draw_filter.php");
                  
             } 
               if ($dateFrom=='' &&$dateto==''){
                     $status = false;
                     $msg = "  Please select between dates";
                     header("Location:competition_draw_filter.php");
                 }
             if ($status == "Ok"){
                
               // $select = "SELECT network_id, sender, receiver,keyword, created from smsmo where lower(keyword)='$campaign'  and  (created >= '$dateFrom' and created <='$dateto')";
             // echo $select;
                $select = "SELECT celnumber, keyword FROM premium_transactions WHERE company = '$company' AND lower(keyword)='$campaign' AND (message_date >= '$dateFrom' AND message_date <= '$dateto')";
		//echo $select;
              $result = mysql_query($select);
              $num_rows = mysql_num_rows($result);
             // $arr = mysql_fetch_array($result); 

              
                $num_records = mysql_num_rows($result);  
               if($num_records > 0)
		{
		 
		     
		echo "<h2> This campaign has generated ".$num_records." entries from ".$startdate." to ".$enddate."</h2>";
		
                 echo "<table border='1' style='width:300px'>  <tr> <th> CELL NUMBER</th> <th> Keyword </th> </tr>";
                 
                 $ii =0;
		   while(list($celnumber, $keyword)=mysql_fetch_row($result)){
		       $receiver_array[$ii]=$celnumber;
			  
			    echo "<tr> <td>".$celnumber."</td> <td>".$keyword."</td></tr>";
               
			   $ii++;
		   }
                   
                   echo "</table>";
                   echo "<br>";
                $a = mt_rand(0,$ii);
                 //  echo " Random number".$a;
                $b = mt_rand(0,$ii);
                echo "<h3>The winner which was picked from the above list was".$receiver_array[$a]." </h3>" ;
                }
               
                
             }   
              ?>
        

    </body>
</html>
