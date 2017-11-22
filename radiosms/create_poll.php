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
        <title></title>
    </head>
    <body>
     <form action="insert_newpoll.php" method="post">   
         
<table  align="center" style="margin: 0px auto;" width="450px">
    <tr>
        <td>Poll Name: </td><td> <textarea name="poll_question" rows="5" cols="30" required=""></textarea></td>
    </tr>
        <tr>
            <td>Option one: </td><td> <input type="text" name="opt1" value="" size="26" required=" This option can't be empty"></td>
    </tr>
        <tr>
            <td>Option two: </td><td> <input type="text" name="opt2" value="" size="26" required="This option can't be empty"></td>
    </tr>
        <tr>
        <td>Option three: </td><td> <input type="text" name="opt3" value="" size="26"></td>
    </tr>
        <tr>
        <td>Option four: </td><td> <input type="text" name="opt4" value="" size="26"></td>
    </tr>
      <tr>
          <td>Is Online: </td><td> <input type=checkbox  name="online"></td>
    </tr>
	 <tr>
	 <td colspan="4" align="center">
             
	
	 <input type="submit" name="Submit" value="Submit">
	  </td>
    
	  </tr>
	 </table>        
         <input type="hidden" name="userid" value="<?php echo $id;?>">
	<input type="hidden" name="user" value="<?php echo $username;?>">
	<input type="hidden" name="compan" value="<?php echo $company;?>">
	<input type="hidden" name="admin" value="<?php echo $admin;?>">
      </form>
         
    </body>
</html>
