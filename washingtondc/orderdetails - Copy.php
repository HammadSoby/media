<?php 
  

   session_start();

		/* load settings */
	require 'connectdb.php';

if(isset($_SESSION['logtrue'])){
    ?><head>
  <title>Client Area </title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" name="viewport" content="width=device-width,initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="style/board.css" />
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body>

 <div id="controls_remember">
   
   <?php   
 
    include 'includes/leftmenu.php'; ?>
      </div>
      <div id="menu">
         <nav>
                <span class="show_menu"></span>
            
            <ul class="ul">
                 <li><a href="http://www.mediaunited.co.uk/">Home</a></li>
                <li><a href="viewproviders.php?mt=2">Radio Advertising</a></li>
                <li><a href="viewproviders.php?mt=3">Tv Advertising</a></li>
                <li><a href="viewproviders.php?mt=1">Print Advertising</a></li>
                <li><a href="#">Media Packages</a></li>
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
     
      <div id="booking" class="booking">
        <div id="book_in">
             <span id="b_title">Please Choose in which field you would like to advertise : </span></br></br>
             <small id="star">*</small>&nbsp;<a href="book.php?type=radio">Radio Advertising </a></br>
             <small id="star">*</small>&nbsp;<a href="book.php?type=tv">Tv Advertising</a></br>
             <small id="star">*</small>&nbsp;<a href="book.php?type=print">Print Advertising</a></br>
           </div>
      </div>
		  <div id="dashboard">
		  <div id="client_info">
		  
	  <?
	$id =  $_REQUEST['id']; // Order ID
	if ($id > 0) 
	{	 
		
		$sSQL = "SELECT DateCreated, Total, BatchID FROM SlotOrders WHERE  SlotOrders_ID =" .$id ;
		//print($sSQL);
		$tmpAccs = mysql_query($sSQL);
		
		while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
			$DateCreated = $thisAccs["DateCreated"];
			$Total = $thisAccs["Total"];
			$BatchID = $thisAccs["BatchID"];
		}
		$DateCreated = date("D-d-M-y", strtotime($DateCreated));

      ?>
		  <table align="center" >
		  <tr>
		  
        <th colspan="4" align="center"><font size="+2">Order Details</font></th>
		  </tr>
		  <tr>
		  
        <th colspan="2"><font size="+1">Order Date</font></th>
        <th colspan="2"><? echo($DateCreated); ?></th>  
		  </tr>
		  <tr>
		<th colspan="2"><font size="+1">Order Total</font></th>
        <th colspan="2">&pound;<? echo($Total); ?></th>		  </tr>
	   </table>  
	   <br/>
	   
      <div id="board_content">
        <h3 id="board_title">Orders Details</h3>
		
        <ul id="board_menu">
		<li><font color="#FFFFFF">Slot Name</font></li>
		<li><font color="#FFFFFF">Slot Description</font></li>    
		<li><font color="#FFFFFF">Slot Price</font></li>
		<li><font color="#FFFFFF">Slot Details</font></li>
		<li><font color="#FFFFFF">Slot Deadline</font></li>            
		<li><font color="#FFFFFF">Slot Provider</font></li>
        </ul>
		
        <ul id="board_data">
      <?php 
			$sSQL = "SELECT  ProvidersCompany, SlotName, SlotDescription, SlotFullSellingPrice, SlotDeadline, SlotSize_ID, SlotTime_ID, Quantity FROM SlotOrdersItems, Slots, Providers WHERE SlotOrdersItems.Slot_ID = Slots.Slot_ID And Slots.Providers_ID = Providers.Providers_ID And SlotOrders_ID =" .$id ;
		//print($sSQL);
		$tmpAccs = mysql_query($sSQL);
		
		while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
			$ProvidersCompany = $thisAccs["ProvidersCompany"];
			$SlotName = $thisAccs["SlotName"];
			$SlotDescription = $thisAccs["SlotDescription"];
			$SlotFullSellingPrice = $thisAccs["SlotFullSellingPrice"];
			$SlotDeadline = $thisAccs["SlotDeadline"];
			$SlotSize_ID = $thisAccs["SlotSize_ID"];
			$SlotTime_ID = $thisAccs["SlotTime_ID"];
			$Quantity = $thisAccs["Quantity"];
			
			$SlotDeadline = date("D-d-M-y", strtotime($SlotDeadline));

			If ($_SESSION['ClientPercent'] > 0)
			{
				$PercentNumber =  $_SESSION['ClientPercent'];
				$OnePercent = $SlotFullSellingPrice / 100;
				$DiscountValue = $OnePercent * $PercentNumber;
				$thisSellingPrice = $SlotFullSellingPrice - $DiscountValue;
			}
			else
			{
				$thisSellingPrice = $SlotFullSellingPrice;
			}
			
			if($SlotSize_ID > 0)
			{
				$GetSizename = GetSizename($SlotSize_ID);
			}
			
			if($SlotTime_ID > 0)
			{
				$GetSlotTime = GetSlotTime($SlotTime_ID);
			}
			$SlotDetails = $GetSizename . "&nbsp;" . $GetSlotTime;
			?>
			
             <li><?php echo $SlotName;?></li>
            <li><?php echo $SlotDescription; ?></li>
            <li><?php echo "£" . $thisSellingPrice; ?></li>
            <li><?php echo $SlotDetails;?></li>
            <li><?php echo $SlotDeadline;?></li>
            <li><?php echo $ProvidersCompany;?></li>
			
			<?
		}
            ?>
           
        </ul>
     

        
      </div>
			<?
		}
            ?>
		
      </div>
  </div>

  </body>
    <?php }
    else{
      header("Location:login.php");
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
    ?>