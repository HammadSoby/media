<?session_start();?>
<!DOCTYPE html>
<head>
	<title>Home | Media United Admin</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"  name="viewport" content="width=device-width,initial-scale=1.0">
<style>@import url(http://fonts.googleapis.com/css?family=Open+Sans:400,700);</style>

<style>
body{
	padding:0px;
	margin:0px;
	background:  #E5E5E5;
}
#menu{
	padding:0px; 
	margin:0px;
	background: #353535;
	color:white;
	text-align: center;
}
#menu li a {
	color:white;
	font-family: "open sans";
	text-decoration: none;
	padding-left: 20px;
	padding-right: 20px;
	font-size: 13px;

}
#menu li {
	display: inline-block;
	padding-top: 1%;
	padding-bottom: 1%;

}
#menu li:hover{
	background: #006699;
	cursor: pointer;

}
#tit{
	margin-left: 10%;
	font-family: "open sans";
	font-size:25px;
	color:#353535;
	border-bottom:1px dashed #353535;
	width: 60%;
	padding-left: 1%;
	padding-bottom: 2%;
}
#manage{
	list-style: none;
	padding:0px;
	margin:0px;
	color:#353535;
	font-family: "open sans";
	font-size: 15px;
	width: 70%;
	text-align: left;
	margin-left: 10%;
	padding-left: 1%;
	border-bottom:1px dashed #353535;

	
}
#manage li {
	
	padding:0px; 
	padding-left: 1%;
	padding-top: 1%;
	text-align: left;
	padding-bottom: 1%;
	

	
}
#manage li a {
	color:white;
	background: #F96E5B;
	text-decoration: none;
	padding-top: 3.5%;
	padding-bottom: 3.5%;
	padding-left: 50%;
	padding-right: 50%;
	border-radius: 6px;
	width: 10%;
}
#manage li a:hover{
	opacity: 0.7;
	transition:1s;
	cursor: pointer;
}
#banner{
	width: 100%;
	background: #F96E5B;
	height: 13%;
	padding-top: 1%;
}
#banner span{
	color:white;
	font-weight:100;
	font-family: "open sans";
	font-size: 38px;
	margin-left: 10%;
	background-image: url("https://cdn2.iconfinder.com/data/icons/business-charts/512/service-128.png");
	background-repeat: no-repeat;
	padding-left: 12%;
	padding-bottom: 10%;
}
#role{

}
#done{
	color:green;
	font-family: "open sans";
	font-size: 14px;
}
#help{
	margin-left: 10%;
	font-family: "open sans";
}
</style>
</head>
<body>
	<div id="banner">
		<span>Media United Admin Panel</span>
	</div>
