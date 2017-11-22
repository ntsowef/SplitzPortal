<?php
	include "remote_connect.php";
	$sender=$_REQUEST['sender'];
	$receiver=$_REQUEST['receiver'];
	$msgdata=strtoupper($_REQUEST['msgdata']);
	$msgid=$_REQUEST['msgid']; 
	$senttime = $_REQUEST['recvtime'];
	$operator = $_REQUEST['operator'];
	$recvtime = date('Y'.'-'.'m'.'-'.'d'.' '.'h'.':'.'m'.':'.'s');
	$msgdata=trim($msgdata);
	/*
	$sender=27744566060;
	$receiver=39941;
	//$receiver=39719;
	//$msgdata='icon';
	$msgdata='TNPS RING 17';
	$msgid='272872782727'; 
	$senttime = date('Y'.'-'.'m'.'-'.'d'.' '.'h'.':'.'m'.':'.'s');
	$recvtime = date('Y'.'-'.'m'.'-'.'d'.' '.'h'.':'.'m'.':'.'s');
	$operator = 'MTN02';
	*/
	$msgtype='SMS:TEXT';
        $ins="INSERT INTO all_smses VALUES('$sender','$receiver','$msgdata','$senttime','$recvtime','$operator','$msgtype','$msgid')";
	$insres=mysql_query($ins) or die('Unable to Insert into all_smses');
	
	$arr = explode(" ",$msgdata);
	$i=0;
	foreach ($arr as $value)
	{
	  if($i==0){$keyval=trim(strtoupper($value));}
	  if($i==1){$keyval2=trim($value);}
	  if($i==2){$extra=trim($value);}	  
	  $i++;
	}
	$q='"';
	$s="'";
	$st='*';
	$b='(';
	$keyval=str_replace($q," ",$keyval);
	$keyval=str_replace($s," ",$keyval);
	$keyval=str_replace($st," ",$keyval);
	$keyval=str_replace($b," ",$keyval);
	$Keyword = trim($keyval);
        $key=$Keyword;
	$sqlc="select mtn_longnumber,voda_longnumber,cellc_longnumber from compu_shortcodes where shortcode='$receiver'";
	$resc=mysql_query($sqlc) or die('Unable to select from compu_shortcodes');
	if(mysql_num_rows($resc) > 0)
		{
			list($mtn_longnumber,$voda_longnumber,$celc_longnumber)=mysql_fetch_row($resc);
			if(substr($operator,0,3)=='VOD')
			{
			//$new_sender=$voda_longnumber;
			$new_sender='27820025520';
			}
			if(substr($operator,0,3)=='MTN')
			{
			//$new_sender=$mtn_longnumber;
			$new_sender='27839300408';
			}
			if(substr($operator,0,3)=='CEL')
			{
			//$new_sender=$celc_longnumber;
			$new_sender='27820025520';
			}
		}
	
	$sql="select shortcode,shortcodetype from compu_shortcodes where shortcode='$receiver'";
	$res=mssql_query($sql) or die('Unable to select from compu_shortcodes');
	if(mssql_num_rows($res) > 0)
	{
	  list($shortcode,$shortcodetype)=mssql_fetch_row($res);
	  
	  if(trim($shortcodetype)=='premium')
	  {	
		
		if($receiver == 39941 and substr($Keyword,0,4) == "TNPS")
		{
			$arr = explode(" ",$msgdata);
			$i=0;
			foreach ($arr as $value)
			{
			  if($i==0){$keyword1=trim(strtoupper($value));}
			  if($i==1){$keyword=trim($value);}
			  if($i==2){$cid=trim($value);}	  
			  if($i==3){$other=trim($value);}	  
			  $i++;
			}
			$cntid = $cid;
			$number=$sender;
			$query="select content_name,content_type from sms_content where content_id = ' $cntid'";
			$result=mssql_query($query) or die("Unable to select from Cont ".mssql_get_last_message());
			if(mssql_num_rows($result)==0)
			{die("I'm sorry, the requested ref ".$cntid." does not exist");}
			list($filename,$filetype)=mssql_fetch_row($result);
			$filename = trim($filename);
			$filetype=trim($filetype);
			$filename = $filename.".".$filetype;
			$insp="INSERT INTO premium_smses VALUES('$sender','$receiver','$msgdata','$senttime','$recvtime','$operator','$msgtype','$msgid')";
			$insresp=mssql_query($insp) or die('Unable to Insert into smses');
			$inspt="insert into premium_transactions values('$sender','$receiver','$price','$Keyword','$operator','$filename','$company','$recvtime')";
			$resinspt=mssql_query($inspt) or die('Unable to insert into premiums_transactions '.mssql_get_last_message());
			//$messagetype='SMS:WAPPUSH';
			//$Response = "<si><indication href=\"http://www.computekmobile.co.za/mtn_ebb/ring.php?ref=$cntid\" action=\"signal-high\">$filename</indication></si>";
			$Response = "You can download your content by clicking the following link <si><indication href=\"http://www.tnps.co.za/ring.php?ref=$cntid\" action=\"signal-high\">Download $filename Content</indication></si>";
			if(!empty($cid))
			{
			$messagetype='SMS:WAPPUSH';
			$Response = "You can download your content by clicking the following link <si><indication href=\"http://www.tnps.co.za/ring.php?ref=$cntid\" action=\"signal-high\">$filename</indication></si>";
			}
			else
			{
			$messagetype='SMS:TEXT';
			$Response = "Thank you for subscribing to ".ucfirst(strtolower($keyword))." services. To opt out SMS STOP to 42098";
			}
			$sql="insert into ozekimessageout(receiver,msgtype,msg,status) values('$number','$messagetype','$Response','send')";
			$res=mssql_query($sql) or die('failed to insert message in ozeki');	
			
		}
		else
		{
		$ins="INSERT INTO premium_smses VALUES('$sender','$receiver','$msgdata','$senttime','$recvtime','$operator','$msgtype','$msgid')";
		$insres=mssql_query($ins) or die('Unable to Insert into smses');
		$sql="select company,message,cmessage,price,status from premium_services where keyword='$Keyword' and shortcode='$receiver'";
		$res=mssql_query($sql) or die('Unable to select from premium services');
		if(mssql_num_rows($res) > 0)
		{
		  list($company,$message,$cmessage,$price,$status)=mssql_fetch_row($res);
		  if($status==0){$message=$cmessage;}
		  $drawdate='14-01-2011';
		  if($key=='ICON' or $key=='icon'or $key=='Icon')
		  {
		  $message='Entry confirmed. More SMS More Chances. Next draw '.$drawdate.' HL: 0861991290. Info & T & C @www.computekmobile.co.za';
		  }
		  $ins="insert into premium_transactions values('$sender','$receiver','$price','$Keyword','$operator','$message','$company','$recvtime')";
		  $resins=mssql_query($ins) or die('Unable to insert into premiums_transactions '.mssql_get_last_message());
		  /*
		  if(substr($operator,0,3)=='MTN')
		   {
		   send_mtn($sender,$message);
		   return 'OK';	
		   }
		   else
		   {
		   */
		   $qry="INSERT INTO ozekimessageout  VALUES('$new_sender','$sender','$message','$recvtime ','','$operator','$msgtype','$company','send','')";
		   $res = mssql_query($qry) or die("Couldn't Insert ozekimessageout ".mssql_get_last_message());
		 //  }
		}
		else
		{
		$message='You sent incorrect message';
		$sql1="insert into invalid_premiums values('$sender','$receiver','$Keyword','$operator','$recvtime')";
		$res1=mssql_query($sql1) or die('Unable to insert into invalid_premiums');
		$qry="INSERT INTO ozekimessageout  VALUES('$new_sender','$sender','$message','$recvtime','','$operator','$msgtype','$company','send','')";
		$res = mssql_query($qry) or die("Couldn't Insert ozekimessageout ".mssql_get_last_message());
		}
		}
	  }
	/*
	else
	{
		  if(substr($operator,0,3)=='MTN')
		  {
		  ?>
		  <script language = "javascript" style = "text/javascript"> 
			window.location = "http://www.computekmobile.co.za/mtn_ebb/mtn_responder.php?sender=<?php echo $sender;?>&receiver=<?php echo $receiver;?>&msgdata=<?php echo $msgdata;?>&operator=<?php echo $operator;?>&msgid=<?php echo $msgid;?>&senttime=<?php echo $senttime;?>";									
		  </script>
		  <?
		  }
		  elseif(substr($operator,0,3)=='CEL')
		  {//echo"<br> its CELC ";
		  ?>
		  <script language = "javascript" style = "text/javascript"> 
			window.location = "http://wasp.computek.co.za/celc_wasp/celc_responder.php?sender=<?php echo $sender;?>&receiver=<?php echo $receiver;?>&msgdata=<?php echo $msgdata;?>&operator=<?php echo $operator;?>&msgid=<?php echo $msgid;?>&senttime=<?php echo $senttime;?>";									
		  </script>
		  <?
		  }
		  else
		  {
			header("Location: http://wasp.computek.co.za/computek/responder?sender=$sender&receiver=$receiver&msgdata=$msgdata&operator=$operator&msgid=$msgid&senttime=$senttime");
		  }
	}
	*/
	}
	//}
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