#!/usr/bin/php
<?php
require_once 'config2.php';
//require_once 'sendsms.php';

if(!ini_get('date.timezone'))
{
	date_default_timezone_set('GMT');
}

$log = '/var/log/send-bulk_sms.log';

function help()
{
	global $log;
	
	echo chr(10);
	echo "Process demonstrating a PHP daemon.".chr(10);
	echo chr(10);
	echo "Usage:".chr(10);
	echo chr(9)."./sendsms-d.php [options]".chr(10);
	echo chr(10);
	echo chr(9)."Options:".chr(10);
	echo chr(9).chr(9)."--help: Displays this help message.".chr(10);
	echo chr(9).chr(9)."--log=<filename> The location of the log file. (default '$log')".chr(10);
	echo chr(10);
}//End of help() function

//Configure command line arguments
if($argc > 0)
{
	foreach ($argv as $arg)
	{
		$args = explode('=', $arg);
		switch ($args)
		{
			case '--help':
				return help();
				break;
			case '--log':
				$log = $args[1];
				break;					
		}//end switch;
	}//end foreach;
}//end if;

file_put_contents($log, chr(10).'Status: Starting up process - '.date("Y-m-d H:i:s").chr(10), FILE_APPEND);

$pid = pcntl_fork();
if ($pid == -1)
{
	file_put_contents($log, chr(10).chr(9).'-- Error: Could not daemonize process'.chr(10), FILE_APPEND);
	return 1;
}//end if
elseif ($pid)
{
	return 0;
}//end elseif
else 
{
	if(!($conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME)))
	{
		file_put_contents($log, chr(10).chr(9).'-- Database error: '.$conn->error.chr(10), FILE_APPEND);
		return 1;
	}//end if
		
	while (1)
	{
		$query = "SELECT * FROM bulkmessages WHERE queued='Q' LIMIT 40";
		if(!($rs = $conn->query($query)))
		{
			file_put_contents($log, chr(10).chr(9).'-- Database error: '.$conn->error().chr(10), FILE_APPEND);
			return 1;
		}//end if
		
                
                
                
		if($rs->num_rows > 0)
		{ 
			for($data = 0; $data < $rs->num_rows; $data++)
			{      $numofMessages = 0;
				$rs->data_seek($data);				
				$row = $rs->fetch_assoc();
                               //  $sender ="+26654000013";
                              //   $network_sender = "Vodacom_BULK";
                               
                        $sender = "+26631019";
                        $network_sender="ETL_SMSC";
                           /* switch ($row['company']){
                                case "Splitz Marketing":{
                                $sender ="Splitz";
                                $network_sender = "Vodacom_BULK_ALPHANUMERIC";
                                file_put_contents($log, chr(10).'sender: '.$sender.' network: '.$network_sender, FILE_APPEND);
                                    break;
                                }
                                case "Dr Kolobe@PolyClinix":{
                                     $sender ="Polyclinix";
                                     $network_sender = "Vodacom_BULK_ALPHANUMERIC";
                                      file_put_contents($log, chr(10).'sender: '.$sender.' network: '.$network_sender, FILE_APPEND);
                                break;
                                      
                                }
                                case "The Lounge":{
                                $sender = 'The Lounge';
                                $network_sender = "Vodacom_BULK_ALPHANUMERIC";
                                 file_put_contents($log, chr(10).'sender: '.$sender.' network: '.$network_sender, FILE_APPEND);
                                    break;
                                }
                                case "S &M Bakery":{
                                $sender = 'S M Bakery';
                                $network_sender = "Vodacom_BULK_ALPHANUMERIC";
                                 file_put_contents($log, chr(10).'sender: '.$sender.' network: '.$network_sender, FILE_APPEND);
                                    break;
                                }
                                case "AON":{
                                $sender = 'AON';
                                $network_sender = "Vodacom_BULK_ALPHANUMERIC";
                                 file_put_contents($log, chr(10).'sender: '.$sender.' network: '.$network_sender, FILE_APPEND);
                                    break;
                                }
                                case "ABC":{
                                $sender = 'ABC';
                                $network_sender = "Vodacom_BULK_ALPHANUMERIC";
                                 file_put_contents($log, chr(10).'sender: '.$sender.' network: '.$network_sender, FILE_APPEND);
                                    break;
                                }
                                case "Alliance":{
                                $sender = 'Alliance';
                                $network_sender = "Vodacom_BULK_ALPHANUMERIC";
                                 file_put_contents($log, chr(10).'sender: '.$sender.' network: '.$network_sender, FILE_APPEND);
                                    break;
                                }
                                case "WASCO":{
                                $sender = 'WASCO';
                                $network_sender = "Vodacom_BULK_ALPHANUMERIC";
                                 file_put_contents($log, chr(10).'sender: '.$sender.' network: '.$network_sender, FILE_APPEND);
                                    break;
                                }
                               case "Loti Brick":{
                                $sender = 'Loti Brick';
                                $network_sender = "Vodacom_BULK_ALPHANUMERIC";
                                 file_put_contents($log, chr(10).'sender: '.$sender.' network: '.$network_sender, FILE_APPEND);
                                    break;
                                }
                                default :{
                                     $sender ="+26654000013";
                                     $network_sender = "Vodacom_BULK";
                                file_put_contents($log, chr(10).'sender: '.$sender.' network: '.$network_sender, FILE_APPEND);
                                    break;
                                }
                            } */   
				$post_data = '<?xml version="1.0"?>';
				$post_data.= '<message>';
				$post_data.= '<submit>';
				$post_data.= '    <da><number>'.$row['msisdn'].'</number></da>';
				$post_data.= '    <oa><number>'.$sender.'</number></oa>';
				$post_data.= '    <ud>'.$row['message'].'</ud>';
				$post_data.= '    <statusrequest>';
				$post_data.= '      <dlr-mask>31</dlr-mask>';
				$post_data.= '      <dlr-url>http://196.37.186.21/sms/dlr_sms.php?type=%d&id='.$row['id'].'</dlr-url>';
				$post_data.= '    </statusrequest>';
				$post_data.= '    <from>';
				$post_data.= '      <user>tester</user>';
				$post_data.= '      <pass>foobar</pass>';
				$post_data.= '    </from>';
			        $post_data.= '     <to>'.$network_sender.'</to>';
				$post_data.= '  </submit>';
				$post_data.= '</message>';
				
				
				//Initiates a connection to example.com using port 80 with a timeout of 15 seconds.
				
				//Checks if the connection was fine
				if(!$socket = @fsockopen(HTTP_HOST, 13013, $errno, $errstr, 15))
				{
					//Connection failed so we display the error number and message and stop the script from continuing
					file_put_contents($log, chr(10).chr(9).'-- Error: '. $errno.' '.$errstr.chr(10), FILE_APPEND);
					return 1;
				}//end if
				else
				{
				        file_put_contents($log, chr(10).'sender: +26654000013 receiver: '.$row['msisdn'], FILE_APPEND);
					
					//Builds the header data we will send along with are post data. This header data tells the web server we are connecting to what
					//we are, what we are requesting and the content type so that it can process are request.
					$http  = "POST ".HTTP_SCRIPT." HTTP/1.1\r\n";
					$http .= "Host: ".HTTP_HOST."\r\n";
					$http .= "User-Agent: PHP API\r\n";
					$http .= "Content-Type: text/xml\r\n";
					$http .= "Content-length: " . strlen($post_data) . "\r\n";
					$http .= "Connection: close\r\n\r\n";
					$http .= $post_data . "\r\n\r\n";
					//Sends are header data to the web server
					fwrite($socket, $http);
					$contents = "";
					//Waits for the web server to send the full response. On every line returned we append it onto the $contents
					//variable which will store the whole returned request once completed.
					while (!feof($socket)) 
					{
						$contents .= fgets($socket, 4096);
					}//end while
						
					$res = explode(":", strrev(substr(strrev($contents), 0, strpos(strrev($contents), "\n"))));
					file_put_contents($log, chr(10).'Kannel response: '.$res[0], FILE_APPEND);
					
					if(($res[0] == 3) || ($res[0] == 0))
					{
						$query = "UPDATE bulkmessages SET queued='P', processed_date=NOW() WHERE id='".$row['id']."'";
						file_put_contents($log, chr(10).chr(9).$query.chr(10), FILE_APPEND);
						if(!$conn->query($query))
						{
							file_put_contents($log, chr(10).chr(9).'-- Error: '. $errno.' '.$errstr.chr(10), FILE_APPEND);
							return 1;
						}//end if
					}//end if
					//echo substr($contents, -1, strpos($contents, "\n"));
					//Close are request or the connection will stay open untill are script has completed.
					fclose($socket);
				}//end else
			}//end for
		}//end if
		$rs->free_result();
		
		sleep(1);
	}//end while
	file_put_contents($log, chr(10).'Status: Ending process - '.date("Y-m-d H:i:s").chr(10), FILE_APPEND);
}//end else
$conn->close();