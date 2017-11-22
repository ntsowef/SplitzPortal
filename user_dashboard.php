<?php
session_start();
$bulk = $_SESSION["accounttype"];
$username = $_SESSION["username"];
$company = $_SESSION["company"];
$reseller = $_SESSION['reseller'];
$id = $_SESSION["user_id"];

$host = $_SERVER['HTTP_HOST'];
	$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$base_url = 'http://'.$host.$uri.'/';
include 'radio.php';

$shotcode = get_shortcode($_SESSION["company"]);
        
       // echo " Short code is ".$shotcode;
?>
<html>
<head>
<title>Portal Dashboard</title>

<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/icon.css">

<script type="text/javascript" src="http://code.jquery.com/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="http://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>
	<script>
		function addTab(title, url){
			if ($('#tt').tabs('exists', title)){
				$('#tt').tabs('select', title);
			} else {
				var content = '<iframe scrolling="auto" frameborder="0"  src="'+url+'" style="width:100%;height:100%;"></iframe>';
				$('#tt').tabs('add',{
					title:title,
					content:content,
					closable:true
				});
			}
		}
	</script>
</head>
<body>



<div style="margin-bottom:10px">
    
    
    <p>  WELCOME <?php echo $_SESSION["username"]; ?> from <?php echo $_SESSION["company"];  ?> </p>
  
             <?php 
    
             //   echo $_SESSION["accounttype"];
                   if ($_SESSION["accounttype"]=="bulk"){
                  ?>      
                       <!--a href="#" class="easyui-linkbutton" onclick="addTab('Bulk SMS','<?php echo $base_url;?>bulksms/bulkmsgs.php?user=<?php echo $username; ?>$company=<?php echo $company; ?>')">BULK SMS</a-->
                        <a href="#" class="easyui-linkbutton" onclick="addTab('BULK SMS','<?php echo $base_url;?>bulksms/bulkmain.php?user=<?php echo $username; ?>$company=<?php echo $company; ?>')">BULK SMS</a>
                  <?php }
                ?>
                       
                  <?php 
             //   echo $_SESSION["accounttype"];
                   if ($_SESSION["accounttype_p"]=="premium"){
                  ?>      
                       <a href="#" class="easyui-linkbutton" onclick="addTab('CAMPAIGNS','<?php echo $base_url;?>premiumsms/poptions.php')">Campaigns&Competitions</a>
                  <?php }
                ?>      
                       
                    <?php 
           
                   if ($_SESSION["admin"]=="Y"){
                  ?>      
                       <a href="#" class="easyui-linkbutton" onclick="addTab('ADMINISTRATION','<?php echo $base_url;?>admin/index.php')">ADMINISTRATION</a>
                       <a href="#" class="easyui-linkbutton" onclick="addTab('REPORTS','<?php echo $base_url;?>reports/index.php')">REPORT</a>
                  <?php }else{
                      
                   ?>
                        <a href="#" class="easyui-linkbutton" onclick="addTab('REPORTS','<?php echo $base_url;?>client_reports/index.php')">REPORT</a>
                 <?php
                      
                  }
                  if ($reseller==1){
                      
                  ?>
                         <a href="#" class="easyui-linkbutton" onclick="addTab('ADMINISTRATION','<?php echo $base_url;?>admin/reseller_admin.php')">ADMINISTRATION</a>
                        
                  <?php
                  }
                  
             
                  
                  if ($_SESSION['company'] =='Ultimate FM'){
                   ?>
                          <a href="#" class="easyui-linkbutton" onclick="addTab('Ultimate Music Awards','<?php echo $base_url;?>special/radio_admin.php')"> UMA </a>
               


                   <?php       
                  }
                  
                    if ($_SESSION['company'] =='BAM Media'){
                   ?>
                          <a href="#" class="easyui-linkbutton" onclick="addTab('FINITE WO MEN Awards','<?php echo $base_url;?>special/bam_admin.php')"> FWO-MAN AWARDS</a>
               


                   <?php       
                 }
                  
                    if ($_SESSION['company'] =='Wireless Connect'){
                   ?>
                          <a href="#" class="easyui-linkbutton" onclick="addTab('Custom','<?php echo $base_url;?>special/special_wireles.php')">Custom</a>
                        
                  <?php       
                  }
                  if (($_SESSION['company'] =="Ultimate FM" ) ||($_SESSION['company'] =="Radio Lesotho" )||
                          ($_SESSION['company'] =="Harvest FM" )||($_SESSION['company'] =="KEL FM" )
                          ||($_SESSION['company'] =="Catholic Radio" )||($_SESSION['company'] =="MoAfrika FM" )||($_SESSION['company'] =="TV Lesotho" )){
                      
                      //$shortcode = get_shortcode($_SESSION['company']);
                  ?>
                    <a href="#" class="easyui-linkbutton" onclick="addTab('RADIO PORTAL','<?php echo $base_url;?>radiosms/index.php')">RADIO PORTAL</a>
      
                  <?php     
                      
                  }
                ?> 
                       
               
                <a href="logout.php" class="easyui-linkbutton">Logout.</a>
	</div>


	<div id="tt" class="easyui-tabs" style="width:1300px;height:550px;">
            <!--dv title="DASHBOARD"-->
            <!--?php if ($_SESSION["admin"]=="Y") {?>
		<div title="DASHBOARD" data-options="href:'dashboard/admin_dashboard.php'"-->
            <!--?php } else if ($reseller==1) {?>	
               <div title="DASHBOARD" data-options="href:'dashboard/reseller_dashboard.php'"-->
             <!--?php } else  {?>	
               <div title="DASHBOARD" data-options="href:'dashboard/client_dashboard.php'"-->
            <!--?php }?-->  
            
            <!--?php 
               if (($_SESSION['company'] =="Ultimate FM")){
                ?>
                <div title="DASHBOARD" data-options="href:'dashboard/radio_front_page.php'"-->
                    
                    
            <!--?php  }
            ?-->
	</div>
	</div>
</body></html>