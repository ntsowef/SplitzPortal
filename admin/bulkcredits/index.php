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
<title>Bulk Credits</title>
<link rel="stylesheet" type="text/css" href="Style/viewtablesearch.css" />
</head>
<body>
<center><h1>Bulk Credits</h1></center>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php  if($reseller==1) {?>
<button onclick="window.location.href='affiliates_addcredits.php'">Add Credits</button>
<?php } else { ?>
<button onclick="window.location.href='addcredits.php'">Add Credits</button>
<?php  } ?>	
<table>
    	<tr>
      
            <th>Invoice #</th>
            <th>Amount</th>
            <th>Invoice Vat</th>
            <th>Invoice Date</th>
            <th>Credits</th>
            <th>Company</th>
            </tr>
        <?php
			include "connect.php";
                        
                        if ($reseller == 1){
                            $i = "SELECT b.invoiceno, b.invoiceamt, b.invoicelesvat, b.invoicedate, b.credits, b.company  FROM bulk_credits b, affiliates a WHERE b.company = a.affiliate_name AND a.parent_company = '$company' AND b.status=1";
                           //echo $i;
                            } else {
			$i = "select invoiceno, invoiceamt,invoicelesvat, invoicedate, credits, company  from bulk_credits where status=1";
                        echo $i;
                        }
                        $h = mysql_query($i);
			while($tr=mysql_fetch_array($h))
			{
		?>
        <tr>
        	
            <td><?php echo $tr['invoiceno']; ?></td>
            <td><?php echo $tr['invoiceamt']; ?></td>
            <td><?php echo $tr['invoicelesvat']; ?></td>
            <td><?php echo $tr['invoicedate']; ?></td>
            <td><?php echo $tr['credits']; ?></td>
            <td><?php echo $tr['company']; ?></td>
            
            <!--td align="center"><a href="Delete_Form.php? txtid=<?php echo $tr[0];?>">Delete</a> / <a href="Edit_Form.php? txtid=<?php echo $tr[0];?>">Edit</a> </td-->    
        </tr>
        <?php
			}
		?>
		
    </table>


<button onclick="window.location.href='../index.php'">Back to Admin Menu</button>



</body>
</html>