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
    	<center><h1 style="color:#939">Add Shortcodes </h1>
    </div>
<div id="form">
		<table>
        	<form method="post" action="">
            	<tr>
                
                <?php
					include ("connect.php");
					$g = mysql_query("select max(id) from shortcodes");
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
                	<th>Shortcode:</th>
                    <td><input type="text" name="txtname" placeholder="Type Shortcode"  /></td>
                </tr>
                
                
                <tr>
                	<th>Price (Inclusive of VAT):</th>
                    <td><input type="text" name="txtprice"  /></td>
                </tr>
                <tr>
                    <th>ShortCode Type:</th>
                    <td>
                    	<select name="txtshortcodetype">
                        	<option>Select Subject</option>
                            <?php
                            	$s=array("premium","Standard");
								for($i=0;$i<count($s);$i++)
								{
									echo "<option>".$s[$i]."</option>";	
								}
                            ?>
                        </select>
                    </td>
        		</tr>
                <tr>
                     <th>Price Excluding VAT:</th>
                    <td><input type="text" name="txtpricevatexcl"  /></td>
                </tr>
                <tr>
                    <td><input type="submit" name="cmdadd" value="Add" /></td>
                     <td>    <script>
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
        $name = trim($_POST['txtname']);
        $price = trim($_POST['txtprice']);
        $pricevatexcl = trim($_POST['txtpricevatexcl']);
        $shortcodetype = trim($_POST['txtshortcodetype']);
        $status = '1';
        if(isset($_POST['cmdadd'])){
        if(empty($name))
        {
            echo "<center>Sorry please input data</center>";
        }else{
        include "connect.php";
        $i = mysql_query("insert into shortcodes values('".$id."','".$name."','".$price."','".$pricevatexcl."','".$status."','".$shortcodetype."')");
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