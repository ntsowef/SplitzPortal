<%@ language=vbscript %>
<%
'Set the response buffer to true so we execute all asp code before sending the HTML to the clients browser
Response.Buffer = True

'Dimension variables
Dim strBody 			'Holds the body of the e-mail
Dim objCDOMail 			'Holds the mail server object
Dim strMyEmailAddress 		'Holds your e-mail address
Dim strCCEmailAddress		'Holds any carbon copy e-mail addresses if you want to send carbon copies of the e-mail
Dim strBCCEmailAddress		'Holds any blind copy e-mail addresses if you wish to send blind copies of the e-mail
Dim strReturnEmailAddress	'Holds the return e-mail address of the user


'----------------- Place your e-mail address in the following sting ----------------------------------

strMyEmailAddress = "techsupport@computekmobile.co.za"

'----------- Place Carbon Copy e-mail address's in the following sting, separated by ; --------------

strCCEmailAddress = "techsupport@computekmobile.co.za;sales@computekmobile.co.za" 'Use this string only if you want to send the carbon copies of the e-mail

'----------- Place Blind Copy e-mail address's in the following sting, separated  by ; --------------

strBCCEmailAddress = "Josiah@computek.co.za" 'Use this string only if you want to send the blind copies of the e-mail

'-----------------------------------------------------------------------------------------------------


'Read in the users e-mail address
strReturnEmailAddress = Request.Form("email")


'Initialse strBody string with the body of the e-mail
'strBody = "<h3>E-mail sent from Computek Mobile</h3>"
strBody = strBody & "<br><b>&nbsp; Name: </b>" & Request.Form("Name") & " " & Request.Form("Surname")
strBody = strBody & "<br><br><b>&nbsp; Company name: </b>" & Request.Form("Company_name")

'strBody = strBody & "<br><br><b>&nbsp; Address: -</b>"
'If (Request.Form("street1")) > "" Then 
'	strBody = strBody & "<br>  " & Request.Form("street1")
'End If
'If (Request.Form("street2")) > "" Then 
'	strBody = strBody & "<br>  " & Request.Form("street2") 
'End If
'If (Request.Form("town")) > "" Then 
'	strBody = strBody & "<br>  " & Request.Form("town")
'End If
'If (Request.Form("county")) > "" Then 
'	strBody = strBody & "<br>  " & Request.Form("county")
'End If
If (Request.Form("country")) <> "None" Then
	strBody = strBody & "<br><br><b>&nbsp; Country: </b>" & Request.Form("country")
End IF
'If (Request.Form("postCode")) > "" Then 
'	strBody = strBody & "<br>  " & Request.Form("postCode")
'End If
strBody = strBody & "<br><br><b>&nbsp; Telephone: </b>" & Request.Form("telephone")
strBody = strBody & "<br><br><b>&nbsp; Cellphone: </b>" & Request.Form("cell_number")
strBody = strBody & "<br><br><b>&nbsp; E-mail: </b>" & strReturnEmailAddress

strBody = strBody & "<br><br><b>&nbsp; Enquiry: - </b>" & Replace(Request.Form("contents"), vbCrLf, "<br>")
strBody = strBody & "<br><br><b>&nbsp; I am interested in the following Product(s)/Services: </b><UL type=square>"

'*** Gather a List of Products Selected ***
For I  =  1 to 48
    If Request.Form("C" & I) <> "" Then
       strBody = strBody & "&nbsp;<Li><b>" & Request.Form("C" & I) & "</b></Li><br>"
    end if
Next       

strBody = strBody & "</UL>"

'*** Gather a list of Services Selected ****
'strBody = strBody & "<br><br><b>&nbsp;I am interested in the following Service(s): </b><br><br><UL type=square>"


'For I  =  1 to 25
'    If Request.Form("Service" & I) <> "" Then
'       strBody = strBody & "&nbsp;<Li><b>" & Request.Form("Service" & I) & "</b></Li><br>"
'    end if
'Next 
strBody = strBody & "</UL>"

Select case Request.Form("Priority")
       Case 0 
            Prior = "Low"
       Case 1
            Prior = "Medium"
       Case 2
            Prior = "High"
       Case else
       
End Select            


strBody = strBody & "<Br><B><font color=red> Priority level: " & Prior & "</font></B></Br>"
'Check to see if the user has entered an e-mail address and that it is a valid address otherwise set the e-mail address to your own otherwise the e-mail will be rejected
If Len(strReturnEmailAddress) < 5 OR NOT Instr(1, strReturnEmailAddress, " ") = 0 OR InStr(1, strReturnEmailAddress, "@", 1) < 2 OR InStrRev(strReturnEmailAddress, ".") < InStr(1, strReturnEmailAddress, "@", 1) Then
	
	'Set the return e-mail address to your own
	strReturnEmailAddress = strMyEmailAddress
