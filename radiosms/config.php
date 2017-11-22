<?Php
$dbhost_name = "196.37.186.21";
$database = "sms_data";
$username = "root";
$password = "n4u2cc";

//////// Do not Edit below /////////
try {
$dbo = new PDO('mysql:host=196.37.186.21;dbname='.$database, $username, $password);
} catch (PDOException $e) {
print "Error!: " . $e->getMessage() . "<br/>";
die();
}
?> 

