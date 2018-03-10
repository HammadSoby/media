 <div id="bookin">
        <span id="book_title">You're About to book Ad Space In Radio Adverstising : </span></br>
       
        <form method="post" action="" enctype="multipart/form-data">
    <span id="book_down">Please choose one of these radio stations : </span>
    <select name="optRadio">
		
		<?
	/* load settings */
	require './connectdb.php';
		
		$sSQL = "SELECT  Providers_ID, ProvidersCompany FROM Providers Where MediaType_ID = 2 Order By ProvidersName" ;
		//print($sSQL);
		$tmpAccs = mysql_query($sSQL);
		
		while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
			$ProvidersCompany = $thisAccs["ProvidersCompany"];
			$Providers_ID = $thisAccs["Providers_ID"];
			echo("<option value='" . $Providers_ID . "'>". $ProvidersCompany . "</option>");
		}
		
		?>	
        </select>
    <input type="submit" name="Submit" value="Select Radio Station">
	</form>
	</br>
	 <hr/>
	 <table align="center">
	 <tr>
	 <td height="170">
<form target="paypal" action="https://www.sandbox.paypal.com/cgi-bin/webscr"
        method="post">

    <!-- Identify your business so that you can collect the payments. -->
    <input type="hidden" name="business" value="bus_test@ics.com">

    <!-- Specify a PayPal Shopping Cart View Cart button. -->
    <input type="hidden" name="cmd" value="_cart">
    <input type="hidden" name="display" value="1">

    <!-- Display the View Cart button. -->
    <input type="image" name="submit" border="0"
        src="https://www.paypalobjects.com/en_US/i/btn/btn_viewcart_LG.gif"
       alt="PayPal - The safer, easier way to pay online">
    <img alt="" border="0" 
        src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >
</form>	 </td>
	 </tr>
	 </table>
    <hr/>
	
	<table border="1" bordercolor="#FF0000">
	<tr>
	<th>Slot name</th> <th>Slot Description</th> <th>Slot Price</th> <th>Slot Quantity</th> <th>Slot Details</th>  <th>Slot Deadline</th><th>Buy Slot</th>
	</tr>
	
	<?
		
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$Providers_ID =  $_POST['optRadio'];
		
		$sSQL = "SELECT Slot_ID, SlotName, SlotDescription,  SlotFullSellingPrice, SlotQuantity, SlotDeadline, SlotSize_ID, SlotTime_ID FROM Slots Where Providers_ID = " . $Providers_ID. " Order By SlotDeadline" ;
		//print($sSQL);
		$tmpAccs = mysql_query($sSQL);
		
		while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
			$Slot_ID = $thisAccs["Slot_ID"];
			$SlotName = $thisAccs["SlotName"];
			$SlotDescription = $thisAccs["SlotDescription"];
			$SlotFullSellingPrice = $thisAccs["SlotFullSellingPrice"];
			
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
			
			$SlotQuantity = $thisAccs["SlotQuantity"];
			$SlotDeadline = $thisAccs["SlotDeadline"];
			$SlotSize_ID = $thisAccs["SlotSize_ID"];
			$SlotTime_ID = $thisAccs["SlotTime_ID"];
			
			echo("<tr>");
			echo("<td align='center'>" . $SlotName . "</td>" );
			echo("<td align='center'>" . $SlotDescription . "</td>" );
			echo("<td align='center'>  &pound;" . $thisSellingPrice  . "</td>" );
			echo("<td align='center'>" . $SlotQuantity  . "</td>" );
			
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
			echo("<td align='center'>" . $SlotDeadline . "</td>" );
			$strProductBoxes = "";
			
			$strProductBoxes = $strProductBoxes . "<form target='_self' action='https://www.sandbox.paypal.com/cgi-bin/webscr' method='post'>";	
			$strProductBoxes = $strProductBoxes . "<input type='hidden' name='add' value='1'>";
			$strProductBoxes = $strProductBoxes . "<input type='hidden' name='item_name' value='" . $SlotName . "'>";
			
			$strProductBoxes = $strProductBoxes . "<input type='hidden' name='item_number' value='" . $Slot_ID . "'>";
			$strProductBoxes = $strProductBoxes . "<input type='hidden' name='amount' value='" . $thisSellingPrice . "'>";
			$strProductBoxes = $strProductBoxes . "<input type='hidden' name='cmd' value='_cart'>" ;
			$strProductBoxes = $strProductBoxes . "<input type='hidden' name='business' value='bus_test@ics.com'>"; // change when live

			$strProductBoxes = $strProductBoxes . "<input type='hidden' name='currency_code' value='GBP'>";
			$strProductBoxes = $strProductBoxes . "<input type='hidden' name='quantity' value='1'>";
			$strProductBoxes = $strProductBoxes . "<INPUT TYPE='hidden' NAME='return' value='http://www.theunited.media/board.php?board=client'>";
			$strProductBoxes = $strProductBoxes . "<INPUT TYPE='hidden' name='notify_url' value='http://www.theunited.media/processord.php'>";
			
			$strProductBoxes = $strProductBoxes . "<input type='hidden' name='custom' value='" . $_SESSION['Client_ID']. "'>";
			
			$strProductBoxes = $strProductBoxes . "<input type='image' src='https://www.sandbox.paypal.com/en_GB/i/btn/btn_cart_SM.gif'  border='0' name='submit'  alt='PayPal – The safer, easier way to pay online.' >";
			$strProductBoxes = $strProductBoxes . "<img alt='' border='0' src='https://www.sandbox.paypal.com/en_GB/i/scr/pixel.gif'  >";
			$strProductBoxes = $strProductBoxes . "</form>";

			
			
			echo("<td align='center'  height='160'>" . $strProductBoxes . "</td>" );
			echo("</tr>");
		}	
	}	
          ?>
		
	</table>
          </br></br>
		 
		  
          <span id="note">
            Please note that it is important to provide us with your Ad slot(s) before deadline date.
          </span></br>
          <?php //include 'off.core.includes/checkout_prices.php'; ?>
          <style>
          #checkout_button{
            color:red;
            font-family: "open sans";
            font-weight: normal;
            cursor: pointer;

          }
          </style>
          <span id="rem">By Clicking Order You accept <a href="">Terms & Condition</a></span></br></br>
          <span id="checkout_button">Click Here to See the Prices Before you Checkout</span></br></br>
          <input type="submit" name="book" id="booka" value="Checkout & Book" /> 
      
      </div>
	  
	  <? 
	  
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