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
	
	 
	$id =  $_REQUEST['id']; // Order ID
	if ($id > 0) 
	{	 
		
		$sSQL = "SELECT DateCreated, Total FROM SlotOrders WHERE  SlotOrders_ID =" .$id ;
		//print($sSQL);
		$tmpAccs = mysql_query($sSQL);
		
		while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
			$DateCreated = $thisAccs["DateCreated"];
			$Total = $thisAccs["Total"];
		}
		
      ?>
		  <table align="center" border="1" bordercolor="#0000FF">
		  <tr>
		  
    <th colspan="4" align="center">Order Details</th>
		  </tr>
		  <tr>
		  <th>Order Date</th>  <th><? echo($DateCreated); ?></th>  <th>Order Total</th> <th><? echo($Total); ?></th>
		  </tr>
	   </table>  
	   <br/>
	   
	   <table align="center" border="1" bordercolor="#0000FF">
	   <tr>
	   <th>Slot Name</th> <th>Slot Description</th> <th>Slot Price</th> <th>Quantity</th> <th>Slot Details</th> <th>Slot Deadline</th> <th>Provider</th>
	   </tr>
		 <?php
		$sSQL = "SELECT  ProvidersCompany, SlotName, SlotDescription, SlotFullSellingPrice, SlotDeadline, SlotSize_ID, SlotTime_ID, Quantity FROM SlotOrdersItems, Slots, Providers WHERE SlotOrdersItems.Slot_ID = Slots.Slot_ID And Slots.Providers_ID = Providers.Providers_ID And SlotOrders_ID =" .$id ;
		//print($sSQL);
		$tmpAccs = mysql_query($sSQL);
		
		while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
			$ProvidersCompany = $thisAccs["ProvidersCompany"];
			$SlotName = $thisAccs["SlotName"];
			$SlotDescription = $thisAccs["SlotDescription"];
			$SlotFullSellingPrice = $thisAccs["SlotFullSellingPrice"];
			$SlotDeadline = $thisAccs["SlotDeadline"];
			$SlotSize_ID = $thisAccs["SlotSize_ID"];
			$SlotTime_ID = $thisAccs["SlotTime_ID"];
			$Quantity = $thisAccs["Quantity"];
			
			If ($_SESSION['ClientPercent'] > 0)
			{
				$PercentNumber =  $_SESSION['ClientPercent'];
				$OnePercent = $SlotFullSellingPrice / 100;
				$DiscountValue = $OnePercent * $PercentNumber;
				$thisSellingPrice = $SlotFullSellingPrice - $DiscountValue;
			}
			else
			{
				$thisSellingPrice = $SlotFullSellingPrice;
			}
			
			if($SlotSize_ID > 0)
			{
				$GetSizename = GetSizename($SlotSize_ID);
			}
			
			if($SlotTime_ID > 0)
			{
				$GetSlotTime = GetSlotTime($SlotTime_ID);
			}
			$SlotDetails = $GetSizename . "&nbsp;" . $GetSlotTime;
			
			echo("<tr>");
			echo("<td  align='center'>". $SlotName  . "</td>");
			echo("<td  align='center'>". $SlotDescription  . "</td>");
			echo("<td  align='center'>". $thisSellingPrice  . "</td>");
			echo("<td  align='center'>". $Quantity  . "</td>");
			echo("<td  align='center'>". $SlotDetails  . "</td>");
			echo("<td  align='center'>". $SlotDeadline  . "</td>");
			echo("<td  align='center'>". $ProvidersCompany  . "</td>");
			echo("</tr>");
		}
		
      } 
	   ?>	
	   <tr>
	   <td colspan="7" align="center"><a href="orders.php">back...</a></td>
	   </tr>  
	    </table>
	

</table>
 <?	
}		

else
{
	echo("Login Details Note correct! Please <a href='index.php'>click here</a>");
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
		
?>




</body>
</html>