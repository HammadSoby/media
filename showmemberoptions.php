<html>
<head>
      <title> Register </title>
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
<table align="center" >
<tr>
        <th colspan="2"><font size="+3">Select Membership Type</font></th>
</tr>

 <?php 

/* load settings */
require 'connectdb.php';
$sSQL = "SELECT Membership_ID, 	MembershipName, Discount, Price, Description FROM Memberships  Order By Membership_ID" ;
//print($sSQL);
$tmpAccs = mysql_query($sSQL);

while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
{
	$Membership_ID = $thisAccs["Membership_ID"];
	$MembershipName = $thisAccs["MembershipName"];
	$Discount = $thisAccs["Discount"];
	$Price = $thisAccs["Price"];
	$Description = $thisAccs["Description"];
	echo("<tr>");
	if($Discount >0)
	{
		echo("<td  colspan='2' align='center'><font size='+2'><strong>" . $MembershipName . "</strong></font><br/><font size='+1'>" . $Description . "<br/> <br/>" . "Cost: &pound;" . $Price . "<br/>" .  $Discount . "% off of advertising price</font>");
	}
	else
	{
		echo("<td colspan='2' align='center'><font size='+2'><strong>" . $MembershipName . "</strong></font><br/><font size='+1'>" . $Description . "<br/> <br/>" . "Cost: &pound;" . $Price . "<br/></font>");
	}
	if($Price > 0)
	{
	?>
		<br/>
		<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top" name="pp">
		<input type="hidden" name="cmd" value="_xclick">
		<input type="hidden" name="item_name" value="<? echo($MembershipName); ?>">
		<input type="hidden" name="amount" value="<? echo($Price); ?>">
		<input type="hidden" name="currency_code" value="GBP">
		<input type="hidden" name="business" value="bus_test@ics.com">
		<input type="image" src="https://www.sandbox.paypal.com/en_US/GB/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal – The safer, easier way to pay online.">
		<img alt="" border="0" src="https://www.sandbox.paypal.com/en_GB/i/scr/pixel.gif" width="1" height="1">
		<INPUT TYPE="hidden" name="custom" value="<? echo($Membership_ID); ?>">
		<INPUT TYPE="hidden" NAME="return" value="http://www.mediaunited.co.uk">
		<input type="hidden" name="cancel_return" value="http://www.mediaunited.co.uk/showmemberoptions.php">
		<INPUT TYPE="hidden" name="notify_url" value="http://www.mediaunited.co.uk/processmem.php">

		
		</form>
	<?
	}
	else
	{
		echo("<br/><br/><a href='regme.php'>Click to Join</a><br/>");
	}
	echo("<hr>");
	echo("</td>");
	echo("</tr>");

}

?>	


</tr>
</table>

</div>
</div>

</div>
</body> 
 