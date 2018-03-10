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

<?php 
     
	/* load settings */
	require 'connectdb.php';
	
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

function AddSlot($SlotName, $SlotCount, $ProdName, $ProvidersCompany)
{
	$sSQL = "Insert Into TopSellingSlots ( SlotName, NumberofSales, ProductName, Providername )"; 
	$sSQL .= " Value('" . $SlotName . "', " .$SlotCount  . ", '" . $ProdName . "', '" . $ProvidersCompany . "')";
	//print($sSQL);
	mysql_query($sSQL); 
}
		
if ($_SESSION['AdminUser_ID'] > 0)
{

	?>
		<br/>
	 <form method="post" action="topslots.php?rt=1"  >
	 <table align="center" border="1" >
	 <tr>
	 <th align="center">Select the number of rows to display: <input type="text" name="txtnumrows" id="txtnumrows"></th>
	 </tr>
     <tr>
     <td align="center"><input type="submit" value="Go"></td>
	 </table>
	 </form>
		 <br/>
	<?
	$txtnumrows = 0;
	$rt =  $_REQUEST['rt'];
	if ($rt ==1) 
	{
		$txtnumrows =  $_POST['txtnumrows'];
	}
	if ($txtnumrows > 0)
	{
		?>
		
		<table align="center" border="1">
		  <tr> 
			<th align="center" colspan="4"><font size="+2">Top <? echo($txtnumrows); ?> Selling Slots</font></th>
		  </tr>
		  <tr>
		  <th align='center'>Provider</th><th align='center'>Brand</th>   <th align="center">Slot Name</th><th align="center">Items Sold</th> 
		  <?
		  
			$SlotCount = 0;
			$Loop = 1;
			
			$sSQL = "Delete from TopSellingSlots "; 
			//print($sSQL);
			mysql_query($sSQL); 
		
			$sSQL = " SELECT Slots.SlotName, ProductName, Products.Providers_ID FROM SlotOrdersItems, Slots, Products Where SlotOrdersItems.Slot_ID = Slots.Slot_ID And Slots.Product_ID = Products.Product_ID  Order By Slots.SlotName" ;
			//print($sSQL);
			$tmpAccs = mysql_query($sSQL);
			
			while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
			{
				$SlotName = $thisAccs["SlotName"];
				$ProductName = $thisAccs["ProductName"];
				$Providers_ID = $thisAccs["Providers_ID"];
				$ProviderName = GetProviderName($Providers_ID);
				
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
						AddSlot($thisSlot, $SlotCount, $ProductName, $ProviderName);
						$thisSlot = $SlotName ;			
						$SlotCount = 1;
					}
				}
				
			}
			
			$sSQL = " SELECT SlotName, NumberofSales, Providername, ProductName FROM TopSellingSlots Order By NumberofSales desc LIMIT " . $txtnumrows ;
			//print($sSQL);
			$tmpAccs = mysql_query($sSQL);
			
			while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
			{
				$SlotName = $thisAccs["SlotName"];
				$NumberofSales = $thisAccs["NumberofSales"];
				$Providername = $thisAccs["Providername"];
				$ProductName = $thisAccs["ProductName"];
				echo("<tr>");
				echo("<td align='center'>" . $Providername . "</td>");
				echo("<td align='center'>" . $ProductName . "</td>");
				echo("<td align='center'>" . $SlotName . "</td>");
				echo("<td align='center'>" . $NumberofSales . "</td>");
				echo("</tr>");
			}
			
			?>
		
		
		  <tr> 
			<td align="center" colspan="4"><font size="+2"><a href = "reports.php">back</a></font></td>
		  </tr>
		</table>
	   <?
	}
	
	else
	{
		?>
		<font size="+2"><a href = "reports.php">back</a></font>
       <?
	}

}
else
{
	echo("Login Details Note correct! Please <a href='index.php'>click here</a>");
}		
		
		
		
?>




</body>
</html>