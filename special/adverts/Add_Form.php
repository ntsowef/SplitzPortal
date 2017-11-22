<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add Form</title>
		<link href="Style/Add_Form.css" rel="stylesheet" type="text/css" />
</head>

<body bgcolor="#99CC66" background="Images/MyBackground.png">
<div class="img"><img src="Images/auditoria.png" /></div>
<div class="ii"><center><img src="Images/Edit_Yes.png" style="margin-top:20px"/></center></div>
<div id="topbar">
    	<center><h1 style="color:#939">Add Adverts</h1>
    </div>
<div id="form">
		<table>
        	<form method="post" action="">
            	<tr>
                
                <?php
					include ("connect.php");
					$g = mysql_query("select max(adv_id) from bam_adverts");
					while($adv_id=mysql_fetch_array($g))
					{
				?>
                
                	<th>ID:</th>
                    <td><input type="text" name="txtid" value="<?php echo $adv_id[0]+1; ?>" readonly="readonly" /></td>
                </tr>
                <?php
					}
				?>
                <tr>
                	<th>Wording:</th>
                    
                                   <td> <textarea cols="20" rows="5" name="wording">

</textarea></td>
                </tr>
                
             
                    <td><input type="submit" name="cmdadd" value="Add" /></td>
                  
                    <td> <script>
                    function goBack()
                      {
                      window.history.back()
                      }
                    </script>
                    <input type="button" value="Go Back" onclick="goBack()"/></td> 
                </tr>
        	</form>
        </table>
    	</div>
        <?php   
        $id = $_POST['txtid'];
                 $status1=1;
		 $status="Ok";
                 $active='1';
                 $msg="";		 
                 $wording= trim($_POST['wording']);
		 $created_by = "Admin";
		 $company = $_POST['company'];
		 $admini= $_POST['admini'];
		 
        
        //$name = trim($_POST['txtname']);
        
        if(isset($_POST['cmdadd'])){
        include ("connect.php");
        if(empty($wording))
		 {
		  $msg=$msg."Fields must be completed : Wording <br>";
		  $status="False";
		 }
		 
		
                  if($status=='Ok')
		  {$date=date('Y'.'-'.'m'.'-'.'d');
		   $insert="INSERT into adverts(adv_id,advert_wording,used_count,status,created_by,creation_date,active) values('','$wording','0','$status1','$created_by',now(),'$active')";
		   echo $insert;
                   $result=mysql_query($insert) or die("Could not insert in accounts ".mysql_get_last_message());
		  ?>
		     <script language = "javascript" style = "text/javascript"> 
			 //window.location = "moptions.php?userid=<?echo $id;?>&user=<? echo $username;?>&compan=<? echo $company;?>&admin=<?echo $admin;?>";									
			 window.location = "index.php";									
		    </script>
		   <?php
		  }
		  else
		  {
		   echo "<font face='Verdana' size='2' color=red>$msg</font><br><input type='button'  value='Retry' onClick='history.go(-1)'>"; 
		  }
        //if($i==true){
        //header('Location:index.php');
        //exit;
        //mysql_close();
        //}
        }
    
    ?>
</body>
</html>