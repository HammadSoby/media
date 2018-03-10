<head>
  <title>Media Provider Panel </title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" name="viewport" content="width=device-width,initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="style/board_providers.css" />
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body>
<script>
function goBack() {
    window.history.back();
}
</script>

 <div id="controls_remember">
   
   <?php   
 

    include 'includes/leftmenu_providers.php'; ?>
      </div>
      <div id="menu">
         <nav>
                <span class="show_menu"></span>
            
            <ul class="ul">
                <li><a href="aboutradio.php">Radio Ads</a></li>
                <li><a href="abouttv.php">Tv Ads</a></li>
                <li><a href="aboutprint.php">Print Ads</a></li>
                <li><a href="aboutod.php">Outdoor Ads</a></li>
                <li><a href="aboutmp.php">Media Packages</a></li>
                <li><a href="contactus.php">Contact us</a></li>
            </ul>
            </nav>
      </div>
      <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
     <script>
$(document).ready(function(){
  $("#booknow").click(function(){
    $("#booking").toggle();
  });
});
$(document).ready(function(){
  $("#update_but").click(function(){
    $("#update_div").toggle();
  });
});
</script>
<?
require 'sendemails.php';

$snd =  $_REQUEST['snd'];
if ($snd ==1) 
{
	$txtName =  $_POST['txtName'];
	$txtEmail =  $_POST['txtEmail'];
	$txtMessage =  $_POST['txtMessage'];
	
	$DocumentText =  $DocumentText . "<p>Name: " . $txtName . "</P>";
	$DocumentText =  $DocumentText . "<p>Email: " . $txtEmail . "</P>";
	$DocumentText =  $DocumentText . "<p>Message: " . $txtMessage . "</P>";
	$to = "admin@mediaunited.co.uk "; 
	

	$DocumentTitle = "Contact US Message" ;
	$Success = SendEmail( $to,  $DocumentText, $DocumentTitle ); 
	if ($Success == "Yes")
	{
		?>
		<p align="center">Email Sent</p>
		<?
	}
	else
	{
		?>
		<p align="center">Email Not Sent</p>
		<?
	}
}

?>
      <div id="dashboard">

      <div id="client_info">
      <h1>CONTACT US</h1>  


<p>
Please leave your Comments, Compliments, Complaints suggesting any ways you would improvements. We support good ideas and appreciate your feedback, rewarding with benefits to you based on results.  </p>
<h2>Stay Connected With Us</h2>
<p>Please Fill In The Form </p>
<form action="contactus.php?snd=1" method="post">
<table>
<tr>
<td>Your Name:</td><td><input name="txtName" type="text" required id="txtName" size="50"></td>
</tr>
<tr>
<td>Your Email:</td><td><input name="txtEmail" type="text" required id="txtEmail" size="50"></td>
</tr>
<tr>
<td>Your Message:</td><td><textarea name="txtMessage" cols="50" rows="7" id="txtMessage"></textarea></td>
</tr>
<tr>
<td align="center" colspan="2"><input type="submit" value="Send"></td>
</tr>
</table>
</form>
<br/>

<h2>Trading Name: Media United Inc</h2>
<h3>USA Business Address: </h3>
<p><strong>Media United Inc<br/>
Head Office</strong><br/>
Ninth Floor<br/>
280 Madison Avenue<br/>
New York<br/>
NY 10016</p>

<h3>UK Business Address: </h3>
<p><strong>Media United Inc<br/>
Representative  Office</strong><br/>
Third Floor<br/>
207 Regent Street<br/>
London<br/>
W1B 3HH<br/>
United Kingdom
</p>

<a href="https://twitter.com" target="_blank"><img src="images/twittericon.png" width="50" height="50"></a> &nbsp;<a href="https://facebook.com" target="_blank"><img src="images/fbicon.png" width="50" height="50"></a>  &nbsp;<a href="https://pinterest.com" target="_blank"><img src="images/pricon.png" width="50" height="50"></a>  &nbsp;<a href="https://google.com" target="_blank"><img src="images/googleicon.png" width="50" height="50"></a>








 
		 
    <div align="center"><a href="" onClick="goBack()">back</a></div>
  </div>
  </div>

  </body>
   