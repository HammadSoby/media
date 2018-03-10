  <?

	/* load settings */
	require 'connectdb.php';
require 'sendemails.php';

$iIsNewCustomer = 1;

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
	$membershipid = $_POST['custom'];
	$myaddress = $address_street . " " . $address_city . " " . $address_country;
	
	// Add Transaction
		$sSQL = "INSERT INTO ics_Transactions (item_name, payment_status, payment_amount, payment_currency, txn_id, receiver_email,  payer_email, first_name, last_name, address_street, address_zip, contact_phone, payer_business_name, payer_id, address_city, address_country)" ;
		$sSQL = $sSQL . " VALUES ('" . $item_name . "','" . $payment_status . "'," . $payment_amount . ",'" . $payment_currency . "','" . $txn_id . "','" . $receiver_email . "','" . $payer_email . "','" . $first_name . "','" . $last_name . "','" . $address_street . "','" . $address_zip . "','" . $contact_phone . "','" . $payer_business_name . "','" . $clientid . "','" . $address_city . "','" . $address_country . "' )";
		
		mysql_query($sSQL);
	

if ($payment_status == "Completed")
{
	$myPass =  $txn_id . "pw" . $last_name;
	$ClientName = $first_name . " " . $last_name;
	
	$sSQL = "Insert Into Clients ( ClientName , ClientCompany , ClientNumber , ClientPassword,   Membership_ID, ClientEmail, ClientAddress, ClientPostcode )"; 
	$sSQL .= " Value('" . $ClientName . "','" . $payer_business_name . "','" .  $contact_phone . "','" .  $myPass . "'," . $membershipid . ",'" .  $payer_email . "','" . $myaddress . "','" . $address_zip . "')";
	//print($sSQL);
	mysql_query($sSQL);
		$payer_email = "bovell_d@hotmail.com"; // remove this line when live
		if ($membershipid == 2)
		{
			$memType = "Sliver";
			$Moreinfo = "";
		}
		if ($membershipid == 3)
		{
			$memType = "Gold";
			$Moreinfo = "<br/>Please remember to add your Black Links UK ID<br/>";
		}
		
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

	$to = "bovell_d@hotmail.com";//$payer_email; 
	$DocumentText =  $message ;

	$DocumentTitle = "WELCOME to Media United" ;
	$Success = SendEmail( $to,  $DocumentText, $DocumentTitle );

}
?>
