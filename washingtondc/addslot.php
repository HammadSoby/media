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
                 <li><a href="http://www.mediaunited.co.uk/">Home</a></li>
                <li><a href="agencys.php?type=radio">Radio Provider</a></li>
                <li><a href="agencys.php?type=tv">Tv Provider</a></li>
                <li><a href="agencys.php?type=print">Print Provider</a></li>
                
                <li><a href="contactus?type=provider">Contact us</a></li>
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
		</tr>
		</table>
		<br/> <br/>
	<form action="viewslot.php?ins=1"	 method="post">
	<table align="center" border="1">
	<tr>
	  <th bgcolor="#0000FF" colspan="5"><font size="+2"><font color="#FFFFFF">Create Slot</font></font></th>
	</tr>
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
    <td><input type="text" name="txtSlotCostPrice"  /></td>
		</tr>
		
	  <?
	  	
		$iloop = 1;
		$sSQL = "SELECT SlotTime_ID, SlotTime FROM SlotTimes Where Providers_ID =" . $_SESSION['Provider_ID'] ;
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
		$sSQL = "SELECT SlotSize_ID, SlotSize FROM  SlotSizes Where Providers_ID =" . $_SESSION['Provider_ID'] ;
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
		$sSQL = "SELECT Date_ID, ProductionDate FROM ProductionDates Where Provider_ID =" . $_SESSION['Provider_ID'] ;
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