<?session_start();?>
	<!DOCTYPE html>
	<html>
	<head>
	<title>Black Links UK - Admin</title>
	</head>
	<body>
	
	<table align="center" bgcolor="#FFFFFF">
	<tr>
	<td><img src="images/logo.png" width="147" height="147"></td>
	<td width="690"><div align="center"><strong><font size="+4">Black Links UK 
        Admin System</font></strong></div></td>
		
	</tr>
	</table>
	<br/>
	<?
	 /* load settings */
require 'connectdb.php';
require 'sendemails.php';

 $ui = 0;
 $ui =  $_REQUEST['ui'];
 if ($ui > 0  )
{
$_SESSION['CurrentUser'] = $ui;

}
?>
<table align="center" border="1">
<tr>
<th>Reports</th>
</tr>
<tr>
<td>
<ul>
<li><a href="reports.php?rep=5">Email Sent Report</a></li>
<li><a href="reports.php?rep=1">Clients Without Email Addresses</a></li>
<li><a href="reports.php?rep=2">Clients Without Company Names</a></li>
<li><a href="reports.php?rep=3">Advertising Spaces Sold</a></li>
<li><a href="reports.php?rep=4">Client Advertising Preferences</a></li>
<li><a href="reports.php?rep=6">Client Numbers By Category</a></li>
<li><a href="reports.php?rep=7">User Comments</a></li>     

</ul>
      <div align="center"><br/>
        <a href="index.php">back</a> </div></td>
</tr>
</table>
<br/> <br/>
	<?
	  /* load settings */
require 'connectdb.php';

$updc =  $_REQUEST['updc'];
if ($updc > 0)
{
?>
<form action="reports.php?sem=1" method="post">
<table align="center">
<tr>
<td>Enter Email:</td> 
    <td> 
      <input name="txtNewEmail" type="text" id="txtNewEmail">
	  <input type="hidden" name="txtClientID" value="<? echo($updc); ?>" />
	 </td>
</tr>
<tr>
<td colspan="2" align="center"><input type="submit" name="Submit" value="Save & Send Email"></td>
</tr>
</table>
</form>
<?

}

$sem =  $_REQUEST['sem'];
if ($sem == 1)
{


	$tmpQuery = "SELECT DocumentText, DocumentTitle";
	$tmpQuery .= " FROM Documents Where DocumentTitle = 'Welcome'" ;
	//print($tmpQuery);
	$tmpAccs = mysql_query($tmpQuery);
	
		while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
	{
		$DocumentText = $thisAccs["DocumentText"];
		$DocumentTitle = $thisAccs["DocumentTitle"];
	}
	
	
	$txtNewEmail = $_POST['txtNewEmail'];
	$txtClientID = $_POST['txtClientID'];
	
	$sSQL = "UPDATE  Clients Set Email =' " .  $txtNewEmail . "' Where Client_ID = " . $txtClientID; 
	mysql_query($sSQL); 
	
	$tmpQuery = "SELECT Client_ID, Company, ContactName, Email, ClientPassword ";
	$tmpQuery .= " FROM Clients Where Client_ID = " . $txtClientID; 
	$tmpAccs = mysql_query($tmpQuery);
	
	while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
	{
		// print($display_two_colums);
		
		$Client_ID = $thisAccs["Client_ID"];
		$Company = $thisAccs["Company"];
		$ContactName = $thisAccs["ContactName"];
		$Email = $thisAccs["Email"];
		$ClientPassword = $thisAccs["ClientPassword"];
		
		$Success = SendEmail($Company, $ContactName, $Email, $ClientPassword, $DocumentText, $DocumentTitle, $Client_ID );
		if ($Success == "Yes")
		{
			 $EmailSent = 1;
			$NoEmailSentCount = $NoEmailSentCount +1;   
		}
		else
		{
		 	$EmailSent = 0;
			$NoEmailNotSentCount =  $NoEmailNotSentCount + 1;
		}
		
		$sSQL = "INSERT INTO Emails_Sent (Client_ID, Document_ID, Sent )"; 
		$sSQL = $sSQL . " VALUES (" .$Client_ID . "," . $cboDoc . "," . $EmailSent . ")";
		// print($sSQL);
		mysql_query($sSQL); 
	}

}

$rep =  $_REQUEST['rep'];

