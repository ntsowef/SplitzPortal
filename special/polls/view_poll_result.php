<?Php


require "config.php";
//////////////////////////////
//echo "<font size='2' face='Verdana' color='#000000'> ( Poll ID = 1)</font>";
$qst_id = $_REQUEST['poll_id'];
//$qst_id=3; // change this to change the poll 

/* Find out the question first */

$count=$dbo->prepare("select bc.category as quest from mobile_poll m, bam_categories bc where bc.id=m.id and m.id=:qst_id ");
$count->bindParam(":qst_id",$qst_id,PDO::PARAM_INT,3);

if($count->execute()){
//echo " Success <br>";
$row = $count->fetch(PDO::FETCH_OBJ);
}else{
echo "Database Problem";
}
echo "<br><b><br>$row->quest</b><br>"; // display the question
/* for percentage calculation we will find out the total number
 of answers ( options submitted ) given by the visitors */

$count=$dbo->prepare("select ans_id from splitz_poll_ans where poll_id=:qst_id");
$count->bindParam(":qst_id",$qst_id,PDO::PARAM_INT,3);
$count->execute();
$rt=$count->rowCount();
echo " No of records = ".$rt; 

/* Find out the answers and display the graph */
$sql="select count(*) as no, mobile_poll.quest,splitz_poll_ans.opt from mobile_poll,splitz_poll_ans where mobile_poll.id=splitz_poll_ans.poll_id and mobile_poll.id='$qst_id' group by splitz_poll_ans.opt";
//echo $sql." <br>";
echo "<table cellpadding='0' cellspacing='0' border='0' >";
 
foreach ($dbo->query($sql) as $noticia) {
 echo "<tr> <td width='10%' bgcolor='#F1F1F1'>&nbsp;<font size='1' face='Verdana' color='#000000'>$noticia[opt]</font></td>";
$width2=$noticia['no'] *10 ; /// change here the multiplicaiton factor //////////
$ct=($noticia[no]/$rt)*100;
$ct=sprintf ("%01.2f", $ct); // number formating 
$number = $noticia['no'];
$realwidth = $width2/2;
echo "<td width='10%' bgcolor='#F1F1F1'>&nbsp;<font size='1' face='Verdana' color='#000000'>($ct%)</font></td><td width='$width2/2%' bgcolor='#F1F1F1'>&nbsp;<img src='graph.jpg' height=19 width=$width2/2>($number) votes</td>
  </tr>";
 echo "<tr><td  bgcolor='#ffffff' colspan=2></td></tr>";
//echo $noticia['sel'],$noticia[no]."<br>";
}
echo "</table>";
echo "</font>";


?>

 <button onclick="goBack()">Go Back</button>

<script>
function goBack() {
    window.history.back();
}
</script>  