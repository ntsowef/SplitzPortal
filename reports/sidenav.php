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
      <!--li>
        <label for="home">Bulk Reports</label>
        <input type="radio" name="verticalMenu" id="home" />
        <div>
           <ul>
            <li><a href="<?php echo $base_url;?>bulkmsgs.php?user=<?php echo $username; ?>$company=<?php echo $company; ?>" target="content">Bulk SMS</a></li>
            <li><a href="<?php echo $base_url;?>add_bulksms_group.php?user=<?php echo $username; ?>$company=<?php echo $company; ?>" target="content">Create/Add Bulk Group</a></li>
            <li><a href="<?php echo $base_url;?>bulk_group.php?user=<?php echo $username; ?>$company=<?php echo $company; ?>" target="content">Send Bulk using groups</a></li>
            <li><a href="<?php echo $base_url;?>schedule_bulk.php?user=<?php echo $username; ?>$company=<?php echo $company; ?>" target="content">Schedule Messages</a></li>      
          </ul>
        </div>
      </li>
     
      <li>
        <label for="manage">Invoices</label>
        <input type="radio" name="verticalMenu" id="manage" />
        <div>
         <ul>
            <li><a href="<?php echo $base_url;?>list_groups.php?user=<?php echo $username; ?>$company=<?php echo $company; ?>" target="content">List All Groups</a></li>
            <li><a href="#">Search for a group</a></li>
            <li><a href="#">Delete Bulk Group</a></li>
          </ul>
        </div>
      </li-->
         <li>
        <label for="report">Campaigns</label>
        <input type="radio" name="verticalMenu" id="report" />
        <div>
         <ul>
            <li><a href="#">Shortcode reports</a></li>
            <li><a href="#">Company reports</a></li>
            <li><a href="#">Network based</a></li>
            <li><a href="#">keyword campaigns</a></li>
          </ul>
        </div>
      </li>
         <li>
        <label for="pos_report">CUP POS</label>
        <input type="radio" name="verticalMenu" id="pos_report" />
        <div>
         <ul>
            <li><a href="<?php echo $base_url;?>userid_report_filter.php?user=<?php echo $username; ?>$company=<?php echo $company; ?>" target="content">Agent Report</a></li>
            <li><a href="<?php echo $base_url;?>team_report_filter.php?user=<?php echo $username; ?>$company=<?php echo $company; ?>" target="content">Team Report</a></li>
            <li><a href="<?php echo $base_url;?>cup_report_filter.php?user=<?php echo $username; ?>$company=<?php echo $company; ?>" target="content">POS Master Report</a></li>
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
            <li>
        <label for="wasco_report">WASCO REPORTS</label>
        <input type="radio" name="verticalMenu" id="wasco_report" />
        <div>
         <ul>
            <li><a href="<?php echo $base_url;?>wasco_report.php?user=<?php echo $username; ?>$company=<?php echo $company; ?>" target="content">WASCO Custom Report</a></li>
            <li><a href="<?php echo $base_url;?>wasco_report_billing.php?user=<?php echo $username; ?>$company=<?php echo $company; ?>" target="content">WASCO Billing Delivery Report</a></li>

          </ul>
        </div>
      </li>
      
       <li>
        <label for="invoices">Invoices</label>
        <input type="radio" name="verticalMenu" id="invoices" />
        <div>
         <ul>
            <li><a href="<?php echo $base_url;?>vcl_report_filter.php?user=<?php echo $username; ?>$company=<?php echo $company; ?>" target="content">Vodacom Invoice</a></li>
            <li><a href="<?php echo $base_url;?>etl_report_filter.php?user=<?php echo $username; ?>$company=<?php echo $company; ?>" target="content">Econet Lesotho Invoice</a></li>
        
          </ul>
        </div>
      </li>
    </ul>
  </nav>
 
</div>
    </body>
</html>
