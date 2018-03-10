<?php 
   session_start();
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
		<br/> <br/>
    			<table align="center">
                 <tr>
                 <td><font size="+1">Select Brand to Add Slots for</font></td>
                 </tr>
                 <tr>
                 <td align="center"><form name="form1" method="post" action="addslot.php?sbr=1">
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
       <br/> <br/>
	<form action="viewslot.php?ins=1"	 method="post">
	<table align="center" border="1">
	<tr>
	  <th bgcolor="#0000FF" colspan="5"><font size="+2"><font color="#FFFFFF">Create Slot</font></font></th>
	</tr>
    
    <?
	if ($MediaType_ID == 4)
	{
		?>	
		<tr>		
		<td><font size="+1">Location Type:</font></td>
		<td><label for="ddLocationType"></label>
        <select name="ddLocationType" id="ddLocationType">
         <option value='0'>Select Location Type</option>
         <?
				$sSQL = "SELECT LocationType_ID, LocationTypeName FROM LocationType  Order By LocationTypeName" ;
				//print($sSQL);
				$tmpAccs = mysql_query($sSQL);
				
				while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
				{
					$LocationType_ID = $thisAccs["LocationType_ID"];
					$LocationTypeName = $thisAccs["LocationTypeName"];
					echo("<option value='" . $LocationType_ID . "'>" . $LocationTypeName . "</option>");
				}
		 
		 ?> 
          
          
        </select>
        </td>
		</tr>
		<?
	}
	?>
	<tr>
		
    <td><font size="+1">Slot Name:</font></td>
    <td><input type="text" name="txtName"/></td>
		</tr>
		<tr>
		
    <td><font size="+1">Slot Description:</font></td>
    <td><textarea name="txtDescription"></textarea></td>
		</tr>
		<tr>
    <td><font size="+1">Cost Price:</font></td>
    <td>
	<?
	if ($_SESSION['MediaType_ID'] == 5)
	{
		?> 
		<input type="text" name="txtSlotCostPrice" value="2"  />	
		<input type="hidden" name="txtSlotSellPrice" value="4"  />	
		<?
	}
	else
	{
		?> 
		<input type="text" name="txtSlotCostPrice"  />	
		<?
	}
	?>
	</td>
		</tr>
	<tr>
		
    <td><font size="+1">Slot Min RRP:</font></td>
    <td><input type="text" name="txtRRP"/></td>
		</tr>
	  <?
	  	
		$iloop = 1;
		$sSQL = "SELECT SlotTime_ID, SlotTime FROM SlotTimes Where Product_ID =" . $_SESSION['Product_ID'] ;
		//print($sSQL);
		$tmpAccs = mysql_query($sSQL);
		
		while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
			if ($iloop == 1)
			{
				echo("<tr>");		
				echo("<td><font size='+1'>Slot  Times:</font></td>");
				echo("<td> <select name='optTimes'>");
				$iloop = 2;
			}
			$thisSlotTime_ID = $thisAccs["SlotTime_ID"];
			$SlotTime = $thisAccs["SlotTime"];
			
			echo("<option value='" . $thisSlotTime_ID . "'>" . $SlotTime . "</option>");
        	
		}
		if($iloop == 2)
		{
			echo("</select> </td>	</tr>");
		}
		
		$iloop = 1;
		$sSQL = "SELECT SlotSize_ID, SlotSize FROM  SlotSizes Where Product_ID =" . $_SESSION['Product_ID'] ;
		//print($sSQL);
		$tmpAccs = mysql_query($sSQL);
		
		while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
			if ($iloop == 1)
			{
				echo("<tr>");		
				echo("<td><font size='+1'>Slot  Size:</font></td>");
				echo("<td> <select name='optionSize'>");
				$iloop = 2;
			}
			
			$ThisSlotSize_ID = $thisAccs["SlotSize_ID"];
			$SlotSize = $thisAccs["SlotSize"];
			
			echo("<option value='" . $ThisSlotSize_ID . "'>" . $SlotSize . "</option>");
			
        	
		}	
		
		if($iloop == 2)
		{
			echo("</select> </td>	</tr>");
		}
	  ?>
          
		
		<tr>
		
    <td><font size="+1">Select Production Date for Slot:</font></td>
    <td><select name="cboDates">
	<option value='0'>Create Slot for All Dates</option>
	<?
		$sSQL = "SELECT Date_ID, ProductionDate FROM ProductionDates Where Product_ID =" . $_SESSION['Product_ID'] ;
		//print($sSQL);
		$tmpAccs = mysql_query($sSQL);
		
		while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
			$ProductionDate = $thisAccs["ProductionDate"];
			$Date_ID = $thisAccs["Date_ID"];
			echo("<option value='" . $Date_ID  . "'>" . $ProductionDate  . "</option>");
		}	 
	 ?>
            </select> </td>
		</tr>
		
		
		  
		<tr>
			<td colspan="2" align="center"><input type="submit" name="Submit" value="Save"></td>
		</tr>
		</table> 
		<input type="hidden" name="memID" value="<? echo($id); ?>" />
		</form>
					 
    <div align="center"><a href="board_providers.php">back</a> </div>
  </div>
  </div>

  </body>
    <?php }
    else{
      header("Location:login.php");
    }


    ?>