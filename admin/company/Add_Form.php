<?php
session_start();
$username = $_SESSION["username"];
$company = $_SESSION["company"];
$id = $_SESSION["user_id"];
$admin = $_SESSION["admin"];
$reseller = $_SESSION['reseller'];

$host = $_SERVER['HTTP_HOST'];
$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$base_url = 'http://'.$host.$uri.'/';
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add Form</title>
		<link href="Style/Add_Form.css" rel="stylesheet" type="text/css" />
</head>
<script type="text/javascript">

function resellerClick(cb) {
  display("Clicked, new value = " + cb.checked);
}

function resellerOnChange(element){
    element.checked ? document.getElementById("affiliate").disabled = true : document.getElementById("affiliate").disabled = false;    
}

function affiliateOnChange(element){
    element.checked ? document.getElementById("reseller").disabled = true : document.getElementById("reseller").disabled = false;    
}
</script>
<body bgcolor="#99CC66" background="Images/MyBackground.png">
<div class="img"><img src="Images/auditoria.png" /></div>
<div class="ii"><center><img src="Images/Edit_Yes.png" style="margin-top:20px"/></center></div>
<div id="topbar">
    	<center><h1 style="color:#939">Add Form</h1>
 </div>
<div id="form">
		<table>
        	<form method="post" action="">
            	<tr>
                
                <?php
					include ("connect.php");
					$g = mysql_query("select max(company_id) from company");
					while($id=mysql_fetch_array($g))
					{
				?>
                
                	<th>ID:</th>
                    <td><input type="text" name="company_id" value="<?php echo $id[0]+1; ?>" readonly="readonly" /></td>
                </tr>
                <?php
					}
				?>
                <tr>
                	<th>Company Name:</th>
                    <td><input type="text" name="compname" placeholder="Type company Name"  /></td>
                </tr>
                  <tr>
                	<th>Company Representative:</th>
                    <td><input type="text" name="comprep" placeholder="Type Company Representative"  /></td>
                </tr>
             
                
                <tr>
                	<th>Company Email Address:</th>
                    <td><textarea cols="19px" rows="3" name="compaddress" placeholder="Type Email Address"  /></textarea></td>
                </tr>
                    <?php if($admin == "Y"){?>
               <tr>
                   <th>Is Company Reseller:</th>
                    <td><input type="checkbox" name="reseller" id="reseller" value = "reseller" onChange="resellerOnChange(this)" /></td>
                </tr>
                    <?php } ?>
                    
                    
                    <?php if ($reseller==1){?>
               <tr>
                   <th>Is Company Affiliate:</th>
                    <td><input type="checkbox" name="affiliate" id="affiliate" value = "1" onChange="affiliateOnChange(this)"/></td>
                </tr>
                    <?php }?>   
                <tr>
                	<th>Register Date:</th>
                    <td><input type="text" name="txtdate" value="<?php echo date("d/M/Y"); ?>" readonly="readonly" /></td>
                </tr>
                <tr>
                    <td><input type="submit" name="cmdadd" value="Add" /></td>
                  
                     <td><script>
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
        $id = $_POST['company_id'];
        $name = trim($_POST['compname']);
        $comprep = trim($_POST['comprep']);
      
        $address = trim($_POST['compaddress']);
       
        $date = trim($_POST['txtdate']);
        $created_by = "Admin";
        $status = "1";
        $company_refno = "SPL".$id;
        if(isset($_POST['cmdadd'])){
        if(empty($name) || empty($comprep) || empty($address) )
        {
            echo "<center>Sorry please input data</center>";
        }else{
        include "connect.php";
        
        $reseller = 0;
        
        if(isset($_POST['reseller'])){
            $reseller = 1;
            $query = "insert into company(company_id, company_name, company_rep, company_email_address, created_by, creation_date,status, company_refno, is_reseller ) values('".$id."','".$name."','".$comprep."','".$address."','".$created_by."',now(),'".$status."','".$company_refno."', $reseller)";
            $i = mysql_query($query);
        }
        if (isset($_POST['affiliate'])){
       
        
         $query = "insert into company(company_id, company_name, company_rep, company_email_address, created_by, creation_date,STATUS, company_refno,is_reseller, is_affiliate ) values('".$id."','".$name."','".$comprep."','".$address."','".$created_by."',now(),'".$status."','".$company_refno."',0,1)";   
         $query2 = "insert into affiliates(affiliate_id, affiliate_name, parent_company, contact_person, email_address, created_by, date_created,status, active ) values ('','".$name."','".$company."','".$comprep."','".$address."','".$username."',now(),".$status.",1)";   
        //echo $query2;
         $i = mysql_query($query);
         $i2 = mysql_query($query2);
       
        } else{
             $query = "insert into company(company_id, company_name, company_rep, company_email_address, created_by, creation_date,status, company_refno, is_reseller ) values('".$id."','".$name."','".$comprep."','".$address."','".$created_by."',now(),'".$status."','".$company_refno."', $reseller)";
             $i = mysql_query($query);
          ///  echo " Affiliate Checked ";
         }
        //$i = mysql_query($query);
      //echo $query2;
       if($i==true){
       echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';
        }
        //if($i==true){
        //header('Location:index.php');
        //exit;
        //mysql_close();
        //}
        }
    }
    ?>
</body>
</html>