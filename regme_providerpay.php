<?    session_start(); ?>
<html>
<head>
      <title>Register Media Provider Account </title>
      <meta name="viewport" content="width=device-width,initial-scale=1.0">
      <link rel="stylesheet" type="text/css" href="style/login.css" />
</head>
<style>
#logowing{
    width: 3.5%;
    float: left;
    margin-left: 8%;
    margin-top: 0.2%;
}
#nologmenu{
  width: 100%;
  height: 10%;
  background: #F96E5B;
  float: left;
  
 }
 </style>
<body>
<div id="menu">
   <nav>
              <span class="show_menu"></span>
            <a href="index.php"><img id="logowing" src="images/media.png" /></a>
            <ul class="ul">
             <li><a href="/">Home</a></li>
            	<li><a href="mediaprovider.php">Media Provider</a></li>
            	<li><a href="aboutus.php">About us</a></li>
            	<li><a href="contactus.php">Contact us</a></li>
            </ul>
            </nav>
            <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
              <script>
              $('.show_menu').click(function(){
                 
                    $('.ul').toggle();
              });
              function jumpScroll() {
    window.scroll(0,1000); // horizontal and vertical scroll targets
}
              </script>
</div>
<div id="content_2">
<div id="form1">

 <?php 
/* load settings */
require 'connectdb.php';
require 'sendemails.php';

	$vc =  $_REQUEST['vc']; //
	
	if ($vc == 1)
	{
		$Voucher =  $_POST['Voucher'];	
		$Voucher_ID = 0;
		
		$sSQL = "SELECT Voucher_ID FROM VoucherCodes  Where VoucherCode = '" . $Voucher . "'" ;
	//print($sSQL);
		$tmpAccs = mysql_query($sSQL);
		
		while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
			$Voucher_ID = $thisAccs["Voucher_ID"];
		}
		
		if ($Voucher_ID > 0)
		{
			$sSQL = "Update Providers Set RegCompleted = 1 Where Providers_ID = " . $_SESSION['Provider_ID'];
			mysql_query($sSQL);
			
		?>
		<script>
		window.location="board.php?board=provider";
		</script>
		<?php
		}
	}	
		?>

<style>
#theerror{
  color:red;
  font-family: "open sans";
  font-weight: normal;
  font-size: 14px;
  margin-top: 1%;
  margin:0 auto;

}
#star{
  color:red;
}
#if{
  font-weight: normal;
  color:#006699;
}
</style>
      <h1>Complete Your Registration       
      </h1>
      </label>
 <table align="center" class="form_01">
 <tr>
 <th align="center">Purchase Registration &nbsp; &pound;250</th>
 </tr>
 <tr>
 <td align="center">
 

 		<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top" name="pp">
		<input type="hidden" name="cmd" value="_xclick">
		<input type="hidden" name="item_name" value="Provider Registration">
		<input type="hidden" name="amount" value="250">
		<input type="hidden" name="currency_code" value="GBP">
		<input type="hidden" name="business" value="bus_test@ics.com">
		<input type="image" src="https://www.sandbox.paypal.com/en_US/GB/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal – The safer, easier way to pay online.">
		<img alt="" border="0" src="https://www.sandbox.paypal.com/en_GB/i/scr/pixel.gif" width="1" height="1">
		<INPUT TYPE="hidden" name="custom" value="<? echo($_SESSION['Provider_ID']); ?>">
		<INPUT TYPE="hidden" NAME="return" value="http://www.mediaunited.co.uk/board.php?board=provider">
		<input type="hidden" name="cancel_return" value="http://www.mediaunited.co.uk/regme_providerpay.php">
		<INPUT TYPE="hidden" name="notify_url" value="http://www.mediaunited.co.uk/processreg.php">

		
		</form>

 
 </td>
 </tr>
 <tr>
 <td align="center">
 Or Enter Voucher Code
 </td>
 </tr>
  <tr>
 <td align="center">
 We believe that its only when you receive the benefits that you should incur a cost. Therefore by inputting the voucher code 123456789
you agree to have your annual setup and administration fee paid out of incoming revenue.

<input type="checkbox" name="chktc" >Tick to agree <a href="terms.php">T &amp; C</a>
<form method="post" action="regme_providerpay.php?vc=1" >
  
  
  
  <label>
      
            <span>Voucher Code <small id="star">*</small>&nbsp;&nbsp; :</span>
           
        <input id="password" type="text" name="Voucher"  maxlength="20"  >
    </label>
     

     <label>
        <span>&nbsp;</span> 
        <input type="submit" class="button" name="register" value="Add" /> 
        <input type="hidden" name="user" value="1" />
        
        
    </label> 
    <div id="dha">
        <span id="dtext">
            Already Have an Account ? <a href="login.php?login=provider">Login </a> Here. </span>
        </div>
</form>
 </td>
 </tr>

 </table>
  </br></br> 
</div>
</div>

</div>
</body> 
 