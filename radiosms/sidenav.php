<?php
session_start();
$username = $_SESSION["username"];
$company = $_SESSION["company"];
$id = $_SESSION["user_id"];
$admin = $_SESSION["admin"];

$host = $_SERVER['HTTP_HOST'];
$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$base_url = 'http://'.$host.$uri.'/';
?>
<html>
    <head>
       <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/navbar.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
          <div class="wrapper">
  <nav class="vertical">
    <ul>
      <li>
        <label for="home">Home</label>
        <input type="radio" name="verticalMenu" id="home" />
        <div>
           <ul>
            <li><a href="<?php echo $base_url;?>pricedraw.php?user=<?php echo $username; ?>$company=<?php echo $company; ?>" target="content">Random Draw Competitions</a></li>
   
            <li><a href="<?php echo $base_url;?>list_polls.php?user=<?php echo $username; ?>$company=<?php echo $company; ?>" target="content">Voting + Polling</a></li>
            <li><a href="<?php echo $base_url;?>pcreateservices.php?user=<?php echo $username; ?>$company=<?php echo $company; ?>" target="content">Setup keywords competition</a></li>
            <li><a href="<?php echo $base_url;?>listmessages.php?user=<?php echo $username; ?>$company=<?php echo $company; ?>" target="content">Logged Messages</a></li>
          </ul>
        </div>
      </li>
  
      <li>
        <label for="reporting">Reporting</label>
        <input type="radio" name="verticalMenu" id="reporting" />
        <div>
           <ul>
            <li><a href="<?php echo $base_url;?>listhits.php?user=<?php echo $username; ?>$company=<?php echo $company; ?>" target="content">Check  hits</a></li>
            <li><a href="#">Competition Reports</a></li>
           
            <li><a href="#">Optimization</a></li>
          </ul>
        </div>
      </li>
     
    </ul>
  </nav>
 
</div>
       
    </body>
</html>
