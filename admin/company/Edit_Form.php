<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit Form</title>

	<link rel="stylesheet" type="text/css"  href="Style/Edit_Form.css" />

</head>

<body background="Images/MyBackground.png" bgcolor="#FFCC99">
	<div class="topbar"> <h1 style="color:#FFF"><center>Edit Form</center></h1></div>    
	<center>
    <div class="box">
    	<?php
		$id = $_GET['txtid'];
		include ("connect.php");
		$i ="select * from company where company_id=".$id;
		$h= mysql_query($i);
		if($tr=mysql_fetch_array($h))
		{
	?>
    <table><form method="post" action="">
    	<tr>
        	<th>ID:</th>
        	<td><input type="text" name="txtid" value="<?php echo $tr[0]; ?>"/></td>
        </tr>
        <tr>
        	<th>Company Name:</th>
        	<td><input type="text" name="txtname" value="<?php echo $tr[1]; ?>" /></td>
        </tr>
        <tr>
        	<th>Company Representative:</th>
        	<td>
            	<input type="text" name="txtgender" value="<?php echo $tr[2]; ?>" /></td>
            </td>
        </tr>
        <tr>
        	<th>Email Address:</th>
        	<td><input type="text" name="txtdob" value="<?php echo $tr[3]; ?>" /></td>
        </tr>
      
        <tr>
        	<th>Date Created:</th>
        	<td><input type="text" name="txtsubject" value="<?php echo $tr[5]; ?>" /></td>
        </tr>            
        <tr>
        	<th>Edited Date:</th>
            <td><input type="text" name="txtdate" value="<?php echo $tr[6];?>"/></td>
        </tr>
            <?php
				}
			?>
        	<td colspan="2" align="center"><input type="submit" name="cmdedit" value="Save" />
            <a href="index.php"><img src="Images/Users_Group.png" title="Go Back"/></a>
            </td>
        </tr>
	</form></table>
    </div>
    </center>
    <?php
        include ("connect.php");
        $i = mysql_query("update company set company_name='".$_POST['txtname']."', company_rep='".$_POST['txtgender']."', company_email_address='".$_POST['txtdob']."' where company_id=".$_POST['txtid']);
        if($i==true){
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';
        }
        //header('Location::index.php');
        //exit;
        //mysql_close();
    ?>
</body>
</html>