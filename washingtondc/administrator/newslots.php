<?session_start();?>
<!DOCTYPE html>
<head>
	<title>Home | Media United Admin</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"  name="viewport" content="width=device-width,initial-scale=1.0">
<style>@import url(http://fonts.googleapis.com/css?family=Open+Sans:400,700);</style>

<style>
body{
	padding:0px;
	margin:0px;
	background:  #E5E5E5;
}
#menu{
	padding:0px; 
	margin:0px;
	background: #353535;
	color:white;
	text-align: center;
}
#menu li a {
	color:white;
	font-family: "open sans";
	text-decoration: none;
	padding-left: 20px;
	padding-right: 20px;
	font-size: 13px;

}
#menu li {
	display: inline-block;
	padding-top: 1%;
	padding-bottom: 1%;

}
#menu li:hover{
	background: #006699;
	cursor: pointer;

}
#tit{
	margin-left: 10%;
	font-family: "open sans";
	font-size:25px;
	color:#353535;
	border-bottom:1px dashed #353535;
	width: 60%;
	padding-left: 1%;
	padding-bottom: 2%;
}
#manage{
	list-style: none;
	padding:0px;
	margin:0px;
	color:#353535;
	font-family: "open sans";
	font-size: 15px;
	width: 70%;
	text-align: left;
	margin-left: 10%;
	padding-left: 1%;
	border-bottom:1px dashed #353535;

	
}
#manage li {
	
	padding:0px; 
	padding-left: 1%;
	padding-top: 1%;
	text-align: left;
	padding-bottom: 1%;
	

	
}
#manage li a {
	color:white;
	background: #F96E5B;
	text-decoration: none;
	padding-top: 3.5%;
	padding-bottom: 3.5%;
	padding-left: 50%;
	padding-right: 50%;
	border-radius: 6px;
	width: 10%;
}
#manage li a:hover{
	opacity: 0.7;
	transition:1s;
	cursor: pointer;
}
#banner{
	width: 100%;
	background: #F96E5B;
	height: 13%;
	padding-top: 1%;
}
#banner span{
	color:white;
	font-weight:100;
	font-family: "open sans";
	font-size: 38px;
	margin-left: 10%;
	background-image: url("https://cdn2.iconfinder.com/data/icons/business-charts/512/service-128.png");
	background-repeat: no-repeat;
	padding-left: 12%;
	padding-bottom: 10%;
}
#role{

}
#done{
	color:green;
	font-family: "open sans";
	font-size: 14px;
}
#help{
	margin-left: 10%;
	font-family: "open sans";
}
</style>
</head>
<body>
	<div id="banner">
		<span>Media United Admin Panel</span>
	</div>
<ul id="menu">
	<li><a href="manage.php?type=clients">Clients</a></li>
	<li><a href="manage.php?type=ra">Radio Adverstising </a> </li>
	<li><a href="manage.php?type=ta">Tv Channel Adverstising </a> </li>
	<li><a href="manage.php?type=pa">Print Adverstising </a></li>
	<li><a href="manage.php?type=slots">Slots </a></li>
	<li><a href="manage.php?type=providers">Providers </a></li>
