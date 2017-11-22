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
        <title>List Hits</title>
        <style>
    body {
        background: white }
    div {
        background: black;
        color: white;
        border-radius: 1em;
        padding: 1em;
        position: absolute;
        top: 50%;
        left: 50%;
        margin-right: -50%;
        transform: translate(-50%, -50%) }
  </style>
    </head>
    <body>
      
        <div>
            
              <?php
        include 'connect.php';
        
     
       
       echo "<h2>Bulk SMS Summary for $company</h2>";
       $query ="SELECT COUNT(STATUS) AS num_of_messages, STATUS as stat FROM bulkmessages WHERE company='$company' GROUP BY stat";
                
           //  echo $query;   
                $result = mysql_query($query);
              //  $row  = mysql_fetch_array($result);
                $num_record = mysql_num_rows($result);
                
                echo "<table>";
                echo " <tr>  <td> Number of Messages</td>  <td>Status </td> </tr> ";
                if($num_record > 0) {
                     while ($r = mysql_fetch_array($result)){
                       echo "  <tr>  <td>     ".$r['num_of_messages']. " </td><td> ".$r['stat']." </td> </tr> ";
                    }
                    
                 echo "</table>";   
                }else{
                    echo " No Records";
                }

   // echo "   Daily Hits ".$daily. "     Weekly Hits   ".$weekly."     Monthly Hits ".$monthly;
        
        ?> 
            
        </div>
     
    </body>
</html>
