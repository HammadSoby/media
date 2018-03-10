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
function getSDate($cDates)
{
		$sSQL = "SELECT ProductionDate FROM ProductionDates Where Date_ID =" . $cDates ;
		//print($sSQL);
		$tmpAccs = mysql_query($sSQL);
		
		while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
			$ProductionDate = $thisAccs["ProductionDate"];
		}
		return $ProductionDate;
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

$insss =  $_REQUEST['insss'];
if ($insss ==1) 
{
	$txtSlot =  $_POST['txtSlot'];
	
	$sSQL = "Insert Into SlotSizes ( Providers_ID , SlotSize )"; 
	$sSQL .= " Value(" . $_SESSION['Provider_ID'] . ",'" . $txtSlot . "')";
	//print($sSQL);
	mysql_query($sSQL);
}	

$insst =  $_REQUEST['insst'];
if ($insst ==1) 
{
	$txtSlot =  $_POST['txtSlot'];
	
	$sSQL = "Insert Into SlotTimes ( Providers_ID , SlotTime )"; 
	$sSQL .= " Value(" . $_SESSION['Provider_ID'] . ",'" . $txtSlot . "')";
	//print($sSQL);
	mysql_query($sSQL);
}	





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
	
<p align="center">&nbsp;</p>
	<br/>
	<? 
	/* load settings */
	require 'connectdb.php';
	$upd =  $_REQUEST['upd'];
	if ($upd ==1) 
	{
		$optTimes = 0;
		$optionSize = 0;
		$txtName =  $_POST['txtName'];
		$txtDescription =  $_POST['txtDescription'];
		$txtSlotCostPrice =  $_POST['txtSlotCostPrice'];
		$txtSlotFullSellingPrice =  $_POST['txtSlotFullSellingPrice'];
		
		$memID =  $_POST['memID'];
		
		$txtSlotQuantity =  $_POST['txtSlotQuantity'];
		$txtSlotReorderLevel =  $_POST['txtSlotReorderLevel'];
		$txtSlotReorderAmount =  $_POST['txtSlotReorderAmount'];
		$txtSlotDeadline =  $_POST['txtSlotDeadline'];
		$optTimes =  $_POST['optTimes'];
		$optionSize =  $_POST['optionSize'];
		
		if(!$optTimes >0)
		{
			$optTimes = 0;
		}
		
		if(!$optionSize >0)
		{
			$optionSize = 0;
		}
		$sSQL = "UPDATE  Slots Set SlotName ='" .  $txtName . "', SlotDescription = '" . $txtDescription . "', SlotCostPrice = " .  $txtSlotCostPrice . ", SlotDeadline = '" . $txtSlotDeadline . "', SlotSize_ID = " .$optionSize . ", SlotTime_ID = " .$optTimes . "  Where Slot_ID = " . $memID; 
		//print($sSQL);
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
		
		$sSQL = "SELECT  SlotName , SlotDescription , SlotCostPrice, SlotDeadline, SlotSize_ID, SlotTime_ID, Providers_ID  FROM Slots Where Slot_ID ="  .$id ;
		//print($sSQL);
		$tmpAccs = mysql_query($sSQL);
		
		while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
			$SlotName = $thisAccs["SlotName"];
			$SlotDescription = $thisAccs["SlotDescription"];
			$SlotCostPrice = $thisAccs["SlotCostPrice"];
			$SlotDeadline = $thisAccs["SlotDeadline"];
			$Providers_ID = $thisAccs["Providers_ID"];
			$SlotSize_ID = $thisAccs["SlotSize_ID"];
			$SlotTime_ID = $thisAccs["SlotTime_ID"];
		}
		?> 
		<br/> <br/>
		<table align="center"> 
		</tr>
		</table>
		<br/> <br/>
	<form action="slot.php?upd=1"	 method="post">
	<table align="center" border="1">
	<tr>
	  <th bgcolor="#0000FF" colspan="5"><font size="+2"><font color="#FFFFFF">Slot Details</font></font></th>
	</tr>
	<tr>
		
    <td><font size="+1">Slot Name:</font></td>
    <td><input type="text" name="txtName" value="<? echo($SlotName); ?>"/></td>
		</tr>
		<tr>
		
    <td><font size="+1">Slot Description:</font></td>
    <td><input type="text" name="txtDescription" value="<? echo($SlotDescription); ?>"/></td>
		</tr>
		<tr>
    <td><font size="+1">Cost Price:</font></td>
    <td><input type="text" name="txtSlotCostPrice" value="<? echo($SlotCostPrice); ?>" /></td>
		</tr>
		
		
		<tr>
		
    <td><font size="+1">Slot Deadline:</font></td>
    <td><input type="text" name="txtSlotDeadline" value="<? echo($SlotDeadline); ?>"/></td>
		</tr>
		
		
	  <?
	  	
		$iloop = 1;
		$sSQL = "SELECT SlotTime_ID, SlotTime FROM SlotTimes Where Providers_ID =" . $Providers_ID ;
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
			
			if($SlotTime_ID == $thisSlotTime_ID)
			{
				echo("<option value='" . $thisSlotTime_ID . "' Selected>" . $SlotTime . "</option>");
			}
			else
			{
				echo("<option value='" . $thisSlotTime_ID . "'>" . $SlotTime . "</option>");
			}
        	
		}
		if($iloop == 2)
		{
			echo("</select> </td>	</tr>");
		}
		
		$iloop = 1;
		$sSQL = "SELECT SlotSize_ID, SlotSize FROM  SlotSizes Where Providers_ID =" . $Providers_ID ;
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
			
			if($SlotSize_ID == $ThisSlotSize_ID)
			{
				echo("<option value='" . $ThisSlotSize_ID . "' Selected>" . $SlotSize . "</option>");
			}
			else
			{
				echo("<option value='" . $ThisSlotSize_ID . "'>" . $SlotSize . "</option>");
			}
        	
		}	
		
		if($iloop == 2)
		{
			echo("</select> </td>	</tr>");
		}
	  ?>
          
		  
		<tr>
			<td align="center"><input type="submit" name="Submit" value="Save"></td><td align="center"><a href="viewslot.php">back...</a></td>
		</tr>
		</table> 
		<input type="hidden" name="memID" value="<? echo($id); ?>" />
		</form>
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