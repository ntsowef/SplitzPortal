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

<body bgcolor="#99CC66" background="Images/MyBackground.png">
<div class="img"><img src="Images/auditoria.png" /></div>
<div class="ii"><center><img src="Images/Edit_Yes.png" style="margin-top:20px"/></center></div>
<div id="topbar">
    	<center><h1 style="color:#939">Add Users</h1>
    </div>
<div id="form">
		<table>
        	<form method="post" action="">
            	<tr>
                
                <?php
					include ("connect.php");
					$g = mysql_query("select max(id) from accounts");
					while($id=mysql_fetch_array($g))
					{
				?>
                
                	<th>ID:</th>
                    <td><input type="text" name="txtid" value="<?php echo $id[0]+1; ?>" readonly="readonly" /></td>
                </tr>
                <?php
					}
				?>
                <tr>
                	<th>Username:</th>
                    <td><input type="text" name="username" placeholder="Type Name"  /></td>
                </tr>
                    <tr>
                	<th>Password:</th>
                        <td><input type="password" name="password" placeholder="Type Password"  /></td>
                </tr>
                <tr>
                	<th>Firstname:</th>
                    <td><input type="text" name="firstname" placeholder="Type FirstName"  /></td>
                </tr>
                 <tr>
                	<th>Lastname:</th>
                    <td><input type="text" name="lastname" placeholder="Type Last Name"  /></td>
                </tr>
                
                <tr>
                    <th>Company:</th>
                    <td>
                    	<select name="company">
                        	<option>Select Company</option>
                            <?php
                            if ($reseller==1){
                              $g = mysql_query("SELECT c.company_name FROM company c, affiliates f WHERE c.company_name = f.affiliate_name AND f.parent_company='$company'");
                            }
                            else
                            {
                            $g = mysql_query("select company_name from company");
                            }	while($id=mysql_fetch_array($g))
					{
                                            echo "<option>".$id[0]."</option>";
                                        }
   							//	}
                            ?>
                        </select>
                    </td>
        		</tr>
    
                    <?php if ($reseller==1) {?>
                    <tr>
                       <th>Administrator:</th>
                       <td><input type="text" name="admini" value="N"> </td>
                       
                   </tr>
                    <?php } else {  ?>
                    <tr>
                       <th>Administrator:</th>
                       <td><select name="admini">
		           <option value="">Select</option>
		           <option value="Y">Yes</option>
		           <option value="N">No</option>
		         </select>
		    </td>
                   </tr>
		 <?php }  ?>
                   
                <tr>
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
		 $msg="";		 
                 $firstname= trim($_POST['firstname']);
		 $lastname= trim($_POST['lastname']);
		 $username= trim($_POST['username']);
		 $password= trim($_POST['password']);
                 $company = $_POST['company'];
		 $admini= $_POST['admini'];
		 $acc_type='bulk';
		$acc_typep='premium';
		$acc_typeo='0';
        
        
        //$name = trim($_POST['txtname']);
        echo $admini."   Administrator";
        if(isset($_POST['cmdadd'])){
        include ("connect.php");
        if(empty($firstname) || empty($lastname))
		 {
		  $msg=$msg."Fields must be completed : Firstname, Lastname<br>";
		  $status="False";
		 }
		 if(empty($admini) || empty($acc_type))
		 {
		  $msg=$msg."Administrator or Account type must be completed <br>";
		  $status="False";
		 }
		 if(empty($username) || empty($password))
		 {
		  $msg=$msg."Fields must be completed : Username,Password<br>";
		  $status="False";
		 }
		 $sql="select username,password from accounts where username='$username' and password='$password' ";
		 //echo $sql;
                 $res=mysql_query($sql);
		 if(mysql_num_rows($res)>0)
		  {     
		    $msg=$msg."Change either your username or password: Already taken<br>";
		    $status="False";
		  }
                  if($status=='Ok')
		  {$date=date('Y'.'-'.'m'.'-'.'d');
		   $insert="INSERT into accounts values('','$password','$username','$firstname','$lastname','$company','$admini','$status1','$acc_type','$acc_typep','$acc_typeo','$date')";
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