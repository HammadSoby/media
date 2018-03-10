<!DOCTYPE html>
<html lang="en-US" class="no-js" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width" />
<title>Payments with PayPal Standard method | Sanjay Sidana</title>
</head>
<body>
<?php include "config.php";

     $first_name=$_POST['first_name'];
     $last_name=$_POST['last_name'];
     $order_status=0;
     $created=date('Y-m-d h:i:s');
     $modified=date('Y-m-d h:i:s');
if(isset($_POST['Submit'])){
/* insert the data into database */
$result=$pdo->prepare("INSERT INTO paypal_oders (first_name,last_name,order_status,created,modified) VALUES (?,?,?,?,?)");
	    $result->BindValue(1,$first_name);
	    $result->BindValue(2,$last_name);
	    $result->BindValue(3,$order_status);
	    $result->BindValue(4,$created);
	    $result->BindValue(5,$modified);
	    $result->execute();

$getlastid = $pdo->lastInsertId();

?>

<form method="post" action="https://www.sandbox.paypal.com/cgi-bin/webscr" id="paypal_form">
<div class="paypal-form">
<input type="hidden" value="<?php echo paypal_email;?>" name="business">
<input type="hidden" value="GBP" name="currency_code">
<input type="hidden" value="GBP" name="lc">
<input type="hidden" value="Donation" name="item_name">
<input type="hidden" value="<?php echo $price; ?>" name="amount">
<input type="hidden" value="1" name="test">
<input type="hidden" value="<?php echo siteurl;?>result.php" name="return">
<input type="hidden" value="<?php echo $getlastid;?>" name="custom">
<input type="hidden" value="paynow" name="type">
<input type="hidden" value="_xclick" name="cmd">
</div><div class="submit">
<!--input type="submit" value="Pay With Paypal" class="btn btn-primary bold"-->
</div>
</form>
<div style="margin:0 auto; font-size:15px;text-align:center;">Please wait while we redirect to PayPal's secure platform to complete your payment...</div>
<script>
setTimeout(function(){
document.getElementById("paypal_form").submit();
},3000);
</script>
<?php } ?>
</body>
</html> 