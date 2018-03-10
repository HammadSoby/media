<?php 
   session_start();
	/* load settings */
	require 'connectdb.php';
	
	function sanitize($data) 
	{
		$data = ltrim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
	$rm =  $_REQUEST['rm'];
	if ($rm > 0) 
	{
		$sSQL = "Delete from ProductionDates Where Date_ID =  " .$rm ; 
		//print($sSQL);
		mysql_query($sSQL);
	}
	
	$ins =  $_REQUEST['ins'];
	if ($ins ==1) 
	{
		$txtEDate =  $_POST['txtEDate'];
		$txtSDate =  $_POST['txtSDate'];
		$Sdate = date("Y-m-d", strtotime($txtSDate . " +0 days")); 
		$Edate = date("Y-m-d", strtotime($txtEDate . " +0 days")); 
		
		//echo $diff->format("%R%a ");
		$Stop = 0;
		
		$sSQL = "Insert Into ProductionDates ( Product_ID , ProductionDate )"; 
		$sSQL .= " Value(" . $_SESSION['Product_ID'] . ",'" . $Sdate . "')";
		mysql_query($sSQL);
		
		while ($Stop <> 1 ) 
		{
		
			switch ($_SESSION['PubDuration']) 
			{
				case "D":
					$Sdate = date("Y-m-d", strtotime($Sdate . " +1 days")); 
					break;
				case "W":
					$Sdate = date("Y-m-d", strtotime($Sdate . " +1 week")); 
					break;
				case "F":
					$Sdate = date("Y-m-d", strtotime($Sdate . " +2 week")); 
					break;
				case "M":
					$Sdate = date("Y-m-d", strtotime($Sdate . " +1 month")); 
					break;
			}	
			
			 $StartDate = date_create($Sdate);
			 $EndDate = date_create($Edate);		 
			 $diff = date_diff($StartDate,$EndDate);
			 
			 $Result = $diff->format("%R%a");
			 $Result = $Result[0];
			
			 
			 if($Result <> "-")
			 {
				$sSQL = "Insert Into ProductionDates ( Product_ID , ProductionDate )"; 
				$sSQL .= " Value(" . $_SESSION['Product_ID'] . ",'" . $Sdate . "')";
				mysql_query($sSQL);
			 }
			 else
			 {
			 	$Stop = 1;
			}
		}	
		
		 
	}	

		/* load settings */
	require 'connectdb.php';




if(isset($_SESSION['logtrue'])){
    ?><head>
  <title>Media Provider Panel </title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" name="viewport" content="width=device-width,initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="style/board_providers.css" />
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body>
 <div id="controls_remember">
   
   <?php   
 

    include 'includes/leftmenu_providers.php'; ?>
      </div>
      <div id="menu">
         <nav>
                <span class="show_menu"></span>
            
            <ul class="ul">
                <li><a href="aboutradio.php">Radio Ads</a></li>
                <li><a href="abouttv.php">Tv Ads</a></li>
                <li><a href="aboutprint.php">Print Ads</a></li>
                <li><a href="aboutod.php">Outdoor Ads</a></li>
                <li><a href="aboutmp.php">Media Packages</a></li>
                <li><a href="contactus.php">Contact us</a></li>
            </ul>
            </nav>
      </div>
 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  </script>
      <div id="dashboard">

      <div id="client_info">
			<table align="center">
                 <tr>
                 <td><font size="+1">Select Brand to Set Dates for</font></td>
                 </tr>
                 <tr>
                 <td align="center"><form name="form1" method="post" action="viewdates.php?sbr=1">
                   <label for="ddBrands"></label>
                   <select name="ddBrands" id="ddBrands" onchange='document.form1.submit();'>
                    <option selected="selected" value="0">Which brand....</option>
                 <?    
				$sSQL = "SELECT Product_ID, ProductName, MediaType_ID, PubDuration FROM Products Where Providers_ID	 ="  . $_SESSION['Provider_ID'] ;
				//print($sSQL);
				$tmpAccs = mysql_query($sSQL);
				
				while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
				{
					$Product_ID = $thisAccs["Product_ID"];
					$ProductName = $thisAccs["ProductName"];
					$MediaType_ID = $thisAccs["MediaType_ID"];
					$PubDuration = $thisAccs["PubDuration"];
					echo("<option value=" . $Product_ID . ">" . $ProductName . "</option>");
				}
				?>
                   </select>
                 </form></td>
                 </tr>
                 
            </table>
            <?
			$Product_ID = 0;
			$sbr =  $_REQUEST['sbr'];
			if ($sbr ==1) 
			{
				$Product_ID =  $_POST['ddBrands'];
				$_SESSION['Product_ID'] = $Product_ID;

				$sSQL = "SELECT ProductName, MediaType_ID, PubDuration FROM Products Where Product_ID	 ="  . $Product_ID ;
				//print($sSQL);
				$tmpAccs = mysql_query($sSQL);
				
				while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
				{
					$ProductName = $thisAccs["ProductName"];
					$MediaType_ID = $thisAccs["MediaType_ID"];
					$PubDuration = $thisAccs["PubDuration"];
					$_SESSION['MediaType_ID'] = $MediaType_ID;
					$_SESSION['PubDuration'] = 	$PubDuration;			
				}
			}
           ?>  
           			<p align="center">Selected Brand = <? echo($ProductName); ?></p>

			<form action="viewdates.php?ins=1" method="post">
			 <table width="389" height="372" border="1"  align="center" bordercolor="#0000FF">
			 <tr>
			 
          <th colspan="2" align="center"><font size="+3">Production Dates</font></th>
			 </tr>
			 <tr>		
   			 
          <td><font size="+1"> Add Start Date:</font></td>
          <td><input name="txtSDate" type="date"  /></td>
			</tr>
			 <tr>		
   			 
          <td><font size="+1"> Add End Date:</font></td>
          <td><input type="date" name="txtEDate"  /></td>
			</tr>
			
			<tr>
				<td colspan="2" align="center"><input type="submit" name="Submit" value="Add Dates"></td>
			</tr>
			</table> 
			</form>
			<br/> <br/>
			<table align="center"  border="1">
			<tr>
			<th colspan="2">Current Dates</th>
			</tr>
		
		
		<?	
		$sSQL = "SELECT Date_ID, ProductionDate FROM ProductionDates Where Product_ID	 ="  . $_SESSION['Product_ID'] . " Order By ProductionDate" ;
		//print($sSQL);
		$tmpAccs = mysql_query($sSQL);
		
		while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
			$ProductionDate = $thisAccs["ProductionDate"];
			$Date_ID = $thisAccs["Date_ID"];
			
			$ProductionDate = date("D-d-M-y", strtotime($ProductionDate )); 
			echo("<tr>");
			echo("<td>" . $ProductionDate . "</td>");
			echo("<td><a href='viewdates.php?rm=" . $Date_ID . "'>Remove Date</a> </td>");
			echo("</tr>");
		}
		?>
		
			 </table>
			 </td>
			 <td>
		
			 </table>
    <div align="center"><a href="board_providers.php">back</a> </div>
  </div>
  </div>

  </body>
    <?php }
    else{
      header("Location:login.php");
    }


    ?>