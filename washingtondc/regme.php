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
#ifa{
color:#aa0000; font-weight:normal; }
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
 // Report simple running errors
error_reporting(E_ERROR);
 session_start();
$email_input="email";
$number="number";

/* load settings */
require 'connectdb.php';
require 'sendemails.php';
function sanitize($data) 
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$password=sanitize($_POST['password']);
	$rpassword=sanitize($_POST['rpassword']);
	if($_POST['password'])
	{
		$email=sanitize($_POST['email']);
		$remail=sanitize($_POST['remail']);
		$password=sanitize($_POST['password']);
		$fullname=sanitize($_POST['fullname']);
		$org_name=sanitize($_POST['organisation']);
		$phone=sanitize($_POST['phone']);
		if($email_input!=$email_input)
		{
			 $email_input==$email_input;
		}
		 if($number!=$number)
		 {
			 $number==$number;
		} 
	}

	if($password==$rpassword)
	{
		if($email==$remail)
		{
			if(filter_var($email, FILTER_VALIDATE_EMAIL))
			{
				$sSQL = "Insert Into Clients ( ClientName , ClientCompany , ClientNumber , ClientPassword,   Membership_ID, ClientEmail )"; 
				$sSQL .= " Value('" . $fullname . "','" . $org_name . "','" .  $phone . "','" .  $password . "',1,'" .  $email . "')";
				//print($sSQL);
				mysql_query($sSQL);
				$Client_ID = mysql_insert_id();
				$_SESSION['Client_ID'] = $Client_ID;
				
				print(" This Client = " . $_SESSION['Client_ID']);
			}
		}
	}			
	
	$message = "
Dear " . $fullname . ",<br/>

Re: " . $org_name . " <br/>

Media United welcomes you an your Organisation to our platform where you are able to upload your media pack and promote your products and services to the business and consumer community across the UK and worldwide.  We sell the space you make available by creating slots. You can create slots using the functionality provided or watch the video that explains the step by step process. <br/>
To access your account and amend, add or delete any information, you will need the following login details:- <br/>

Username: " . $email . " <br/>
Password: " . $password . " <br/>


We promote and publicise any special offers, promotions, gifts and giveaways that you have across the thousands of business owners and members of the public that we have access to .This will help to bring in new business, stay ahead of competition and gain market share. . Please make your offers available using the platform or email sales@mediaunited.co.uk. <br/>

Here are some of the benefits:-<br/><br/>

Media United will allow you to use our platform or  we will purchase from your advertising platform, guaranteeing sales to maximise your revenue.<br/>
Media United can target a specific audience and provide you with the results.<br/>
We take care of all the customer and consumer obligations up to the point of sale.<br/>
Consumers that we canvass get to purchase your products or services as part of a package that we offer. <br/>
Sizes and prices that you do not offer normally can be  provided through Media United.<br/>
Consumers can choose to broadcast at different times throughout the week, month or year, and will change their broadcast times to suit their campaign.<br/>
Change what you want to be seen, heard or read to target specific areas to develop or redevelop.<br/>
Media United will also promote your products and services via Radio DJ's across the UK, who via audience participation and competitions bring the consumers to you.<br/>
Media United Services will help you to create market share, public awareness and revenue.<br/>

To protect the integrity of our relationship with our purchasers and avoid contentious situations we pay funds received within 7 days of you confirming that the broadcast has taken place.  Please notify us of any changes to your information using the website on or before the change happens as failure to do this may invalidate our service offered.  Any complaints, comments or compliments should be submitted to admin@mediaunited.co.uk.   <br/> 

Thank you <br/>
";

	$to = $email; 
	$DocumentText =  $message ;

	$DocumentTitle = "WELCOME to Media United" ;
	$Success = SendEmail( $to,  $DocumentText, $DocumentTitle );
	?>
	<script>
	window.location="board.php?board=client";
	</script>
	<?
         


}
?>

<form method="post" action="" class="form_01">
 
    <h1>Register A Media United Account
        <span>Please enter your details below.</span>  <span id="ifa">if your a media provider please click <a href="register.php?register=provider">here </a>to register </span></br>
   <?   
          if(isset($email_error)){
    ?>
   <center> <small id="theerror"><?php echo $email_error; ?></small></center>
    <?php
  }
      if(isset($fullname_error)){
  ?> <center><small id="theerror"><?php echo $fullname_error; ?></small></center>
  <?php
   }  
      if(isset($org_error)){
  ?> <center><small id="theerror"><?php echo $org_error; ?></small></center>
  <?php
      }
     if(isset($phone_error)){
  ?> <center><small id="theerror"><?php echo $phone_error; ?></small></center>
  <?php
      }
      if(isset($required_error)){
  ?> <center><small id="theerror"><?php echo $required_error; ?></small></center>
  <?php
      }
       if(isset($password_error)){
  ?> <center><small id="theerror"><?php echo $password_error; ?></small></center>
  <?php
      }

     
          ?>
    </h1>
       
    
	<p> Enter Your  Details</p>
	
	<label> <span>Your name <small id="star">*</small>&nbsp;&nbsp; :</span> </td> <td> <input id="password" type="name" name="fullname"   maxlength="20" required> </label>
  
	</br> 
    <label>   <span> Organization  :</span>  <input id="password" type="name" name="organisation"  maxlength="20"/>  </label>
</br>
    <label>  <span>Phone Number <small id="star">*</small>&nbsp;&nbsp; :</span>  <input id="password" type="name" name="phone"  maxlength="20" required> </label>
	</br></br>
    <span id="logmem">Login Details</span>&nbsp;&nbsp;
	</br>
    <label>  <span>Password <small id="star">*</small>&nbsp;&nbsp;:</span>   <input id="password" type="password" name="password"  maxlength="20" required>  </label>
	</br>
    <label>  <span>Repeat Password <small id="star">*</small>&nbsp;&nbsp;:</span>  <input id="password" type="password" name="rpassword" maxlength="20" required>    </label>
	</br>
    <label>  <span>Email Address :<small id="star">*</small>&nbsp;&nbsp;</span>  <input id="password" type="text" name="email" required >  </label>
	</br>
    <label>  <span>Repeat Email Address :<small id="star">*</small>&nbsp;&nbsp;</span>  <input id="password" type="text" name="remail" required >  </label>
</br>
     <label>  <span>&nbsp;</span> 
        <input type="submit" class="button" name="register" value="Register" /> 
        <input type="hidden" name="user" value="1" />
    </label> 
    <div id="dha">
        <span id="dtext">
            Already Have an Account ? <a href="login.php?login=client">Login </a> Here. </span> 
        </div>
</form>
</div>
</div>


</body> 
 