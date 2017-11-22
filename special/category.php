<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="style.css" type="text/css" rel="stylesheet" />	
	<script src="http://code.jquery.com/jquery-2.1.1.js"></script>
	<script>
	function getresult(url) {    
	$.ajax({
		url: url,
		type: "POST",
		data:  {rowcount:$("#rowcount").val()},
		success: function(data){ $("#toys-grid").html(data); $('#add-form').hide();}
	   });
	}
	getresult("getresult.php");
	function add() {
	var valid = validate();
	if(valid) {
		$.ajax({
			url: "add.php",
			type: "POST",
			data:  {category:$("#category").val()},
			success: function(data){ getresult("getresult.php"); }
		   });
		}
	}
	function showEdit(id) {
		$.ajax({
			url: "show_edit.php?id="+id,
			type: "POST",
			success: function(data){ $("#toy-"+id).html(data); }
	   });
	}
	function edit(id) {
	var valid = validate();
	if(valid) {
		$.ajax({
			url: "edit.php?id="+id,
			type: "POST",
			data:  {category:$("#category").val()},
			success: function(data){ $("#toy-"+id).html(data); }
		   });
		}
	}	
	function del(id) {
	$.ajax({
		url: "delete.php?id="+id,
		type: "POST",
		success: function(data){ $("#toy-"+id).html(''); }
	   });
	}
	function validate() {
		var valid = true;	
		$(".demoInputBox").css('background-color','');
		$(".info").html('');
		
		if(!$("#category").val()) {
			$("#category-info").html("(required)");
			$("#category").css('background-color','#FFFFDF');
			valid = false;
		}			
		return valid;
	}
	</script>

    </head>
    <body>
     <h2>BAM Categories</h2>
		
		<div id="toys-grid">
			<input type="hidden" name="rowcount" id="rowcount" />					
		</div>
		<div id="add-form">
		<!--form name="frmToy" method="post" action="" id="frmToy">
		
		<div>
		<label>Category</label> 
		<span id="category-info" class="info"></span><br/>
		<input type="text" name="category" id="category" class="demoInputBox">
		</div>
		</div>
			<div>
		<input type="button" name="submit" id="btnAddAction" value="Add" onClick="add();" />
		</div>
		</form-->
		</div>
    </body>
</html>
