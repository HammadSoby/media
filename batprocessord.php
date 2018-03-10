  <?

	/* load settings */
	require 'connectdb.php';
require 'sendemails.php';


// STEP 1: Read POST data
// reading posted data from directly from $_POST causes serialization 

// issues with array data in POST

// reading raw POST data from input stream instead. 

$raw_post_data = file_get_contents('php://input');

$raw_post_array = explode('&', $raw_post_data);

$myPost = array();

foreach ($raw_post_array as $keyval) {

  $keyval = explode ('=', $keyval);

  if (count($keyval) == 2)

     $myPost[$keyval[0]] = urldecode($keyval[1]);

}

// read the post from PayPal system and add 'cmd'

$req = 'cmd=_notify-validate';

if(function_exists('get_magic_quotes_gpc')) {

   $get_magic_quotes_exists = true;

} 

$req .= '&'.http_build_query($_POST); 



 

// STEP 2: Post IPN data back to paypal to validate



 // Test $ch = curl_init('https://www.sandbox.paypal.com/cgi-bin/webscr');

 $ch = curl_init('https://www.sandbox.paypal.com/cgi-bin/webscr'); // Live

curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);

curl_setopt($ch, CURLOPT_POST, 1);

curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);

curl_setopt($ch, CURLOPT_POSTFIELDS, $req);

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);

curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);

curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);

curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));



// In wamp like environments that do not come bundled with root authority certificates,

// please download 'cacert.pem' from "http://curl.haxx.se/docs/caextract.html" and set the directory path 

// of the certificate as shown below.

// curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__) . '/cacert.pem');

$res = curl_exec($ch);

    // error_log("Got " . curl_error($ch) . " when processing IPN data");

 //   curl_close($ch);

  //  exit;



curl_close($ch);
 



// STEP 3: Inspect IPN validation result and act accordingly

//Print("res " .$res);

//if (stripos($res, "VERIFIED") !== false)  {

    // check whether the payment_status is Completed

    // check that txn_id has not been previously processed

    // check that receiver_email is your Primary PayPal email

    // check that payment_amount/payment_currency are correct

    // process payment



    // assign posted variables to local variables

    $item_name = $_POST['item_name'];

    $item_number = $_POST['item_number'];

    $payment_status = $_POST['payment_status'];

    $payment_amount = $_POST['mc_gross'];

    $payment_currency = $_POST['mc_currency'];

    $txn_id = $_POST['txn_id'];

    $receiver_email = $_POST['receiver_email'];

    $payer_email = $_POST['payer_email'];

	$first_name = $_POST['first_name'];

	$last_name = $_POST['last_name'];

	$address_street = $_POST['address_street'];
	$address_zip = $_POST['address_zip'];
	$contact_phone = $_POST['contact_phone'];
	$payer_business_name = $_POST['payer_business_name'];
	$payer_id = $_POST['payer_id'];
	$address_city = $_POST['address_city'];
	$address_country = $_POST['address_country'];
	$num_cart_items = $_POST['num_cart_items'];
	$memo = $_POST['memo'];
	$custom = $_POST['custom'];
	


