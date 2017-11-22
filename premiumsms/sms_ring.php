<?php
	$number=27739213467;
 /*
	$msg='images/com in english.mp3';
	$ozeki_user = "admin";
	$ozeki_password = "abc123";
	$ozeki_url = "http://127.0.0.1:9501/api?";
    // global $ozeki_user,$ozeki_password,$ozeki_url;
      $url = 'username='.$ozeki_user;
      $url.= '&password='.$ozeki_password;
      $url.= '&action=sendmessage';
      $url.= '&messagetype=SMS:RINGTONE';
      $url.= '&recipient='.urlencode($phone);
      $url.= '&messagedata='.urlencode($msg);
      $urltouse =  $ozeki_url.$url;
      
      if ($debug) { 
      //echo "Request: <br>$urltouse<br><br>"; 
      }
      //Open the URL to send the message
      $response = httpRequest($urltouse);
      
      if ($debug) {
	  // echo "Response: <br><pre>".str_replace(array("<",">"),array("&lt;","&gt;"),$response)."</pre><br>"; 
	   }
      return($response);
      */
        $username = "admin";
	$password = "abc123";
	$ozeki_url = "http://127.0.0.1:9501/api?";
	$sendmessage='sendmessage';
	$messagetype='SMS:RINGTONE';
	//$msg='images/com in english.mp3';
	$filename='com in english.mp3';
	$download_path='http://wasp.computek.co.za/premiumsms/images/';
	$msg= "<a href=\"images/com in english.mp3\"></a>";
	$file = "$download_path$filename";
	//$msg=$file;
	$msg="<a href='$file'>$filename</a>";
	echo"<br>Message file".$msg."<br>";
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
?>