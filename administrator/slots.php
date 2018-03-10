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

	?>
	<p align="center"><a href="addslot.php">Add New Slot</a>   &nbsp; <a href="provider.php?id=<? echo($_SESSION['CurrentProvider_ID']); ?>">back...</a></p>
	<br/>
	<table align="center" border="1">
	<tr>
	  <th bgcolor="#0000FF" colspan="8"><font size="+2"><font color="#FFFFFF">Provider's Slots</font></font></th>
	</tr>
	<tr>
	<th>Slot Name</th> <th>Slot Description</th> <th>Slot Cost Price</th> <th>Slot Full Selling Price</th> <th>Slot Quantity</th> <th>Slot Details</th> <th>Slot Deadline </th> <th>Select To Edit</th>
	</tr>
	<? 
	/* load settings */
	require 'connectdb.php';
	
	$ins =  $_REQUEST['ins'];
	if ($ins ==1) 
	{
	
		$optTimes = 0;
		$optionSize = 0;
		$txtName =  $_POST['txtName'];
		$txtDescription =  $_POST['txtDescription'];
		$txtSlotCostPrice =  $_POST['txtSlotCostPrice'];
		$txtSlotFullSellingPrice =  $_POST['txtSlotFullSellingPrice'];
		
		$cboLocations =  $_POST['cboLocations'];
		$memID =  $_POST['memID'];
		
		$txtSlotQuantity =  $_POST['txtSlotQuantity'];
		$txtSlotReorderLevel =  $_POST['txtSlotReorderLevel'];
		$txtSlotReorderAmount =  $_POST['txtSlotReorderAmount'];
		
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
		
		$cboDates =  $_POST['cboDates'];
		//print("Here" .$cboDates );
		if($cboDates > 0)
		{
			$SelectedDate = getSDate($cboDates);
			$txtSlotDeadline = date("Y-m-d", strtotime($SelectedDate . " -7 days")); 
			
			$sSQL = "Insert Into Slots ( SlotName , SlotDescription , SlotCostPrice, SlotFullSellingPrice, SlotQuantity, SlotReorderLevel, SlotReorderAmount, SlotDeadline, SlotSize_ID, SlotTime_ID, Providers_ID, Locations )"; 
			$sSQL .= " Value('" . $txtName . "','" . $txtDescription . "'," .  $txtSlotCostPrice . "," .  $txtSlotFullSellingPrice . "," .  $txtSlotQuantity . "," .  $txtSlotReorderLevel . "," .  $txtSlotReorderAmount . ",'" .  $txtSlotDeadline . "'," . $optionSize . "," . $optTimes . "," . $_SESSION['CurrentProvider_ID'] ."," . $cboLocations . " )";
			//print($sSQL);
			mysql_query($sSQL); 
			
		}
		else
		{
			$sSQL = "SELECT ProductionDate FROM ProductionDates Where Provider_ID	 ="  . $_SESSION['CurrentProvider_ID'] ;
			//print($sSQL);
			$tmpAccs = mysql_query($sSQL);
			
			while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
			{
				$ProductionDate = $thisAccs["ProductionDate"];
				$txtSlotDeadline = date("Y-m-d", strtotime($ProductionDate . " -10 days")); 
				
				$sSQL = "Insert Into Slots ( SlotName , SlotDescription , SlotCostPrice, SlotFullSellingPrice, SlotQuantity, SlotReorderLevel, SlotReorderAmount, SlotDeadline, SlotSize_ID, SlotTime_ID, Providers_ID, Locations )"; 
				$sSQL .= " Value('" . $txtName . "','" . $txtDescription . "'," .  $txtSlotCostPrice . "," .  $txtSlotFullSellingPrice . "," .  $txtSlotQuantity . "," .  $txtSlotReorderLevel . "," .  $txtSlotReorderAmount . ",'" .  $txtSlotDeadline . "'," . $optionSize . "," . $optTimes . "," . $_SESSION['CurrentProvider_ID'] ."," . $cboLocations ." )";
				//print($sSQL);
				mysql_query($sSQL); 
				
			}
			
		}	
	}	
	
	$id =  $_REQUEST['id'];
	
	if($id >0 )
	{
		$_SESSION['CurrentProvider_ID'] = $id;
	}
	else
	{
		$id = $_SESSION['CurrentProvider_ID'] ;
	}
	

	
	if ($id >0) 
	{
	
		$_SESSION['CurrentMediaType_ID'] = GetMediaType($id);
		
		$sSQL = "SELECT Slot_ID, SlotName, SlotDescription, SlotCostPrice, SlotFullSellingPrice, SlotQuantity, SlotDeadline, SlotSize_ID, SlotTime_ID FROM Slots Where Providers_ID = " . $id . " Order By SlotName" ;
		//print($sSQL);
		$tmpAccs = mysql_query($sSQL);
		
		while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
			$Slot_ID = $thisAccs["Slot_ID"];
			$SlotName = $thisAccs["SlotName"];
			$SlotDescription = $thisAccs["SlotDescription"];
			$SlotCostPrice = $thisAccs["SlotCostPrice"];
			$SlotFullSellingPrice = $thisAccs["SlotFullSellingPrice"];
			$SlotQuantity = $thisAccs["SlotQuantity"];
			$SlotDeadline = $thisAccs["SlotDeadline"];
			$SlotSize_ID = $thisAccs["SlotSize_ID"];
			$SlotTime_ID = $thisAccs["SlotTime_ID"];
			
			echo("<tr>");
			echo("<td align='center'>" . $SlotName . "</td>" );
			echo("<td align='center'>" . $SlotDescription . "</td>" );
			echo("<td align='center'>" . $SlotCostPrice  . "</td>" );
			echo("<td align='center'>" . $SlotFullSellingPrice  . "</td>" );
			echo("<td align='center'>" . $SlotQuantity  . "</td>" );
			
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
			echo("<td align='center'>" . $SlotDeadline . "</td>" );
			
			
			echo("<td align='center'><a href = 'slot.php?id=" . $Slot_ID . "'>Select</a></td>" );
			echo("</tr>");
		}	
	}
	?> </table> <?	
}		

else
{
	echo("Login Details Note correct! Please <a href='index.php'>click here</a>");
}		

		
function GetMediaType($ProdID)		
{
		$sSQL = "SELECT MediaType_ID FROM Providers Where Providers_ID = " . $ProdID ;
		//print($sSQL);
		$tmpAccs = mysql_query($sSQL);
		
		while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
			$MediaType_ID = $thisAccs["MediaType_ID"];
		}	
		return $MediaType_ID;

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