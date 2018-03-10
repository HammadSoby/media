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
if ($_SESSION['AdminUser_ID'] > 0)
{  
	$memID = 0;  
	/* load settings */
	require 'connectdb.php';
	$upd =  $_REQUEST['upd'];
	if ($upd ==1) 
	{
		$txtName =  $_POST['txtName'];
		$txtComp =  $_POST['txtComp'];
		$txtNumber =  $_POST['txtNumber'];
		$optMedia =  $_POST['optMedia'];
		$memID =  $_POST['memID'];
		$txtEmail =  $_POST['txtEmail'];
		
		
		$sSQL = "UPDATE  Providers Set ProvidersName ='" .  $txtName . "', ProvidersCompany = '" . $txtComp . "', ProvidersNumber = '" .  $txtNumber . "', MediaType_ID = " .  $optMedia . ", ProvidersEmail = '" . $txtEmail . "' Where Providers_ID = " . $memID; 
		mysql_query($sSQL);
	}	
	$id =  $_REQUEST['id'];
	
	if ($id == 0 And $memID > 0)
	{
		$id = $memID;
	}
	
	if ($id > 0) 
	{

	//	$txtEmail =  $_POST['txtEmail'];
	//	$txtPass =  $_POST['txtPassword'];
		
		$sSQL = "SELECT  Providers_ID, ProvidersName, ProvidersCompany, ProvidersEmail, ProvidersNumber, MediaType_ID FROM Providers Where Providers_ID ="  .$id ;
		//print($sSQL);
		$tmpAccs = mysql_query($sSQL);
		
		while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
			$ProvidersName = $thisAccs["ProvidersName"];
			$ProvidersCompany = $thisAccs["ProvidersCompany"];
			$ProvidersNumber = $thisAccs["ProvidersNumber"];
			$MediaType_ID = $thisAccs["MediaType_ID"];
			$ProvidersEmail = $thisAccs["ProvidersEmail"];
			$_SESSION['CurrentMediaType_ID'] = $MediaType_ID;
		}
		?> 
		
		
		<br/> <br/>
		<table align="center"> 
		<tr>
		<th><a href="slotsizes.php?pid=<? echo($id); ?>">Configure Slot Sizes</a> </th> <th><a href="slottimes.php?pid=<? echo($id); ?>">Configure Slot Times </a></th> <th><a href="productiondates.php?pid=<? echo($id); ?>">Set Production Dates</a></th>
		</tr>
		</table>
		<br/> <br/>
	<form action="provider.php?upd=1"	 method="post">
	<table align="center" border="1">
	<tr>
	  <th bgcolor="#0000FF" colspan="5"><font size="+2"><font color="#FFFFFF">Provider Details</font></font></th>
	</tr>
	<tr>
		
    <td><font size="+1">Provider Name:</font></td>
    <td><input type="text" name="txtName" value="<? echo($ProvidersName); ?>"/></td>
		</tr>
		<tr>
		
    <td><font size="+1">Provider Company:</font></td>
    <td><input type="text" name="txtComp" value="<? echo($ProvidersCompany); ?>"/></td>
		</tr>
		<tr>
    <td><font size="+1">Provider Email:</font></td>
    <td><input type="text" name="txtEmail" value="<? echo($ProvidersEmail); ?>" /></td>
		</tr>
		
		<tr>
		
    <td><font size="+1">Provider Number:</font></td>
    <td><input type="text" name="txtNumber" value="<? echo($ProvidersNumber); ?>"/></td>
		</tr>
		<tr>
		
    <td><font size="+1">Media Type:</font></td>
      <td> <select name="optMedia">
	  <?
		$sSQL = "SELECT MediaType_ID, MediaTypeName FROM MediaTypes " ;
		//print($sSQL);
		$tmpAccs = mysql_query($sSQL);
		
		while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
			$thisMediaType_ID = $thisAccs["MediaType_ID"];
			$MediaTypeName = $thisAccs["MediaTypeName"];
			if($MediaType_ID == $thisMediaType_ID)
			{
				echo("<option value='" . $thisMediaType_ID . "' Selected>" . $MediaTypeName . "</option>");
			}
			else
			{
				echo("<option value='" . $thisMediaType_ID . "'>" . $MediaTypeName . "</option>");
			}
		}	
	  ?>
          
		  
        </select> </td>
	
		</tr>
		<tr>
			<td  align="center"><input type="submit" name="Submit" value="Save"></td><td align="center"><a href="providers.php">back...</a></td>
		</tr>
		</table> 
		<input type="hidden" name="memID" value="<? echo($id); ?>" />
		</form>
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