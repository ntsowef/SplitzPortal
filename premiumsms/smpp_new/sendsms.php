<?PHP
$msisdn=$_REQUEST['celnumber'];
$message=$_REQUEST['mesage'];
//$msisdn=27739213467;
require_once('smppclass.php');
$smpphost = "196.11.240.100"; // your host address
$smppport = '6100 TX';
$systemid = "TMOBILE_001"; // Your system id
$password = "tmob1"; // Your smpp account password
$system_type = "INFO"; // Your userid
$from = "27839300366"; // From number

$smpp = new SMPPClass();
$smpp->SetSender($from);
/* bind to smpp server */
$smpp->Start($smpphost, $smppport, $systemid, $password, $system_type);
/* send enquire link PDU to smpp server */
$smpp->TestLink();
/* send single message; large messages are automatically split */
$smpp->Send($msisdn, "This is a test message. Give me a missed call if you get this. sajith");
/* send unicode message */
//$smpp->Send("31648072766", "?????????", true);
/* send message to multiple recipients at once */
//$smpp->SendMulti("31648072766,31651931985", "This is my PHP message");
/* unbind from smpp server */
$smpp->End();
?>