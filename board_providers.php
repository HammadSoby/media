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
	
	
	
	$ins =  $_REQUEST['ins'];
	if ($ins ==1) 
	{
		$txtSlot =  $_POST['txtSlot'];
		
		$sSQL = "Insert Into SlotSizes ( Providers_ID , SlotSize )"; 
		$sSQL .= " Value(" . $_SESSION['Provider_ID'] . ",'" . $txtSlot . "')";
		//print($sSQL);
		mysql_query($sSQL);
	}	

		/* load settings */
	require 'connectdb.php';

	$sSQL = "SELECT ProvidersName, ProvidersAddress, ProvidersPostcode, ProvidersCompany, ProvidersNumber, MediaType_ID, ProvidersEmail, ProvidersPassword, PubDuration FROM Providers WHERE Providers_ID =" . $_SESSION['Provider_ID'] ;
	//print($sSQL);
	$tmpAccs = mysql_query($sSQL);
	
	while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
	{
		$ProvidersName = sanitize($thisAccs["ProvidersName"]);
		$ProvidersAddress = sanitize($thisAccs["ProvidersAddress"]);
		$ProvidersEmail = sanitize($thisAccs["ProvidersEmail"]);
		$ProvidersNumber = sanitize($thisAccs["ProvidersNumber"]);
		$MediaType_ID = $thisAccs["MediaType_ID"];
		$ProvidersPassword = sanitize($thisAccs["ProvidersPassword"]);
		$ProvidersPostcode = sanitize($thisAccs["ProvidersPostcode"]);
		$ProvidersCompany = sanitize($thisAccs["ProvidersCompany"]);
		$PubDuration = sanitize($thisAccs["PubDuration"]);
		
		$_SESSION['MediaType_ID'] = $MediaType_ID;
		
	}

$_SESSION['PubDuration'] = $PubDuration;
$_SESSION['ProvidersCompany'] = $ProvidersCompany;

if(isset($_SESSION['logtrue'])){
    ?><head>
  <title>Media Provider Panel </title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" name="viewport" content="width=device-width,initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="style/board_providers.css" />
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
function add_file(){
var popurl='loadpdf.php'; 
winpops=window.open(popurl,'','width=500,height=300,scrollbars,resizable')
}
</script>
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

	<span id="b_title" >Brand &amp; Slots Configuration: &nbsp;<a href="viewslot.php">4. View &amp; Add Slots</a> <a href="viewdates.php">3. Set Production Dates</a>  <a href="configureslots.php?pid=<? echo($_SESSION['Provider_ID']); ?>">2. Configure Slot Details</a>  <a href="products.php" >1 . Add Brands</a> </span>
	<br/>       
	  </div>
    
	<div id="client_info">
        <ul>
            <li><span id="client_info_tit">Name : </span><?php echo $ProvidersCompany; ?></li>
            <li><span id="client_info_tit">Email : </span> <?php echo $ProvidersEmail; ?></li>
            <li><span id="client_info_tit">Address : </span>
            <?php
            
            echo $ProvidersAddress;
            
           
             ?>
          </li>
            <li><span id="client_info_tit">Phone Number :</span> 
              <?php

               $nemra=$ProvidersNumber;
               if($nemra==""){
                echo "No Phone";
               }

               if($nemra!=""){
                 echo $ProvidersNumber;
               }


              ?>

            </li>
        </ul>
		<hr>

		
       

     <?php
        
         if ($_SERVER["REQUEST_METHOD"] == "POST"){
           //new data


       }
       

        

       ?>

        <small id="update_but">Update Information</small>
                   

      </div>
      <div id="update_div">
      
        <span id="ud_title">Update Your Details : </span></br></br>
        <hr/></br>
          <form method="post">
        <label for="fullname">New Full Name </label></br>
          <input type="text" name="fullname" /></br></br>
             <label for="newemail">New Email </label></br>
          <input type="text" name="email" /></br></br>
             <label for="fullname">New Phone Number </label></br>
          <input type="text" name="phone" /></br></br>
           <label for="fullname">New Address </label></br>
          <input type="text" name="adress" /></br></br>
           <label for="fullname" >New Password </label></br>
          <input type="text" name="password" /></br></br>
          <input id="change_button" type="submit" name="change" value="Update" />
        </form>

      </div>
      <div id="board_content">
        <h3 id="board_title">Media Orders</h3>
        <ul id="board_menu">
            <li>Order Date</li>
            <li>Slot Name</li>   
            <li>SlotDescription</li>  
            <li>Slot Purchase Price</li>    
            <li>Quantity</li>    
            <li>Slot Production Date</li>  
            <li>Slot Quantity Left</li>  
           <!--  <li>Status</li> -->
        </ul>
        <ul id="board_data">
      <?php 
	$sSQL = "SELECT SlotOrders.DateCreated, Processed, Quantity, SlotName, SlotDescription, SlotCostPrice, SlotQuantity, SlotDeadline FROM SlotOrders, SlotOrdersItems, Slots WHERE SlotOrders.SlotOrders_ID = SlotOrdersItems.SlotOrders_ID And SlotOrdersItems.Slot_ID = Slots.Slot_ID And Slots.Providers_ID =" . $_SESSION['Provider_ID'] ;
	//print($sSQL);
	$tmpAccs = mysql_query($sSQL);
	
	while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
	{
		$DateCreated = $thisAccs["DateCreated"];
		$Quantity = $thisAccs["Quantity"];
		$SlotName = $thisAccs["SlotName"];
		
		$SlotDescription = $thisAccs["SlotDescription"];
		$SlotCostPrice = $thisAccs["SlotCostPrice"];
		$SlotQuantity = $thisAccs["SlotQuantity"];
		$SlotDeadline = $thisAccs["SlotDeadline"];
		
		$Processed = $thisAccs["Processed"];
		
		$SlotDeadline = date("D-d-M-y", strtotime($SlotDeadline . " +7 days")); 
		$DateCreated = date("D-d-M-y", strtotime($DateCreated )); 
		
		if($Processed ==0)
		{
			$ProcessedDetails = "Not Processed";
		}
		else
		{
			$ProcessedDetails = "Processed";
		}
			?>
             <li><?php echo $DateCreated;?></li>
             <li><?php echo $SlotName;?></li>
             <li><?php echo $SlotDescription;?></li>
            <li><?php echo "£" . $SlotCostPrice;?></li>
            <li><?php echo $Quantity;?></li>
            <li><?php echo $SlotDeadline;?></li>
            <li><?php echo $SlotQuantity;?></li>
          
			<br/>
			<?
		
	}


      ?>
			
            <?php 
              
            ?>
            </li>
        </ul>
      <?php ?>
        
      </div>
  </div>

  </body>
    <?php }
    else{
      header("Location:login.php");
    }


    ?>