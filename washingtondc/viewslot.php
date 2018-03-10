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
	<p align="center"><a href="addslot.php">Add New Slot</a>   </p>
	<br/>
	<table align="center" border="1">
	<tr>
	  <th bgcolor="#0000FF" colspan="8"><font size="+2"><font color="#FF00FF">Provider's Slots</font></font></th>
	</tr>
	<tr>
	<th>Slot Name</th> <th>Slot Description</th> <th>Slot Cost Price</th> <th>Slot Details</th> <th>Slot Production Date </th> <th>Select To Edit</th>
	</tr>
	<? 
	/* load settings */
	require 'connectdb.php';
	$ins =  $_REQUEST['ins'];
	if ($ins ==1) 
	{
	
		$optTimes = 0;
		$optionSize = 0;
		$txtName =  $_POST['txtName'];
		$txtDescription =  $_POST['txtDescription'];
		$txtSlotCostPrice =  $_POST['txtSlotCostPrice'];
		//$txtSlotFullSellingPrice =  $_POST['txtSlotFullSellingPrice'];
		
		$memID =  $_POST['memID'];
		
		//$txtSlotQuantity =  $_POST['txtSlotQuantity'];
		//$txtSlotReorderLevel =  $_POST['txtSlotReorderLevel'];
		//$txtSlotReorderAmount =  $_POST['txtSlotReorderAmount'];
		
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
		
		$cboDates =  $_POST['cboDates'];
		if($cboDates > 0)
		{
			$SelectedDate = getSDate($cboDates);
			$txtSlotDeadline = date("Y-m-d", strtotime($SelectedDate . " -7 days")); 
			
			$sSQL = "Insert Into Slots ( SlotName , SlotDescription , SlotCostPrice, SlotDeadline, SlotSize_ID, SlotTime_ID, Providers_ID )"; 
			$sSQL .= " Value('" . $txtName . "','" . $txtDescription . "'," .  $txtSlotCostPrice . ",'" .  $txtSlotDeadline . "'," . $optionSize . "," . $optTimes . "," . $_SESSION['Provider_ID'] ." )";
			//print($sSQL);
			mysql_query($sSQL); 
			
		}
		else
		{
			$sSQL = "SELECT ProductionDate FROM ProductionDates Where Provider_ID	 ="  . $_SESSION['Provider_ID'] ;
			//print($sSQL);
			$tmpAccs = mysql_query($sSQL);
			
			while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
			{
				$ProductionDate = $thisAccs["ProductionDate"];
				$txtSlotDeadline = date("Y-m-d", strtotime($ProductionDate . " -7 days")); 
				
				$sSQL = "Insert Into Slots ( SlotName , SlotDescription , SlotCostPrice, SlotDeadline, SlotSize_ID, SlotTime_ID, Providers_ID )"; 
				$sSQL .= " Value('" . $txtName . "','" . $txtDescription . "'," .  $txtSlotCostPrice . ",'" .  $txtSlotDeadline . "'," . $optionSize . "," . $optTimes . "," . $_SESSION['Provider_ID'] ." )";
				//print($sSQL);
				mysql_query($sSQL); 
				
			}
			
		}	
	}	
	
		$sSQL = "SELECT Slot_ID, SlotName, SlotDescription, SlotCostPrice, SlotFullSellingPrice, SlotQuantity, SlotDeadline, SlotSize_ID, SlotTime_ID FROM Slots Where Providers_ID = " . $_SESSION['Provider_ID'] . " Order By SlotName" ;
		//print($sSQL);
		$tmpAccs = mysql_query($sSQL);
		
		while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
			$Slot_ID = $thisAccs["Slot_ID"];
			$SlotName = $thisAccs["SlotName"];
			$SlotDescription = $thisAccs["SlotDescription"];
			$SlotCostPrice = $thisAccs["SlotCostPrice"];
			$SlotDeadline = $thisAccs["SlotDeadline"];
			$SlotSize_ID = $thisAccs["SlotSize_ID"];
			$SlotTime_ID = $thisAccs["SlotTime_ID"];
			
			echo("<tr>");
			echo("<td align='center'>" . $SlotName . "</td>" );
			echo("<td align='center'>" . $SlotDescription . "</td>" );
			echo("<td align='center'>" . $SlotCostPrice  . "</td>" );
			
			if($SlotSize_ID > 0)
			{
				$GetSizename = GetSizename($SlotSize_ID);
			}
			
			if($SlotTime_ID > 0)
			{
				$GetSlotTime = GetSlotTime($SlotTime_ID);
			}
			$SlotDetails = $GetSizename . "&nbsp;" . $GetSlotTime;
			echo("<td align='center'>" . $SlotDetails . "</td>" );
			$SlotDeadline = date("D-d-M-y", strtotime($SlotDeadline . " +7 days")); 
			echo("<td align='center'>" . $SlotDeadline . "</td>" );
			
			
			echo("<td align='center'><a href = 'slot.php?id=" . $Slot_ID . "'>Select</a></td>" );
			echo("</tr>");
		}	
		

?>
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