<?php 
if ($_SESSION['AdminUser_ID'] > 0)
{  
	$memID = 0;  
	/* load settings */
	require 'connectdb.php';
	
	
	$add =  $_REQUEST['add'];
	if ($add ==1) 
	{
		$txtName =  $_POST['txtName'];
		$txtDescription =  $_POST['txtDescription'];
		
		$sSQL = "Insert Into SpecialOffers ( SpecialOfferName , SpecialOfferDetails )"; 
		$sSQL .= " Value('" . $txtName . "','" . $txtDescription . "' )";
		//print($sSQL);
		mysql_query($sSQL); 
		$_SESSION['CurrentSpecialOffersID'] =  mysql_insert_id();	
	}	
	
	
	$id =  $_REQUEST['id'];
	if ($id > 0) 
	{
		$_SESSION['CurrentSpecialOffersID'] =	$id;
		//print("ID = " . $_SESSION['CurrentSpecialOffersID']);
	}
	
	$upd =  $_REQUEST['upd'];
	if ($upd ==1) 
	{
		$txtName =  $_POST['txtName'];
		$txCost =  $_POST['txCost'];
		$txtSell =  $_POST['txtSell'];
		$txtDescription =  $_POST['txtDescription'];
		$txtDDate =  $_POST['txtDDate'];
		$chkLive =  $_POST['chkLive'];
		
		if ($chkLive == true)
		{
			$chkLive = 1;
		}
		else
		{
			$chkLive = 0;
		}
		
		$sSQL = "UPDATE  SpecialOffers Set SpecialOfferName ='" .  $txtName . "', SpecialOfferCostPrice = " . $txCost . ", SpecialOfferSellingPrice = " .  $txtSell . ", SpecialOfferDetails = '" .  $txtDescription . "', SpecialOfferDealine ='" . $txtDDate . "' , Live = " . $chkLive . " Where SpecialOffers_ID = " . $_SESSION['CurrentSpecialOffersID']; 
		mysql_query($sSQL);
	}	
	
	$rsid =  $_REQUEST['rsid']; // Remove Slot Selection Added to Batch
	if ($rsid > 0)
	{
		$sSQL = "Delete From SpecialOfferSlots Where SpecialOffers_ID = " . $_SESSION['CurrentSpecialOffersID'] . " And Slot_ID =" .$rsid; 
		//print($sSQL);
		mysql_query($sSQL); 
	}		
		
	$asl =  $_REQUEST['asl'];
	if ($asl ==1) 
	{
		$optSltnum =  $_POST['optSltnum'];		
		$SpecialOffers_ID = 0;
		$sSQL = "SELECT SpecialOffers_ID FROM SpecialOfferSlots Where Slot_ID = " . $optSltnum ;
		//print($sSQL);
		$tmpAccs = mysql_query($sSQL);
		
		while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
			$SpecialOffers_ID = $thisAccs["SpecialOffers_ID"];
		}
		if ($SpecialOffers_ID >0)
		{
		?>
		<p><font color="#FF0000"><strong>This Slot has already been added to this special 
		  offer!</strong></font></p>
		<?
		}
		else
		{
			$sSQL = "Insert Into SpecialOfferSlots ( SpecialOffers_ID, Slot_ID )"; 
			$sSQL .= " Value(" . $_SESSION['CurrentSpecialOffersID'] . ", " . $optSltnum . ")";
			
			//print($sSQL);
			mysql_query($sSQL); 
		}
		
	}	

	
	
	
		$Loop = 1;
		$DropStr = "";
		$TotalCostPrice = 0;
		$TotalSellingPrice = 0;
		
		$sSQL = "SELECT SpecialOfferSlots.Slot_ID, SlotName, SlotCostPrice, SlotFullSellingPrice, SlotDeadline FROM SpecialOfferSlots, Slots Where SpecialOfferSlots.Slot_ID = Slots.Slot_ID And SpecialOffers_ID = " .  $_SESSION['CurrentSpecialOffersID'] . " Order By SlotDeadline";
		//print($sSQL);
		$tmpAccs = mysql_query($sSQL);
		
		while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
			$Slot_ID = $thisAccs["Slot_ID"];
			$SlotName = $thisAccs["SlotName"];
			$SlotCostPrice = $thisAccs["SlotCostPrice"];
			$SlotFullSellingPrice = $thisAccs["SlotFullSellingPrice"];
			$SlotDeadline = $thisAccs["SlotDeadline"];
			
			if ($Loop ==1)
			{
				$FirstDeadlineDate = date("D-d-M-y", strtotime($SlotDeadline)); 
			}
			
			$TotalCostPrice = $TotalCostPrice + $SlotCostPrice;
			$TotalSellingPrice = $TotalSellingPrice + $SlotFullSellingPrice;
			
			$DropStr .= "<tr>";
			$DropStr .= "<td>" . $SlotDeadline  . "</td> <td>" . $SlotName . "</td> <td>" . $SlotCostPrice . "</td> <td>" . $SlotFullSellingPrice . "</td> <td> <a href='special.php?rsid=" .  $Slot_ID . "'> Remove </a></td>";
			$DropStr .= "</tr>";
			$Loop = $Loop +1;
			//echo("<option value=" . $MediaType_ID  . ">" . $MediaTypeName . "</option>");
		}
	
			
	$sSQL = "SELECT SpecialOffers_ID, Live, DateCreated, SpecialOfferCostPrice, SpecialOfferName, SpecialOfferSellingPrice, SpecialOfferDealine, SpecialOfferDetails FROM SpecialOffers Where SpecialOffers_ID =" . $_SESSION['CurrentSpecialOffersID'] ;
	//print($sSQL);
	$tmpAccs = mysql_query($sSQL);
	
	while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
	{
		$Live = $thisAccs["Live"];
		$DateCreated = $thisAccs["DateCreated"];
		$SpecialOfferName = $thisAccs["SpecialOfferName"];
		$SpecialOfferCostPrice = $thisAccs["SpecialOfferCostPrice"];
		$SpecialOfferSellingPrice = $thisAccs["SpecialOfferSellingPrice"];
		$SpecialOfferDealine = $thisAccs["SpecialOfferDealine"];
		$SpecialOfferDetails = $thisAccs["SpecialOfferDetails"];
	}
		?> 
		<br/> <br/>
	<form action="special.php?upd=1" method="post">
	<table align="center" border="1">
	<tr>
	  <th bgcolor="#0000FF" colspan="5"><font size="+2"><font color="#FFFFFF">Special Offer Details</font></font></th>
	</tr>
	<tr>
		
    <td><font size="+1">Offer Name:</font></td>
    <td><input type="text" name="txtName" value="<? echo($SpecialOfferName); ?>"/></td>
		</tr>
		<tr>
		
    <td><font size="+1">Description:</font></td>
    <td><textarea name="txtDescription" cols="40" rows="7"><? echo($SpecialOfferDetails); ?></textarea></td>
		</tr>
		
	<tr>
	<td><font size="+1">Total Cost Price:</font> &pound; <input type="text" name="txTCost" value="<? echo($TotalCostPrice); ?>"/></td>
	<td><font size="+1">Offer Cost Price:</font> &pound; <input type="text" name="txCost" value="<? echo($SpecialOfferCostPrice); ?>"/></td>
	</tr>
	
	<tr>
	<td><font size="+1">Total Selling Price:</font> &pound; <input type="text" name="txtTSell" value="<? echo($TotalSellingPrice); ?>"/></td>
	<td><font size="+1">Offer Selling Price:</font> &pound; <input type="text" name="txtSell" value="<? echo($SpecialOfferSellingPrice); ?>"/></td>
	</tr>
	<tr>
	<td><font size="+1">1st Deadline Date:</font> <input type="text" name="txtTDDate" value="<? echo($FirstDeadlineDate); ?>"/></td>
	<td><font size="+1">1st Deadline Date:</font> <input type="date" name="txtDDate" value="<? echo($SpecialOfferDealine); ?>"/></td>
	</tr>
	
		<tr>
        <td>Live 
        <? 
		if ($Live == 1)
		{
			?>
       	 	<input type="checkbox" name="chkLive" id="chkLive"   checked>
           <?
        } 
        else
		{
			?>
       	 	<input type="checkbox" name="chkLive" id="chkLive"  >
            <?
        } 
		?>       
        </td>
			<td  align="center"><input type="submit" name="Submit" value="Save">
        <a href="specials.php">back</a> </td>
		</tr>
		</table> 
		<input type="hidden" name="memID" value="<? echo($id); ?>" />
		</form>
		
		<hr>
		
		<table align="center" border="1" >
		<tr>
		<th colspan="2" align="center">Select Slots for Offer</th>
		</tr>
		<tr>
		<td align="center">Media Type:</td> 
		
		<form name="FrmMedia" method="post" action="special.php?mdty=1">
		<td align="center"><select name="optMedia" onchange='document.FrmMedia.submit();'>
		<option value='0'>Please choose Media Type </option>

		<?
		$sSQL = "SELECT MediaType_ID, MediaTypeName FROM MediaTypes" ;
		//print($sSQL);
		$tmpAccs = mysql_query($sSQL);
		
		while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
			$MediaType_ID = $thisAccs["MediaType_ID"];
			$MediaTypeName = $thisAccs["MediaTypeName"];
			echo("<option value=" . $MediaType_ID  . ">" . $MediaTypeName . "</option>");
		}
		
		?>	
      </select>
	  </td>
	  </form>
		</tr>
		
		<?
		$mdty =  $_REQUEST['mdty'];
		if ($mdty ==1) 
		{
			$optMedia =  $_POST['optMedia'];
			$_SESSION['AdminMediatype'] = $optMedia;
			
			if ( $_SESSION['AdminMediatype'] ==1)
			{
				$Media = "Print";
				$Typetext = "newspapers";
				$Buttontxt = "Newspapers";
				$_SESSION['AdminMediatypeName'] = "print";
			}
			if ( $_SESSION['AdminMediatype'] ==2)
			{
				$Media = "Radio";
				$Typetext = "radio stations";
				$Buttontxt = "Radio Station";
				 $_SESSION['AdminMediatypeName'] = "radio";
			}
			if ( $_SESSION['AdminMediatype'] ==3)
			{
				$Media = "TV";
				$Typetext = "TV stations";
				$Buttontxt = "TV Station";
				
				 $_SESSION['AdminMediatypeName'] = "tv";
			}
		
			if ( $_SESSION['AdminMediatype'] ==4)
			{
				$Media = "Bilboards";
				$Typetext = "Bilboards";
				$Buttontxt = "Bilboards";
				
				 $_SESSION['AdminMediatypeName'] = "board";
			}
			if($_SESSION['AdminMediatype'] > 3)
			{	
				?>
				<tr>
				<th align="center" colspan="2">Media Type Selected = <? echo($Media); ?></th>
				</tr>
				<tr>
				<td align="center">Location Type:</td> 
				
				<form name="FrmLocation" method="post" action="special.php?blc=1">
				<td align="center"><select name="optLocation" onchange='document.FrmLocation.submit();'>
				<option value='0'>Please choose Location Type </option>

				<?
				$sSQL = "SELECT  LocationType_ID, LocationTypeName  FROM  LocationType" . " Order By LocationTypeName" ;
				//print($sSQL);
				$tmpAccs = mysql_query($sSQL);
				
				while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
				{
					$LocationTypeName = $thisAccs["LocationTypeName"];
					$LocationType_ID = $thisAccs["LocationType_ID"];
					
					echo("<option value='" . $LocationType_ID . "'>". $LocationTypeName . "</option>");
				}
				
				?>	
			  </select>
			  </td>
			  </form>
				</tr>
				<?
			}
			else
			{	
				?>
				<tr>
				<th align="center" colspan="2">Media Type Selected = <? echo($Media); ?></th>
				</tr>
				<tr>
				<td align="center">Provider:</td> 
				
				<form name="FrmProv" method="post" action="special.php?pro=1">
				<td align="center"><select name="optProvider" onchange='document.FrmProv.submit();'>
				<option value='0'>Please choose one of these <? echo($Typetext); ?> </option>		
				<?
				$sSQL = "SELECT  Product_ID, ProductName FROM Products Where MediaType_ID = " . $_SESSION['AdminMediatype'] . " Order By ProductName" ;
				//print($sSQL);
				$tmpAccs = mysql_query($sSQL);
				
				while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
				{
					$ProvidersCompany = $thisAccs["ProductName"];
					$Providers_ID = $thisAccs["Product_ID"];
					
					echo("<option value='" . $Providers_ID . "'>". $ProvidersCompany . "</option>");
				}
				
				?>	
			  </select>
			  </td>
			  </form>
				</tr>
				<?
			}
			
		}	
		
		$pro =  $_REQUEST['pro'];
		$blc =  $_REQUEST['blc'];
		
		if ($pro ==1 Or $blc ==1) 
		{
			if ( $_SESSION['AdminMediatype'] ==1)
			{
				$Media = "Print";
				$Typetext = "newspapers";
				$Buttontxt = "Newspapers";
				$_SESSION['AdminMediatypeName'] = "print";
			}
			if ( $_SESSION['AdminMediatype'] ==2)
			{
				$Media = "Radio";
				$Typetext = "radio stations";
				$Buttontxt = "Radio Station";
				 $_SESSION['AdminMediatypeName'] = "radio";
			}
			if ( $_SESSION['AdminMediatype'] ==3)
			{
				$Media = "TV";
				$Typetext = "TV stations";
				$Buttontxt = "TV Station";
				
				 $_SESSION['AdminMediatypeName'] = "tv";
			}
		
			if ( $_SESSION['AdminMediatype'] ==4)
			{
				$Media = "Bilboards";
				$Typetext = "Bilboards";
				$Buttontxt = "Bilboards";
				
				 $_SESSION['AdminMediatypeName'] = "board";
			}			
			
			if($pro ==1)
			{
				$optProvider =  $_POST['optProvider'];
				
				$sSQL = "SELECT ProductName, PubDuration FROM Products Where Product_ID = " . $optProvider ;
				//print($sSQL);
				$tmpAccs = mysql_query($sSQL);
				
				while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
				{
					$ProvidersCompany = $thisAccs["ProductName"];
					$PubDuration = $thisAccs["PubDuration"];
					$_SESSION['AStandTxt'] = "Provider";
					$_SESSION['AProvidersCompany'] =  $ProvidersCompany;
					$_SESSION['APubDuration'] =  $PubDuration;
					$_SESSION['AthisProviders_ID'] =  $optProvider;
					
					$sSQL = "SELECT SlotCostPrice, SlotDeadline, Slot_ID, SlotName , SlotDescription , SlotQuantity,  SlotFullSellingPrice FROM Slots Where TIMESTAMPDIFF(DAY,NOW(),SlotDeadline) >= 1 And SlotQuantity >0 And Live = 1 And Product_ID = " . $_SESSION['AthisProviders_ID'] . " Order by SlotName" ;
				}
			}
			else
			{
				$optLocation =  $_POST['optLocation'];
				
				$sSQL = "SELECT LocationTypeName FROM LocationType Where LocationType_ID = " . $optLocation ;
				//print($sSQL);
				$tmpAccs = mysql_query($sSQL);
				
				while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
				{
					$LocationTypeName = $thisAccs["LocationTypeName"];
					
					$_SESSION['AStandTxt'] = "Location Type";
					$_SESSION['AProvidersCompany'] =  $LocationTypeName;
				//	$_SESSION['PubDuration'] =  $PubDuration;
				}
				
				$sSQL = "SELECT SlotCostPrice, SlotDeadline, Slot_ID, SlotName , SlotDescription , SlotQuantity,  SlotFullSellingPrice, Location FROM Slots, ProviderLocations Where TIMESTAMPDIFF(DAY,NOW(),SlotDeadline) >= 1 And SlotQuantity >0 And Live = 1 And Slots.Locations = ProviderLocations.ProviderLocation_ID And ProviderLocations.LocationType_ID =" . $optLocation . " Order by SlotName" ;
			}
			?>
			<tr>
			  <th  align="center"><font size="+1"><? echo($_SESSION['AStandTxt']); ?>:</font></th>
			  <th align="center"><font size="+1"><? echo($_SESSION['AProvidersCompany']); ?></font></br></th>
			</tr>
			
			<tr>
			<td>Slots</td>
			<td>
			<form name="FrmStot" method="post" action="special.php?asl=1">
			<select name="optSltnum" onchange='document.FrmStot.submit();' >
			<option value='0'>Please choose one of these slots </option>
			
			<?
			//print("SQL = " . $sSQL);
			$tmpAccs = mysql_query($sSQL);
			
			while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
			{
				$SlotName = $thisAccs["SlotName"];
				$SlotDescription = $thisAccs["SlotDescription"];
				$SlotFullSellingPrice = $thisAccs["SlotFullSellingPrice"];
				$SlotQuantity = $thisAccs["SlotQuantity"];				
				$thisSellingPrice = $SlotFullSellingPrice;
				$SlotDeadline =  $thisAccs["SlotDeadline"];	 
				$Slot_ID =  $thisAccs["Slot_ID"];	
				
				$SlotCostPrice =  $thisAccs["SlotCostPrice"];	
				
				$DateSelected = date("D-d-M-y", strtotime($SlotDeadline)); 
				
				if($_SESSION['StandTxt'] == "Location Type")
				{
					$Location = $thisAccs["Location"];
					$Displaystr =  $DateSelected . " -: " . $SlotName . " (" . $SlotDescription .  ") RRP &pound;" . $SlotFullSellingPrice .  " Cost Price &pound;" . $SlotCostPrice . " Location: " . $Location; 
				}
				else
				{
					$Location = "";
					$Displaystr = $DateSelected . " -: " . $SlotName . " (" . $SlotDescription .  ")  RRP &pound;" . $SlotFullSellingPrice .  " Cost Price &pound;" . $SlotCostPrice; 
				}
				
				echo("<option value='" . $Slot_ID . "'>". $Displaystr . "</option>");
			}
		}	
		?>
			 </select>
			</form>	
			</td>
			</tr>
		</table>
	
		<table align="center" border="1">
		<tr>
		<th align="center" colspan="5">Selected Slots for this Offer</th>
		</tr>
		<tr>
		<th>Deadline Date</th> <th>Slot</th> <th>Cost Price</th>  <th>Selling Price</th> <th>Remove Slot</th> 
		</tr>
		<?
		echo($DropStr );
		?>
		</table>
		<?	
}		

else
{
	echo("Login Details Note correct! Please <a href='index.php'>click here</a>");
}		
		
		
		
?>




</body>
</html>