if ($rep==1)
{
?>
<table align="center" border="1">
<tr>
<th colspan="3">Clients Without Email Adresses</th>
</tr>
<tr>
<th>Company</th> <th>Contact Name</th> <th>Company Telephone</th> <th>Email</th>
</tr>
<? 
	$tmpQuery = "SELECT Company, ContactName, Telephone, Client_ID ";
	$tmpQuery .= " FROM Clients ";
	$tmpQuery .= " Where Email = 'temp_login@blacklinksuk.com'";
	//print($tmpQuery);
	// ListDisplayType
	$tmpAccs = mysql_query($tmpQuery);
	
	while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
	{
		$Company = $thisAccs["Company"];
		$ContactName = $thisAccs["ContactName"];
		$Telephone = $thisAccs["Telephone"];
		$Client_ID = $thisAccs["Client_ID"];
		echo("<tr>");
		echo("<td>" . $Company . "</td>");
		echo("<td>" . $ContactName . "</td>");
		echo("<td>" . $Telephone . "</td>");
		echo("<td> <a href ='reports.php?updc=". $Client_ID ."'/>Enter Email & Send Welcome Letter</a></td>");		
		echo("</tr>");
	}
}
?>
</table>
<?
if ($rep==2)
{
?>
<table align="center" border="1">
<tr>
<th colspan="3">Clients Without Company Names</th>
</tr>
<tr>
<th>Email</th> <th>Contact Name</th> <th>Company Telephone</th>
</tr>
<? 
	$tmpQuery = "SELECT Email, ContactName, Telephone ";
	$tmpQuery .= " FROM Clients ";
	$tmpQuery .= " Where Company = ''";
	//print($tmpQuery);
	// ListDisplayType
	$tmpAccs = mysql_query($tmpQuery);
	
	while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
	{
		$Email = $thisAccs["Email"];
		$ContactName = $thisAccs["ContactName"];
		$Telephone = $thisAccs["Telephone"];
		
		if ($Email == "temp_login@blacklinksuk.com")
		{
			$Email = "";
		}
		echo("<tr>");
		echo("<td>" . $Email . "</td>");
		echo("<td>" . $ContactName . "</td>");
		echo("<td>" . $Telephone . "</td>");		
		echo("</tr>");
	}
}
?>
</table>

<?
if ($rep==3)
{
?>
<table align="center" border="1">
<tr>
<th colspan="4">Advertising Spaces Sold</th>
</tr>
<tr>
<th>Company</th> <th>Date Created</th> <th>Expiry Date</th> <th>Advert Type Name</th>
</tr>
<? 
	$tmpQuery = "SELECT Company, Adverts.DateCreated, Adverts.ExpiryDate, AdvertTypeName ";
	$tmpQuery .= " FROM Clients, Adverts, AdvertType ";
	$tmpQuery .= " Where Adverts.Client_ID = Clients.Client_ID And Adverts.AdvertType_ID = AdvertType.AdvertType_ID";
	//print($tmpQuery);

	$tmpAccs = mysql_query($tmpQuery);
	
	while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
	{
		$Company = $thisAccs["Company"];
		$DateCreated = $thisAccs["DateCreated"];
		$ExpiryDate = $thisAccs["ExpiryDate"];
		$AdvertTypeName = $thisAccs["AdvertTypeName"];
		
		echo("<tr>");
		echo("<td>" . $Company . "</td>");
		echo("<td>" . $DateCreated . "</td>");
		echo("<td>" . $ExpiryDate . "</td>");
		echo("<td>" . $AdvertTypeName . "</td>");		
		echo("</tr>");
	}
}
?>
</table>
<?
if ($rep==4)
{
?>
<table align="center" border="1">
<tr>
<th colspan="5">Client Advertising Preferences</th>
</tr>
<tr>
<th>Company</th> <th>Contact Name</th> <th>Company Email</th> <th>Company Telephone</th> <th>Customer Advertising Providers</th>
</tr>
<? 
	$tmpQuery = "SELECT Company, ContactName, Email, Telephone, CustomerProviders ";
	$tmpQuery .= " FROM Clients ";
	$tmpQuery .= " Where CustomerProviders <> ''";
	//print($tmpQuery);
	// ListDisplayType
	$tmpAccs = mysql_query($tmpQuery);
	
	while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
	{
		$Company = $thisAccs["Company"];
		$ContactName = $thisAccs["ContactName"];
		$Telephone = $thisAccs["Telephone"];
		$Email = $thisAccs["Email"];
		$CustomerProviders = $thisAccs["CustomerProviders"];
		echo("<tr>");
		echo("<td>" . $Company . "</td>");
		echo("<td>" . $ContactName . "</td>");
		echo("<td>" . $Email . "</td>");
		echo("<td>" . $Telephone . "</td>");
		echo("<td>" . $CustomerProviders . "</td>");
		echo("</tr>");
	}
}
?>
</table>
<?
if ($rep==5)
{
	?>
	<table align="center" border="1">
	<tr>
	<th colspan="4">Email Sent Report</th>
	</tr>
	<tr>
	<th>Company</th> <th>Date Sent</th> <th>Document Title</th> <th>Sent Successfully</th>
	</tr>
	<? 
		$tmpQuery = "SELECT Company, EmailSentDate, Sent, DocumentTitle ";
		$tmpQuery .= " FROM Emails_Sent, Clients, Documents ";
		$tmpQuery .= " Where Emails_Sent.Client_ID = Clients.Client_ID And Emails_Sent.Document_ID = Documents.Document_ID Order By EmailSentDate Desc";
		//print($tmpQuery);
	
		$tmpAccs = mysql_query($tmpQuery);
		
		while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
			$Company = $thisAccs["Company"];
			$EmailSentDate = $thisAccs["EmailSentDate"];
			$Sent = $thisAccs["Sent"];
			$DocumentTitle = $thisAccs["DocumentTitle"];
			if ($Sent ==1)
			{
				$EmailSent = "Yes";
			}
			else
			{
				$EmailSent = "No";
			}
			
			echo("<tr>");
			echo("<td>" . $Company . "</td>");
			echo("<td>" . $EmailSentDate . "</td>");
			echo("<td>" . $DocumentTitle . "</td>");
			echo("<td>" . $EmailSent . "</td>");  		
			echo("</tr>");
		}
	
	?>
	</table>

