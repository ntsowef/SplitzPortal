<?php
	include "remote_connect.php";
	
	$sender=$_REQUEST['sender'];
	$receiver=$_REQUEST['receiver'];
	$msgdata=strtoupper($_REQUEST['msgdata']);
	$msgid=$_REQUEST['msgid']; 
	$senttime = $_REQUEST['recvtime'];
	$operator = strtoupper($_REQUEST['operator']);
	$recvtime = date('Y'.'-'.'m'.'-'.'d'.' '.'h'.':'.'m'.':'.'s');
	
	/*
	$sender=27739213467;
	$receiver=42098;
	//$receiver=39719;
	//$msgdata='icon';
	$msgdata='STOP';
	$msgid='272872782727'; 
	$senttime = date('Y'.'-'.'m'.'-'.'d'.' '.'h'.':'.'m'.':'.'s');
	$recvtime = date('Y'.'-'.'m'.'-'.'d'.' '.'h'.':'.'m'.':'.'s');
	$operator = 'MTN02';
	*/
	$msgtype='SMS:TEXT';
        $ins="INSERT INTO all_smses VALUES('$sender','$receiver','$msgdata','$senttime','$recvtime','$operator','$msgtype','$msgid')";
	$insres=mssql_query($ins) or die('Unable to Insert into all_smses');
	
	$arr = explode(" ",$msgdata);
	$i=0;
	foreach ($arr as $value)
	{
	  if($i==0){$keyval=trim(strtoupper($value));}
	  if($i==1){$keyval2=trim($value);}
	  if($i==2){$extra=trim($value);}	  
	  $i++;
	}
	$Keyword = $keyval; 
	if(substr($Keyword,0,4) == "STOP")
	{	
		$message = "You have been successfully removed from our promotional database."; 
		$up = "update sms_subscriber set status ='0', sdate='$recvtime' where celnumber = '$sender'";			 
		$uprt = mssql_query($up) or die("Couldn't update sms_subscriber ".mssql_get_last_message());
		
		if(substr($operator,0,3)=='MTN')
		{
		//send_mtn($sender,$message);
		$new_sender=27839300408;
		}
		else
		{
		$new_sender=27820025520;
		//$qry="INSERT INTO ozekimessageout  VALUES('$new_sender','$sender','$message','$recvtime ','','$operator','$msgtype','$company','send','')";
		//$res = mssql_query($qry) or die("Couldn't Insert ozekimessageout ".mssql_get_last_message());
		}

		$qry="INSERT INTO ozekimessageout  VALUES('$new_sender','$sender','$message','$recvtime ','','$operator','$msgtype','$company','send','')";
		$res = mssql_query($qry) or die("Couldn't Insert ozekimessageout ".mssql_get_last_message());
		//sendsms($sender, $message);
		//sendsms($sender, $$message,$new_sender,$operator);
	}	   
	else
	{
	$sql="select shortcode,shortcodetype from compu_shortcodes where shortcode='$receiver'";
	$res=mssql_query($sql) or die('Unable to select from compu_shortcodes');
	if(mssql_num_rows($res) > 0)
	{ //echo"<br> shortcode ".$shortcode." shortcodetype ".$shortcodetype;
	  list($shortcode,$shortcodetype)=mssql_fetch_row($res);
	  if(substr($operator,0,3)=='MTN')
		 {
		  ?>
		  <script language = "javascript" style = "text/javascript"> 
			window.location = "http://www.computekmobile.co.za/mtn_ebb/mtn_responder.php?sender=<?php echo $sender;?>&receiver=<?php echo $receiver;?>&msgdata=<?php echo $msgdata;?>&operator=<?php echo $operator;?>&msgid=<?php echo $msgid;?>&senttime=<?php echo $senttime;?>";									
		  </script>
		  <?php
		  }
		  elseif(substr($operator,0,3)=='CEL')
		  {
		  ?>
		  <script language = "javascript" style = "text/javascript"> 
			window.location = "http://wasp.computek.co.za/celc_wasp/celc_responder.php?sender=<?php echo $sender;?>&receiver=<?php echo $receiver;?>&msgdata=<?php echo $msgdata;?>&operator=<?php echo $operator;?>&msgid=<?php echo $msgid;?>&senttime=<?php echo $senttime;?>";									
		  </script>
		  <?php
		  }
		  else
		  {
			//header("Location: http://wasp.computek.co.za/computek/responder?sender=$sender&receiver=$receiver&msgdata=$msgdata&operator=$operator&msgid=$msgid&senttime=$senttime");
		   ?>
		    <script language = "javascript" style = "text/javascript"> 
			//window.location = "http://wasp.computek.co.za:8100/computek/responder?sender=<?php echo $sender;?>&receiver=<?php echo $receiver;?>&msgdata=<?php echo $msgdata;?>&operator=<?php echo $operator;?>&msgid=<?php echo $msgid;?>&senttime=<?php echo $senttime;?>";									
			window.location = "localhost/computek/responder?sender=<?php echo $sender;?>&receiver=<?php echo $receiver;?>&msgdata=<?php echo $msgdata;?>&operator=<?php echo $operator;?>&msgid=<?php echo $msgid;?>&senttime=<?php echo $senttime;?>";									
		    </script>
		    <?php
		  }
	 }
	}
	return 'OK';	
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
		return 'OK';	
	 } 
	 
function sendsms($number,$msg)
{
	$username = "admin";
	$password = "abc123";
	$ozeki_url = "http://127.0.0.1:9501/api?";
	$sendmessage='sendmessage';
	$messagetype='SMS:TEXT';
	/*
	$url = 'username='.$ozeki_user;
	      $url.= '&password='.$ozeki_password;
	      $url.= '&action=sendmessage';
	      $url.= '&messagetype=SMS:TEXT';
	      $url.= '&recipient='.urlencode($phone);
	      $url.= '&messagedata='.urlencode($msg);
	 */    
	$ch = curl_init();
         curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
         curl_setopt($ch, CURLOPT_URL,$ozeki_url);
         curl_setopt ($ch, CURLOPT_POST, 1);
         curl_setopt($ch, CURLOPT_HEADER, 0);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	 curl_setopt($ch, CURLINFO_HEADER_OUT, true);
         $post_values = '';
         $post_vals = array(
          username => $username,
          password => $password,
          recipient => $number,
          action => $sendmessage, 
          messagetype => $messagetype, 
          messagedata => $msg
          );					
            foreach($post_vals as $key=>$value) 
              {
                 $post_values .= urlencode($key).'='.urlencode($value).'&';
              }
              $post_values = rtrim($post_values,'&');
              curl_setopt ($ch, CURLOPT_POSTFIELDS, $post_values);
              $response_string = curl_exec($ch);
              $curl_info = curl_getinfo($ch);
	      if ($response_string == FALSE) 
                  {
                    print "cURL error: ".curl_error($ch)."\n";
		   } 
                elseif ($curl_info['http_code'] != 200)
                   {
                     print "Error: non-200 HTTP status code: ".$curl_info['http_code']." ".$curl_info."\n";
                   }
                 else 
                   {
                      $blnSent = true;
                 //     echo "<br>Message Sent Successfully! ";
		   }
		curl_close($ch);
		return;
	}	
	
?>