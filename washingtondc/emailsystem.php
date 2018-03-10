	
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
	<table align="center">
	<tr>
	<th colspan="4">Mass Email System</th>
	</tr>
	<tr>
	<td></td>
	</tr>
	</table>
	<br/>
	<table align="center">
	<tr>
	<td><a href="docs.php">Documents</a></td>
    <td><a href="attech2.php">Attechments</a></td>
    <td><a href="reports.php?rep=5">Email Report</a></td>
    <td>&nbsp;</td>
    <td><a href="index.php">back</a></td>
	</tr>
	</table>
	<?
	  /* load settings */
require 'connectdb.php';
require 'sendemails.php';

	$tmpQuery = "SELECT Document_ID, DocumentTitle";
	$tmpQuery .= " FROM Documents order by DocumentTitle";
	//print($tmpQuery);
	$tmpAccs = mysql_query($tmpQuery);

?>	
<form action="emailsystem.php?rt=1" method="post" >
				
<table align="center">
<tr>
<td>Select Document</td> 
     <td>
      <select name="cboDoc" id="cboDoc" >
       
        <?
			while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
			$iloop = $iloop + 1;

			$Document_ID = $thisAccs["Document_ID"];
			$DocumentTitle = $thisAccs["DocumentTitle"];
			
			echo("<option value=". $Document_ID . ">" . $DocumentTitle . "</option>");

			
		}
	?>
      </select>
						
						

	</td>
      <td>Select Attechment 1</td> 
     <td>
      <select name="cboAtt1" id="cboAtt1" >
	  <option value="0" selected>No Attechment</option>       
	   <?
			$tmpQuery = "SELECT AttechmentPath, AttechmentTitle";
			$tmpQuery .= " FROM Attechments order by AttechmentTitle";
			//print($tmpQuery);
			$tmpAccs = mysql_query($tmpQuery);
		
			while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
			$iloop = $iloop + 1;

			$AttechmentPath = $thisAccs["AttechmentPath"];
			$AttechmentTitle = $thisAccs["AttechmentTitle"];
			
			echo("<option value='". $AttechmentPath . "'>" . $AttechmentTitle . "</option>");

			
		}
	?>
      </select>
						
						

	</td>
      <td>Select Attechment 2</td> 
     <td>
      <select name="cboAtt2" id="cboAtt2" >
	  <option value="0" selected>No Attechment</option>       
	   <?
			$tmpQuery = "SELECT AttechmentPath, AttechmentTitle";
			$tmpQuery .= " FROM Attechments order by AttechmentTitle";
			//print($tmpQuery);
			$tmpAccs = mysql_query($tmpQuery);
		
			while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
			$iloop = $iloop + 1;

			$AttechmentPath = $thisAccs["AttechmentPath"];
			$AttechmentTitle = $thisAccs["AttechmentTitle"];
			
			echo("<option value='". $AttechmentPath . "'>" . $AttechmentTitle . "</option>");

			
		}
	?>
      </select>
						
						

	</td>
      <td>Select Attechment 3</td> 
     <td>
      <select name="cboAtt3" id="cboAtt3" >
	  <option value="0" selected>No Attechment</option>       
	   <?
			$tmpQuery = "SELECT AttechmentPath, AttechmentTitle";
			$tmpQuery .= " FROM Attechments order by AttechmentTitle";
			//print($tmpQuery);
			$tmpAccs = mysql_query($tmpQuery);
		
			while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
			$iloop = $iloop + 1;

			$AttechmentPath = $thisAccs["AttechmentPath"];
			$AttechmentTitle = $thisAccs["AttechmentTitle"];
			
			echo("<option value='". $AttechmentPath . "'>" . $AttechmentTitle . "</option>");

			
		}
	?>
      </select>
						
						

	</td>	</tr>
<tr>
		<td>
		<?
	$tmpQuery = "SELECT Category_ID, CategoryName";
	$tmpQuery .= " FROM Categories order by CategoryName";
	//print($tmpQuery);
	$tmpAccs = mysql_query($tmpQuery);
