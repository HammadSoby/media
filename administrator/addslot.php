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
<br/> <br/>
<?php 
if ($_SESSION['AdminUser_ID'] > 0)
{     
	/* load settings */
	require 'connectdb.php';

?>
		<br/> <br/>
		<table align="center"> 
		</tr>
		</table>
		<br/> <br/>
	<form action="slots.php?ins=1"	 method="post">
	<table align="center" border="1">
	<tr>
	  <th bgcolor="#0000FF" colspan="5"><font size="+2"><font color="#FFFFFF">Create Slot</font></font></th>
	</tr>
	<tr>
		
    <td><font size="+1">Slot Name:</font></td>
    <td><input type="text" name="txtName"/></td>
		</tr>
		<tr>
		
    <td><font size="+1">Slot Description:</font></td>
    <td><input type="text" name="txtDescription" /></td>
		</tr>
		<tr>
    <td><font size="+1">Cost Price:</font></td>
    <td><input type="text" name="txtSlotCostPrice"  /></td>
		</tr>
		
		<tr>
		
    <td><font size="+1">Full Selling Price:</font></td>
    <td><input type="text" name="txtSlotFullSellingPrice" /></td>
		</tr>
		
	<tr>
		
    <td><font size="+1">Quantity:</font></td>
    <td><input type="text" name="txtSlotQuantity" /></td>
		</tr>
		<tr>
		
    <td><font size="+1">Reorder Level:</font></td>
    <td><input type="text" name="txtSlotReorderLevel" /></td>
		</tr>
		<tr>
    <td><font size="+1">Amount to Reorder:</font></td>
    <td><input type="text" name="txtSlotReorderAmount"  /></td>
		</tr>
	<?
	if ($_SESSION['CurrentMediaType_ID'] > 3)
	{
	?>	
<tr>
		
      <td><font size="+1">Select Location Type for Slot:</font></td>
    <td><select name="cboLocations">
	<option value='0'>Select Location  </option>
	<?
		$sSQL = "SELECT DISTINCT LocationType.LocationType_ID, LocationTypeName, Location, ProviderLocation_ID FROM  LocationType, ProviderLocations Where LocationType.LocationType_ID = ProviderLocations.LocationType_ID And ProviderLocations.Providers_ID =" . $_SESSION['CurrentProvider_ID'] ;
		//print($sSQL);
		$tmpAccs = mysql_query($sSQL);
		
		while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
			$LocationTypeName = $thisAccs["LocationTypeName"];
			$ProviderLocation_ID = $thisAccs["ProviderLocation_ID"];
			$Location = $thisAccs["Location"];
			echo("<option value=" . $ProviderLocation_ID  . ">" . $LocationTypeName . " - " . $Location . "</option>");
		}	 
	 ?>
            </select> </td>
		</tr>
		<?
		}
		?>
		
		<tr>
		
    <td><font size="+1">Select Production Date for Slot:</font></td>
    <td><select name="cboDates">
	<option value='0'>Create Slot for All Dates</option>
	<?
		$sSQL = "SELECT Date_ID, ProductionDate FROM ProductionDates Where Provider_ID =" . $_SESSION['CurrentProvider_ID'] ;
		//print($sSQL);
		$tmpAccs = mysql_query($sSQL);
		
		while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
			$ProductionDate = $thisAccs["ProductionDate"];
			$Date_ID = $thisAccs["Date_ID"];
			echo("<option value='" . $Date_ID  . "'>" . $ProductionDate  . "</option>");
		}	 
	 ?>
            </select> </td>
		</tr>
		
		
	  <?
	  	
		$iloop = 1;
		$sSQL = "SELECT SlotTime_ID, SlotTime FROM SlotTimes Where Providers_ID =" . $_SESSION['CurrentProvider_ID'] ;
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
			
			echo("<option value='" . $thisSlotTime_ID . "'>" . $SlotTime . "</option>");
        	
		}
		if($iloop == 2)
		{
			echo("</select> </td>	</tr>");
		}
		
		$iloop = 1;
		$sSQL = "SELECT SlotSize_ID, SlotSize FROM  SlotSizes Where Providers_ID =" . $_SESSION['CurrentProvider_ID'] ;
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
			
			echo("<option value='" . $ThisSlotSize_ID . "'>" . $SlotSize . "</option>");
			
        	
		}	
		
		if($iloop == 2)
		{
			echo("</select> </td>	</tr>");
		}
	  ?>
          
		  
		<tr>
			<td colspan="2" align="center"><input type="submit" name="Submit" value="Save"></td>
		</tr>
		</table> 
		<input type="hidden" name="memID" value="<? echo($id); ?>" />
		</form>
		<?	
	
}		

else
{
	echo("Login Details Note correct! Please <a href='index.php'>click here</a>");
}		
	

		
		
?>




</body>
</html>