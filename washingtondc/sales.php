<?
	/* load settings */
	require 'connectdb.php';
	 if(isset($_SESSION['logtrue']))
	 {
	 	$Action = "book.php";
	 }
	 else
	 {
	 	$Action = "shop.php";
	 }
	 
	$ty =  $_REQUEST['ty'];
	//print($ty);
	if ( $_SESSION['mediatype'] ==1)
	{
		$Media = "Print";
		$Typetext = "newspapers";
		$Buttontxt = "Newspapers";
		 $_SESSION['mediatypeName'] = "print";
	}
	if ( $_SESSION['mediatype'] ==2)
	{
		$Media = "Radio";
		$Typetext = "radio stations";
		$Buttontxt = "Radio Station";
		 $_SESSION['mediatypeName'] = "radio";
	}
	if ( $_SESSION['mediatype'] ==3)
	{
		$Media = "TV";
		$Typetext = "TV stations";
		$Buttontxt = "TV Station";
		
		 $_SESSION['mediatypeName'] = "tv";
	}

	if ( $_SESSION['mediatype'] ==4)
	{
		$Media = "Bilboards";
		$Typetext = "Bilboards";
		$Buttontxt = "Bilboards";
		
		 $_SESSION['mediatypeName'] = "board";
	}
	
	function CreateNewbatch()
	{
			
			if ($_SESSION['Client_ID'] >0)
			{
				$sSQL = "Insert Into SlotBatch ( Client_ID )"; 
				$sSQL .= " Value(" . $_SESSION['Client_ID'] . " )";
			}
			else
			{
				$sSQL = "Insert Into SlotBatch ( TotalPrice )"; 
				$sSQL .= " Value(0)";
			}
			//print($sSQL);
			mysql_query($sSQL); 
			$BatchID =  mysql_insert_id();
			return $BatchID;
	}
	
	function UpdateSlotCount($BatID)
	{
		$SlotCount = 0;
		
		$sSQL = "SELECT count(*) As SlotCount FROM SlotBatchItems Where SlotBatch_ID = " .$BatID ;
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
	
	function GetBatchTotal($BatID)
	{
		$sSQL = "SELECT TotalPrice FROM SlotBatch Where  SlotBatch_ID =" . $BatID; 
		//print($sSQL);
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
			$sSQL = "Delete From SlotBatchItems Where SlotBatch_ID = " . $_SESSION['CurrentBatchID'] . " And SlotBatchItem_ID  = " .$rembatnb; 
			print($sSQL);
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
	
?>
 <div id="bookin">
<hr/>
        <div id="book_in">
             <span id="b_title">Please Choose in which field you would like to advertise : </span>
            <a href="<? echo($Action); ?>?type=radio">Radio Advertising </a>
             <a href="<? echo($Action); ?>?type=tv">Tv Advertising</a>
            <a href="<? echo($Action); ?>?type=print">Print Advertising</a>
            <a href="<? echo($Action); ?>?type=board">Board Advertising</a></br>
			</br>
           </div>
	<hr/>
	
        <span id="book_title">You're About to book Ad Space In <? echo($Media); ?> Adverstising : </span></br>
       
        <form method="post" name="frmMain" action="" enctype="multipart/form-data">
<?
if ($_SESSION['mediatype'] > 3)
{
?>
  
    <select name="optLocation" onchange='document.frmMain.submit();'>
	<option value='0'>Please choose Location Type </option>
		<?

	
		
	$ty =  $_REQUEST['ty'];
		
	$sSQL = "SELECT  LocationType_ID, LocationTypeName  FROM  LocationType" . " Order By LocationTypeName" ;
	//print($sSQL);
	$tmpAccs = mysql_query($sSQL);
	
	while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
	{
		$LocationTypeName = $thisAccs["LocationTypeName"];
		$LocationType_ID = $thisAccs["LocationType_ID"];
		
		echo("<option value='" . $LocationType_ID . "'>". $LocationTypeName . "</option>");
	}
	
}
else
{
?>
  
    <select name="optRadio" onchange='document.frmMain.submit();'>
	<option value='0'>Please choose one of these <? echo($Typetext); ?> </option>
	<?

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
}
		?>	
        </select>
	</form>
	</br>
        <?
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$accp =  $_REQUEST['accp'];
		if ($accp == 1) 
		{
			$choTerms =  $_POST['choTerms'];
			if($choTerms == "Accepted")
			{
				$_SESSION['TermsAccped'] = "Y";
			}
			else
			{
				$_SESSION['TermsAccped'] = "N";
			}
			?>
			<script>
			window.location="<? echo($Action); ?>?type=<? echo( $_SESSION['mediatypeName']); ?>";
			</script>}
			<?
		}	
		$optLocation =  $_POST['optLocation'];
		
		$Providers_ID =  $_POST['optRadio'];
		if($Providers_ID > 0 Or $optLocation > 0 )
		{
			if ($optLocation > 0)
			{
				
				$sSQL = "SELECT LocationTypeName FROM LocationType Where LocationType_ID = " . $optLocation ;
				//print($sSQL);
				$tmpAccs = mysql_query($sSQL);
				
				while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
				{
					$LocationTypeName = $thisAccs["LocationTypeName"];
					
					$_SESSION['StandTxt'] = "Location Type";
					$_SESSION['ProvidersCompany'] =  $LocationTypeName;
				//	$_SESSION['PubDuration'] =  $PubDuration;
				}
				
				$sSQL = "SELECT DISTINCT SlotName , SlotDescription , SlotQuantity,  SlotFullSellingPrice, Location FROM Slots, ProviderLocations Where TIMESTAMPDIFF(DAY,NOW(),SlotDeadline) >= 1 And SlotQuantity >0 And Live = 1 And Slots.Locations = ProviderLocations.ProviderLocation_ID And ProviderLocations.LocationType_ID =" . $optLocation . " Order by SlotName" ;
			}
				
			if ($Providers_ID> 0)
			{
				$sSQL = "SELECT ProvidersCompany, PubDuration FROM Providers Where Providers_ID = " . $Providers_ID ;
				//print($sSQL);
				$tmpAccs = mysql_query($sSQL);
				
				while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
				{
					$ProvidersCompany = $thisAccs["ProvidersCompany"];
					$PubDuration = $thisAccs["PubDuration"];
					$_SESSION['StandTxt'] = "Provider";
					$_SESSION['ProvidersCompany'] =  $ProvidersCompany;
					$_SESSION['PubDuration'] =  $PubDuration;
					$_SESSION['thisProviders_ID'] =  $Providers_ID;
					
					$sSQL = "SELECT DISTINCT SlotName , SlotDescription , SlotQuantity,  SlotFullSellingPrice FROM Slots Where TIMESTAMPDIFF(DAY,NOW(),SlotDeadline) >= 1 And SlotQuantity >0 And Live = 1 And Providers_ID = " . $_SESSION['thisProviders_ID'] . " Order by SlotName" ;
				}
			}	
			?>
			<hr>
			
			<table align="center">	
			  <td  align="center"><font size="+2"><? echo($_SESSION['StandTxt']); ?>:</font></td>
			  <td align="center"><font size="+2"><? echo($_SESSION['ProvidersCompany']); ?></font></br></td>
			</tr>
			</table>
			
			<span id="book_title">Slot Types: </span>
			</br>
			<form method="post" name="frmSlot" action="<? echo(	$Action); ?>?type=<? echo( $_SESSION['mediatypeName']); ?>&sltsel=1" enctype="multipart/form-data">
		
			<select name="optSltname" onchange='document.frmSlot.submit();' >
			<option value=''>Please choose one of these slots </option>
			<?
			
			//print("SQL = " . $sSQL);
			$tmpAccs = mysql_query($sSQL);
			
			while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
			{
				$SlotName = $thisAccs["SlotName"];
				$SlotDescription = $thisAccs["SlotDescription"];
				$SlotFullSellingPrice = $thisAccs["SlotFullSellingPrice"];
				$SlotQuantity = $thisAccs["SlotQuantity"];
				
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
				
				if($_SESSION['StandTxt'] == "Location Type")
				{
					$Location = $thisAccs["Location"];
					$Displaystr = $SlotName . " (" . $SlotDescription .  ") RRP &pound;" . $SlotFullSellingPrice .  " Your Price &pound;" . $thisSellingPrice . " Location: " . $Location; 
				}
				else
				{
					$Location = "";
					$Displaystr = $SlotName . " (" . $SlotDescription .  ") RRP &pound;" . $SlotFullSellingPrice .  " Your Price &pound;" . $thisSellingPrice; 
				}
				
				echo("<option value='" . $SlotName . "'>". $Displaystr . "</option>");
			}
			?>
			 </select>
			</form>	
			<?
		}
		
	}
	
	$sltsel =  $_REQUEST['sltsel'];
	if ($sltsel == 1) 
	{
		$optSltname =  $_POST['optSltname'];
		if($optSltname <> "")
		{
		
			switch ($_SESSION['PubDuration'] ) 
			{
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
			
			$Selection = $_SESSION['StandTxt'] . $_SESSION['ProvidersCompany'] . " - Production Duration: " .  $Duration . " - Slot Selected: " . $optSltname;
			$_SESSION['Selection'] = $Selection;
			
			$txtProvID =  $_SESSION['thisProviders_ID'];
			$txtPubDuration =  $_SESSION['PubDuration'];
			$txtProvidersCompany =  $_SESSION['ProvidersCompany'];
			$_SESSION['CurrentSlotName'] = $optSltname;
			
				if($_SESSION['StandTxt'] == "Location Type")
				{
					$sSQL = "SELECT count(*) as NumSlots FROM Slots Where TIMESTAMPDIFF(DAY,NOW(),SlotDeadline) >= 1 And SlotQuantity > 0 And Live = 1 And SlotName = '" . $optSltname ."'" ;
				}
				else
				{
					$sSQL = "SELECT count(*) as NumSlots FROM Slots Where TIMESTAMPDIFF(DAY,NOW(),SlotDeadline) >= 1 And SlotQuantity > 0 And Live = 1 And SlotName = '" . $optSltname . "' And Providers_ID = " . $txtProvID ;
				}
			
			//print($sSQL);
			$tmpAccs = mysql_query($sSQL);
			
			while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
			{
				$NumSlots = $thisAccs["NumSlots"];
			}
			
			if ($NumSlots > 14)
			{
				$NumSlots = 14;
			}
			
			
			//	print(" Total slots = " . $NumSlots);
			?>
			<span id="book_title">Selection Details: <? echo($Selection); ?></span>
			<br/>
			<form method="post" name="frmSlotdisp" action="<? echo($Action); ?>?type=<? echo($_SESSION['mediatypeName']); ?>&sltnum=1" enctype="multipart/form-data">
		
			<select name="optSlotNum" onchange='document.frmSlotdisp.submit();' >
			<option value='0'>Please select number of slots </option>
			
			<?	
			for ($loop = 1; $loop <= $NumSlots; $loop++) 
			{
				echo ("<option value='" . $loop . "'>" .  $loop . " </option>");
			} 
			?>
			 </select>
			</form>	
			<?
		}
	}
	
	
	$sltnum =  $_REQUEST['sltnum'];
	if ($sltnum == 1) 
	{
		$optSlotNum =  $_POST['optSlotNum'];
		
		$_SESSION['NumSlots'] = $optSlotNum;
		
		switch ($_SESSION['PubDuration']) 
		{
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
		?>
		<span id="book_title">Selection Details: <? echo($_SESSION['Selection'] . " - No Slots Requested: " . $optSlotNum ); ?></span>
		<br/><br/>
		<form method="post" name="frmSlotdisp" action="<? echo(	$Action); ?>?type=<? echo($_SESSION['mediatypeName']); ?>&sltDate=1" enctype="multipart/form-data">
		<span id="book_title">Select 1st Date, Plus the next <? echo($optSlotNum-1); ?> Slots Available: <input name="chkGetAllSlots" type="checkbox" id="chkGetAllSlots" value="Y" checked /></span> <br/>
		
		<select name="optSlotFDate" onchange='document.frmSlotdisp.submit();' >
		<option value='0'>Please select first Slot by Deadline Date </option>
		
		<?
		if($_SESSION['StandTxt'] == "Location Type")
		{		
			$sSQL = "SELECT Slot_ID, SlotDeadline FROM Slots Where TIMESTAMPDIFF(DAY,NOW(),SlotDeadline) >= 1 And SlotQuantity > 0 And Live = 1 And SlotName = '" . $_SESSION['CurrentSlotName'] . "'  Order By SlotDeadline" ;
		}
		else
		{		
			$sSQL = "SELECT Slot_ID, SlotDeadline FROM Slots Where TIMESTAMPDIFF(DAY,NOW(),SlotDeadline) >= 1 And SlotQuantity > 0 And Live = 1 And SlotName = '" . $_SESSION['CurrentSlotName'] . "' And Providers_ID = " . $_SESSION['thisProviders_ID'] . " Order By SlotDeadline" ;
		}
		//print($sSQL);
		$tmpAccs = mysql_query($sSQL);
		
		while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
			$Slot_ID = $thisAccs["Slot_ID"];
			
			$SlotDeadline = $thisAccs["SlotDeadline"];
			$ProductionDate = date("D-d-M-y", strtotime($SlotDeadline )); 
			
			echo ("<option value='" . $Slot_ID . "'>" .  $ProductionDate . " </option>");
		} 
		
			?>
			 </select>
			</form>	
			<?
	}
	
	$sltDate =  $_REQUEST['sltDate'];
	
	if ($sltDate == 1) 
	{
		$Slot_ID =  $_POST['optSlotFDate'];
		
		$DateSelected2 = GetSlotDate($Slot_ID);
		$DateSelected = date("D-d-M-y", strtotime($DateSelected2)); 
		$_SESSION['FirstStotID'] = $Slot_ID;
		
		$chkGetAllSlots =  $_POST['chkGetAllSlots'];
		
			// add slots to batch
		AddSlottoBatch($Slot_ID);
			
		if($chkGetAllSlots == "Y")
		{
			$Limit = $_SESSION['NumSlots'] -1;
			if($_SESSION['StandTxt'] == "Location Type")
			{		
				$sSQL = "SELECT Slot_ID FROM Slots Where TIMESTAMPDIFF(DAY,NOW(),SlotDeadline) >= 1 And SlotDeadline > '" . $DateSelected2 . "' And SlotQuantity > 0 And Live = 1 And SlotName = '" . $_SESSION['CurrentSlotName'] . "' Order By SlotDeadline Limit " . $Limit  ;
			}
			else
			{		
				$sSQL = "SELECT Slot_ID FROM Slots Where TIMESTAMPDIFF(DAY,NOW(),SlotDeadline) >= 1 And SlotDeadline > '" . $DateSelected2 . "' And SlotQuantity > 0 And Live = 1 And SlotName = '" . $_SESSION['CurrentSlotName'] . "' And Providers_ID = " . $_SESSION['thisProviders_ID'] . " Order By SlotDeadline Limit " . $Limit  ;
			}
			//print($sSQL);
		//	die("Here");
			$tmpAccs = mysql_query($sSQL);
			
			while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
			{
				$Slot_ID = $thisAccs["Slot_ID"];
				AddSlottoBatch($Slot_ID);
			} 
			?>
			<script>
			window.location="<? echo($Action); ?>?type=<? echo($_SESSION['mediatypeName']); ?>";
			</script>
			<?
		}
		else
		{
			?>
		<span id="book_title">Selection Details: <? echo($_SESSION['Selection'] . " - No. Slots Requested: " . $_SESSION['NumSlots'] ); ?></span><br/>
		<span id="book_title">1st Date Selected: <? echo($DateSelected); ?></span>
		<br/><br/>
			<form method="post" name="frmAdd" action="<? echo($Action); ?>?type=<? echo($_SESSION['mediatypeName']); ?>&sltAdd=1" enctype="multipart/form-data">
			<?
			// select the other dates
			for ($loop = 2; $loop <= $_SESSION['NumSlots']; $loop++) 
			{
				switch ($loop) 
				{
					case '2':
						$NumText ="2nd";			  
					  break;
					  
					   case '3':
						$NumText ="3rd";			  
					  break;
							 
					   case '4':
						$NumText ="4th";			  
					  break;
					  
					   case '5':
						$NumText ="5th";			  
					  break;
					  
					case '6':
						$NumText ="6th";			  
					  break;
					  
					   case '7':
						$NumText ="7th";			  
					  break;
							 
					   case '8':
						$NumText ="8th";			  
					  break;
					  
					   case '9':
						$NumText ="9th";			  
					  break;
					  		 
					case '10':
						$NumText ="10th";			  
					  break;
					  
					   case '11':
						$NumText ="11th";			  
					  break;
							 
					   case '12':
						$NumText ="12th";			  
					  break;
					  
					   case '13':
						$NumText ="13th";			  
					  break;
					  
					   case '14':
						$NumText ="14th";			  
					  break;
				 }
				 ?>
				<select name="optSlot<? echo($loop); ?>Date"  >
				<option value='0'>Please select <? echo($NumText); ?> Slot by Deadline Date </option>
				
				<?
					
				$sSQL = "SELECT Slot_ID, SlotDeadline FROM Slots Where TIMESTAMPDIFF(DAY,NOW(),SlotDeadline) >= 1 And SlotQuantity > 0 And Live = 1 And SlotName = '" . $_SESSION['CurrentSlotName'] . "' And Providers_ID = " . $_SESSION['thisProviders_ID'] . " Order By SlotDeadline" ;
				//print($sSQL);
				$tmpAccs = mysql_query($sSQL);
				
				while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
				{
					$Slot_ID = $thisAccs["Slot_ID"];
					
					$SlotDeadline = $thisAccs["SlotDeadline"];
					$ProductionDate = date("D-d-M-y", strtotime($SlotDeadline )); 
					
					echo ("<option value='" . $Slot_ID . "'>" .  $ProductionDate . " </option>");
				} 
				
					?>
					 </select>
					 <br/>
					<?
			
			}
			?>
			<input name="cmdAdd" type="submit" id="cmdAdd" value="Add Slots" />
			</form>
			<?
			// add slots to batch
			
		
		}
		
		
		// print("chkGetAllSlots = " . $chkGetAllSlots);
	}	
	
	$sltAdd =  $_REQUEST['sltAdd'];
	
	if ($sltAdd == 1) 
	{
		for ($loop = 2; $loop <= $_SESSION['NumSlots']; $loop++) 
		{
			$Slot_ID =  $_POST["optSlot" . $loop . "Date"];
			AddSlottoBatch($Slot_ID);
		}	
			?>
			<script>
			window.location="<? echo($Action); ?>?type=<? echo($_SESSION['mediatypeName']); ?>";
			</script>
			<?
		
	}
	

	?>
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
</br>
   </div>
   <br/>
   <form name="frmTerms" method="post" action="<? echo($Action); ?>?type=<? echo( $_SESSION['mediatypeName']); ?>&accp=1">
   <table align="center">
   <tr>
   <td>click <a href="images/Terms and Conditions v2.1.pdf" target="_blank">HERE</a> to read our TERMS AND CONDITIONS</td> 
   <td> Check Box to accept 
   <?
   if($_SESSION['TermsAccped'] == "Y")
   {
   ?>
     <input type="checkbox" name="choTerms" value="Accepted" onchange='document.frmTerms.submit();' checked>
	<? 
	}
	else
	{

   ?>
     <input type="checkbox" name="choTerms" value="Accepted" onchange='document.frmTerms.submit();'>
	<? 
	} 
	?>
     </td>
   </tr>
   <tr>
      <td colspan="2" align="center">click <a href="images/Media United Privacy Policy.pdf" target="_blank">HERE</a> 
        to read</font> our Privacy Policy </td>
   </tr>
   </table>
   </form>
	<table align="center" >
	<tr>
	<td height="130" align="center">
	<form target="paypal" action="https://www.paypal.com/cgi-bin/webscr"
	method="post">
	
	<!-- Identify your business so that you can collect the payments. -->
	<input type="hidden" name="business" value="sales@blacklinksuk.com">
	
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
	<tr>
	<?
	if (isset($_SESSION['CurrentBatchID']) And  $_SESSION['CurrentBatchID'] > 0)
	{
		echo("<td align='center'>");
		$SlotbatchCount = UpdateSlotCount($_SESSION['CurrentBatchID']);
		$SlotbatchTotal = GetBatchTotal($_SESSION['CurrentBatchID']);
		
		$strProductBoxes ="";
		$strProductBoxes = $strProductBoxes . "<form target='_self' action='https://www.sandbox.paypal.com/cgi-bin/webscr' method='post'>";	
		$strProductBoxes = $strProductBoxes . "<input type='hidden' name='add' value='1'>";
		$strProductBoxes = $strProductBoxes . "<input type='hidden' name='item_name' value='Batch'>";
		
		$strProductBoxes = $strProductBoxes . "<input type='hidden' name='item_number' value='" . $_SESSION['CurrentBatchID'] . "'>";   
		$strProductBoxes = $strProductBoxes . "<input type='hidden' name='amount' value='" . $SlotbatchTotal . "'>";
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
		
		$strProductBoxes = $strProductBoxes . "<INPUT TYPE='hidden' name='notify_url' value='http://www.mediaunited.co.uk/batprocessord.php'>";
		
		$strProductBoxes = $strProductBoxes . "<input type='hidden' name='custom' value='" . $_SESSION['Client_ID']. "'>";
		$strProductBoxes = $strProductBoxes . "<input type='hidden' name='shopping_url'  value='http://www.mediaunited.co.uk/board.php?board=client&nwbth=1'>";
		$strProductBoxes = $strProductBoxes . "<input type='image' src='https://www.sandbox.paypal.com/en_GB/i/btn/btn_cart_SM.gif'  border='0' name='submit'  alt='PayPal � The safer, easier way to pay online.' >";
		$strProductBoxes = $strProductBoxes . "<img alt='' border='0' src='https://www.sandbox.paypal.com/en_GB/i/scr/pixel.gif'  >";
		$strProductBoxes = $strProductBoxes . "</form>";
		
	   if ($_SESSION['TermsAccped'] <> "Y")
	   {
		echo("<tr>");
		echo("<td align='center'><font color='#FF0000'>You Must accept our Terms &amp; Conditions to add slots to cart!</td>");
		echo("/<tr>");
	   }
	   ?>
			<br/>
			 <span id="book_title"><? echo($SlotbatchCount); ?> Slot(s) in batch - Total Price: &pound; <? echo($SlotbatchTotal); ?> </span></br> </br>
			 <table>
			 <tr>
			 <th colspan="6" align="center">Current Slots in Batch</th>
			 </br>
			 </tr>
			 <tr>
			  <th>Slot Name</th>  <th>Slot Description</th>  <th>Slot Quantity</th>  <th>Slot Full Selling Price</th>  <th>Slot Provider</th>  <th>Remove Slot</th>
			 </tr>
			 
			 <?
			$sSQL = "SELECT SlotBatchItem_ID, SlotName , SlotDescription , Quantity, SlotFullSellingPrice, ProvidersCompany FROM SlotBatchItems, Slots, Providers Where SlotBatchItems.Slot_ID = Slots.Slot_ID And Slots.Providers_ID = Providers.Providers_ID And SlotBatch_ID = " . $_SESSION['CurrentBatchID'] . " Order by SlotName" ;
			//print($sSQL);
			$tmpAccs = mysql_query($sSQL);
			
			while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
			{
				$SlotBatchItem_ID = $thisAccs["SlotBatchItem_ID"];
				$SlotName = $thisAccs["SlotName"];
				$SlotDescription = $thisAccs["SlotDescription"];
				$Quantity = $thisAccs["Quantity"];
				$SlotFullSellingPrice = $thisAccs["SlotFullSellingPrice"];
				$ProvidersCompany = $thisAccs["ProvidersCompany"];
				
				echo("<tr>");
				echo("<td align='center'>" . $SlotName . "</td>" );
				echo("<td align='center'>" . $SlotDescription . "</td>" );
				echo("<td align='center'>" . $Quantity . "</td>" );
				echo("<td align='center'>&pound;" . $SlotFullSellingPrice . "</td>" );
				echo("<td align='center'>" . $ProvidersCompany . "</td>" );
				echo("<td align='center'><a href='book.php?type=" . $_SESSION['mediatypeName'] . "&rembatnb="  . $SlotBatchItem_ID . "'>Remove</a></td>" );
				echo("</tr>");
			}
		 ?>
		 </table>

		<br/>
		<? 
		if ( $_SESSION['TermsAccped'] == "Y" )
		{
			echo($strProductBoxes); 
		}
		echo("<td>");
	}
	
	?>
	</tr>
	</table>	  <? 
	  
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

function GetSlotDate($SlotID)		
{
	$sSQL = "SELECT SlotDeadline FROM Slots Where Slot_ID = " . $SlotID ;
	//print($sSQL);
	$tmpAccs = mysql_query($sSQL);
	
	while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
	{
		$SlotDeadline = $thisAccs["SlotDeadline"];
	}	
	return $SlotDeadline;

}

 function AddSlottoBatch($thisSlot)
 {
 
	 if (ChkSlotinBatch($SlotID) ==0)
	 {
		if( $_SESSION['CurrentBatchID'] >0)
		{
			$sSQL = "Insert Into SlotBatchItems ( SlotBatch_ID, Slot_ID )"; 
			$sSQL .= " Value(" . $_SESSION['CurrentBatchID'] . "," . $thisSlot . " )";
			//print($sSQL);
			mysql_query($sSQL); 
		}
		else
		{
			 $_SESSION['CurrentBatchID'] = CreateNewbatch();
			$sSQL = "Insert Into SlotBatchItems ( SlotBatch_ID, Slot_ID )"; 
			$sSQL .= " Value(" . $_SESSION['CurrentBatchID'] . "," . $thisSlot . " )";
			//print($sSQL);
			mysql_query($sSQL); 
		}
			
		UpdateBatchTotal($thisSlot);
	}	
 
 }
?>
