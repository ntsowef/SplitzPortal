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

} else {
$message = "Invalid Username or Password!";
}
}
if((isset($_SESSION["username"])) && ($_SESSION["username"] != NULL )) {
header("Location:pos.php");
}
?>
<html>
<head>
<title>User Login</title>
 <link href="css/tables_form.css" rel="stylesheet" type="text/css" />
</head>
<body>
    
         
         <form name="frmUser" method="post" action="login.php" class="dark-matter">
             <h1>Enter Login Details</h1>
           <div class="message"><?php if($message!="") { echo $message; } ?></div>

    <label>
        <span>Username</span>
     <input type="text" name="user_name">
    </label>
    <label>
        <span>Password</span>
     <input type="password" name="password">
    </label>

<label>
<input type="submit" name="submit" value="Submit" class="button">
</label>
</form>
       
</body></html>