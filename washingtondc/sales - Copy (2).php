<?
	$ty =  $_REQUEST['ty'];
	//print($ty);
	if ( $_SESSION['mediatype'] ==1)
	{
		$Media = "Print";
		$Typetext = "newspapers";
		$Buttontxt = "Newspapers";
	}
	if ( $_SESSION['mediatype'] ==2)
	{
		$Media = "Radio";
		$Typetext = "radio stations";
		$Buttontxt = "Radio Station";
	}
	if ( $_SESSION['mediatype'] ==3)
	{
		$Media = "TV";
		$Typetext = "tv stations";
		$Buttontxt = "TV Station";
	}
	
	
?>
 <div id="bookin">
<hr/>
	<table align="center" >
	<tr>
	<td height="130" align="center">
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
	
        <span id="book_title">You're About to book Ad Space In <? echo($Media); ?> Adverstising : </span></br>
       
        <form method="post" action="" enctype="multipart/form-data">
    <span id="book_down">Please choose one of these <? echo($Typetext); ?> : </span>
    <select name="optRadio">
		<?
	/* load settings */
	require 'connectdb.php';

	function CreateNewbatch()
	{
			$sSQL = "Insert Into SlotBatch ( Client_ID )"; 
			$sSQL .= " Value(" . $_SESSION['Client_ID'] . " )";
			//print($sSQL);
			mysql_query($sSQL); 
			$BatchID =  mysql_insert_id();
			return $BatchID;
	}
	
	function UpdateSlotCount()
	{
		$sSQL = "SELECT count(*) As SlotCount FROM SlotBatchItems Where SlotBatch_ID = " . $_SESSION['CurrentBatchID'] ;
		//print($sSQL);
		$tmpAccs = mysql_query($sSQL);
		
		while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
			$SlotCount = $thisAccs["SlotCount"];
		}
		return $SlotCount;
	}
	
	function ChkSlotinBatch($SlotID)
	{
		$Result = 0;
		$sSQL = "SELECT SlotBatchItem_ID FROM SlotBatchItems Where Slot_ID = " . $SlotID  . " And SlotBatch_ID = " . $_SESSION['CurrentBatchID'] ;
		//print($sSQL);
		$tmpAccs = mysql_query($sSQL);
		
		while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
			$SlotBatchItem_ID = $thisAccs["SlotBatchItem_ID"];
			$Result = 1;
		}
		return $Result;
	}	
	
	function GetBatchTotal()
	{
		$sSQL = "SELECT TotalPrice FROM SlotBatch Where  SlotBatch_ID =" .  $_SESSION['CurrentBatchID']; 
		$tmpAccs = mysql_query($sSQL);
		
		while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
			$TotalPrice = $thisAccs["TotalPrice"];
		}
		return $TotalPrice;	
	}
		
	function UpdateBatchTotal($SlotID)
	{
	
		$sSQL = "SELECT  SlotFullSellingPrice  FROM Slots Where Slot_ID = " .$SlotID ;
		$tmpAccs = mysql_query($sSQL);
		
		while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
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
		}	
		$sSQL = "Update SlotBatch Set TotalPrice = TotalPrice + " . $thisSellingPrice   . " Where SlotBatch_ID =" .  $_SESSION['CurrentBatchID']; 
		mysql_query($sSQL); 
	}
	
		
	function UpdateRemBatchTotal($SlotID)
	{
	
		$sSQL = "SELECT  SlotFullSellingPrice  FROM Slots Where Slot_ID = " .$SlotID ;
		$tmpAccs = mysql_query($sSQL);
		
		while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
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
		}	
		$sSQL = "Update SlotBatch Set TotalPrice = TotalPrice - " . $thisSellingPrice   . " Where SlotBatch_ID =" .  $_SESSION['CurrentBatchID']; 
		mysql_query($sSQL); 
	}
		
		
	$rembatnb =  $_REQUEST['rembatnb']; // Remove Slot Selection Added to Batch
	if ($rembatnb > 0)
	{
			$sSQL = "Delete From SlotBatchItems Where SlotBatch_ID = " . $_SESSION['CurrentBatchID'] . " And Slot_ID  = " .$rembatnb; 
		//	print($sSQL);
			mysql_query($sSQL); 
			UpdateRemBatchTotal($rembatnb);

		//die("Got Here2");
		?>
	<script>
	window.location="book.php?type=tv";
	</script>
		<?
	}	
		
	
	$nxbatnb =  $_REQUEST['nxbatnb']; // Multi Slot Selection Added to Batch
	if ($nxbatnb > 0)
	{
	//print(" nxbatnb = " . $nxbatnb);
	
		$iCount = 1;
		
		$sSQL = "SELECT Slot_ID  FROM Slots Where SlotName = '" . $_SESSION['CurrentSlotName'] . "' And Providers_ID = " . $_SESSION['thisProviders_ID']. " Order By SlotDeadline" ;
		//print($sSQL);
		$tmpAccs = mysql_query($sSQL);
		
	while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
	{
		$Slot_ID = $thisAccs["Slot_ID"];
		$SlotinBatch = ChkSlotinBatch($Slot_ID);
			if($iCount <= $nxbatnb)
			{
				If($SlotinBatch == 0)
				{
					if( $_SESSION['CurrentBatchID'] >0)
					{
							$sSQL = "Insert Into SlotBatchItems ( SlotBatch_ID, Slot_ID )"; 
							$sSQL .= " Value(" . $_SESSION['CurrentBatchID'] . "," . $Slot_ID . " )";
							//print($sSQL);
							mysql_query($sSQL); 
					}
					else
					{
						 $_SESSION['CurrentBatchID'] = CreateNewbatch();
						$sSQL = "Insert Into SlotBatchItems ( SlotBatch_ID, Slot_ID )"; 
						$sSQL .= " Value(" . $_SESSION['CurrentBatchID'] . "," . $Slot_ID . " )";
						//print($sSQL);
						mysql_query($sSQL); 
					}
					$iCount = $iCount + 1;
					UpdateBatchTotal($Slot_ID);

				}
			}
		}
		?>
	<script>
	window.location="book.php?type=tv";
	</script>
		<?
	}	

	
	$batnb =  $_REQUEST['batnb']; // Single Slot Selection Added to Batch
	
	if ($batnb > 0)
	{
		if( $_SESSION['CurrentBatchID'] >0)
		{
				$sSQL = "Insert Into SlotBatchItems ( SlotBatch_ID, Slot_ID )"; 
				$sSQL .= " Value(" . $_SESSION['CurrentBatchID'] . "," . $batnb . " )";
				//print($sSQL);
				mysql_query($sSQL); 
		}
		else
		{
			 $_SESSION['CurrentBatchID'] = CreateNewbatch();
			$sSQL = "Insert Into SlotBatchItems ( SlotBatch_ID, Slot_ID )"; 
			$sSQL .= " Value(" . $_SESSION['CurrentBatchID'] . "," . $batnb . " )";
			//print($sSQL);
			mysql_query($sSQL); 
		}
			
			UpdateBatchTotal($batnb);
			
		?>
	<script>
	window.location="book.php?type=tv";
	</script>
		<?
		
	}	
		
	$ty =  $_REQUEST['ty'];
		
	$sSQL = "SELECT  Providers_ID, ProvidersCompany FROM Providers Where MediaType_ID = " . $_SESSION['mediatype'] . " Order By ProvidersName" ;
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
    <input type="submit" name="Submit"  id="booka" value="Select <? echo($Buttontxt); ?>">
	</form>
	</br>
        <?
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$Providers_ID =  $_POST['optRadio'];
		$sSQL = "SELECT ProvidersCompany, PubDuration FROM Providers Where Providers_ID = " . $Providers_ID ;
		//print($sSQL);
		$tmpAccs = mysql_query($sSQL);
		
		while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
			$ProvidersCompany = $thisAccs["ProvidersCompany"];
			$PubDuration = $thisAccs["PubDuration"];
			$_SESSION['ProvidersCompany'] =  $ProvidersCompany;
			$_SESSION['PubDuration'] =  $PubDuration;
			$_SESSION['thisProviders_ID'] =  $Providers_ID;
		}

		?>
		<hr>
		<table align="center">
		<tr>
		
      <td  align="center"><font size="+2">Provider:</font></td>
      <td align="center"><font size="+2"><? echo($ProvidersCompany); ?></font></td>
		</tr>
		<tr>
      <td  colspan="2" align="center"><a href="book.php?type=tv&pt=sl&proid=<? echo($Providers_ID); ?>"><font size="+2"><strong>View Slots</strong></font></a></td>
		</tr>
		<tr>
		
      <td colspan="2" align="center"><a href="book.php?type=tv&pt=so&proid=<? echo($Providers_ID); ?>"><font size="+2"><strong>View Special Offers</strong></font></a></td>
		</tr>
		</table>
		<hr>
		
		<?
	}	
	$pt =  $_REQUEST['pt'];
	if ($pt=="sl")
	{
		$proid =  $_REQUEST['proid'];
		if ($proid >0)
		{
			?>
			<table align="center" border="1" bordercolor="#0000FF">
			<tr>
			
      <th  colspan="3" align="center"><font size="+3">Select Slot to order</font></th>
			</tr>
			<tr>
			
      <th align="center" ><font size="+2">Slot Name</font></th>  <th align="center" ><font size="+2">Slot Description</font></th> <th align="center" ><font size="+2">Slot Price</font></th>
			</tr>
			<?
			$sSQL = "SELECT DISTINCT SlotName , SlotDescription ,  SlotFullSellingPrice FROM Slots Where Providers_ID = " . $proid . " Order by SlotName" ;
			//print($sSQL);
			$tmpAccs = mysql_query($sSQL);
			
			while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
			{
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
				echo("<tr>");
				echo("<td align='center' ><font size='+2'><a href='book.php?type=tv&sln=" . $SlotName . "'>" . $SlotName . "</a></font></td><td align='center' ><font size='+2'>" . $SlotDescription . "</font></td><td align='center' ><font size='+2'>" . $thisSellingPrice . "</font></td>");
				echo("</tr>");
			}
			?>
			 </table>
			<?
		}	
	}
	
	
	
		$BatTotal = GetBatchTotal();
		$SlotName = "Multi slot purchase. Batch Num = " . $_SESSION['CurrentBatchID'];
		
		$strProductBoxes ="";
		$strProductBoxes = $strProductBoxes . "<form target='_self' action='https://www.sandbox.paypal.com/cgi-bin/webscr' method='post'>";	
		$strProductBoxes = $strProductBoxes . "<input type='hidden' name='add' value='1'>";
		$strProductBoxes = $strProductBoxes . "<input type='hidden' name='item_name' value='Batch'>";
		
		$strProductBoxes = $strProductBoxes . "<input type='hidden' name='item_number' value='" . $_SESSION['CurrentBatchID'] . "'>";   
		$strProductBoxes = $strProductBoxes . "<input type='hidden' name='amount' value='" . $BatTotal . "'>";
		$strProductBoxes = $strProductBoxes . "<input type='hidden' name='cmd' value='_cart'>" ;
		$strProductBoxes = $strProductBoxes . "<input type='hidden' name='business' value='bus_test@ics.com'>"; // change when live
	
		$strProductBoxes = $strProductBoxes . "<input type='hidden' name='currency_code' value='GBP'>";
		$strProductBoxes = $strProductBoxes . "<input type='hidden' name='quantity' value='1'>";
		$strProductBoxes = $strProductBoxes . "<INPUT TYPE='hidden' NAME='return' value='http://www.theunited.media/board.php?board=client'>";
		$strProductBoxes = $strProductBoxes . "<INPUT TYPE='hidden' name='notify_url' value='http://www.theunited.media/batprocessord.php'>";
		
		$strProductBoxes = $strProductBoxes . "<input type='hidden' name='custom' value='" . $_SESSION['Client_ID']. "'>";
		$strProductBoxes = $strProductBoxes . "<input type='hidden' name='shopping_url'  value='http://www.theunited.media/board.php?board=client&nwbth=1'>";
		$strProductBoxes = $strProductBoxes . "<input type='image' src='https://www.sandbox.paypal.com/en_GB/i/btn/btn_cart_SM.gif'  border='0' name='submit'  alt='PayPal – The safer, easier way to pay online.' >";
		$strProductBoxes = $strProductBoxes . "<img alt='' border='0' src='https://www.sandbox.paypal.com/en_GB/i/scr/pixel.gif'  >";
		$strProductBoxes = $strProductBoxes . "</form>";

	
	$sln =  $_REQUEST['sln'];
	if ($sln <>"") 
	{
		$optSlot = $sln;
		$txtProvID =  $_SESSION['thisProviders_ID'];
		$txtPubDuration =  $_SESSION['PubDuration'];
		$txtProvidersCompany =  $_SESSION['ProvidersCompany'];
		 $_SESSION['CurrentSlotName'] = $optSlot;
		$Duration = "";
		$NumberofSlotsSelected = 0;
		switch ($txtPubDuration) {
			case 'D':
				$Duration ="Daily";			  
			  break;
			  
			   case 'W':
				$Duration ="Weekly";			  
			  break;
			  		 
			   case 'F':
				$Duration ="Fortnight";			  
			  break;
			  
			   case 'M':
				$Duration ="Monthly";			  
			  break;		 
			  }
			  $NumberofSlotsSelected = UpdateSlotCount();
			  $BatchTotal = GetBatchTotal();
			  
			  ?>
		 <table border="1" bordercolor="#0000FF" align="center">
		 <tr>
		 
      <td align="center"><font size="+2"><strong>Provider Name: </strong>&nbsp; 
        <? echo($txtProvidersCompany); ?></font>
		<br/>
<font size="+2"><strong>Production Duration: </strong><? echo($Duration); ?></font>		</td>
     
	  <td align="center"><font size="+2">Number of Slots Selected:</font> </td>
		 </tr>
		 <tr>
		 <td align="center"><p><font size="+2"><a href="book.php?type=tv&nxbatnb=5">Select 
          Next 5 slots</a></font></p>
        <p><font size="+2"><a href="book.php?type=tv&nxbatnb=7">Select Next 7 
          slots</a></font></p>
        <p><font size="+2"><a href="book.php?type=tv&nxbatnb=10">Select Next 10 
          slots</a></font></p>
        <p><font size="+2"><a href="book.php?type=tv&nxbatnb=14">Select Next 14 
          slots</a></font></p></td>  
      
      <td height="350" align="center"><font size="+2"><? echo($NumberofSlotsSelected); ?> <br/>Total Balance: &nbsp; <? echo($BatTotal); ?>  &nbsp; <? echo($strProductBoxes); ?></font></td>
		 </tr>
		 </table>
		 <br/>
		 <table align="center" border="1" bordercolor="#FF0000">
		 <tr>
		 <th colspan="7"><font size='+1'>Select Slots to Purchase</font></th>
		 </tr>
		 <tr>
		 <th><font size="+1">Slot</font></th>  <th><font size="+1">Description</font></th>  <th><font size="+1">Price</font></th>  <th><font size="+1">Slot Details</font></th>  <th><font size="+1">Production Date</font></th>  <th align="center"  ><font size="+1">Select</font> </th>
		 </tr>
		 <?
		 $loop = 1;
		$sSQL = "SELECT Slot_ID, SlotName, SlotDescription,  SlotFullSellingPrice, SlotDeadline, SlotSize_ID, SlotTime_ID FROM Slots Where SlotName = '" . $optSlot . "' And Providers_ID = " . $txtProvID. " Order By SlotDeadline" ;
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
			
			$SlotDeadline = $thisAccs["SlotDeadline"];
			$SlotSize_ID = $thisAccs["SlotSize_ID"];
			$SlotTime_ID = $thisAccs["SlotTime_ID"];
			
			echo("<tr>");
			echo("<td align='center'><font size='+1'>" . $SlotName . "</font></td>" );
			echo("<td align='center'><font size='+1'>" . $SlotDescription . "</font></td>" );
			echo("<td align='center'><font size='+1'>  &pound;" . $thisSellingPrice  . "</font></td>" );
			
			if($SlotSize_ID > 0)
			{
				$GetSizename = GetSizename($SlotSize_ID);
			}
			
			if($SlotTime_ID > 0)
			{
				$GetSlotTime = GetSlotTime($SlotTime_ID);
			}
			$SlotDetails = $GetSizename . "&nbsp;" . $GetSlotTime;
			echo("<td align='center'><font size='+1'>" . $SlotDetails . "</font></td>" );
			$ProductionDate = date("Y-m-d", strtotime($SlotDeadline . " +10 days")); 

			echo("<td align='center'><font size='+1'>" . $ProductionDate . "</font></td>" );
			
			$SlotinBatch = ChkSlotinBatch($Slot_ID);
			If($SlotinBatch == 0)
			{
				echo("<td align='center'><font size='+1'> <a href='book.php?type=tv&batnb=" . $Slot_ID ."'>Select Slot</a></font></td>" );
			}
			else
			{
				echo("<td align='center'><font size='+1'> <a href='book.php?type=tv&rembatnb=" . $Slot_ID ."'>Remove Slot</a></font></td>" );
			}
			
			echo("</tr>");
			 $loop =  $loop +1;
	
	 	}
			?>
			
			</table>
			<?
	 }
	$pt =  $_REQUEST['pt'];
	if ($pt=="so")
	{
		$proid =  $_REQUEST['proid'];
		if ($proid >0)
		{
		 ?>
		<hr/>
		
		<table border="1" bordercolor="#FF0000" align="center">
		<tr>
		<th>Slot name</th> <th>Slot Description</th> <th>Slot Price</th> <th>Slot Quantity</th> <th>Slot Details</th>  <th>Slot Deadline</th><th>Buy Slot</th>
		</tr>
		
		<?
	
		$Providers_ID =  $_POST['optRadio'];
		
		$sSQL = "SELECT Slot_ID, SlotName, SlotDescription,  SlotFullSellingPrice, SlotQuantity, SlotDeadline, SlotSize_ID, SlotTime_ID FROM Slots Where Providers_ID = " . $proid. " Order By SlotDeadline" ;
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
			$strProductBoxes = $strProductBoxes . "<INPUT TYPE='hidden' name='notify_url' value='http://www.theunited.media/batprocessord.php'>";
			
			$strProductBoxes = $strProductBoxes . "<input type='hidden' name='custom' value='" . $_SESSION['Client_ID']. "'>";
			
			$strProductBoxes = $strProductBoxes . "<input type='image' src='https://www.sandbox.paypal.com/en_GB/i/btn/btn_cart_SM.gif'  border='0' name='submit'  alt='PayPal – The safer, easier way to pay online.' >";
			$strProductBoxes = $strProductBoxes . "<img alt='' border='0' src='https://www.sandbox.paypal.com/en_GB/i/scr/pixel.gif'  >";
			$strProductBoxes = $strProductBoxes . "</form>";

			
			
			echo("<td align='center'  height='160'>" . $strProductBoxes . "</td>" );
			echo("</tr>");
		}	
		
          ?>
		
		</table>
		</br></br>
	 <?
	}	
}	
    ?>      <span id="note">
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