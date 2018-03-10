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
                                   
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= 'From: <Mediaunited@Welcome.com>' . "\r\n";
                $headers .= 'Cc: Welcome|MediaUnited' . "\r\n";
                $to="Benlaksire@gmail.com";
                $subject="Mediaunited Welcomes you";
                $message = "
                           <html>
                             <head>
                               <title>Welcome To Media United</title>
                               
                                 </head>
                                   <body>
                                    Media United Advertising Agency is making advertising affordable </br></br>

Since it started Media United has been at the forefront of accessing the UK’s black community. We invite 

you to step into our world and join the thousands of growing members online who benefit from the Media 

Providers who are our partners. </br></br>

Access your Client Area log in using:</br></br>

Username:  <?php echo $username; ?>

Password:  <?php echo $password; ?>

BlackLinks ID (optional) : <?php if(isset($blackLink)){echo $blackLink;} ?>

Your account entitles you to purchase advertising space across Print & Publications ,  

Radio and Television across the UK. As a standard member you have your own area 

called the Client Area. It is free to be a standard member or guest . Please update 

your membership and subscribe to become an upgraded (Standard Plus) member 

and obtain discounts on advertising you purchase.</br>

As our gift to you please enjoy an introductory membership price of £200.00 pa and 

become an upgraded (Standard Plus) member. Using your promotional BlackLinks 

ID reduces this to £100.00.</br></br>

If you have any questions or concerns do not hesitate to contact  us at 

CustomerAssistance@MediaUnited.co.uk or call + 44 (0) 203 289 0616. Our 

customer assistance team will be happy to help you.</br></br>

Save money and get the following:-</br></br>

 A one stop shop for advertising across Print, Radio and Television uniting media.</br></br>

 Rates which makes it affordable to be read, heard and seen by customers. </br></br>

 A dedicated service that works to your benefit and welcomes others.</br></br></br>

Yours Sincerely</br></br>

Media United</br></br>

Admin Team</br></br>

Call:+44 (0) 203 289 0616</br></br>
                                       </body>
                                          </html>
                                                  ";
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
        <span> Please enter your details below.</br></br><span id="if"> Not the owner or representative of a Media Provider , please register using our <a href="register.php?register=client">Media Purchaser page</a></span> </span></br>
        
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
  <span id="logmem">Enter Your Details</span> <br/>
  
  <table id="logmem">
  <tr>
  <td>
  <table>
  <tr>
  <td> <font size="1">Media Type <small id="star">*</small>&nbsp;&nbsp; :</font></td>
 
  <td>
	 <label><input  type="radio" name="optmedia" value="1"> Print  </label> <br/>
	<input type="radio" name="optmedia" value="2"> Radio   <br/>
	<input type="radio" name="optmedia" value="3"> TV
  </td>
  </tr>
  </table>
  </td>
  </tr>
  <tr>
  <td>
  <table>
  <tr>
  <td> <font size="1"> <label>Production Duration <small id="star">*</small>&nbsp;&nbsp; : </label></font></td>
  
  <td>
	<input type="radio" name="optdur" value="D"> Daily <br/>
	<input type="radio" name="optdur" value="W"> Weekly <br/>
	<input type="radio" name="optdur" value="F"> Fortnightly <br/>
	<input type="radio" name="optdur" value="M"> Monthly 
 </td>
  </tr>
  </table>
  </td>
  </tr>
  
  </table>
  <label>
               
              <span>Decision Maker <small id="star">*</small>&nbsp;&nbsp; :</span> 
      
 
            
        <input id="password" type="name" name="fullname"  maxlength="20" >
    </label>
    <label>
             
              <span> Organization <small id="star">*</small>&nbsp;&nbsp; :</span>

         
            
        <input id="password" type="name" name="organisation"  maxlength="20"/>
    </label>


    <label>
      
            <span>Phone Number <small id="star">*</small>&nbsp;&nbsp; :</span>
           
        <input id="password" type="text" name="phone"  maxlength="20" >
    </label>
     
     <label>
   
              <span>Post Adress <small id="star">*</small>&nbsp;&nbsp; :</span>
  


        <input id="email" type="text"   name="postadress"  required>  
    </label>
     <label>
   
              <span>Street Number <small id="star">*</small>&nbsp;&nbsp; :</span>
  


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
      
        <input id="password" type="text" name="email" >
    </label>
      <label>

       <span>Repeat Email Address :<small id="star">*</small>&nbsp;&nbsp;</span>
      
        <input id="password" type="text" name="remail"  >
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
 