<?
}

if ($rep==6)
{
?>
<table align="center" border="1">
<tr>
<th colspan="2">Clients By Category</th>
</tr>
<tr>
<th>Category</th> <th>Number Of Clients </th>
</tr>
<? 
	$tmpQuery = "SELECT Category_ID, CategoryName ";
	$tmpQuery .= " FROM Categories ";
	$tmpQuery .= " Order By CategoryName";
	//print($tmpQuery);
	// ListDisplayType
	$tmpAccs = mysql_query($tmpQuery);
	
	while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
	{
		$Category_ID = $thisAccs["Category_ID"];
		$CategoryName = $thisAccs["CategoryName"];
		$ClientCount = GetClientCount($Category_ID);
		echo("<tr>");
		echo("<td align='center'>" . $CategoryName . "</td>");
		echo("<td align='center'>" . $ClientCount . "</td>");
		echo("</tr>");
	}
}

if ($rep==7)
{
?>
<table align="center" border="1">
<tr>
<th colspan="4">User Comments</th>
</tr>
<tr>
<th>Date Created</th> <th>Contact Name </th> <th>Contact Email </th> <th>Comments </th>
</tr>
<? 
	$tmpQuery = "SELECT DateCreated, ContactName, ContactEmail, Notes ";
	$tmpQuery .= " FROM Contact ";
	$tmpQuery .= " Order By DateCreated Desc";
	//print($tmpQuery);
	// ListDisplayType
	$tmpAccs = mysql_query($tmpQuery);
	
	while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
	{
		$DateCreated = $thisAccs["DateCreated"];
		$ContactName = $thisAccs["ContactName"];
		$ContactEmail = $thisAccs["ContactEmail"];
		$Notes = $thisAccs["Notes"];
		
		echo("<tr>");
		echo("<td align='center'>" . $DateCreated . "</td>");
		echo("<td align='center'>" . $ContactName . "</td>");
		echo("<td align='center'>" . $ContactEmail . "</td>");
		echo("<td align='center'>" . $Notes . "</td>");
		echo("</tr>");
	}
}
function GetClientCount($CatID)
{

	$Count = 0;
	$tmpQuery = "SELECT count(*) as CatCount ";
	$tmpQuery .= " FROM Clients ";
	$tmpQuery .= " Where Category_ID = " . $CatID;;
	//print($tmpQuery);
	
	$tmpAccs = mysql_query($tmpQuery);
	
	while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
	{
		$Count = $thisAccs["CatCount"];
	}
		
	return $Count;
}


?>
	</body>
	</html>					