</ul>
<br/> <br/>
<?php 
if ($_SESSION['AdminUser_ID'] > 0)
{    



	/* load settings */
	require 'connectdb.php';
	$upd =  $_REQUEST['upd'];
	if ($upd ==1) 
	{
		$optTimes = 0;
		$optionSize = 0;
		$txtName =  $_POST['txtName'];
		$txtDescription =  $_POST['txtDescription'];
		$txtSlotCostPrice =  $_POST['txtSlotCostPrice'];
		$txtSlotFullSellingPrice =  $_POST['txtSlotFullSellingPrice'];
		
		$optUpdate =  $_POST['optUpdate'];
		$txtLive =  $_POST['txtLive'];
	
		
		$slotID =  $_POST['slotID'];
		$providerID =  $_POST['providerID'];
		
		$txtSlotQuantity =  $_POST['txtSlotQuantity'];
		$txtSlotReorderLevel =  $_POST['txtSlotReorderLevel'];
		$txtSlotReorderAmount =  $_POST['txtSlotReorderAmount'];
		$txtSlotDeadline =  $_POST['txtSlotDeadline'];
		$optTimes =  $_POST['optTimes'];
		$optionSize =  $_POST['optionSize'];
		
		if(!$optTimes >0)
		{
			$optTimes = 0;
		}
		
		if(!$optionSize >0)
		{
			$optionSize = 0;
		}
		
		if ($txtLive =="Y")
		{
			$Live = 1;
		}
		else
		{
			$Live = 0;
		}
		
		if ($optUpdate =="one")
		{		
			$sSQL = "UPDATE  Slots Set SlotName ='" .  $txtName . "', SlotDescription = '" . $txtDescription . "', SlotCostPrice = " .  $txtSlotCostPrice . ", SlotFullSellingPrice = " .  $txtSlotFullSellingPrice . ", SlotDeadline = '" . $txtSlotDeadline . "', SlotSize_ID = " .$optionSize . ", SlotTime_ID = " .$optTimes . ", Live = " . $Live . "  Where Slot_ID = " . $slotID; 
		}
		else
		{
			$sSQL = "UPDATE  Slots Set SlotName ='" .  $txtName . "', SlotDescription = '" . $txtDescription . "', SlotCostPrice = " .  $txtSlotCostPrice . ", SlotFullSellingPrice = " .  $txtSlotFullSellingPrice . ", SlotSize_ID = " .$optionSize . ", SlotTime_ID = " .$optTimes . ", Live = " . $Live . "  Where Providers_ID = " . $providerID . " And  SlotName = '" . $txtName . "' And  SlotDescription = '" . $txtDescription . "' And SlotCostPrice = " . $txtSlotCostPrice ; 
		}
		//print($sSQL);
		mysql_query($sSQL);
		
	}	
	
	
	$pro =  $_REQUEST['pro'];
	if ($pro <>"") 
	{
	$Des =  $_REQUEST['Des'];
	$Cst =  $_REQUEST['Cst'];
	$Slt =  $_REQUEST['Slt'];
	

		
	?>
	<br/>
	<? 
		$sSQL = "SELECT Slots.Providers_ID, Slot_ID, SlotName, SlotDescription, SlotCostPrice, SlotFullSellingPrice, SlotSize_ID, SlotTime_ID, SlotDeadline FROM Slots, Providers Where Slots.Providers_ID = Providers.Providers_ID And SlotName = '" . $Slt . "'  And ProvidersCompany = '" . $pro . "' And SlotDescription = '" . $Des . "' And SlotCostPrice = " . $Cst . " And Live = 0 Order By Slot_ID Limit 1" ;
		//print($sSQL);
		$tmpAccs = mysql_query($sSQL);
		
		while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
			//$Slot_ID = $thisAccs["Slot_ID"];
			$SlotName = $thisAccs["SlotName"];
			$SlotDescription = $thisAccs["SlotDescription"];
			$SlotCostPrice = $thisAccs["SlotCostPrice"];
			$SlotSize_ID = $thisAccs["SlotSize_ID"];
			$SlotTime_ID = $thisAccs["SlotTime_ID"];
			$SlotFullSellingPrice = $thisAccs["SlotFullSellingPrice"];
			$Slot_ID = $thisAccs["Slot_ID"];
			$SlotDeadline = $thisAccs["SlotDeadline"];
			$Providers_ID = $thisAccs["Providers_ID"];
		}	
		$ProID =  GetProviderID($pro);
	?>  
	<form action="newslots.php?upd=1"	 method="post">
	<table align="center" border="1">
	<tr>
	  <th bgcolor="#0000FF" colspan="5"><font size="+2"><font color="#FFFFFF">Slot Details</font></font></th>
	</tr>
	<tr>
		
    <td><font size="+1">Slot Name:</font></td>
    <td><input type="text" name="txtName" value="<? echo($SlotName); ?>"/></td>
		</tr>
		<tr>
		
    <td><font size="+1">Slot Description:</font></td>
    <td><input type="text" name="txtDescription" value="<? echo($SlotDescription); ?>"/></td>
		</tr>
		<tr>
    <td><font size="+1">Cost Price:</font></td>
    <td><input type="text" name="txtSlotCostPrice" value="<? echo($SlotCostPrice); ?>" /></td>
		</tr>
		
		
    <tr> 
      <td><font size="+1">Full Selling Price:</font></td>
    <td><input type="text" name="txtSlotFullSellingPrice" value="<? echo($SlotFullSellingPrice); ?>"/></td>
		</tr>
		
		
		<tr>
		
    <td><font size="+1">Slot Deadline:</font></td>
    <td><input type="text" name="txtSlotDeadline" value="<? echo($SlotDeadline); ?>"/></td>
		</tr>
		
	  	<?
		$iloop = 1;
		$sSQL = "SELECT SlotTime_ID, SlotTime FROM SlotTimes Where Providers_ID =" . $ProID ;
		//print($sSQL);
		$tmpAccs = mysql_query($sSQL);
		
		while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
			if ($iloop == 1)
			{
				echo("<tr>");		
				echo("<td><font size='+1'>Slot  Times:</font></td>");
				echo("<td> <select name='optTimes'>");
				$iloop = 2;
			}
			$thisSlotTime_ID = $thisAccs["SlotTime_ID"];
			$SlotTime = $thisAccs["SlotTime"];
			
			if($SlotTime_ID == $thisSlotTime_ID)
			{
				echo("<option value='" . $thisSlotTime_ID . "' Selected>" . $SlotTime . "</option>");
			}
			else
			{
				echo("<option value='" . $thisSlotTime_ID . "'>" . $SlotTime . "</option>");
			}
        	
		}
		if($iloop == 2)
		{
			echo("</select> </td>	</tr>");
		}
		
		$iloop = 1;
		$sSQL = "SELECT SlotSize_ID, SlotSize FROM  SlotSizes Where Providers_ID =" . $ProID ;
		//print($sSQL);
		$tmpAccs = mysql_query($sSQL);
		
		while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
			if ($iloop == 1)
			{
				echo("<tr>");		
				echo("<td><font size='+1'>Slot  Size:</font></td>");
				echo("<td> <select name='optionSize'>");
				$iloop = 2;
			}
			
			$ThisSlotSize_ID = $thisAccs["SlotSize_ID"];
			$SlotSize = $thisAccs["SlotSize"];
			
			if($SlotSize_ID == $ThisSlotSize_ID)
			{
				echo("<option value='" . $ThisSlotSize_ID . "' Selected>" . $SlotSize . "</option>");
			}
			else
			{
				echo("<option value='" . $ThisSlotSize_ID . "'>" . $SlotSize . "</option>");
			}
        	
		}	
		
		if($iloop == 2)
		{
			echo("</select> </td>	</tr>");
		}
	  ?>
		<tr>
		
    <td><font size="+1">Set to Live:</font></td>
    <td><input type="checkbox" name = "txtLive" value="Y" checked /></td>
		</tr>
	  
		<tr>
      <td><font size="+1">Update Options:</font></td>
      <td><select name="optUpdate" id="optUpdate">
          <option value="one">This Slot Only</option>
          <option value="all">All Occurrences</option>
        </select></td>
		</tr>
		<tr>
			<td align="center"><input type="submit" name="Submit" value="Save"></td><td align="center"><a href="mainmenu.php">back...</a></td>
		</tr>
		</table> 
		<input type="hidden" name="slotID" value="<? echo($Slot_ID); ?>" />
		<input type="hidden" name="providerID" value="<? echo($Providers_ID); ?>" />
		</form>
	<?	
	die("");
	
}	

	?>
	<br/>
	<table align="center" border="1">
	<tr>
	  <th bgcolor="#0000FF" colspan="8"><font size="+2"><font color="#FFFFFF">New Slots</font></font></th>
	</tr>
	<tr>
	 <th>Slot Name</th> <th>Slot Description</th> <th>Slot Cost Price</th> <th>Slot Details</th> <th>Provider Name</th>
	</tr>
	<? 
		$sSQL = "SELECT DISTINCT ProvidersCompany, SlotName, SlotDescription, SlotCostPrice, SlotSize_ID, SlotTime_ID FROM Slots, Providers Where Slots.Providers_ID = Providers.Providers_ID And Live = 0 Order By ProvidersName" ;
		//print($sSQL);
		$tmpAccs = mysql_query($sSQL);
		
		while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
			//$Slot_ID = $thisAccs["Slot_ID"];
			$SlotName = $thisAccs["SlotName"];
			$SlotDescription = $thisAccs["SlotDescription"];
			$SlotCostPrice = $thisAccs["SlotCostPrice"];
			$SlotSize_ID = $thisAccs["SlotSize_ID"];
			$SlotTime_ID = $thisAccs["SlotTime_ID"];
			$ProvidersName = $thisAccs["ProvidersCompany"];
			
			echo("<tr>");
			echo("<td align='center'> <a href = 'newslots.php?pro=" . $ProvidersName . "&Slt=" .  $SlotName ."&Des=" .  $SlotDescription ."&Cst=" .  $SlotCostPrice . "'>". $SlotName ." </a></td>" );
			
			echo("<td align='center'>" . $SlotDescription . "</td>" );
			echo("<td align='center'>" . $SlotCostPrice  . "</td>" );
			
			if($SlotSize_ID > 0)
			{
				$GetSizename = GetSizename($SlotSize_ID);
			}
			
			if($SlotTime_ID > 0)
			{
				$GetSlotTime = GetSlotTime($SlotTime_ID);
			}
			$SlotDetails = $GetSizename . "&nbsp;" . $GetSlotTime;
			echo("<td align='center'>" . $SlotDetails . "</td>" );
			echo("<td align='center'>" . $ProvidersName . "</td>" );
			
			echo("</tr>");
		}	
	?> </table> <?	
}		

