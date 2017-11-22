<?php


session_start();
$username = $_SESSION["username"];
$company = $_SESSION["company"];
$id = $_SESSION["user_id"];
$admin = $_SESSION["admin"];

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Splitz Bulk POS </title>
        <link href="css/tables_form.css" rel="stylesheet" type="text/css" />
    </head>
    <body bgcolor="#99CC66">
        <?php
         include "connect.php";
         $amount= trim($_POST['amount']);
         $keyword= trim($_POST['keyword']);
         $msisdn= trim($_POST['msisdn']);
          $status="Ok";
         
           if(isset($_POST['cmdadd'])){
               //echo " Add was pressed";
              if(empty($amount) && empty($msisdn)) {
                   $msg=$msg."Fields must be completed : Amount, MSISDN<br>";
		  $status="False";
              }
              
             if($keyword == 'Select Team'){
                 $msg=$msg."Select the team of choice<br>";
		  $status="False";
             } 
              
              if ($status == "Ok"){
                 if (strlen($msisdn)==8){
                     $msisdn = "+266".$msisdn;
                 }
                     
                 $base_price = 2.00;
                  
                 $num_votes = round($amount/$base_price);
                 
               //  echo  "number of votes for this number are ".$num_votes."<br>";
                 
                 $query = "INSERT INTO cup_transaction (id,user_id,date_loggedin,msisdn,cash_received,votes_allocated, team)VALUES('','$username',NOW(),'$msisdn','$amount','$num_votes','$keyword')";
                 // echo ''.$query;
              $i = mysql_query($query);
              
              $select = " SELECT * from teams where name='$keyword'";
              
              $result = mysql_query($select);
              $arr = mysql_fetch_array($result);
              $team_id = $arr['id'];
              
              
              $ii = 0;
              while ($ii < $num_votes){
              
              $query = "INSERT INTO bulk_votes_queue (id, msisdn, team_keyword,team_number,date_voted) VALUES(id,'$msisdn','$keyword','$team_id',NOW()) ";
             // echo $query;
              $eye =  mysql_query($query);
              $ii++;
              }
              $message = $num_votes." votes were allocated to ".$keyword.", thanks for voting and continue to do so. Ke masiasiane. ";
               $query1="INSERT INTO bulkmessages(id, message, msisdn, queued, message_date, company, username)
                                     VALUES('','$message','$msisdn', 'Q',now(),'Splitz Marketing','Thabang')";
               $eyee =  mysql_query($query1);
               
      // echo $query;
            if(($i==true)&&($eye=true)&&($eyee=true)){
            // echo '<META HTTP-EQUIV="Refresh" Content="0"; URL=confirmation.php?msisdn=$msisdn&amount=$amount>';
               // echo 'something went right';
             
             ?>
                        <script language = "javascript" style = "text/javascript"> 
				window.location = "confirmation.php?msisdn=<?php echo $msisdn;?>&amount=<?php echo $amount;?>&votes=<?php echo $num_votes;?>&userid=<?php echo $username;?>&team=<?php echo $keyword;?>";	
			</script>
            <?php
             }
                  
              }else{
                  echo "<font face='Verdana' size='2' color=red>$msg</font><br>"; 
              }
           }
       /*  } else{
             header("Location:login.php");
         }*/
        ?>
        
      <?php if ($_SESSION['username'] != ""){?> 
        <div>
         
                <form action='pos.php' method='post' class="dark-matter">
                    <h1>Bulk voting Point Of Sales</h1>
                    
                       <label>
                       <span>Amount</span>
                    
                        <input type="text" name="amount" size="5"> 
                       </label>
                       <label>
                   
                         <span>Team </span>
                   
                    	<select name="keyword">
                        	<option>Select Team</option>
                            <?php
                           // $g = mysql_query("select name from teams");
                           $g = mysql_query("select t.name as name from first_division_league pl, teams t WHERE pl.team_id=t.id order by name asc");
					while($id=mysql_fetch_array($g))
					{
                                            echo "<option>".$id['name']."</option>";
                                        }
   							//	}
                            ?>
                        </select>
                    
                    </label>
                       <label>
                     <span> MSISDN</span>
                      
                        <input type="text" name="msisdn" size="15"> 
                    
                       </label>
                    <label>
                        
                            <input type="submit"  class="button" name="cmdadd" value="Transact" />
                  
                   
                </label>
                </form>
                
            </table>
            
            
        </div>
      <?php } else {
          header("Location:login.php");
      }
        ?>
        
    </body>
</html>
