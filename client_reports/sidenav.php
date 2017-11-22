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
        <label for="report">Campaigns</label>
        <input type="radio" name="verticalMenu" id="report" />
        <div>
         <ul>
            <li><a href="<?php echo $base_url;?>competion_draw_filter.php?user=<?php echo $username; ?>$company=<?php echo $company; ?>" target="content">Competition Random draw</a></li>
     <li><a href="<?php echo $base_url;?>campaign_raw_filter.php?user=<?php echo $username; ?>$company=<?php echo $company; ?>" target="content">Campaign/Keyword </a></li>
          </ul>
        </div>
      </li>
        
      
         <li>
        <label for="system_report">RAWDATA</label>
        <input type="radio" name="verticalMenu" id="system_report" />
        <div>
         <ul>
            <li><a href="<?php echo $base_url;?>network_raw_filter.php?user=<?php echo $username; ?>$company=<?php echo $company; ?>" target="content">Network RAW</a></li>
            <li><a href="<?php echo $base_url;?>shortcode_raw_filter.php?user=<?php echo $username; ?>$company=<?php echo $company; ?>" target="content">Shortcode Raw data</a></li>
            <li><a href="<?php echo $base_url;?>campaign_raw_filter.php?user=<?php echo $username; ?>$company=<?php echo $company; ?>" target="content">Campaign Raw</a></li>
          </ul>
        </div>
      </li>
      <?php
      if ($company=="BAM Media"){
      ?>
            <li>
        <label for="pos_report">Bulk voting Reports</label>
        <input type="radio" name="verticalMenu" id="pos_report" />
        <div>
         <ul>
            <li><a href="<?php echo $base_url;?>/BAM/userid_report_filter.php?user=<?php echo $username; ?>$company=<?php echo $company; ?>" target="content">Agent Report</a></li>
            <li><a href="<?php echo $base_url;?>/BAM/team_report_filter.php?user=<?php echo $username; ?>$company=<?php echo $company; ?>" target="content">Category Report</a></li>
            <!--li><a href="<?php echo $base_url;?>cup_report_filter.php?user=<?php echo $username; ?>$company=<?php echo $company; ?>" target="content">POS Master Report</a></li-->
          </ul>
        </div>
      </li>
      
      <?php
      }
      ?>
      
       
    </ul>
  </nav>
 
</div>
    </body>
</html>