else
{
	echo("Login Details Note correct! Please <a href='index.php'>click here</a>");
}		
		
function GetProviderID($sdName)		
{
		$sSQL = "SELECT Providers_ID FROM Providers Where ProvidersCompany = '" . $sdName . "'" ;
		//print($sSQL);
		$tmpAccs = mysql_query($sSQL);
		
		while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
			$Providers_ID = $thisAccs["Providers_ID"];
		}	
		return $Providers_ID;

}
		
function GetSizename($sdID)		
{
		$sSQL = "SELECT SlotSize FROM SlotSizes Where SlotSize_ID = " . $sdID ;
		//print($sSQL);
		$tmpAccs = mysql_query($sSQL);
		
		while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
			$SlotSize = $thisAccs["SlotSize"];
		}	
		return $SlotSize;

}

function GetSlotTime($sdID)		
{
		$sSQL = "SELECT SlotTime FROM SlotTimes Where SlotTime_ID = " . $sdID ;
		//print($sSQL);
		$tmpAccs = mysql_query($sSQL);
		
		while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
			$SlotTime = $thisAccs["SlotTime"];
		}	
		return $SlotTime;

}

function getSDate($cDates)
{
		$sSQL = "SELECT ProductionDate FROM ProductionDates Where Date_ID =" . $cDates ;
		//print($sSQL);
		$tmpAccs = mysql_query($sSQL);
		
		while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
			$ProductionDate = $thisAccs["ProductionDate"];
		}
		return $ProductionDate;
}	

?>




</body>
</html>