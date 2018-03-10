<?session_start();?>
<!DOCTYPE html>
<head>
	<title>Home | Media United Admin</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"  name="viewport" content="width=device-width,initial-scale=1.0">
<style>@import url(http://fonts.googleapis.com/css?family=Open+Sans:400,700);</style>
 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  </script>
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
	
	$ins =  $_REQUEST['ins'];
	if ($ins ==1) 
	{
		$txtNumDates =  $_POST['txtNumDates'];
		$optDur =  $_POST['optDur'];
		$txtDate =  $_POST['txtDate'];
		$date = date("Y-m-d", strtotime($txtDate . " +0 days")); 
		
		
		$sSQL = "Insert Into ProductionDates ( Provider_ID , ProductionDate )"; 
		$sSQL .= " Value(" . $_SESSION['CurrentProvider_ID'] . ",'" . $date . "')";
		//print($sSQL);
		mysql_query($sSQL);
		
		for ($count = 1; $count < $txtNumDates; $count++ ) 
		{
		
			switch ($optDur) 
			{
				case "d":
					$date = date("Y-m-d", strtotime($date . " +1 days")); 
					break;
				case "w":
					$date = date("Y-m-d", strtotime($date . " +1 week")); 
					break;
				case "f":
					$date = date("Y-m-d", strtotime($date . " +2 week")); 
					break;
				case "m":
					$date = date("Y-m-d", strtotime($date . " +1 month")); 
					break;
			}	
			
			$sSQL = "Insert Into ProductionDates ( Provider_ID , ProductionDate )"; 
			$sSQL .= " Value(" . $_SESSION['CurrentProvider_ID'] . ",'" . $date . "')";
		//print($sSQL);
			mysql_query($sSQL);
		}	
		
	}	
	
	
	
	?>
			<form action="productiondates.php?ins=1" method="post">
			 <table width="389" height="372" border="1"  align="center" bordercolor="#0000FF">
			 <tr>
			 
          <th colspan="2" align="center"><font size="+3">Production Dates</font></th>
			 </tr>
			 <tr>		
   			 <td><font size="+1"> Number of Dates:</font></td>    <td><input type="text" name="txtNumDates" /></td>
			</tr>
			 <tr>		
   			 <td><font size="+1"> Add Start Date:</font></td>    <td><input type="text" name="txtDate" id="datepicker"/></td>
			</tr>
			
			 <tr>		
   			 <td><font size="+1"> Then Every:</font></td>    <td><p>
                    <label>
                    <input type="radio" name="optDur" value="d">
                    Day</label>
                    <br>
                    <label>
                    <input type="radio" name="optDur" value="w">
                    Week</label>
                    <br>
                    <label>
                    <input type="radio" name="optDur" value="f">
                    Fortnight</label>
                    <br>
                    <label>
                    <input type="radio" name="optDur" value="m">
                    Month</label>
                    <br>
                  </p></td>
			</tr>
			<tr>
				<td colspan="2" align="center"><input type="submit" name="Submit" value="Add Dates"><a href="" onclick="history.back(-1)">back</a></td>
			</tr>
			</table> 
			</form>
			<br/> <br/>
			<table align="center"  border="1">
			<tr>
			<th>Current Dates</th>
			</tr>
		
		
		<?	
		$sSQL = "SELECT ProductionDate FROM ProductionDates Where Provider_ID	 ="  . $_SESSION['CurrentProvider_ID'] ;
		//print($sSQL);
		$tmpAccs = mysql_query($sSQL);
		
		while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
			$ProductionDate = $thisAccs["ProductionDate"];
			echo("<tr>");
			echo("<td>" . $ProductionDate . "</td>");
			echo("</tr>");
		}
		?>
		
			 </table>
			 </td>
			 <td>
		
			 </table>	
			 <?
}		

else
{
	echo("Login Details Note correct! Please <a href='index.php'>click here</a>");
}		
	

		
		
?>




</body>
</html>