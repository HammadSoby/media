<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home | Media United Admin</title>
</head>

<body>
 <?php 
/* load settings */
require 'connectdb.php';
require 'sendemails.php';

function  GetProviderName($Providers_ID)
{
	$sSQL = " SELECT ProvidersCompany FROM Providers Where Providers_ID = " . $Providers_ID;
	//print($sSQL);
	$tmpAccs = mysql_query($sSQL);
	
	while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
	{
		$ProvidersCompany = $thisAccs["ProvidersCompany"];
		
	}
	return $ProvidersCompany;
}

function AddSlot($SlotName, $SlotCount, $ProdID)
{
	$sSQL = "Insert Into SlotsSold ( SlotName, NumberCreated, Product_ID )"; 
	$sSQL .= " Value('" . $SlotName . "', " .$SlotCount  . ", " . $ProdID . " )";
	//print($sSQL);
	mysql_query($sSQL); 
}

function AddNumSold($SlotName, $scount)
{
	$numsold = 0;
	$percent = 0;
	
	$sSQL = " SELECT COUNT(*) as numsold FROM SlotOrdersItems, Slots Where SlotOrdersItems.Slot_ID = Slots.Slot_ID And Slots.SlotName = '" . $SlotName . "' " ;
	//print($sSQL);
	$tmpAccs = mysql_query($sSQL);
	
	while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
	{
		$numsold = $thisAccs["numsold"];
	}
	if ($numsold > 0)
	{
		$percent = ($numsold  / $scount) * 100;
		
	}
	$sSQL = "Update SlotsSold Set NumberSold = " . $numsold . ", PercentSold = " . $percent . " Where SlotName = '" . $SlotName . "'" ; 
	//print($sSQL);
	mysql_query($sSQL); 
	
}

$SlotCount = 0;
$Loop = 1;

$sSQL = "Delete from SlotsSold "; 
//print($sSQL);
mysql_query($sSQL); 

$sSQL = " SELECT Slots.SlotName, Product_ID FROM Slots Order By Slots.SlotName" ;
//print($sSQL);
$tmpAccs = mysql_query($sSQL);

while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
{
	$SlotName = $thisAccs["SlotName"];
	$Product_ID = $thisAccs["Product_ID"];
	
	if ($Loop == 1)
	{
		$thisSlot = $SlotName ;
		$SlotCount = $SlotCount + 1;
		$Loop = 2;
	}
	else
	{
		if ($SlotName == $thisSlot)
		{
			$SlotCount = $SlotCount + 1;
		}
		else
		{
			AddSlot($thisSlot, $SlotCount, $Product_ID);
			AddNumSold($thisSlot,$SlotCount );
			$thisSlot = $SlotName ;			
			$SlotCount = 1;
		}
	}
	
}


?>
	 <form method="post" action="available.php?rt=1"  > 
	 <table align="center" border="1" >
	 <tr>
	 <th align="center">Select the percentage sold from: <input type="text" name="txtfrom" id="txtfrom"> to: <input type="text" name="txtto" id="txtto"></th>
	 </tr>
     <tr>
     <td align="center"><input type="submit" value="Go"></td> 
	 </table>
	 </form>
	 <br/>
     <?
	 $DocumentText = "<table align='center'  border='2'>
     <tr>
     <th align='center' colspan='4'>Slots Sold Percent</th>
     </tr>
     <tr>
     <th align='center'>Provider</th><th align='center'>Brand</th>  <th align='center'>Slot Names</th><th align='center'>Percent Sold </th>
     </tr>
	 ";
     
	
	$txtnumrows = 0;
	$rt =  $_REQUEST['rt'];
	if ($rt ==1) 
	{
		$txtfrom =  $_POST['txtfrom'];
		$txtto =  $_POST['txtto'];
	}
	if ($txtfrom > 0)
	{
		$sSQL = " SELECT SlotName, PercentSold, ProductName, Providers_ID FROM SlotsSold, Products  Where SlotsSold.Product_ID = Products.Product_ID And PercentSold Between " . $txtfrom . " And  " . $txtto . " Order By SlotName" ;
		print($sSQL);
		$tmpAccs = mysql_query($sSQL);
		
		while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
			$SlotName = $thisAccs["SlotName"];
			$PercentSold = $thisAccs["PercentSold"];
			$ProductName = $thisAccs["ProductName"];
			$Providers_ID = $thisAccs["Providers_ID"];
			$ProviderName = GetProviderName($Providers_ID);
			
			$DocumentText =  $DocumentText . "<tr>";
			$DocumentText =  $DocumentText . "<td align='center'>" . $ProviderName .  "</td>";
			$DocumentText =  $DocumentText . "<td align='center'>" . $ProductName .  "</td>";
			$DocumentText =  $DocumentText . "<td align='center'>" . $SlotName .  "</td>";
			$DocumentText =  $DocumentText . "<td align='center'>" . $PercentSold .  "&#37 </td>";
			$DocumentText =  $DocumentText . "</tr>";
		}
		$DocumentText =  $DocumentText . "</table><br/>";
		$to = "admin@mediaunited.co.uk "; 
		

		$DocumentTitle = "Slot Availability" ;
		$Success = SendEmail( $to,  $DocumentText, $DocumentTitle ); 
		if ($Success == "Yes")
		{
			?>
            <p align="center">Email Sent</p>
            <?
		}
		else
		{
			?>
            <p align="center">Email Not Sent</p>
            <?
		}
	}
	?>
		<p align="center"><font size="+2"><a href = "reports.php">back</a></font></p>

</body>
</html>