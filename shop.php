 <?php
 error_reporting(E_ERROR);
  session_start(); ?>
<head>

  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="style/book.css" />
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
          <script type="text/javascript" src="http://www.demosunited/js/jquery.min.js"></script>
          <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
          <script type="text/javascript" src="http://www.demosunited/js/script.js"></script>
</head>
<body>
 <div id="controls_remember">
 <?php


  include'includes/leftmenunli.php';

  ?>
    </div>

      <?php


		    include 'includes/logmenu.php';



           //   include 'includes/nologmenu.php';




                include 'includes/booknewad.php';

       ?>
      <div id="book">
       <?php
     if(isset($_GET['type']))
	 {
            $type=$_GET['type'];
            $_SESSION['type']=$type;
            if(!empty($type)){

                  switch ($type) {
                    case 'radio':
					$_SESSION['mediatype']=	2;
                      require'sales.php';

                      break;
                       case 'print':
					   $_SESSION['mediatype']=	1;
                      require'sales.php';

                      break;

                       case 'board':
					   $_SESSION['mediatype']=	4;
                      require'sales.php';

                      break;


                       case 'dj':
					   $_SESSION['mediatype']=	5;
                      require'sales.php';
                      break;

                       case 'os':
					   $_SESSION['mediatype']=	6;
                      require'sales.php';
                      break;

                       case 'tv':
					   $_SESSION['mediatype']=	3;
                      require'sales.php';

                      break;

                    default:
                      ?>
                       <script>
                   window.location="http://www.demosunited.com/board";
                  </script>
                      <?php
                      break;
                  }

            }
		}
		else
		{
		?>

  <div id="book_in">
    <div align="center"><span id="b_title">Please Choose in which field you would
      like to advertise : </span><br><br>

             <table align="center" width="50%">
			 <tr>

            <td align="center"><a href="<?php echo($Action); ?>?type=radio">Radio Advertising </a></td>
			 </tr>
			 <tr>
             <td align="center"><a href="<?php echo($Action); ?>?type=tv">Tv Advertising</a></td>
			 </tr>
			 <tr>
           <td align="center"> <a href="<?php echo($Action); ?>?type=print">Print Advertising</a></td>
			 </tr>
			 <tr>
            <td align="center"><a href="<?php echo($Action); ?>?type=board">Outdoor Advertising</a></td>
			 </tr>
			 <tr>
			 <td align="center"><a href="<?php echo($Action); ?>?type=dj"> DJ Services</a></td>
			 </tr>
			 <tr>
			 <td align="center"> <a href="<?php echo($Action); ?>?type=os"> Other Services</a></td>
			 </tr>
			 </table>

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
      </div>
      <div id="board_content">
	  <table align="center" >
	  <tr>

	 <?php
	/* load settings */
	require 'connectdb.php';

	function GetSlotsinOffer($OfferID)
	{
		$SlotsStr = "";
		$sSQL = "SELECT SlotName FROM SpecialOfferSlots, Slots Where SpecialOfferSlots.Slot_ID = Slots.Slot_ID And SpecialOffers_ID = " .$OfferID ;
		//print($sSQL);
		$tmpAccs = mysql_query($sSQL);

		while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
			$SlotName = $thisAccs["SlotName"];
			$SlotsStr .= $SlotName . "<br/>";
		}
		return $SlotsStr;
	}

	function GetProvidersinOffer($OfferID)
	{
		$SlotsStr = "";
		$sSQL = "SELECT Distinct ProvidersCompany FROM SpecialOfferSlots, Slots, Providers Where SpecialOfferSlots.Slot_ID = Slots.Slot_ID And Slots.Providers_ID = Providers.Providers_ID And SpecialOffers_ID = " .$OfferID ;
		//print($sSQL);
		$tmpAccs = mysql_query($sSQL);

		while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
			$ProvidersCompany = $thisAccs["ProvidersCompany"];
			$SlotsStr .= $ProvidersCompany . "<br/>";
		}
		return $SlotsStr;
	}

	$sSQL = "SELECT SpecialOffers_ID, DateCreated, SpecialOfferCostPrice, SpecialOfferName, SpecialOfferSellingPrice, SpecialOfferDealine, SpecialOfferDetails FROM SpecialOffers Where Live = 1" ;
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
		$SpecialOfferDetails = $thisAccs["SpecialOfferDetails"];

		$FirstDeadlineDate = date("D-d-M-y", strtotime($SpecialOfferDealine));
		$SlotList = GetProvidersinOffer($SpecialOffers_ID);
	 ?>
	  <td>
	  <table id ="rcorners3">
	  <tr>
	  <th align="center" colspan="2"><? echo($SpecialOfferName); ?></th>
	  </tr>
	  <tr>
	  <td>Price:</td>  <td>&pound;<? echo($SpecialOfferSellingPrice); ?></td>
	  </tr>
	  <tr>
	  <td>Details:</td>  <td><? echo($SpecialOfferDetails); ?></td>
	  </tr>
	  <tr>
	  <td>Providers:</td>  <td><? echo($SlotList); ?></td>
	  </tr>
	  <tr>
	   <td align="center" colspan="2"><a href="viewoffer.php?id=<? echo($SpecialOffers_ID); ?>">View Details</a>   </td>
	  </tr>
	  <tr>
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

		$strProductBoxes = $strProductBoxes . "<INPUT TYPE='hidden' name='notify_url' value='http://www.mediaunited.co.uk/offerprocessord.php'>";

		$strProductBoxes = $strProductBoxes . "<input type='hidden' name='custom' value='" . $_SESSION['Client_ID']. "'>";
		$strProductBoxes = $strProductBoxes . "<input type='hidden' name='option_name1' value='SP'>";

		$strProductBoxes = $strProductBoxes . "<input type='hidden' name='shopping_url'  value='http://www.mediaunited.co.uk/shop.php'>";
		$strProductBoxes = $strProductBoxes . "<input type='image' src='https://www.sandbox.paypal.com/en_GB/i/btn/btn_cart_SM.gif'  border='0' name='submit'  alt='PayPal – The safer, easier way to pay online.' >";
		$strProductBoxes = $strProductBoxes . "<img alt='' border='0' src='https://www.sandbox.paypal.com/en_GB/i/scr/pixel.gif'  >";
		$strProductBoxes = $strProductBoxes . "</form>";
	  ?>
	  <td align="center" colspan="2"> <? echo( $strProductBoxes); ?></td>
	  </tr>
	  </table>
	  </td>
	  <?php
	}

	 ?>
	  </tr>
	  </table>	  </div>
  </div>
		   <p>Please note that all slot price displayed will be the full recommended retail price until you register or sign in. </p>
		<?php

		}
       ?>
      </div>
