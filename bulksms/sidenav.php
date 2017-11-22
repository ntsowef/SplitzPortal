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
        <link href="css/navbar.css" rel="stylesheet" type="text/css" />
        <title>Side Navigation</title>
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
            <li><a href="<?php echo $base_url;?>bulkmsgs.php?user=<?php echo $username; ?>$company=<?php echo $company; ?>" target="content">Bulk SMS</a></li>
            <li><a href="<?php echo $base_url;?>add_bulksms_group.php?user=<?php echo $username; ?>$company=<?php echo $company; ?>" target="content">Create/Add Bulk Group</a></li>
            <li><a href="<?php echo $base_url;?>bulk_group.php?user=<?php echo $username; ?>$company=<?php echo $company; ?>" target="content">Send Bulk using groups</a></li>
            <li><a href="<?php echo $base_url;?>schedule_bulk.php?user=<?php echo $username; ?>$company=<?php echo $company; ?>" target="content">Schedule Messages</a></li> 
            <?php if ($admin=="Y"){?>
            <li><a href="<?php echo $base_url;?>bulk_group_cup.php?user=<?php echo $username; ?>$company=<?php echo $company; ?>" target="content">Team Bulk Groups</a></li>
            <?php }?>
            <?php if ($company=="BAM Media"){?>
            <li><a href="<?php echo $base_url;?>bulk_group_bam.php?user=<?php echo $username; ?>$company=<?php echo $company; ?>" target="content">BAM Bulk Groups</a></li>
            <?php }?>
            
            
           </ul>
        </div>
      </li>
     
      <li>
        <label for="manage">Manage Groups</label>
        <input type="radio" name="verticalMenu" id="manage" />
        <div>
         <ul>
            <li><a href="<?php echo $base_url;?>list_groups.php?user=<?php echo $username; ?>$company=<?php echo $company; ?>" target="content">List All Groups</a></li>
            
            <li><a href="#">Search for a group</a></li>
            <li><a href="#">Delete Bulk Group</a></li>
          </ul>
        </div>
      </li>
         <li>
        <label for="report">Reports</label>
        <input type="radio" name="verticalMenu" id="report" />
        <div>
         <ul>
          
            <li><a href="<?php echo $base_url;?>list_dlr.php?user=<?php echo $username; ?>$company=<?php echo $company; ?>" target="_parent"">List Delivery Reports</a></li>
            <li><a href="<?php echo $base_url;?>listhits.php?user=<?php echo $username; ?>$company=<?php echo $company; ?>" target="content"">Delivery Reports Summary</a></li>

          </ul>
        </div>
      </li>
    </ul>
  </nav>
 
</div>
    </body>
</html>
