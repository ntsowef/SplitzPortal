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
        include './radio.php';
        
        $shortcode = get_shortcode($company);
       $str = "   ".$company. "     Shortcode ".$shortcode;
       
       
       echo "<h2>  Hits for the  $str</h2>";
        $query ="SELECT
             shortcode,
             COUNT(IF(message_date>=CURRENT_DATE, 1,NULL)) daily_count,
             COUNT(IF(message_date>=CURRENT_DATE - INTERVAL 1 WEEK,1,NULL)) weekly_count,
             COUNT(IF(message_date>=CURRENT_DATE - INTERVAL 1 MONTH,1,NULL)) monthly_count

                FROM premium_transactions
                WHERE message_date>CURRENT_DATE - INTERVAL 1 MONTH and shortcode='$shortcode' ";
                
            // echo $query;   
            $result = mysql_query($query);
             $row  = mysql_fetch_array($result);
    if(is_array($row)) {
        $daily = $row['daily_count'];   
         $weekly = $row['weekly_count'];  
          $monthly = $row['monthly_count'];  
    }
    
    echo "   Daily Hits ".$daily. "     Weekly Hits   ".$weekly."     Monthly Hits ".$monthly;
        
        ?> 
            
        </div>
     
    </body>
</html>
