<?php
session_start();
$username = $_SESSION["username"];
$company = $_SESSION["company"];
$id = $_SESSION["user_id"];
$admin = $_SESSION["admin"];

$host = $_SERVER['HTTP_HOST'];
$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$base_url = 'http://'.$host.$uri.'/';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
   <link rel="stylesheet" type="text/css" href="./jquery.datetimepicker.css"/>

        <script type="text/javascript">
	
//Edit the counter/limiter value as your wish
var count = "160";   //Example: var count = "175";
function limiter(){
var tex = document.myform.message.value;
var len = tex.length;
if(len > count){
        tex = tex.substring(0,count);
        document.myform.message.value =tex;
        return false;
}
document.myform.limit.value = count-len;
}

function check_length(my_form)
	{
		maxLen = 150; // max number of characters allowed
		if (my_form.Message.value.length >= maxLen) {
// Alert message if maximum limit is reached. 
// If required Alert can be removed. 
var msg = "You have reached your maximum limit of characters allowed";
alert(msg);
		// Reached the Maximum length so trim the textarea
			my_form.Message.value = my_form.Message.value.substring(0, maxLen);
		 }
		else{ // Maximum length not reached so update the value of my_text counter
			my_form.text_num.value = maxLen - my_form.Message.value.length;}
	}
// +,- delete
var r={'special':/[\W]/g}
function valid(o,w)
{
  o.value = o.value.replace(r[w],'');
}

// phone number checker
function isNumeric()
{
  var elem=document.myform.to.value;
  var nalt=document.getElementById('phno1');
 if(elem!="")
 {
    var numericExpression = /^[0-9]+$/;
	  if(elem.match(numericExpression))
    {
         nalt.innerHTML="";
         return true;
       }
    
    else{
		
    nalt.innerHTML="<font size=1 > Numbers Only</font>";
		  document.myform.to.focus();
	 	  document.myform.to.value="";
       return false;
	  }
  }
  else if(elem.length==0)  {
    nalt.innerHTML="<font size=1 > Enter Numbers</font>";
     document.myform.to.focus();;
   return false;
    }
}

var checkboxes = $("input[type='checkbox']"),
    submitButt = $("input[type='file']");

checkboxes.click(function() {
    submitButt.attr("disabled", !checkboxes.is(":checked"));
});
</script>
    </head>
    <body>
          <div align="center">	
        <?php
        include "connect.php";
		$sql="select max(id) from bulk_credits where company='$company' group by company";
		$res=mysql_query($sql);
		list($creditid)=mysql_fetch_row($res);
		$sql1="select credits from bulk_credits where  company='$company' and status=1";
		$res1=mysql_query($sql1);
		list($credits)=  mysql_fetch_row($res1);
		mysql_close();
        ?>
           <table class = "content" cellpadding="0" cellspacing="0" border="0px" align="center"style="width: 440; height: 50%; padding-right: 0px; padding-left: 0px; padding-bottom: 0px; margin: 0px; clip: rect(0px 0px 0px 0px); padding-top: 0px; font-size: 12px;">
               
               <form class="contact_form" action="schedule_bulkmsg.php" method="post" name="contact_form" enctype="multipart/form-data">
                   <tr>
                      <td colspan="3" align="center" valign="top" style="height: 40px; font-size: 10px;"><font color="" size="3">Bulk Message form</font><font color="red" size="2"><br/><?php echo"Credits Available: ".$credits;?></font></td>
                   </tr>
                   
                    <tr>
                      <td width="38%" align="left" valign="top" class = "content">Message:</td>
                      <td width="306" align="left" valign="top" colspan="2" ><textarea onKeyPress=check_length(this.form); onKeyDown=check_length(this.form); name="Message"  rows="4" cols="39"></textarea></td>
                    </tr>
                    <tr>                   <td align="left" valign="top" class = "content">Count:</td>
                          <td align="left" valign="top" colspan="2" > <input size=1 value=160 name=text_num> 
                        </script>
                        </td>
                    </tr>
                     <tr>
                      <td align="left" valign="top" class = "content">From File:</td>
                      <td align="left" valign="top" colspan="2" ><input type="checkbox" name="check" id="check" value = "From File" onclick ="disable()" /></td>
                    </tr>
                      <tr>
                      <td align="left" valign="top" class = "content">Upload File:</td>
                      <td align="left" valign="top" colspan="2" >
		      <input type="file" size="37"  accept = "accept=&quot;content-type-list" [csv,txt]" name="file" id="file" />
		      </td>
                    </tr>
                    <tr>
                      <td align="left" valign="top" class = "content">Phone Numbers:</td>
                      <td align="left" valign="top" colspan="2" ><textarea name="Phone_numbers" id="Phone_numbers" rows="4" cols="39"></textarea></td>
                    </tr>
                    <tr>
                        <td align="left" valign="top" class = "content"> Schedule date time </td>
                        <td align="left" valign="top" colspan="2">  <input type="text" id="datetimepicker" name="schedule" readonly></td>
                    </tr>
                    <tr>
                        <td></td>
                           <td align="right" valign="top" width="66%">
                                  <input type="submit" name="submit" value="Send Message" />
                                  <input type="reset" name="Clear" value="Clear" />
                            </td>  
                            <td align="left"valign="top">
                                 <input type="hidden" name="id" value="<?php echo $id;?>">
                        	<input type="hidden" name="user" value="<?php echo $username;?>">
                                <input type="hidden" name="compan" value="<?php echo $company;?>">
                                <input type="hidden" name="admin" value="<?php echo $admin;?>">
                                <input type="hidden" name="creditid" value="<?php echo $creditid;?>"> 
                        	<input type="hidden" name="credits" value="<?php echo $credits;?>"> 
			
                             </td>
                    </tr>
                
                </form>
           </table>
          </div>
    </body>
    <script src="./jquery.js"></script>
<script src="./jquery.datetimepicker.js"></script>
<script>/*
window.onerror = function(errorMsg) {
	$('#console').html($('#console').html()+'<br>'+errorMsg)
}*/
$('#datetimepicker').datetimepicker({
dayOfWeekStart : 1,
format:'Y-m-d H:i', 

lang:'en',
disabledDates:['1986/01/08','1986/01/09','1986/01/10'],
startDate:	'1990-01-05'
});
</script>
</html>
