<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home | Media United </title>
</head>

<body>
<form method="post" action="providerpassword.php?ppr=1">
<table align="center" border="1" bordercolor="#0000FF">
<tr>
<th align="center" colspan="2">Provider Password Reminder</th>
</tr>
<tr>
<td>Enter Email</td><td><input type="text" name="txtEmail" /></td>
</tr>
<tr>
<td align="center" colspan="2"><input type="submit" value="Send Password"  /> </td>
</tr>
</table>
</form>
	<? 
	/* load settings */
	require 'connectdb.php';
	require 'sendemails.php';
	
	$ppr =  $_REQUEST['ppr'];
	if ($ppr ==1) 
	{
		$ProvidersPassword = "";
		$txtEmail =  $_POST['txtEmail'];
		$sSQL = "SELECT ProvidersPassword FROM Providers Where ProvidersEmail	 = '"  .$txtEmail . "'" ;
		//print($sSQL);
		$tmpAccs = mysql_query($sSQL);
		
		while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
			$ProvidersPassword = $thisAccs["ProvidersPassword"];
		}
		if ($ProvidersPassword <> "")
		{
			$to = $txtEmail; // admin@theunited.media
			
			$DocumentTitle = "Password Reminder ";
			$DocumentText = "Your passeword is: " . $ProvidersPassword;
			$Success = SendEmail($to,  $DocumentText, $DocumentTitle );
			
			echo("<p>Password Sent!</p>");
		}
		else
		{
			echo("<p>Email Not Found!</p>");
		}
	}
	?>

</body>
</html>