?>
      <select name="cboCat" id="cboCat" >
        <option value="0">All Categories</option>
        <?
			while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
			$iloop = $iloop + 1;

			$Category_ID = $thisAccs["Category_ID"];
			$CategoryName = $thisAccs["CategoryName"];
			
			$cboCat = $_POST['cboCat'];
			
			echo("<option value=". $Category_ID . ">" . $CategoryName . "</option>");

			
		}
	?>
      </select>
	</td>
	
		<td><input class="resize" name="txtName" type="text" id="txtName"   placeholder="Name" /></td>
		<td><input class="resize" name="txtArea" type="text" id="txtArea" placeholder="Area" /></td>
		<td><input class="resize" name="txtCity" type="text" id="txtCity" placeholder="City" /></td>
		<td><input class="resize" name="txtPostcode" type="text" id="txtPostcode" placeholder="Post Code(1st half)" /></td>
		<td><input class="resize" name="txtFreeText" type="text" id="txtFreeText" placeholder="Free Text Search" /></td>
	</tr>
	<tr>
	  <td><input type="submit" name="Submit" value="Search"></td> 
	</tr>
</table>
</form>
<?
 $rt =  $_REQUEST['rt'];
if ($rt==1)
{
	$chkSent = "";
	$txtName = $_POST['txtName'];
	$cboCat = $_POST['cboCat'];
	$txtArea = $_POST['txtArea'];
	$txtCity = $_POST['txtCity'];
	$txtPostcode = $_POST['txtPostcode'];
	$txtFreeText = $_POST['txtFreeText'];
	$cboDoc =  $_POST['cboDoc'];
	$chkSent =  $_POST['chkSent'];
	
	$cboAtt3 =  $_POST['cboAtt3'];
	$cboAtt2 =  $_POST['cboAtt2'];
	$cboAtt1 =  $_POST['cboAtt1'];
	
	
	
	
	$CFlag = 0;
	
	$Wherecluse = " Where ";
	if ($cboCat > 0)
	{
		$Wherecluse .= " Category_ID = " . $cboCat;
		$CFlag = 1;
		
	}
	
	if ($txtName <> "")
	{
		if ($CFlag == 1)
		{
			$Wherecluse .= " and Company LIKE  '" . $txtName ."%'";
		}
		else
		{
			$Wherecluse .= " Company LIKE '" . $txtName ."%'";
			$CFlag = 1;
		}
	}
	
	
	if ($txtArea <> "")
	{
		if ($CFlag == 1)
		{
			$Wherecluse .= " and Area = '" . $txtArea ."'";
		}
		else
		{
			$Wherecluse .= " Area = '" . $txtArea ."'";
			$CFlag = 1;
		}
	}
		
	if ($txtCity <> "")
	{
		if ($CFlag == 1)
		{
			$Wherecluse .= " and City = '" . $txtCity ."'";
		}
		else
		{
			$Wherecluse .= " City = '" . $txtCity ."'";
			$CFlag = 1;
		}
	}
	
	if ($txtPostcode <> "")
	{
		if ($CFlag == 1)
		{
			$Wherecluse .= " and PostCode LIKE  '" . $txtPostcode ."%'";
		}
		else
		{
			$Wherecluse .= " PostCode LIKE '" . $txtPostcode ."%'";
			$CFlag = 1;
		}
	}
	
	if ($txtFreeText <> "")
	{
		$FreeTextItems = explode(',', $txtFreeText);
		
		foreach ($FreeTextItems as &$FreeTextItem) 
		{
			if ($CFlag == 1)
			{
				$Wherecluse .= " or SearchText LIKE  '%" . $FreeTextItem ."%'";
			}
			else
			{
				$Wherecluse .= " SearchText LIKE '%" . $FreeTextItem ."%'";
				$CFlag = 1;
			}
	
		}
	
	}
	
	$cboDoc =  $_POST['cboDoc'];
	$chkSent =  $_POST['chkSent'];
	$cboAtt3 =  $_POST['cboAtt3'];
	$cboAtt2 =  $_POST['cboAtt2'];
	$cboAtt1 =  $_POST['cboAtt1'];
	
		
	$tmpQuery = " Select count(*) As EmailList FROM Clients ";
	if ($CFlag == 1)
		{
			$tmpQuery .= $Wherecluse;
		}
		//print($tmpQuery);
	$tmpAccs = mysql_query($tmpQuery);
	while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
	 {
		$EmailList = $thisAccs["EmailList"];
	}
	
	$_SESSION['DocumentText'] = $DocumentText;
	
	?>
	<form method="post" action="emailsystem.php?rt=2">
	<table align="center">
	<tr>		
		<td>Number of Emails to Send:</td>
		<td><? echo($EmailList); ?></td>
	</tr>	
	<tr>	
	<td  colspan="6">Only Emails Not Sent for this Document: 
		<input name="chkSent" type="checkbox" id="chkSent" value="NotSent" checked> 
		<input type="hidden" name="sql" value="<? echo($Wherecluse); ?>" />
		<input type="hidden" name="cboDoc" value="<? echo($cboDoc); ?>" />
		
		<input type="hidden" name="cboAtt3" value="<? echo($cboAtt3); ?>" />
		<input type="hidden" name="cboAtt2" value="<? echo($cboAtt2); ?>" />
		<input type="hidden" name="cboAtt1" value="<? echo($cboAtt1); ?>" />
		
		<input type="submit" value="Send Emails" />
	</td>
	</tr>
	</table>
	</form>
	
	<?
}	
 $rt =  $_REQUEST['rt'];
