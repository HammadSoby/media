<?php


   session_start();



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
                <li><a href="viewproviders.php?mt=2">Radio Ads</a></li>
                <li><a href="viewproviders.php?mt=3">Tv Ads</a></li>
                <li><a href="viewproviders.php?mt=1">Print Ads</a></li>
                <li><a href="viewproviders.php?mt=4">Outdoor Ads</a></li>
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
      <div id="booking" class="booking">
      </div>
	  <?

if($Membership_ID == 3 And $BlackLinkID ==0)
	  {	}
else
{
	  ?>
      <div id="dashboard">
      <div id="client_info">
        <div id="book_in">
             <span id="b_title">Please Choose in which field you would like to advertise : </span></br></br>
			 <table align="center" width="50%">
			 <tr>
			 <td align="center"><a href="book.php?type=radio">Radio Advertising </a></td>
			 </tr>
			 <tr>
			 <td align="center"> <a href="book.php?type=tv">Television Advertising</a></td>
			 </tr>
			 <tr>
			 <td align="center"> <a href="book.php?type=print">Print Advertising</a></td>
			 </tr>
			 <tr>
			 <td align="center"> <a href="book.php?type=board">Outdoor Advertising</a></td>
			 </tr>
			 <tr>
			 <td align="center"> <a href="book.php?type=dj"> DJ Services</a></td>
			 </tr>
			 <tr>
			 <td align="center"> <a href="book.php?type=os"> Other Services</a></td>
			 </tr>
			 </table>
           </div>

    <ul>
      <li></li>
    </ul>

     <?php


       ?>
    <!--  <p> Media Files: <a href="javascript:add_file('3')">Upload Video File</a> &nbsp;  <a href="javascript:add_file('2')">Upload Audio File</a> &nbsp;  <a href="javascript:add_file('1')">Upload Image File</a> </p>&nbsp;-->
  </div>
<style>
#rcorners3 {
    border-radius: 25px;
    background: url(paper.gif);
    background-position: left top;
    background-repeat: repeat;
    padding: 20px;
    width: 200px;
    height: 150px;

	 box-shadow: black 0.5em 0.5em 0.3em
}

