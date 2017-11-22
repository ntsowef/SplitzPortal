<?php
	$sender=27739213467;
	$msgdata='STOP';
	$operator='MTN';
	if(substr($operator,0,3)=='MTN')
	{
	echo"testing";
	//send_mtn($sender,$Response);
	}
	else
	{
	echo"testing 1";
	}
	

function send_mtn($msisdn,$message)
	 {
		require_once('smpp_new/smppclass.php');
		$smpphost = "196.11.240.100"; // your host address
		$smppport = '6100 TX';
		$systemid = "HR_001"; // Your system id
		$password = "8KA315J6"; // Your smpp account password
		$system_type = "INFO"; // Your userid
		$from = "27839300408"; // From number
		
		$smpp = new SMPPClass();
		$smpp->SetSender($from);
		/* bind to smpp server */
		$smpp->Start($smpphost, $smppport, $systemid, $password, $system_type);
		/* send enquire link PDU to smpp server */
		$smpp->TestLink();
		/* send single message; large messages are automatically split */
		$smpp->Send($msisdn, $message);
		$smpp->End();
	 } 
?>