if ($rt==2)
{
	$cboDoc = $_POST['cboDoc'];
	$chkSent = "";
	$sql = $_POST['sql'];
	$cboAtt3 = $_POST['cboAtt3'];
	$cboAtt2 = $_POST['cboAtt2'];
	$cboAtt1 = $_POST['cboAtt1'];
	
		$tmpQuery = "SELECT DocumentTitle, DocumentText";
		$tmpQuery .= " FROM Documents Where Document_ID = " . $cboDoc;
		//print($tmpQuery);
		$tmpAccs = mysql_query($tmpQuery);
	
			while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
	
			$DocumentText = $thisAccs["DocumentText"];
			$DocumentTitle = $thisAccs["DocumentTitle"];
		}
	
	
	$tmpQuery = "SELECT Client_ID, Company, ContactName, Email, ClientPassword ";
	$tmpQuery .= " FROM Clients ";
	if ($sql <>"")
		{
			$tmpQuery .= $sql;
			
		}
	$tmpQuery .= "  order by Company";
	
	//print($tmpQuery);
	$tmpAccs = mysql_query($tmpQuery);
	
	
	?>
	
	
	  <table border="1"  bordercolor="#0000FF" width="980">
	  <?
	  $NoEmailSentCount =0;
	  $NoEmailNotSentCount =0;
	  $EmailSent = 0;
	  // temp_login@blacklinksuk.com/
		while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		 {
		// print($display_two_colums);
	
			$Client_ID = $thisAccs["Client_ID"];
			$Company = $thisAccs["Company"];
			$ContactName = $thisAccs["ContactName"];
			$Email = $thisAccs["Email"];
			$ClientPassword = $thisAccs["ClientPassword"];
			
			$HasEmailBeenSent = EmailSent($cboDoc, $Client_ID);
			if ($HasEmailBeenSent ==0 Or $chkSent =="")
			{
			
				$Success = SendEmail($Company, $ContactName, $Email, $ClientPassword, $DocumentText, $DocumentTitle, $Client_ID, $cboAtt1, $cboAtt2, $cboAtt3 );
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
			}//	 print($sSQL);
		
		}
		?>
		<br/><br/>
		<table align="center">
		<tr>
		<th colspan="2">Email Report</th>
		</tr>
		<tr>
		<td>Emails Sent &nbsp;</td> <td><? echo($NoEmailSentCount); ?></td>
		</tr>
		<tr>
		<td>Emails Not Sent &nbsp;</td> <td><? echo($NoEmailNotSentCount); ?></td>
		</tr>
		</table>
			<?
	}		



function EmailSent($docID, $ClID)
{
	$Sent = 0;
	$tmpQuery = "SELECT Sent";
	$tmpQuery .= " FROM Emails_Sent Where Client_ID = " . $ClID . " And Document_ID = " . $docID ;
//	print($tmpQuery);
	$tmpAccs = mysql_query($tmpQuery);
	while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
	 {
	// print($display_two_colums);

		$Sent = $thisAccs["Sent"];
	}
	return $Sent;	
}
	

?>
	</body>
	</html>					
