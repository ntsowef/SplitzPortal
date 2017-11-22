<?php
session_start();
//unset($_SESSION["user_id"]);
unset($_SESSION["username"]);
unset($_SESSION["status"]) ;
unset($_SESSION["username"]);
unset($_SESSION["company"]);
unset($_SESSION["admin"]);
unset($_SESSION["accouttype"]);
unset($_SESSION["accounttype_p"]);
header("Location:login.php");
?>