<?php
session_start();
$message="";
if(count($_POST)>0) {
$conn = mysql_connect("196.37.186.21","root","n4u2cc");
mysql_select_db("sms_data",$conn);
$result = mysql_query("SELECT * FROM accounts WHERE username='" . $_POST["user_name"] . "' and password = '". $_POST["password"]."'");
$row  = mysql_fetch_array($result);
if(is_array($row)) {
    
    $message = "Login was successful indeed today";
$_SESSION["status"] = $row[status];
$_SESSION["username"] = $row[username];
$_SESSION["company"] = $row[company];
$_SESSION["admin"] = $row[admin];
$_SESSION["accounttype"] = $row[accounttype];
$_SESSION["accounttype_p"] = $row[accounttype_p];
$_SESSION["user_id"] = $row["id"];

$query1= "SELECT * from company where company_name='".$row['company']."'";
echo $query1;
$result1 = mysql_query($query1);
$rows = mysql_fetch_array($result1);
 if (is_array($rows)){
   $_SESSION['reseller'] = $rows['is_reseller']; 
   
   //echo " RESELLER INDEED ".$rows['is_reseller'];
 }



} else {
$message = "Invalid Username or Password!";
}
}
if(isset($_SESSION["username"])) {
   header("Location:user_dashboard.php");
} 
?>
<html>
<head>
<title>User Login</title>
<link rel="stylesheet" type="text/css" href="styles1.css" />
</head>
<body>
<form name="frmUser" method="post" action="">
<div class="message"><?php if($message!="") { echo $message; } ?></div>
<table border="0" cellpadding="10" cellspacing="1" width="500" align="center">
<tr class="tableheader">
<td align="center" colspan="2">Enter Login Details</td>
</tr>
<tr class="tablerow">
<td align="right">Username</td>
<td><input type="text" name="user_name"></td>
</tr>
<tr class="tablerow">
<td align="right">Password</td>
<td><input type="password" name="password"></td>
</tr>
<tr class="tableheader">
<td align="center" colspan="2"><input type="submit" name="submit" value="Submit"></td>
</tr>
</table>
</form>
</body></html>