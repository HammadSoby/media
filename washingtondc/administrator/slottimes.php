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
	
	$ins =  $_REQUEST['ins'];
	if ($ins ==1) 
	{
		$txtSlot =  $_POST['txtSlot'];
		$txtpid =  $_POST['txtpid'];
		
		$sSQL = "Insert Into SlotTimes ( Providers_ID , SlotTime )"; 
		$sSQL .= " Value(" . $txtpid . ",'" . $txtSlot . "')";
		//print($sSQL);
		mysql_query($sSQL);
	}	
	
	$pid =  $_REQUEST['pid'];
	
	if ($pid == 0 And  $txtpid > 0)
	{
		$pid =  $txtpid;
	}
	
	if ($pid > 0 )
	{
	?>
		<br/> <br/>
	<form action="slottimes.php?ins=1"	 method="post">
	<table align="center" border="1">
	<tr>
	  <th bgcolor="#0000FF" colspan="5"><font size="+2"><font color="#FFFFFF">Provider 
        Slot Times</font></font></th>
	</tr>
	<tr>
		
    <td><font size="+1"> Slot Time:</font></td>
    <td><input type="text" name="txtSlot" /></td>
		</tr>
		<tr>
			<td colspan="2" align="center"><input type="submit" name="Submit" value="Add"></td>
		</tr>
		</table> 
		<input type="hidden" name="txtpid" value="<? echo($pid); ?>"/>
		</form>
		<br/> <br/>
		<table align="center"  border="1">
		<tr>
		<th>Current Slot Times</th>
		</tr>
		
		
		<?	
		$sSQL = "SELECT SlotTime_ID, SlotTime FROM SlotTimes Where Providers_ID	 ="  .$pid ;
		//print($sSQL);
		$tmpAccs = mysql_query($sSQL);
		
		while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
			$SlotTime_ID = $thisAccs["SlotTime_ID"];
			$SlotTime = $thisAccs["SlotTime"];
			echo("<tr>");
			echo("<td>" . $SlotTime . "</td>");
			echo("</tr>");
		}
		?>
		</table>
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