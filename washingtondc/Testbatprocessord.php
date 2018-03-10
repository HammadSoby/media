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

if( !($res = curl_exec($ch)) ) {

    // error_log("Got " . curl_error($ch) . " when processing IPN data");

    curl_close($ch);

    exit;

}

curl_close($ch);

 



// STEP 3: Inspect IPN validation result and act accordingly

//Print("res " .$res);

if (stripos($res, "VERIFIED") !== false)  {

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
	$num_cart_items = 1;
	$memo = $_POST['memo'];
	$custom = $_POST['custom'];
	
}
	$num_cart_items = 1;

$Ordername = (string)$num_cart_items   . " Item(s) in Order - Check Order Details" ;


	// Add Transaction
		$sSQL = "INSERT INTO ics_Transactions (item_name, payment_status, payment_amount, payment_currency, txn_id, receiver_email,  payer_email, first_name, last_name, address_street, address_zip, contact_phone, payer_business_name, payer_id, address_city, address_country)" ;
		$sSQL = $sSQL . " VALUES ('" . $Ordername . "','" . $payment_status . "'," . $payment_amount . ",'" . $payment_currency . "','" . $txn_id . "','" . $receiver_email . "','" . $payer_email . "','" . $first_name . "','" . $last_name . "','" . $address_street . "','" . $address_zip . "','" . $contact_phone . "','" . $payer_business_name . "','" . $payer_id . "','" . $address_city . "','" . $address_country . "' )";
		
	//	mysql_query($sSQL);
		
		
		// Search to see if customer exists
		$sSQL = "SELECT ClientName FROM Clients WHERE Client_ID = 7" ;
		$tmpAccs = mysql_query($sSQL);
	//print($sSQL);
		while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
			$ClientName  = $thisAccs["ClientName"];
		}
		$bPaid = 0;
		
		//if ($payment_status == "Completed") { 
			$bPaid = 1;
	//	}
		
	//'lCustID = 222
	//'payment_amount = 45
	
		// Add Order
		if ($memo <> "") {
			$memo = "Customer wrote: " . $memo;
			$sSQL = "INSERT INTO SlotOrders (Total, Client_ID, Paid, Notes,BatchID )" ;
			$sSQL = $sSQL . " VALUES (" . $payment_amount . "," . $custom . "," . $bPaid . ", '" . $memo . "',1)";
			}
		else {
			$sSQL = "INSERT INTO SlotOrders (Total, Client_ID, Paid, BatchID)" ;
			$sSQL = $sSQL . " VALUES (" . $payment_amount . "," . $custom . "," . $bPaid . ",1)";
		}
		//	mysql_query($sSQL);
		//	$Order_ID = mysql_insert_id();
			for ($Ind = 1; $Ind <= $num_cart_items; $Ind++)
			{
				//sQuantity = "quantity" & cstr(Ind)
				$sItem = "item_name" . $Ind;
				$ItemID = 'item_number' . $Ind;
			//	$ProductID = "custom_" . $Ind;
				$iquantity = 1;
				$sProductName = "Batch";
   				$ProductID = 9;
 

				if ($sProductName == "Batch")
				{
					$thisLoop = 1;
					
					$sSQL = "SELECT Slot_ID, Quantity FROM SlotBatchItems WHERE SlotBatch_ID =" . $ProductID ;
					
					$tmpAccs = mysql_query($sSQL);
				
					while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
					{
					
						$Slot_ID  = $thisAccs["Slot_ID"];
						$Quantity  = $thisAccs["Quantity"];
						
						$sSQL = "INSERT INTO SlotOrdersItems (SlotOrders_ID, Slot_ID, Quantity)" ;
						$sSQL = $sSQL . " VALUES (" . $Order_ID . "," . $Slot_ID . ", " . $Quantity . ")";
						mysql_query($sSQL);
						
						$sSQL = "Update Slots Set SlotQuantity = SlotQuantity -1 Where Slot_ID = " . $Slot_ID;
						mysql_query($sSQL);
						
						$ProviderslotID[$thisLoop] = $Slot_ID;
						$thisLoop = $thisLoop + 1;
					} 
					
				}
				else
				{
					$sSQL = "INSERT INTO SlotOrdersItems (SlotOrders_ID, Slot_ID, Quantity)" ;
					$sSQL = $sSQL . " VALUES (" . $Order_ID . "," . $ProductID . ", " . $iquantity . ")";
					mysql_query($sSQL);
					
					$sSQL = "Update Slots Set SlotQuantity = SlotQuantity -1 Where Slot_ID = " . $ProductID;
					
					mysql_query($sSQL);
					
					$ProviderslotID[$Ind] = $ProductID;
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
			<th align='center'>Provider Name</th> <th align='center'>Slot Name</th>  <th align='center'>Slot Details</th>  <th align='center'>Slot Quantity</th>   <th align='center'>Production Broadcast Date</th>  <th align='center'>Slot Deadline Date</th>
			</tr>";
			
			$sMessage = "";
			
			for($x = 1; $x < $Ind; $x++) 
			{
				print("Got Here1 " . $x);
				$thisSlotID =  $ProviderslotID[$x];
				$sSQL = "SELECT Slots.Providers_ID, SlotName, SlotCostPrice, SlotDeadline, SlotSize_ID, SlotTime_ID, SlotQuantity, ProvidersEmail, ProvidersCompany FROM Slots, Providers WHERE Slots.Providers_ID = Providers.Providers_ID And Slot_ID =" . $thisSlotID ;
				print($sSQL);
				$tmpAccs = mysql_query($sSQL);
				while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
				{
				print("Got Here2 " . $x);
					$SlotName  = $thisAccs["SlotName"];
					$SlotCostPrice  = $thisAccs["SlotCostPrice"];
					$SlotDeadline  = $thisAccs["SlotDeadline"];
					$ProvidersEmail  = $thisAccs["ProvidersEmail"];
					$ProvidersCompany  = $thisAccs["ProvidersCompany"];
					$Providers_ID  = $thisAccs["Providers_ID"];
					$SlotSize_ID  = $thisAccs["SlotSize_ID"];
					$SlotTime_ID  = $thisAccs["SlotTime_ID"];
					$Quantity  = $thisAccs["Quantity"];
					
					$ProductionDate = date("D-d-M-y", strtotime(SlotDeadline . " +7 days")); 					
					$SlotDeadline = date("D-d-M-y", strtotime($SlotDeadline));
					
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
					$sMessage = $sMessage . "<td align='center'>" . $ProvidersCompany . "</td>" . "<td align='center'>"  . $SlotName . "</td>" . "<td align='center'>" . $SlotDetails . "</td>" .  "<td align='center'>" . $Quantity . "</td>" .  "<td align='center'>" . $ProductionDate . "</td>" . "<td align='center'>" . $SlotDeadline . "</td>" ;									
					$sMessage = $sMessage . "</tr>";
					
					$sMessage = $sMessage . "</table>";
					
					
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
						<th align='center'>Slot Name</th> <th align='center'>Slot Price</th> <th align='center'>Slot Production Date</th>
						</tr>";
						$TotalPrice = 0;
						
						$Message = "";
						for($thisLoop = 0; $thisLoop < $Recs; $thisLoop++) 
						{
							$thisDate = date("D-d-M-y", strtotime($OrderedSlotDeadline[$thisLoop] . " +7 days")); 
							
							$thisSlot =  $OrderedSlotName[$thisLoop];
							$thisSlotCostPrice =  $OrderedSlotCostPrice[$thisLoop];
							
							$Message = $Message ."<tr>";
							$Message = $Message . "<td align='center'>" . $thisSlot . "</td>" . "<td align='center'>"  . $thisSlotCostPrice . "</td>" . "<td align='center'>" . $thisDate . "</td>" ;									
							$Message = $Message . "</tr>";
							$TotalPrice = $TotalPrice + $OrderedSlotCostPrice[$thisLoop];
						}
						
					//	$OrderedProvidersEmail[0] = $ProvidersEmail;
					//	$OrderedProvidersCompany[0] = $ProvidersCompany;
			
			
						$Message = $Message . "<tr>";
						$Message = $Message . "<th colspan='2'>Total price:</th><th> &pound;" . $TotalPrice . "</th>";
						$Message = $Message . "</tr>";
						$Message = $Message . "</table>";
			
						$to = "bovell_d@hotmail.com"; // admin@theunited.media
						
						$DocumentTitle = "New Order Notification ";
						$DocumentText = "<br/>A new order for a Media Slot was made at The United Media!<br/>";
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
			
			
			$MessageHeader = "
			<table>
			<tr>
			<th colspan='3'>Slots Ordered</th>
			</tr>
			<tr>
			<th align='center'>Slot Name</th> <th align='center'>Slot Price</th> <th align='center'>Slot Production Date</th>
			</tr>";
			$TotalPrice = 0;
			
			$Message = "";
			for($thisLoop = 0; $thisLoop < $Recs; $thisLoop++) 
			{
				$thisDate = date("D-d-M-y", strtotime($OrderedSlotDeadline[$thisLoop] . " +7 days")); 
				
				$thisSlot =  $OrderedSlotName[$thisLoop];
				$thisSlotCostPrice =  $OrderedSlotCostPrice[$thisLoop];
				
				$Message = $Message ."<tr>";
				$Message = $Message . "<td align='center'>" . $thisSlot . "</td>" . "<td align='center'>"  . $thisSlotCostPrice . "</td>" . "<td align='center'>" . $thisDate . "</td>" ;									
				$Message = $Message . "</tr>";
				$TotalPrice = $TotalPrice + $OrderedSlotCostPrice[$thisLoop];
			}
			
		//	$OrderedProvidersEmail[0] = $ProvidersEmail;
		//	$OrderedProvidersCompany[0] = $ProvidersCompany;
			
			
			$Message = $Message . "<tr>";
			$Message = $Message . "<th colspan='2'>Total price:</th><th> &pound;" . $TotalPrice . "</th>";
			$Message = $Message . "</tr>";
			$Message = $Message . "</table>";

			$to = "bovell_d@hotmail.com"; // admin@theunited.media
			
			$DocumentTitle = "New Order Notification ";
			$DocumentText = "<br/>A new order for a Media Slot was made at The United Media!<br/>";
			$DocumentText = $DocumentText . $MessageHeader . $Message . "<br/>";
			
			$Success = SendEmail( $to, $DocumentText, $DocumentTitle );
			
			$Recs =0;
	
			// Send order email to sales
			$to = "bovell_d@hotmail.com"; // admin@theunited.media
			
			$DocumentTitle = "New Order Notification Order Number: " . $Order_ID;
			$DocumentText = "<br/>A new order for a Media Slot was made at The United Media!<br/>";
			$Success = SendEmail( $to, $DocumentText, $DocumentTitle );
			
			
			// Send order email to customer
			//'iIsNewCustomer = 1			
						
			$to = "bovell_d@hotmail.com"; //Payer_email - Change back when live sEmailTo
			$DocumentText = "Dear " . $ClientName . "," .  "<br/>" . " Thank you for your purchase the details of which are in your Order page and is stated below: " . "<br/>" ;
			$DocumentText = $DocumentText . $sMessageHeader . $sMessage . "<br/>";

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

		
?>