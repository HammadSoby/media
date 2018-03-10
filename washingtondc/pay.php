
<?php include "config.php";?>
<!DOCTYPE html>
<html lang="en-US" class="no-js" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width" />
<title>Payments with PayPal Standrad method | Sanjay Sidana</title>
</head>
<body>
<form action="payment.php" method="post">
First Name : <input type="text" name="first_name" required><br /><br />
Last Name : <input type="text" name="last_name" required><br /><br />
<input type="submit" name="Submit" value="Pay now" />
</form>
</body>
</html> 