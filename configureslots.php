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
	
	
	$insss =  $_REQUEST['insss'];
	if ($insss ==1) 
	{
		$txtSlot =  $_POST['txtSlot'];
		
		$sSQL = "Insert Into SlotSizes ( Product_ID , SlotSize )"; 
		$sSQL .= " Value(" . $_SESSION['Product_ID'] . ",'" . $txtSlot . "')";
		//print($sSQL);
		mysql_query($sSQL);
	}	

	$insst =  $_REQUEST['insst'];
	if ($insst ==1) 
	{
		$txtSlot =  $_POST['txtSlot'];
		
		$sSQL = "Insert Into SlotTimes ( Product_ID , SlotTime )"; 
		$sSQL .= " Value(" . $_SESSION['Product_ID'] . ",'" . $txtSlot . "')";
		//print($sSQL);
		mysql_query($sSQL);
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
      <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
     <script>
$(document).ready(function(){
  $("#booknow").click(function(){
    $("#booking").toggle();
  });
});
$(document).ready(function(){
  $("#update_but").click(function(){
    $("#update_div").toggle();
  });
});
</script>

      <div id="dashboard">

      <div id="client_info">
			<table align="center">
                 <tr>
                 <td><font size="+1">Select Brand to configure slots for</font></td>
                 </tr>
                 <tr>
                 <td align="center"><form name="form1" method="post" action="configureslots.php?sbr=1">
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
				}
			}
			if ($_SESSION['Product_ID'] > 0) 
			{				
			?>
			<p align="center">Selected Brand = <? echo($ProductName); ?></p>
				 <table align="center"  >
				 <tr>
				 <td>
				 <?
				 if ($_SESSION['MediaType_ID'] == 1)
				 {
					 ?>
					<form action="configureslots.php?insss=1" method="post">
					 <table>
					 <tr>
					 <th colspan="2" align="center">Add Slot Sizes</th>
					 </tr>
					 
					 <tr>		
					 <td><font size="+1"> Slot Size:</font></td>    <td><input type="text" name="txtSlot" /></td>
					</tr>
					<tr>
						<td colspan="2" align="center"><input type="submit" name="Submit" value="Add"></td>
					</tr>
					</table> 
					</form>
					<br/> <hr/>
					<table align="center"  border="1">
					<tr>
					<th>Current Slot Sizes</th>
					</tr>
				
				
					<?	
					$sSQL = "SELECT SlotSize_ID, SlotSize FROM SlotSizes Where Product_ID	 ="  . $_SESSION['Product_ID'] ;
					//print($sSQL);
					$tmpAccs = mysql_query($sSQL);
					
					while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
					{
						$ProviSlotSize_IDdersName = $thisAccs["SlotSize_ID"];
						$SlotSize = $thisAccs["SlotSize"];
						echo("<tr>");
						echo("<td>" . $SlotSize . "</td>");
						echo("</tr>");
					}
					?>
				
					 </table>
				<?
				}
				?>		 
				 </td>
				 <td>
				 <?
				 if ($_SESSION['MediaType_ID'] > 1)
				 {
					 ?>
					<form action="configureslots.php?insst=1" method="post">
					 <table>
					 <tr>
                     <?
					 if ($_SESSION['MediaType_ID'] == 6)
				 	{
						?>
					 	<th colspan="2" align="center">Add Slot Details</th>
                     	<?
					}
					else
				 	{
						?>
					 	<th colspan="2" align="center">Add Slot Times</th>
                     	<?
					}
					?>
					 </tr>
					 <tr>
                     <?
					 if ($_SESSION['MediaType_ID'] == 6)
				 	{
						?>
					 <td><font size="+1"> Slot Details:</font></td>    <td><input type="text" name="txtSlot" /></td>
                     	<?
					}
					else
				 	{
						?>
					 <td><font size="+1"> Slot Time:</font></td>    <td><input type="text" name="txtSlot" /></td>
                     	<?
					}
					?>
                     
					</tr>
					<tr>
						<td colspan="2" align="center"><input type="submit" name="Submit" value="Add"></td>
					</tr>
					</table> 
					</form>
					<br/> <hr/>
					<table align="center"  border="1">
					<tr>
                     <?
					 if ($_SESSION['MediaType_ID'] == 6)
				 	{
						?>
					<th>Current Slot Details</th>
                     	<?
					}
					else
				 	{
						?>
					<th>Current Slot Times</th>
                     	<?
					}
					?>
					</tr>
				
				
					<?	
					$sSQL = "SELECT SlotTime_ID, SlotTime FROM SlotTimes Where Product_ID	 ="  .$_SESSION['Product_ID'] ;
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
				
					 </table>
				<?
				}
				?>	 
				 </td>
				 <td>
				 </td>
				 </tr>
		</table> 
     <?
	 }
	 ?>   
    <div align="center"><a href="board_providers.php">back</a> </div>
  </div>
  </div>

  </body>
    <?php }
    else{
      header("Location:login.php");
    }


    ?>