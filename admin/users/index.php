<<?php
session_start();
$username = $_SESSION["username"];
$company = $_SESSION["company"];
$id = $_SESSION["user_id"];
$admin = $_SESSION["admin"];
$reseller = $_SESSION['reseller'];

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Users</title>
<link rel="stylesheet" type="text/css" href="Style/viewtablesearch.css" />
</head>
<body>
<center><h1>List of Users</h1></center>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button onclick="window.location.href='Add_Form.php'">Add User</button>
		
	<table>
    	<tr>
            <th>UserID</th>
            <th>password</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Surname</th>
            <th>Company</th>
            <th>Is Admin</th>
        
            <th>Option</th>
    	</tr>
        <?php
			include "connect.php";
                        if ($reseller==1){
                            $i = "SELECT a.id, a.firstname, a.username, a.lastname, a.password, a.company, a.admin FROM accounts a, affiliates f WHERE a.company = f.affiliate_name AND f.parent_company='$company'";
                        
                           // echo $i;
                            
                        }else{
			$i = "SELECT a.id, a.firstname,a.username, a.lastname, a.password, a.company, a.admin FROM accounts a";
                        }
			$h = mysql_query($i);
			while($tr=mysql_fetch_array($h))
			{
		?>
        <tr>
        	<td><?php echo $tr['id']; ?></td>
            <td><?php echo $tr['password']; ?></td>
            <td><?php echo $tr['username']; ?></td>
            <td><?php echo $tr['firstname']; ?></td>
            <td><?php echo $tr['lastname']; ?></td>
            <td><?php echo $tr['company']; ?></td>
            <td><?php echo $tr['admin']; ?></td>
          
            <td align="center"><a href="Delete_Form.php? txtid=<?php echo $tr[0];?>">Delete</a> / <a href="Edit_Form.php? txtid=<?php echo $tr[0];?>">Edit</a> </td>    
        </tr>
        <?php
			}
		?>
		
    </table>

<button onclick="window.location.href='../index.php'">Back to Admin Menu</button>
</body>
</html>