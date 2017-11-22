<?php
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
<title>Student Information</title>
<link rel="stylesheet" type="text/css" href="Style/viewtablesearch.css" />
</head>
<body>
<center><h1>Active Companies</h1></center>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button onclick="window.location.href='Add_Form.php'">Add Record</button>
	
	<table>
    	<tr>

            <th>Company Name</th>
            <th>Company Representative</th>
            <th>Company Email</th>
            <th>Create By</th>
            <th>Created Date</th>
            <th>Company RefNo</th>
            <th>Option</th>
    	</tr>
        <?php
			include "connect.php";
                        
                        if ($reseller == 1){
                        $i = "select c.company_id,c.company_name,c.company_rep, c.company_email_address, c.created_by, c.creation_date, company_refno from company c, affiliates f where c.company_name = f.affiliate_name AND f.parent_company='$company'";   
                       // echo " RESELLLER <br>";
                      //  echo $i;
                        
                        
                        }else{
                        
			$i = "select company_id,company_name,company_rep, company_email_address, created_by, creation_date, company_refno from company";
                        }
                        $h = mysql_query($i);
			while($tr=mysql_fetch_array($h))
			{
		?>
        <tr>
        	
            <td><?php echo $tr['company_name']; ?></td>
            <td><?php echo $tr['company_rep']; ?></td>
            <td><?php echo $tr['company_email_address']; ?></td>
            <td><?php echo $tr['created_by']; ?></td>
            <td><?php echo $tr['creation_date']; ?></td>
            <td><?php echo $tr['company_refno']; ?></td>
            <td align="center"><a href="Delete_Form.php? txtid=<?php echo $tr[0];?>">Delete</a> / <a href="Edit_Form.php? txtid=<?php echo $tr[0];?>">Edit</a> </td>    
        </tr>
        <?php
			}
		?>
		
    </table>
        

<button onclick="window.location.href='../index.php'">Back to Admin Menu</button>
</body>
</html>