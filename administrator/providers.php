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
	<p align="center"><a href="addprov.php">Add New Provider</a> &nbsp; <a href="mainmenu.php">back...</a></p>
	<br/>
	<table align="center" border="1">
	<tr>
	  <th bgcolor="#0000FF" colspan="7"><font size="+2"><font color="#FFFFFF">Providers</font></font></th>
	</tr>
	<tr>
	<th>Provider Name</th> <th>Provider Company</th> <th>Provider Email</th> <th>Provider Number</th> <th>Media Type</th> <th>Select To Edit</th> <th>View Slots</th>
	</tr>
	<? 
	/* load settings */
	require 'connectdb.php';
	
	$ins =  $_REQUEST['ins'];
	if ($ins ==1) 
	{
		$txtName =  $_POST['txtName'];
		$txtComp =  $_POST['txtComp'];
		$txtNumber =  $_POST['txtNumber'];
		$optMedia =  $_POST['optMedia'];		
		$txtAddress =  $_POST['txtAddress'];
		$txtPostcode =  $_POST['txtPostcode'];
		$txtPassword =  $_POST['txtPassword'];
		$txtEmail =  $_POST['txtEmail'];
		
		$sSQL = "Insert Into Providers ( ProvidersName , ProvidersCompany , ProvidersNumber , MediaType_ID, ProvidersAddress, ProvidersPostcode, ProvidersPassword, ProvidersEmail )"; 
		$sSQL .= " Value('" . $txtName . "','" . $txtComp . "','" .  $txtNumber . "'," .  $optMedia . ",'" .  $txtAddress . "','" .  $txtPostcode . "','" .  $txtPassword . "','" .  $txtEmail . "')";
		//print($sSQL);
		mysql_query($sSQL);
	}	
	
	$sSQL = "SELECT Providers_ID, ProvidersName, ProvidersCompany, ProvidersEmail, ProvidersNumber, MediaTypeName FROM Providers, MediaTypes Where Providers.MediaType_ID = MediaTypes.MediaType_ID Order By ProvidersName" ;
	//print($sSQL);
	$tmpAccs = mysql_query($sSQL);
	
	while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
	{
		$Providers_ID = $thisAccs["Providers_ID"];
		$ProvidersName = $thisAccs["ProvidersName"];
		$ProvidersCompany = $thisAccs["ProvidersCompany"];
		$ProvidersNumber = $thisAccs["ProvidersNumber"];
		$MediaTypeName = $thisAccs["MediaTypeName"];
		$ProvidersEmail = $thisAccs["ProvidersEmail"];
		
		echo("<tr>");
		echo("<td align='center'>" . $ProvidersName . "</td>" );
		echo("<td align='center'>" . $ProvidersCompany . "</td>" );
		echo("<td align='center'>" . $ProvidersEmail  . "</td>" );
		echo("<td align='center'>" . $ProvidersNumber  . "</td>" );
		
		echo("<td align='center'>" . $MediaTypeName . "</td>" );
		echo("<td align='center'><a href = 'provider.php?id=" . $Providers_ID . "'>Select</a></td>" );
		echo("<td align='center'><a href = 'slots.php?id=" . $Providers_ID . "'>View</a></td>" );
		echo("</tr>");
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