End If	


'Send the e-mail

'Create the e-mail server object
Set objCDOMail = Server.CreateObject("CDONTS.NewMail")

'Who the e-mail is from (this needs to have an e-mail address in it for the e-mail to be sent)
objCDOMail.From = Request.Form("firstName") & " " & Request.Form("lastName") & " <" & strReturnEmailAddress & ">"

'Who the e-mail is sent to
objCDOMail.To = strMyEmailAddress

'Who the carbon copies are sent to
objCDOMail.Cc = strCCEmailAddress

'Who the blind copies are sent to
objCDOMail.Bcc = strBCCEmailAddress

'Set the subject of the e-mail
objCDOMail.Subject = "Enquiry sent from enquiry form on Computek Mobile"

'Set the e-mail body format (0=HTML 1=Text)
objCDOMail.BodyFormat = 0

'Set the mail format (0=MIME 1=Text)
objCDOMail.MailFormat = 0

'Set the main body of the e-mail
objCDOMail.Body = strBody

'Importance of the e-mail (0=Low, 1=Normal, 2=High)
objCDOMail.Importance = Request.Form("Priority") 



'Send the e-mail
objCDOMail.send
	
'Close the server object
Set objCDOMail = Nothing
%>






<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>.::Computek Mobile::.</title>
<link href="newyear.css" rel="stylesheet" type="text/css" />
</head>

<body>
<center>
<div id="border">
<div id="rc1"></div><div id="rc2"></div>
<div class="white">
<div id="header">
<div id="left">


</div>
<div id="center" style="background-image:url(images/header-bg.jpg); background-repeat:repeat-x;">
<div id="logo-bg"><br>
	<br>
	<img border="0" src="images/Computek_Mobile_Logo.png" width="250" height="124"></div><div id="fireworks">
 <div class="tag">&nbsp;</div>
</div>

</div>
</div>
<div id="links-bg">
<div id="left2"></div><div id="center2">
<div class="toplinks"><a href="index.html">Homepage</a></div>
<div class="sap">»</div>
<div class="toplinks"><a href="About_Us.html">About</a></div>
<div class="sap">»</div>
<div class="toplinks"><a href="Products.html">Products</a></div>
<div class="sap">»</div>
<div class="toplinks"><a href="Services.html">Services</a></div>
<div class="sap">»</div>
<div class="toplinks">
	<a href="Contact_Us.html">Contact us</a></div>
</div><div id="right3"></div>
</div>
</div>
	<div class="white2"><div class="white">

	<div id="left10">
	<div id="rc5"><div class="heading2">&nbsp;</div></div>
	<div class="quicklinks">» <a href="About_Us.html">About 
		Us</a></div>
	<div class="quicklinks">» <a href="Products.html">Products</a></div>
	<div class="quicklinks">» <a href="Services.html">Services</a></div>
	<div class="quicklinks" style="width: 178px; height: 36px">» 
		<a href="Contact_Us.html">Contact Us</a></div>
	<div class="quicklinks">&nbsp;</div>
	</div>

	<div id="center10"></div>
	<div id="right10">
	<div style="clear:both;"><div id="rc7"></div><div id="rc-bg"></div>
	<div id="rc8"></div>
	</div>
	<div class="main2"><div class="heading" style="width: 517px; height: 55px">
		Enquiry details sent to computek mobile</div></div>

	<div class="main">
 <div id="wrapper">
	<div id="conTent">
		<span class="box">
		<div id="in_right">
			<br>
			Thank you for your enquiry, our sales team will be in touch with you 
			shortly.<p>&nbsp;</p>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			<p>&nbsp;</div>
		</span></div>
	</div>
	</div>
	<div style="clear:both;">
	<div id="rc12"></div><div id="rc-bg2"></div>
	<div id="rc13"></div></div><div style="height:20px;"></div>
	</div>
	</div></div>
	<div></div>
	<div id="rc10"></div><div id="rc11"></div>
	<div class="bottom">
<div class="toplinks"><a href="index.html">Homepage</a></div>
<div class="sap">»</div>
<div class="toplinks"><a href="About_Us.html">About</a></div>
<div class="sap">»</div>
<div class="toplinks"><a href="Products.html">Products</a></div>
<div class="sap">»</div>
<div class="toplinks"><a href="Services.html">Services</a></div>
<div class="sap">»</div>
<div class="toplinks">
	<a href="Contact_Us.html">Contact us</a></div>
</div>

<center>
<div style="height:28px; line-height:28px; width:779px; clear:left;"><strong>Designed by 
	<a href="http://www.computek.co.za">Computek</a> Pty (LTD) 2010</strong></div></center>
</div>

</center>
</body>
</html>
