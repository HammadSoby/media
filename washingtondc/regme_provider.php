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
 function sanitize($data) 
 {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
if ($_SERVER["REQUEST_METHOD"] == "POST")
{ 
	$email_input="email";
	$number="number";
		$txtName = sanitize( $_POST['fullname']);
		$txtComp =  sanitize($_POST['organisation']);
		$txtNumber =  sanitize($_POST['phone']);
		$optMedia =  sanitize($_POST['optmedia']);		
		$optdur =  sanitize($_POST['optdur']);		
		
		$txtAddress1 =  sanitize($_POST['postadress']);
		$txtAddress2 =  sanitize($_POST['streetno']);
		$txtAddress3 =  sanitize($_POST['country']);
		
		$txtPostcode =  sanitize($_POST['postcode']);
		$txtPassword =  sanitize($_POST['password']);
		$txtEmail =  sanitize($_POST['email']);
		
		$txtAddress = $txtAddress1 . " " . $txtAddress2 . " " .  $txtAddress3; 
		
		$sSQL = "Insert Into Providers ( ProvidersName , ProvidersCompany , ProvidersNumber , MediaType_ID, ProvidersAddress, ProvidersPostcode, ProvidersPassword, ProvidersEmail, PubDuration )"; 
		$sSQL .= " Value('" . $txtName . "','" . $txtComp . "','" .  $txtNumber . "'," .  $optMedia . ",'" .  $txtAddress . "','" .  $txtPostcode . "','" .  $txtPassword . "','" .  $txtEmail . "','" .  $optdur . "')";
		//print($sSQL);
		mysql_query($sSQL);
		$ProviderID = mysql_insert_id();
		$_SESSION['Provider_ID'] = $ProviderID;
		
		$Message = "
Dear " . $txtName . ",<br/>

Re: " . $txtComp . " <br/>

Media United welcomes you to  where you are able to choose your Media Provider across Radio, Television, Papers and Publications, including Billboards.  To access your account and amend, add or delete any information, you will need the following login details:- <br/>

Username: " . $txtEmail . " <br/>
Password: " . $txtPassword . " <br/>

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
		
		
		
		$to = $txtEmail; 
		$DocumentText =  $Message ;

		$DocumentTitle = "WELCOME to Media United" ;
		$Success = SendEmail( $to,  $DocumentText, $DocumentTitle );
		
		
		?>
		<script>
		window.location="board.php?board=provider";
		</script>
		<?php
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
<form method="post" action="" class="form_01">
 
    <h1>Register A Media Provider Account
        <span> Please enter your details below.</br></br><span id="if"> if your not the owner or representive of a Media agency ,</br> please register using our <a href="register.php?register=client">Client Register page</a></span> </span></br>
        
         <?php if(isset($username_error))
		 {
            ?>
            <center><small id="theerror"><?php echo $username_error; ?> </small></center>
            <?php
          }
          if(isset($email_error))
		  {
			?>
		   <center> <small id="theerror"><?php echo $email_error; ?></small></center>
			<?php
		  }
		  if(isset($fullname_error))
		  {
			  ?> <center><small id="theerror"><?php echo $fullname_error; ?></small></center>
			  <?php
		  }
		  if(isset($org_error))
		  {
			  ?> <center><small id="theerror"><?php echo $org_error; ?></small></center>
			  <?php
		  }
		 if(isset($phone_error))
		 {
			  ?> <center><small id="theerror"><?php echo $phone_error; ?></small></center>
			  <?php
		  }
		  if(isset($required_error))
		  {
			  ?> <center><small id="theerror"><?php echo $required_error; ?></small></center>
			  <?php
		  }
		   if(isset($password_error))
		   {
			  ?> <center><small id="theerror"><?php echo $password_error; ?></small></center>
			  <?php
		  }

     
          ?>
    </h1></label>
  <span id="logmem">Enter Your Details</span> </br></br> 
  <label> <span>Media Type <small id="star">*</small>&nbsp;&nbsp; :</span> </label>

    <label> <input type="radio" name="optmedia" value="1" checked> Print  
    <input type="radio" name="optmedia" value="2"> Radio 
     <input type="radio" name="optmedia" value="3"> TV</label>
<br/>
  <label> <span>Production Duration<small id="star">*</small>&nbsp;&nbsp; :</span> </label>

    <label> <input type="radio" name="optdur" value="D" checked> Daily  
    <input type="radio" name="optdur" value="W"> Weekly   
    <input type="radio" name="optdur" value="F"> Fortnightly
    <input type="radio" name="optdur" value="M"> Monthly
	</label>
	<br/>
  <label>
               
              <span>Decision Maker <small id="star">*</small>&nbsp;&nbsp; :</span> 
      
 
            
        <input id="password" type="name" name="fullname"  maxlength="20" required>
    </label>
    <label>
             
              <span> Organization <small id="star">*</small>&nbsp;&nbsp; :</span>

         
            
        <input id="password" type="name" name="organisation"  maxlength="20" required/>
    </label>


    <label>
      
            <span>Phone Number <small id="star">*</small>&nbsp;&nbsp; :</span>
           
        <input id="password" type="text" name="phone"  maxlength="20"  required>
    </label>
     
     <label>
   
              <span>Post Adress <small id="star">*</small>&nbsp;&nbsp; :</span>
  


        <input id="email" type="text"   name="postadress"  required>  
    </label>
     <label>
   
              <span>City <small id="star">*</small>&nbsp;&nbsp; :</span>
  


        <input id="email" type="text"  name="streetno"   required>
    </label>
    <label>
   
              <span>Country <small id="star">*</small>&nbsp;&nbsp; :</span>
  


        <input id="email" type="text"  name="country"  required>
    </label>
      <label>
   
              <span>Post Code <small id="star">*</small>&nbsp;&nbsp; :</span>
  


        <input id="email" type="text"   name="postcode"  required>
    </label></br></br>
     <span id="logmem">Login Details</span>&nbsp;&nbsp;
                

     <label>
            
              <span>Password <small id="star">*</small>&nbsp;&nbsp;:</span>
   
  
        <input id="password" type="password" name="password"  maxlength="20" required>
    </label></br>
    <label>
            
              <span>Repeat Password <small id="star">*</small>&nbsp;&nbsp;:</span>
   
  
        <input id="password" type="password" name="rpassword" maxlength="20" required>
    </label></br>
      <label>

       <span>Email Address :<small id="star">*</small>&nbsp;&nbsp;</span>
      
        <input id="password" type="text" name="email" required>
    </label>
      <label>

       <span>Repeat Email Address :<small id="star">*</small>&nbsp;&nbsp;</span>
      
        <input id="password" type="text" name="remail" required >
    </label>


     <label>
        <span>&nbsp;</span> 
        <input type="submit" class="button" name="register" value="Register" /> 
        <input type="hidden" name="user" value="1" />
        
        
    </label> 
    <div id="dha">
        <span id="dtext">
            Already Have an Account ? <a href="login.php?login=provider">Login </a> Here. </span>
        </div>
</form>
</div>
</div>

</div>
</body> 
 