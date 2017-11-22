<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Users</title>
<link rel="stylesheet" type="text/css" href="Style/viewtablesearch.css" />
</head>
<body>
<center><h1>List of available campaign adverts</h1></center>

	<button onclick="window.location.href='Add_Form.php'">Add Record</button>
	<table>
    	<tr>
            <th>ADVERT_ID</th>
            <th>WORDING</th>
            <th>CREATED BY</th>
            <th>DATE_CREATED</th>
            <th>STATUS</th>
            <th>ACTIVE</th>

        
            <th>Option</th>
    	</tr>
        <?php
			include "connect.php";
			$i = "select * from bam_adverts";
			$h = mysql_query($i);
			while($tr=mysql_fetch_array($h))
			{
		?>
        <tr>
        	<td><?php echo $tr['adv_id']; ?></td>
            <td><?php echo $tr['advert_wording']; ?></td>
            <td><?php echo $tr['created_by']; ?></td>
            <td><?php echo $tr['creation_date']; ?></td>
            <td><?php echo $tr['status']; ?></td>
            <td><?php echo $tr['active']; ?></td>
          
          
            <td align="center"><a href="Delete_Form.php? txtid=<?php echo $tr['adv_id'];?>">Delete</a> / <a href="Edit_Form.php? txtid=<?php echo $tr['adv_id'];?>">Edit</a> </td>    
        </tr>
        <?php
			}
		?>
		
    </table>

<button onclick="window.location.href='../special_admin.php'">Back to Admin Menu</button>
</body>
</html>