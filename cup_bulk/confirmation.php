<?php

header("Cache-Control: private, must-revalidate, max-age=0");
header("Pragma: no-cache");
 // header("Expires: Sat, 4 Jun 2016 12:00:00 GMT");

session_start();
$username = $_SESSION["username"];
$company = $_SESSION["company"];
$id = $_SESSION["user_id"];
$admin = $_SESSION["admin"];

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Comfirmation Screen</title>
        
    <script type="text/javascript">

window.history.forward(1);
function noBack(){
window.history.forward();
}
</script>
    </head>
    <body onload="noBack();" onpageshow="if (event.persisted) noBack();" onunload="" bgcolor="#99CC66">
        
          <div id="topbar">
    	<center><h1 style="color:#939">Confirmation Screen</h1>
       </div>
        
        <?php
        
        $username = $_REQUEST['userid'];
        $votes = $_REQUEST['votes'];
        $amount = $_REQUEST['amount'];
        $msisdn = $_REQUEST['msisdn'];
        $team = $_REQUEST['team'];
        //echo "Username ".$username." tranaction ";
        echo "Splitz Marketing would like to confirm that <b>".$team."</b> was allocate <b>".$votes." votes</b> from the purchase of M".$amount.", by this number (".$msisdn."). Text message is sent to the cellphone number as a confirmation, thank you. <br>";
        echo "<p> To perform another transaction <a href='logout.php'> click here </a>";
        ?>
        
        
        
    </body>
</html>