$Ordername = (string)$num_cart_items   . " Item(s) in Order - Check Order Details" ;


	// Add Transaction
		$sSQL = "INSERT INTO ics_Transactions (item_name, payment_status, payment_amount, payment_currency, txn_id, receiver_email,  payer_email, first_name, last_name, address_street, address_zip, contact_phone, payer_business_name, payer_id, address_city, address_country)" ;
		$sSQL = $sSQL . " VALUES ('" . $Ordername . "','" . $payment_status . "'," . $payment_amount . ",'" . $payment_currency . "','" . $txn_id . "','" . $receiver_email . "','" . $payer_email . "','" . $first_name . "','" . $last_name . "','" . $address_street . "','" . $address_zip . "','" . $contact_phone . "','" . $payer_business_name . "','" . $payer_id . "','" . $address_city . "','" . $address_country . "' )";
		
		mysql_query($sSQL);
		$Trans_ID = mysql_insert_id();
		
		$bPaid = 0;

		if ($payment_status == "Completed") 
		{ 
			$bPaid = 1;
		}
		
		if($custom > 0)
		{
			// Search to see if customer exists
			$sSQL = "SELECT ClientName FROM Clients WHERE Client_ID = " .$custom ;
			$tmpAccs = mysql_query($sSQL);
			//print($sSQL);
			while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
			{
				$ClientName  = $thisAccs["ClientName"];
			}
		}
		else
		{
		 
		 	$custom = 0;
		
			$sSQL = "SELECT Client_ID, ClientName FROM Clients WHERE ClientEmail = '" .$payer_email . "'" ;
			$tmpAccs = mysql_query($sSQL);
			//print($sSQL);
			while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
			{
				$ClientName  = $thisAccs["ClientName"];
				$custom  = $thisAccs["Client_ID"];
			}
		}
		if ($custom == 0)
		{
			$membershipid = 1;
			$memType = "Standard";
			$Moreinfo = "";
			$myPass =  $txn_id . "pw" . $last_name;
			$ClientName = $first_name . " " . $last_name;
			
			$sSQL = "Insert Into Clients ( ClientName , ClientCompany , ClientNumber , ClientPassword,   Membership_ID, ClientEmail, ClientAddress, ClientPostcode )"; 
			$sSQL .= " Value('" . $ClientName . "','" . $payer_business_name . "','" .  $contact_phone . "','" .  $myPass . "'," . $membershipid . ",'" .  $payer_email . "','" . $myaddress . "','" . $address_zip . "')";
			//print($sSQL);
			mysql_query($sSQL);
			$custom = mysql_insert_id();
			
			
	//		$payer_email = "bovell_d@hotmail.com"; // remove this line when live
				
			$message = "
		Dear " . $ClientName . ",<br/>
		
		Re: " . $org_name . " <br/>
		
		Media United welcomes you to  where you are able to choose your Media Provider across Radio, Television, Papers and Publications, including Billboards.  To access your account and amend, add or delete any information, you will need the following login details:- <br/>
		
		Username: " . $payer_email . " <br/>
		Password: " . $myPass . " <br/> <br/>
		membership Type: " . $memType . " <br/> " . $Moreinfo . "
		
		
		This platform will allow you to promote your products , services and events to the business and consumer community across the UK and worldwide.  You advertise by purchasing space called slots  or watch the video that explains the step by step process. <br/>
		
		We will promote and publicise any special offers, promotions, gifts and giveaways from our media providers to your email address.  These are for your benefit and support your advertising in providing value for money.  We encourage you to submit details of any Media Provider you may wish to recommend so we can include them on our platform for your needs. <br/>
		
		Here are some of the benefits:-<br/><br/>
		
		1. One stop shop to pay one price to advertise across all available Media Providers.<br/>
		2. Divide your budget to get the exposure that is the perfect combination for your product, service or event.<br/>
		3. Choose to broadcast at different times throughout the week, month or year.<br/>
		4. Change your broadcast times to suit your campaign.<br/>
		5. Change what you want to be seen, heard or read to target specific areas to develop or redevelop your campaign.<br/>
		6. Use your purchase of space/slots to help family, friends or acquaintances to advertise what they have.<br/>
		7. Purchase this unique offering as a gift or earn by providing it as a benefit for others.<br/>
		8. Earn from becoming an agent, acquire an account and sub-sell to others e.g. ideal for Radio, TV, Print and Graphic Producers.<br/>
		9. Media United will also promote your products and services via Radio DJ's across the UK, who via audience participation and competitions bring the consumers to you.<br/>
		10. Media United Services will help you to create market share, public awareness and revenue.<br/><br/>
		
		Please notify us within 24 hours of any failed broadcast. Failure to do this  will affect our ability to provide a speedy resolution and may result in a loss to you.  Any complaints, comments or compliments should be submitted to admin@mediaunited.co.uk.   <br/><br/> 
		
		Thank you for giving our service a try.	<br/>
		 
		
		";
		
			$to = $payer_email;//$payer_email; 
			$DocumentText =  $message ;
		
			$DocumentTitle = "WELCOME to Media United" ;
			$Success = SendEmail( $to,  $DocumentText, $DocumentTitle );
		}	
	
		
		
		
	//'lCustID = 222
	//'payment_amount = 45
	
		// Add Order
		if ($memo <> "") {
			$memo = "Customer wrote: " . $memo;
			$sSQL = "INSERT INTO SlotOrders (Total, Client_ID, Paid, Notes, BatchID, Trans_ID )" ;
			$sSQL = $sSQL . " VALUES (" . $payment_amount . "," . $custom . "," . $bPaid . ", '" . $memo . "',1, ". $Trans_ID . ")";
			}
		else {
			$sSQL = "INSERT INTO SlotOrders (Total, Client_ID, Paid, BatchID, Trans_ID )" ;
			$sSQL = $sSQL . " VALUES (" . $payment_amount . "," . $custom . "," . $bPaid . ",1, ". $Trans_ID . ")";
		}
			mysql_query($sSQL);
			$Order_ID = mysql_insert_id();
		
			$ISlotssold = 0;
			$thisLoop = 1;
			
			for ($Ind = 1; $Ind <= $num_cart_items; $Ind++)
			{
				//sQuantity = "quantity" & cstr(Ind)
				$sItem = "item_name" . $Ind;
				$ItemID = 'item_number' . $Ind;
			//	$ProductID = "custom_" . $Ind;
				$iquantity =  $_POST['quantity' . $Ind];
				$sProductName = $_POST[$sItem];
   				 $ProductID = $_POST[$ItemID];
 

				if ($sProductName == "Batch")
				{
					
					$sSQL = "SELECT Slot_ID, Quantity FROM SlotBatchItems WHERE SlotBatch_ID =" . $ProductID ;
					
					$tmpAccs = mysql_query($sSQL);
				
					while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
					{
						$Slot_ID  = $thisAccs["Slot_ID"];
						$Quantity  = $thisAccs["Quantity"];
						
						$sSQL = "INSERT INTO SlotOrdersItems (SlotOrders_ID, Slot_ID, Quantity)" ;
						$sSQL = $sSQL . " VALUES (" . $Order_ID . "," . $Slot_ID . ", " . $Quantity . ")";
						mysql_query($sSQL);
						
						$sSQL = "Update Slots Set SlotQuantity = SlotQuantity -" .  $Quantity . " Where Slot_ID = " . $Slot_ID;
						mysql_query($sSQL);
						
						$ProviderslotID[$thisLoop] = $Slot_ID;
						$thisLoop = $thisLoop + 1;
						
						$ISlotssold = $ISlotssold + $Quantity;
					} 
					
				}
				else
				{
					$sSQL = "INSERT INTO SlotOrdersItems (SlotOrders_ID, Slot_ID, Quantity)" ;
					$sSQL = $sSQL . " VALUES (" . $Order_ID . "," . $ProductID . ", " . $iquantity . ")";
					mysql_query($sSQL);
					
					$sSQL = "Update Slots Set SlotQuantity = SlotQuantity -" .  $Quantity . "  Where Slot_ID = " . $ProductID;
					
					mysql_query($sSQL);
					
					$ProviderslotID[$Ind] = $ProductID;
					$ISlotssold = $ISlotssold + $Quantity;
				}
			}
			
			$Recs = 0;
			$ThisProviderID = 0;
			
			if ($Ind < $thisLoop)
			{
				$Ind =  $thisLoop;
			}
			
			$sMessageHeader = "
			<table>
			<tr>
			<th colspan='6'>Slots Ordered</th>
			</tr>
			<tr>
			<th align='center'>Provider Name</th> <th align='center'>Provider Email</th>  <th align='center'>Slot Name</th>  <th align='center'>Slot Details</th>   <th align='center'>Production Broadcast Date</th>  <th align='center'>Slot Deadline Date</th>
			</tr>";
			
			$sMessage = "";
			
			for($x = 1; $x < $Ind; $x++) 
			{
				$thisSlotID =  $ProviderslotID[$x];
				$sSQL = "SELECT Slots.Product_ID, SlotName, SlotCostPrice, SlotDeadline, SlotSize_ID, SlotTime_ID, SlotQuantity, ContactEmail, ProductName, ContactName  FROM Slots, Products WHERE Slots.Product_ID = Products.Product_ID And Slot_ID =" . $thisSlotID ;
				$tmpAccs = mysql_query($sSQL);
				while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
				{
					$SlotName  = $thisAccs["SlotName"];
					$SlotCostPrice  = $thisAccs["SlotCostPrice"];
					$SlotDeadline  = $thisAccs["SlotDeadline"];
					$ProvidersEmail  = $thisAccs["ContactEmail"];
					$ProvidersCompany  = $thisAccs["ProductName"];
					$Providers_ID  = $thisAccs["Providers_ID"];
					$SlotSize_ID  = $thisAccs["SlotSize_ID"];
					$SlotTime_ID  = $thisAccs["SlotTime_ID"];
					$Quantity  = $thisAccs["SlotQuantity"];
					$ContactName  = $thisAccs["ContactName"];
					
					$ProductionDate = date("D-d-M-y", strtotime($SlotDeadline . " +7 days")); 					
					$thisSlotDeadline = date("D-d-M-y", strtotime($SlotDeadline));
					
					if($SlotSize_ID > 0)
					{
						$GetSizename = GetSizename($SlotSize_ID);
					}
					
					if($SlotTime_ID > 0)
					{
						$GetSlotTime = GetSlotTime($SlotTime_ID);
					}
					
					$SlotDetails = $GetSizename . "&nbsp;" . $GetSlotTime;
					
					$TotalPrice = 0;
					
					
						
					$sMessage = $sMessage ."<tr>";
					$sMessage = $sMessage . "<td align='center'>" . $ProvidersCompany . "</td>" . "<td align='center'>"  . $ProvidersEmail . "</td>" . "<td align='center'>" . $SlotName . "</td>" .  "<td align='center'>" . $SlotDetails . "</td>" .  "<td align='center'>" . $ProductionDate . "</td>" . "<td align='center'>" . $thisSlotDeadline . "</td>" ;									
					$sMessage = $sMessage . "</tr>";
					
					
					
					if ($Recs > 0 And $ThisProviderID == $Providers_ID)
					{
						$OrderedSlotName[$Recs] = $SlotName;
						$OrderedSlotCostPrice[$Recs] = $SlotCostPrice;
						$OrderedSlotDeadline[$Recs] = $SlotDeadline;
	
						$OrderedProvidersEmail[$xRecs] = $ProvidersEmail;
						$OrderedProvidersCompany[$Recs] = $ProvidersCompany;
						
						$Recs = $Recs + 1;
					}
					
					if ($Recs > 0 And $ThisProviderID <> $Providers_ID)
					{
						$MessageHeader = "
						<table>
						<tr>
						<th colspan='3'>Slots Ordered</th>
						</tr>
						<tr>
						<th align='center'>Slot Name</th> <th align='center'>Slot Price</th> <th align='center'>Slot Production Date</th> <th align='center'>Slot Deadline Date</th>
						</tr>";
						$TotalPrice = 0;
						
						$Message = "";
						for($thisLoop = 0; $thisLoop < $Recs; $thisLoop++) 
						{
							$thisDate = date("D-d-M-y", strtotime($OrderedSlotDeadline[$thisLoop] . " +7 days")); 
							$thiSlotDeadline = date("D-d-M-y", strtotime($OrderedSlotDeadline[$thisLoop]));
							
							$thisSlot =  $OrderedSlotName[$thisLoop];
							$thisSlotCostPrice =  $OrderedSlotCostPrice[$thisLoop];
							
							$Message = $Message ."<tr>";
							$Message = $Message . "<td align='center'>" . $thisSlot . "</td>" . "<td align='center'>&pound;"  . $thisSlotCostPrice . "</td>" . "<td align='center'>" . $thisDate . "</td>" . "<td align='center'>" . $thiSlotDeadline . "</td>" ;									
							$Message = $Message . "</tr>";
							$TotalPrice = $TotalPrice + $OrderedSlotCostPrice[$thisLoop];
							
							if ($thisLoop == 0)
							{
								$ThisProvider = $OrderedProvidersCompany[$thisLoop];
								$ThisProviderEmail = $OrderedProvidersEmail[$thisLoop];
							}
						}
						
					//	$OrderedProvidersEmail[0] = $ProvidersEmail;
					//	$OrderedProvidersCompany[0] = $ProvidersCompany;
			
			
						$Message = $Message . "<tr>";
						$Message = $Message . "<th colspan='2'>Total price:</th><th> &pound;" . $TotalPrice . "</th>";
						$Message = $Message . "</tr>";
						$Message = $Message . "</table>";
			
						$to = $ThisProviderEmail; // admin@theunited.media
						
						$DocumentTitle = "New Order Notification ";
						$DocumentText = "<br/>A new order for a Media Slot was made at Media United!<br/>";
						$DocumentText = $DocumentText . $MessageHeader . $Message . "<br/>";
						
						$Success = SendEmail( $to, $DocumentText, $DocumentTitle );
						
						$Recs =0;
					}
					
					
					if ($Recs == 0 And $ThisProviderID <> $Providers_ID)
					
					{
						$ThisProviderID = $Providers_ID;
						$OrderedSlotName[$Recs] = $SlotName;
						$OrderedSlotCostPrice[$Recs] = $SlotCostPrice;
						$OrderedSlotDeadline[$Recs] = $SlotDeadline;
	
						$OrderedProvidersEmail[$xRecs] = $ProvidersEmail;
						$OrderedProvidersCompany[$Recs] = $ProvidersCompany;
						
						$Recs = $Recs + 1;
					}
				}
			}
			
			$sMessage = $sMessage . "</table>";

			$MessageHeader = "
			<table>
			<tr>
			<th colspan='3'>Slots Ordered</th>
			</tr>
			<tr>
			<th align='center'>Slot Name</th> <th align='center'>Slot Price</th> <th align='center'>Slot Production Date</th> <th align='center'>Slot Deadline Date</th>
			</tr>";
			$TotalPrice = 0;
			
			$Message = "";
			for($thisLoop = 0; $thisLoop < $Recs; $thisLoop++) 
			{
				$thisDate = date("D-d-M-y", strtotime($OrderedSlotDeadline[$thisLoop] . " +7 days")); 
				$thiSlotDeadline = date("D-d-M-y", strtotime($OrderedSlotDeadline[$thisLoop]));
				$thisSlot =  $OrderedSlotName[$thisLoop];
				$thisSlotCostPrice =  $OrderedSlotCostPrice[$thisLoop];
				
				$Message = $Message ."<tr>";
				$Message = $Message . "<td align='center'>" . $thisSlot . "</td>" . "<td align='center'>&pound;"  . $thisSlotCostPrice . "</td>" . "<td align='center'>" . $thisDate . "</td>" . "<td align='center'>" . $thiSlotDeadline . "</td>" ;									
				$Message = $Message . "</tr>";
				$TotalPrice = $TotalPrice + $OrderedSlotCostPrice[$thisLoop];
				if ($thisLoop == 0)
				{
					$ThisProvider = $OrderedProvidersCompany[$thisLoop];
					$ThisProviderEmail = $OrderedProvidersEmail[$thisLoop];
				}
			}
			
		//	$OrderedProvidersEmail[0] = $ProvidersEmail;
		//	$OrderedProvidersCompany[0] = $ProvidersCompany;
			
			
			$Message = $Message . "<tr>";
			$Message = $Message . "<th colspan='2'>Total price:</th><th> &pound;" . $TotalPrice . "</th>";
			$Message = $Message . "</tr>";
			$Message = $Message . "</table>";

			$to = "bovell_d@hotmail.com"; //$ThisProviderEmail; // admin@theunited.media
			
			$DocumentTitle = "New Order Notification ";
			$DocumentText = "<br/>Dear " . $ThisProvider . ",<br/>You have received a transaction as shown on your  Order page and is stated below:<br/>";
			$DocumentText = $DocumentText . $MessageHeader . $Message . "<br/>The production for broadcast will be made available by the client prior to the deadline date(s). It has been made clear that failure to comply may result in the failure to broadcast. Monies will be held on account until the broadcast is confirmed by you. <br/>";
			
			$Success = SendEmail( $to, $DocumentText, $DocumentTitle );
			
			$Recs =0;
	
			$TotalSlotsLeft =  GetSlotsLeft();
			// Send order email to sales
			$to = "admin@mediaunited.co.uk"; 
			
			$DocumentTitle = "New Order Notification Order Number: " . $Order_ID;
			$DocumentText = "<br/>Administration,<br/>Received the  purchase,  the details of which are in your Order page and is stated below:<br/>";
			$DocumentText = $DocumentText . $sMessageHeader . $sMessage . "<br/>The total amount of space sold is " . $ISlotssold . "  with " . $TotalSlotsLeft . "  remaining.<br/>";
			$Success = SendEmail( $to, $DocumentText, $DocumentTitle );
			
			
			// Send order email to customer
			//'iIsNewCustomer = 1			
						
			$to = $payer_email; //Payer_email - Change back when live sEmailTo
			$DocumentText = "Dear " . $ClientName . "," .  "<br/>" . " Thank you for your purchase the details of which are in your Order page and is stated below: " . "<br/>" ;
			$DocumentText = $DocumentText . $sMessageHeader . $sMessage . "<br/> <br/>It is important that you contact the Provider and provide the production for broadcast prior to the deadline date(s). Failure to comply will result in the failure to broadcast. ";

			$DocumentTitle = "New Order Notification Order Number: " . $Order_ID;
			$Success = SendEmail( $to,  $DocumentText, $DocumentTitle );
			

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

function GetSlotsLeft()		
{
		$sSQL = "SELECT count(*) as SlotCount FROM Slots Where TIMESTAMPDIFF(DAY,NOW(),SlotDeadline) >= 1 And SlotQuantity > 0 And Live = 1" ;
		//print($sSQL);
		$tmpAccs = mysql_query($sSQL);
		
		while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
			$SlotCount = $thisAccs["SlotCount"];
		}	
		return $SlotCount;

}
		
?>