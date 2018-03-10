<?php
error_reporting(0);
ini_set('track_errors', 1);

/** Only allow this IP range to view this script /

if ( !preg_match('/^64\.202\./', $_SERVER['REMOTE_ADDR']) ) { //limit access by IP
	header("HTTP/1.1 403 Forbidden");
	echo 'Access denied by IP rule.';
	exit;
}

**/

if ( isset($_POST['sendemail']) ) {
	header("Content-Type: text/plain");
	$from = $_POST['from'] ; 
	$toemail = $_POST['toemail'] ; 
	$subject = $_POST['subject'] ;
	$message = $_POST['message'] ;
	$result = @mail($toemail, $subject, $message, "From: $from" );
	if ( $result ) {
		echo 'OK';
	} else {
		echo 'FAIL (' . $php_errormsg . ')';
	}
	exit;
}
?><!DOCTYPE html>
<html>
<head>
<title>PHP mail function testing</title>
</head>
<body>
<h1>PHP mail function testing</h1>

<form id="mailform" name="mailform">
	To: <input name='toemail' type='text' size='40' /><br />
	From: <input name='from' type='text' size='40' /><br />
	Subject: <input name='subject' type='text' size='40' /><br />
	Message:<br />
	<textarea name='message' rows='15' cols='40'>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed tempor incididunt ut labore et dolore magna aliqua. </textarea><br />
</form>
<button id='sendemail' onclick='GoSend();'>Send</button><br /><br />

<hr>

<table id="msglog" border="1" bordercolor="#FFCC00" style="background-color:#FFFFCC" width="100%" cellpadding="3" cellspacing="3">
	<tr>
		<td>TO</td>
		<td>FROM</td>
		<td>SUBJECT</td>
		<td>MESSAGE</td>
		<td>RESULT</td>
	</tr>
</table>

<script>
function GoSend() {
	var table=document.getElementById("msglog");
	var rowCount = table.rows.length;
	var row = table.insertRow(rowCount);
	
	var TOcell = row.insertCell(0);
	TOcell.innerHTML=document.mailform.toemail.value;
	
	var FROMcell = row.insertCell(1);
	FROMcell.innerHTML=document.mailform.from.value;
	
	var SUBJECTcell = row.insertCell(2);
	SUBJECTcell.innerHTML=document.mailform.subject.value;
	
	var MESSAGEcell = row.insertCell(3);
	MESSAGEcell.innerHTML=document.mailform.message.value;
	
	var RESULTcell = row.insertCell(4);
	RESULTcell.innerHTML="<img height=\"24\" src=\"data:image/gif;base64,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\">";
	
	var postdata= "sendemail=1&toemail="+document.mailform.toemail.value;
	    postdata+="&from="+document.mailform.from.value;
	    postdata+="&subject="+document.mailform.subject.value;
	    postdata+="&message="+encodeURIComponent(document.mailform.message.value).replace("%20", "+");
	var url="<?=$_SERVER['PHP_SELF']; ?>";
	var request=new XMLHttpRequest();
	request.open("POST",url,true);
	request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	request.overrideMimeType("text/plain");
	request.onreadystatechange=function() { 
		if ( request.readyState==4 ) {
			if ( request.responseText == "OK" || request.responseText == "FAIL" ) {
				RESULTcell.innerHTML=request.responseText;
			} else {
				RESULTcell.innerHTML="HTTP/1.1 "+request.status+" "+request.statusText+"<br /><br />"+request.responseText;
			}
		}
	}
	request.send(postdata);
}
</script>
</body>
</html>