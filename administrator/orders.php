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
<table align="center" border="1">
<tr>
  <th bgcolor="#0000FF" colspan="6"><font size="+2" color="#FFFFFF">Orders &nbsp; <a href="mainmenu.php">back...</a></font> </th>
</tr>
<tr>
<th>Client Name</th> <th>Company</th> <th>Order Date</th> <th>Order Total</th> <th>Processed</th> <th>Select</th>
</tr>
<?php 
if ($_SESSION['AdminUser_ID'] > 0)
{     
	/* load settings */
	require 'connectdb.php';
		

	
$sSQL = "SELECT SlotOrders_ID, SlotOrders.DateCreated, Total, Processed, ClientName, ClientCompany FROM SlotOrders, Clients WHERE  SlotOrders.Client_ID = Clients.Client_ID Order By DateCreated Desc";
	//print($sSQL);
	$tmpAccs = mysql_query($sSQL);
	
	while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
	{
		$SlotOrders_ID = $thisAccs["SlotOrders_ID"];
		$DateCreated = $thisAccs["DateCreated"];
		$Total = $thisAccs["Total"];
		$Processed = $thisAccs["Processed"];
		$ClientName = $thisAccs["ClientName"];
		$ClientCompany = $thisAccs["ClientCompany"];
		
		if($Processed ==0)
		{
			$ProcessedDetails = "Not Processed";
		}
		else
		{
			$ProcessedDetails = "Processed";
		}		
		echo("<tr>");
		echo("<td align='center'>" . $ClientName . "</td>" );
		echo("<td align='center'>" . $ClientCompany . "</td>" );
		echo("<td align='center'>" . $DateCreated  . "</td>" );
		echo("<td align='center'>" . $Total . "</td>" );
		echo("<td align='center'>" . $Processed . "</td>" ); 
		echo("<td align='center'><a href='orderdetails.php?id=" . $SlotOrders_ID . "'>View Order Details</a></td>" ); 
		echo("/<tr>");
	}
?> </table> <?	
}		

else
{
	echo("Login Details Note correct! Please <a href='index.php'>click here</a>");
}		
		
		
		
?>




</body>
</html>