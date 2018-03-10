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
	$ProviderID = $_POST['custom'];
	$myaddress = $address_street . " " . $address_city . " " . $address_country;
	
	// Add Transaction
		$sSQL = "INSERT INTO ics_Transactions (item_name, payment_status, payment_amount, payment_currency, txn_id, receiver_email,  payer_email, first_name, last_name, address_street, address_zip, contact_phone, payer_business_name, payer_id, address_city, address_country)" ;
		$sSQL = $sSQL . " VALUES ('" . $item_name . "','" . $payment_status . "'," . $payment_amount . ",'" . $payment_currency . "','" . $txn_id . "','" . $receiver_email . "','" . $payer_email . "','" . $first_name . "','" . $last_name . "','" . $address_street . "','" . $address_zip . "','" . $contact_phone . "','" . $payer_business_name . "','" . $clientid . "','" . $address_city . "','" . $address_country . "' )";
		
		mysql_query($sSQL);
		$Trans_ID = mysql_insert_id();
		
if ($payment_status == "Completed")
{
	$sSQL = "Update Providers Set RegCompleted = 1 , Trans_ID = " . $Trans_ID  . " Where Providers_ID = " . $ProviderID;
	
	mysql_query($sSQL);
}
?>