</style>

      <div id="board_content">
	  <table align="center"  id ="rcorners3" >



	 <?
	/* load settings */
	require 'connectdb.php';

	function GetSlotsinOffer($OfferID)
	{
		$SlotsStr = "";
		$SlotsHeadStr = "<table >
	<tr>
	<th>Slot Name</th> <th>Slot Description</th>
	</tr>";

		$sSQL = "SELECT SlotName, SlotDescription FROM SpecialOfferSlots, Slots Where SpecialOfferSlots.Slot_ID = Slots.Slot_ID  And SpecialOffers_ID = " .$OfferID ;
		//print($sSQL);
		$tmpAccs = mysql_query($sSQL);

		while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
			$SlotName = $thisAccs["SlotName"];
			$SlotDescription = $thisAccs["SlotDescription"];

			$Descrip = $SlotDescription ;
			$SlotsStr .= "<tr>";
			$SlotsStr .= "<td>" . $SlotName . "</td> <td>" . $Descrip . "</td>";
			$SlotsStr .= "</tr>";

		}
		$NewSlotsStr = $SlotsHeadStr . $SlotsStr . "</table>";
		return $NewSlotsStr;
	}

	$id =  $_REQUEST['id'];
	if ($id >0)
	{
		//$optSltnum =  $_POST['optSltnum'];

	$sSQL = "SELECT SpecialOffers_ID, DateCreated, SpecialOfferCostPrice, SpecialOfferName, SpecialOfferSellingPrice, SpecialOfferDealine FROM SpecialOffers Where SpecialOffers_ID ="  . $id;
	//print($sSQL);
	$tmpAccs = mysql_query($sSQL);

	while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
	{
		$SpecialOffers_ID = $thisAccs["SpecialOffers_ID"];
		$DateCreated = $thisAccs["DateCreated"];
		$SpecialOfferName = $thisAccs["SpecialOfferName"];
		$SpecialOfferCostPrice = $thisAccs["SpecialOfferCostPrice"];
		$SpecialOfferSellingPrice = $thisAccs["SpecialOfferSellingPrice"];
		$SpecialOfferDealine = $thisAccs["SpecialOfferDealine"];

		$FirstDeadlineDate = date("D-d-M-y", strtotime($SpecialOfferDealine));
		$SlotList = GetSlotsinOffer($SpecialOffers_ID);
	 ?>

	  <tr>
	  <th align="center" colspan="2"><? echo($SpecialOfferName); ?></th>
	  </tr>
	  <tr>
	  <td>Price:</td>  <td>&pound;<? echo($SpecialOfferSellingPrice); ?></td>
	  </tr>
	  <tr>
	  <td>Slots:</td>  <td><? echo($SlotList); ?></td>
	  </tr>
	  <tr>
	  <td>Deadline Date:</td>  <td><? echo($FirstDeadlineDate); ?></td>
	  </tr>
	  <tr>
	  <td align="center" colspan="2">
	  <?
		$strProductBoxes ="";
		$strProductBoxes = $strProductBoxes . "<form target='_self' action='https://www.sandbox.paypal.com/cgi-bin/webscr' method='post'>";
		$strProductBoxes = $strProductBoxes . "<input type='hidden' name='add' value='1'>";
		$strProductBoxes = $strProductBoxes . "<input type='hidden' name='item_name' value='" . $SpecialOfferName  . "'>";

		$strProductBoxes = $strProductBoxes . "<input type='hidden' name='item_number' value='" . $SpecialOffers_ID . "'>";
		$strProductBoxes = $strProductBoxes . "<input type='hidden' name='amount' value='" . $SpecialOfferSellingPrice . "'>";
		$strProductBoxes = $strProductBoxes . "<input type='hidden' name='cmd' value='_cart'>" ;
		$strProductBoxes = $strProductBoxes . "<input type='hidden' name='business' value='bus_test@ics.com'>"; // change when live

		$strProductBoxes = $strProductBoxes . "<input type='hidden' name='currency_code' value='GBP'>";
		$strProductBoxes = $strProductBoxes . "<input type='hidden' name='quantity' value='1'>";

		if ($_SESSION['Client_ID'] > 0)
		{
			$strProductBoxes = $strProductBoxes . "<INPUT TYPE='hidden' NAME='return' value='http://www.mediaunited.co.uk/board.php?board=client&nwbth=1'>";
		}
		else
		{
			$strProductBoxes = $strProductBoxes . "<INPUT TYPE='hidden' NAME='return' value='http://www.mediaunited.co.uk'>";
		}
		$strProductBoxes = $strProductBoxes . "<input type='hidden' name='option_name1' value='SP'>";
		$strProductBoxes = $strProductBoxes . "<INPUT TYPE='hidden' name='notify_url' value='http://www.mediaunited.co.uk/offerprocessord.php'>";

		$strProductBoxes = $strProductBoxes . "<input type='hidden' name='custom' value='" . $_SESSION['Client_ID']. "'>";
		$strProductBoxes = $strProductBoxes . "<input type='hidden' name='shopping_url'  value='http://www.mediaunited.co.uk/board.php?board=client&nwbth=1'>";
		$strProductBoxes = $strProductBoxes . "<input type='image' src='https://www.sandbox.paypal.com/en_GB/i/btn/btn_cart_SM.gif'  border='0' name='submit'  alt='PayPal – The safer, easier way to pay online.' >";
		$strProductBoxes = $strProductBoxes . "<img alt='' border='0' src='https://www.sandbox.paypal.com/en_GB/i/scr/pixel.gif'  >";
		$strProductBoxes = $strProductBoxes . "</form>";

	  ?>
	  <? echo( $strProductBoxes); ?>
	  </td>
	  </tr>
	 <tr>
	 <td align="center"><a href="javascript:history.go(-1)">back</a></td>
	 </tr>
	  </td>
	  <?
	}
}

	 ?>
	  </tr>
	  </table>

        <ul id="board_data">
      <?php



            ?>
            </li>
        </ul>
      <?php ?>


      </div>
  </div>

  </body>
    <?php }



    ?>