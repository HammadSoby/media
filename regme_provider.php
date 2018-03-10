<? session_start(); ?>
<html>
<head>
      <title>Register Media Provider Account </title>
      <meta name="viewport" content="width=device-width,initial-scale=1.0">
      <link rel="stylesheet" type="text/css" href="style/login.css" />
</head>
<style>
/* Shared styling */
.validation-image {
    height:19px; 
    width:20px;
    display: none;
}

/* Error styling */
.validation-error {
    background-color: #ff0000;
    background-image: url('/images/readcross.png');
}

/* Success styling */
.validation-success {
    background-color: #00ff00;
    background-image: url('/images/greentick.jpg');
}
</style>
<script language="javascript">

function checkEmail() {
    // Find the validation image div
    var validationElement = document.getElementById('nameValidation');
    // Get the form values
    var name1 = document.forms["frmMain"]["thisemail"].value;
	var name2 = document.forms["frmMain"]["remail"].value;
	var both = name1 + name2;
    // Reset the validation element styles
    validationElement.style.display = 'none';
    validationElement.className = 'validation-image';
    // Check if name2 isn't null or undefined or empty
	if (name1 == name2)
	{
		document.getElementById('register').disabled = false;
		document.getElementById('checkemail').src ="/images/greentick.jpg";
		
	}
	else
	{
		document.getElementById('register').disabled = true;
		document.getElementById('checkemail').src ="/images/readcross.png";
	}
	
	if (document.getElementById('chkUK').checked = true)
	{
		document.getElementById('streetno').required = false;
	}
	else
	{
		document.getElementById('streetno').required = true;
	}
}

function checkPass() {
    // Find the validation image div
    var validationElement = document.getElementById('nameValidation2');
    // Get the form values
    var name1 = document.forms["frmMain"]["mypassword"].value;
	var name2 = document.forms["frmMain"]["rpassword"].value;
	var both = name1 + name2;
	
    // Reset the validation element styles
    validationElement.style.display = 'none';
    validationElement.className = 'validation-image';
    // Check if name2 isn't null or undefined or empty
	if (name1 == name2)
	{
		document.getElementById('register').disabled = false;
		document.getElementById('checkpass').src ="/images/greentick.jpg";
		
	}
	else
	{
		document.getElementById('register').disabled = true;
		document.getElementById('checkpass').src ="/images/readcross.png";
	}
	
	if (document.getElementById('chkUK').checked = true)
	{
		document.getElementById('streetno').required = false;
	}
	else
	{
		document.getElementById('streetno').required = true;
	}
	
	
}





</script>
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
                <li><a href="aboutradio.php">Radio Ads</a></li>
                <li><a href="abouttv.php">Tv Ads</a></li>
                <li><a href="aboutprint.php">Print Ads</a></li>
                <li><a href="aboutod.php">Outdoor Ads</a></li>
                <li><a href="aboutmp.php">Media Packages</a></li>
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

function CheckLogin($txtEmail, $txtPass)
{
	$sSQL = "SELECT Providers_ID, RegCompleted FROM Providers WHERE ProvidersEmail ='" . $txtEmail . "' and ProvidersPassword ='" . $txtPass . "'" ;
	//print($sSQL);
	$tmpAccs = mysql_query($sSQL);
	$_SESSION['Provider_ID'] = 0;
	while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
	{
		$Providers_ID = $thisAccs["Providers_ID"];
		$RegCompleted = $thisAccs["RegCompleted"];
		$_SESSION['Provider_ID'] = $Providers_ID;
		$_SESSION['logtrue']=true;
		
		if ($RegCompleted ==1)
		{
		
			?>
			<script>
			window.location="board.php?board=provider";
			</script>
			<?php
		}
	}
}

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
		$chkUK =  sanitize($_POST['chkUK']);
		if ($chkUK = "1")
		{
			$val = 1;
		}
		else
		{
			$val = 0;
		}
		$txtAddress3 =  sanitize($_POST['country']);
		
		$txtPostcode =  sanitize($_POST['postcode']);
		$txtPassword =  sanitize($_POST['mypassword']);
		$txtEmail =  sanitize($_POST['thisemail']);
		
		CheckLogin($txtEmail, $txtPassword);
		
		$txtAddress = $txtAddress1 . " " . $txtAddress2 . " " .  $txtAddress3; 
		
		$sSQL = "Insert Into Providers ( ProvidersName , ProvidersCompany , ProvidersNumber , ProvidersAddress, ProvidersPostcode, ProvidersPassword, ProvidersEmail, ProviderCity, UKWide )"; 
		$sSQL .= " Value('" . $txtName . "','" . $txtComp . "','" .  $txtNumber . "','" .  $txtAddress . "','" .  $txtPostcode . "','" .  $txtPassword . "','" .  $txtEmail . "', '" .$txtAddress2 . "', " . $val . " )";
		//print($sSQL);
		mysql_query($sSQL);
		$ProviderID = mysql_insert_id();
		$_SESSION['Provider_ID'] = $ProviderID;
		$_SESSION['logtrue']=true;
		
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
		
		// board.php?board=provider
		
		
		?>
		<script>
		window.location="regme_providerpay.php";
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
<form method="post" action="" class="form_01" name="frmMain">
 
    <h1>Register as a Media Provider 

        <span> Please enter your details below.</br></br><span id="if"> To become a media purchaser <a href="register.php?register=client">click here</a></span> </span></br>
        
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
        <span id="dtext"> Already Have an Account ? <a href="login.php?login=provider">Login </a> Here. </span>
       
 <br/>  <br/>
  <span id="logmem">Enter Your Details</span> </br></br> 
	<br/>
  <label>
               
              <span>Name of Decision Maker <small id="star">*</small>&nbsp;&nbsp; :</span> 
      
 
            
        <input id="password" type="name" name="fullname"  maxlength="20" required>
    </label>
    <label>
             
              <span> Organization <small id="star">*</small>&nbsp;&nbsp; :</span>

         
            
        <input id="password" type="name" name="organisation"   required/>
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
   
              <span>Post Code <small id="star">*</small>&nbsp;&nbsp; :</span>
  


        <input id="email" type="text"   name="postcode"  required>
    </label></br>     <label>
   
              <span>Broadcast or Distribution Cities (City1,City2) <br/>or choose UKwide below<small id="star">*</small>&nbsp;&nbsp; :</span>
  


              <textarea name="streetno"  id="streetno"></textarea>
        </label>
      <label> <span>UK Wide &nbsp; </span><input type="checkbox" name="chkUK" id="chkUK" value="1"  onBlur="checkUKWide()"  title="Only select if you operate UK Wide">
      </label>
      <label>&nbsp;</label>
    <label><span>Country <small id="star">*</small>&nbsp;&nbsp; :</span>
  


<select id="country" name="country">
<option value="Afghanistan">Afghanistan</option>
<option value="Åland Islands">Åland Islands</option>
<option value="Albania">Albania</option>
<option value="Algeria">Algeria</option>
<option value="American Samoa">American Samoa</option>
<option value="Andorra">Andorra</option>
<option value="Angola">Angola</option>
<option value="Anguilla">Anguilla</option>
<option value="Antarctica">Antarctica</option>
<option value="Antigua and Barbuda">Antigua and Barbuda</option>
<option value="Argentina">Argentina</option>
<option value="Armenia">Armenia</option>
<option value="Aruba">Aruba</option>
<option value="Australia">Australia</option>
<option value="Austria">Austria</option>
<option value="Azerbaijan">Azerbaijan</option>
<option value="Bahamas">Bahamas</option>
<option value="Bahrain">Bahrain</option>
<option value="Bangladesh">Bangladesh</option>
<option value="Barbados">Barbados</option>
<option value="Belarus">Belarus</option>
<option value="Belgium">Belgium</option>
<option value="Belize">Belize</option>
<option value="Benin">Benin</option>
<option value="Bermuda">Bermuda</option>
<option value="Bhutan">Bhutan</option>
<option value="Bolivia">Bolivia</option>
<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
<option value="Botswana">Botswana</option>
<option value="Bouvet Island">Bouvet Island</option>
<option value="Brazil">Brazil</option>
<option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
<option value="Brunei Darussalam">Brunei Darussalam</option>
<option value="Bulgaria">Bulgaria</option>
<option value="Burkina Faso">Burkina Faso</option>
<option value="Burundi">Burundi</option>
<option value="Cambodia">Cambodia</option>
<option value="Cameroon">Cameroon</option>
<option value="Canada">Canada</option>
<option value="Cape Verde">Cape Verde</option>
<option value="Cayman Islands">Cayman Islands</option>
<option value="Central African Republic">Central African Republic</option>
<option value="Chad">Chad</option>
<option value="Chile">Chile</option>
<option value="China">China</option>
<option value="Christmas Island">Christmas Island</option>
<option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
<option value="Colombia">Colombia</option>
<option value="Comoros">Comoros</option>
<option value="Congo">Congo</option>
<option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
<option value="Cook Islands">Cook Islands</option>
<option value="Costa Rica">Costa Rica</option>
<option value="Cote D'ivoire">Cote D'ivoire</option>
<option value="Croatia">Croatia</option>
<option value="Cuba">Cuba</option>
<option value="Cyprus">Cyprus</option>
<option value="Czech Republic">Czech Republic</option>
<option value="Denmark">Denmark</option>
<option value="Djibouti">Djibouti</option>
<option value="Dominica">Dominica</option>
<option value="Dominican Republic">Dominican Republic</option>
<option value="Ecuador">Ecuador</option>
<option value="Egypt">Egypt</option>
<option value="El Salvador">El Salvador</option>
<option value="Equatorial Guinea">Equatorial Guinea</option>
<option value="Eritrea">Eritrea</option>
<option value="Estonia">Estonia</option>
<option value="Ethiopia">Ethiopia</option>
<option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
<option value="Faroe Islands">Faroe Islands</option>
<option value="Fiji">Fiji</option>
<option value="Finland">Finland</option>
<option value="France">France</option>
<option value="French Guiana">French Guiana</option>
<option value="French Polynesia">French Polynesia</option>
<option value="French Southern Territories">French Southern Territories</option>
<option value="Gabon">Gabon</option>
<option value="Gambia">Gambia</option>
<option value="Georgia">Georgia</option>
<option value="Germany">Germany</option>
<option value="Ghana">Ghana</option>
<option value="Gibraltar">Gibraltar</option>
<option value="Greece">Greece</option>
<option value="Greenland">Greenland</option>
<option value="Grenada">Grenada</option>
<option value="Guadeloupe">Guadeloupe</option>
<option value="Guam">Guam</option>
<option value="Guatemala">Guatemala</option>
<option value="Guernsey">Guernsey</option>
<option value="Guinea">Guinea</option>
<option value="Guinea-bissau">Guinea-bissau</option>
<option value="Guyana">Guyana</option>
<option value="Haiti">Haiti</option>
<option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
<option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
<option value="Honduras">Honduras</option>
<option value="Hong Kong">Hong Kong</option>
<option value="Hungary">Hungary</option>
<option value="Iceland">Iceland</option>
<option value="India">India</option>
<option value="Indonesia">Indonesia</option>
<option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
<option value="Iraq">Iraq</option>
<option value="Ireland">Ireland</option>
<option value="Isle of Man">Isle of Man</option>
<option value="Israel">Israel</option>
<option value="Italy">Italy</option>
<option value="Jamaica">Jamaica</option>
<option value="Japan">Japan</option>
<option value="Jersey">Jersey</option>
<option value="Jordan">Jordan</option>
<option value="Kazakhstan">Kazakhstan</option>
<option value="Kenya">Kenya</option>
<option value="Kiribati">Kiribati</option>
<option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
<option value="Korea, Republic of">Korea, Republic of</option>
<option value="Kuwait">Kuwait</option>
<option value="Kyrgyzstan">Kyrgyzstan</option>
<option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
<option value="Latvia">Latvia</option>
<option value="Lebanon">Lebanon</option>
<option value="Lesotho">Lesotho</option>
<option value="Liberia">Liberia</option>
<option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
<option value="Liechtenstein">Liechtenstein</option>
<option value="Lithuania">Lithuania</option>
<option value="Luxembourg">Luxembourg</option>
<option value="Macao">Macao</option>
<option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
<option value="Madagascar">Madagascar</option>
<option value="Malawi">Malawi</option>
<option value="Malaysia">Malaysia</option>
<option value="Maldives">Maldives</option>
<option value="Mali">Mali</option>
<option value="Malta">Malta</option>
<option value="Marshall Islands">Marshall Islands</option>
<option value="Martinique">Martinique</option>
<option value="Mauritania">Mauritania</option>
<option value="Mauritius">Mauritius</option>
<option value="Mayotte">Mayotte</option>
<option value="Mexico">Mexico</option>
<option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
<option value="Moldova, Republic of">Moldova, Republic of</option>
<option value="Monaco">Monaco</option>
<option value="Mongolia">Mongolia</option>
<option value="Montenegro">Montenegro</option>
<option value="Montserrat">Montserrat</option>
<option value="Morocco">Morocco</option>
<option value="Mozambique">Mozambique</option>
<option value="Myanmar">Myanmar</option>
<option value="Namibia">Namibia</option>
<option value="Nauru">Nauru</option>
<option value="Nepal">Nepal</option>
<option value="Netherlands">Netherlands</option>
<option value="Netherlands Antilles">Netherlands Antilles</option>
<option value="New Caledonia">New Caledonia</option>
<option value="New Zealand">New Zealand</option>
<option value="Nicaragua">Nicaragua</option>
<option value="Niger">Niger</option>
<option value="Nigeria">Nigeria</option>
<option value="Niue">Niue</option>
<option value="Norfolk Island">Norfolk Island</option>
<option value="Northern Mariana Islands">Northern Mariana Islands</option>
<option value="Norway">Norway</option>
<option value="Oman">Oman</option>
<option value="Pakistan">Pakistan</option>
<option value="Palau">Palau</option>
<option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
<option value="Panama">Panama</option>
<option value="Papua New Guinea">Papua New Guinea</option>
<option value="Paraguay">Paraguay</option>
<option value="Peru">Peru</option>
<option value="Philippines">Philippines</option>
<option value="Pitcairn">Pitcairn</option>
<option value="Poland">Poland</option>
<option value="Portugal">Portugal</option>
<option value="Puerto Rico">Puerto Rico</option>
<option value="Qatar">Qatar</option>
<option value="Reunion">Reunion</option>
<option value="Romania">Romania</option>
<option value="Russian Federation">Russian Federation</option>
<option value="Rwanda">Rwanda</option>
<option value="Saint Helena">Saint Helena</option>
<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
<option value="Saint Lucia">Saint Lucia</option>
<option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
<option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
<option value="Samoa">Samoa</option>
<option value="San Marino">San Marino</option>
<option value="Sao Tome and Principe">Sao Tome and Principe</option>
<option value="Saudi Arabia">Saudi Arabia</option>
<option value="Senegal">Senegal</option>
<option value="Serbia">Serbia</option>
<option value="Seychelles">Seychelles</option>
<option value="Sierra Leone">Sierra Leone</option>
<option value="Singapore">Singapore</option>
<option value="Slovakia">Slovakia</option>
<option value="Slovenia">Slovenia</option>
<option value="Solomon Islands">Solomon Islands</option>
<option value="Somalia">Somalia</option>
<option value="South Africa">South Africa</option>
<option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
<option value="Spain">Spain</option>
<option value="Sri Lanka">Sri Lanka</option>
<option value="Sudan">Sudan</option>
<option value="Suriname">Suriname</option>
<option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
<option value="Swaziland">Swaziland</option>
<option value="Sweden">Sweden</option>
<option value="Switzerland">Switzerland</option>
<option value="Syrian Arab Republic">Syrian Arab Republic</option>
<option value="Taiwan, Province of China">Taiwan, Province of China</option>
<option value="Tajikistan">Tajikistan</option>
<option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
<option value="Thailand">Thailand</option>
<option value="Timor-leste">Timor-leste</option>
<option value="Togo">Togo</option>
<option value="Tokelau">Tokelau</option>
<option value="Tonga">Tonga</option>
<option value="Trinidad and Tobago">Trinidad and Tobago</option>
<option value="Tunisia">Tunisia</option>
<option value="Turkey">Turkey</option>
<option value="Turkmenistan">Turkmenistan</option>
<option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
<option value="Tuvalu">Tuvalu</option>
<option value="Uganda">Uganda</option>
<option value="Ukraine">Ukraine</option>
<option value="United Arab Emirates">United Arab Emirates</option>
<option value="United Kingdom">United Kingdom</option>
<option value="United States">United States</option>
<option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
<option value="Uruguay">Uruguay</option>
<option value="Uzbekistan">Uzbekistan</option>
<option value="Vanuatu">Vanuatu</option>
<option value="Venezuela">Venezuela</option>
<option value="Viet Nam">Viet Nam</option>
<option value="Virgin Islands, British">Virgin Islands, British</option>
<option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
<option value="Wallis and Futuna">Wallis and Futuna</option>
<option value="Western Sahara">Western Sahara</option>
<option value="Yemen">Yemen</option>
<option value="Zambia">Zambia</option>
<option value="Zimbabwe">Zimbabwe</option>
</select>        
    </label>
</br>
     <span id="logmem">Login Details</span>&nbsp;&nbsp;
                

     <label>
            
              <span>Create a Password <small id="star">*</small>&nbsp;&nbsp;:</span>
   
  
        <input id="mypassword" type="password" name="mypassword"  required onBlur="checkPass()">
    </label></br>
    <label>
            
              <span>Repeat Password <small id="star">*</small>&nbsp;&nbsp;:</span>
   
  
        <input id="rpassword" type="password" name="rpassword"  required onBlur="checkPass()"><img name="checkpass" id="checkpass" width="25" height="25">
      <div id="nameValidation2" class="validation-image"></div>
    </label></br>
      <label>

       <span>Email Address :<small id="star">*</small>&nbsp;&nbsp;</span>
      
        <input id="thisemail" type="text" name="thisemail"  onBlur="checkEmail()" required>
    </label>
      <label>

       <span>Repeat Email Address :<small id="star">*</small>&nbsp;&nbsp;</span>
      
        <input id="remail" type="text" name="remail" required  onBlur="checkEmail()"><img name="checkemail" id="checkemail" width="25" height="25">
        <div id="nameValidation" class="validation-image"></div>
    </label>


     <label>
        <span>&nbsp;</span> 
        <input type="submit" class="button"  id = "register" name="register" value="Register"  /> 
        <input type="hidden" name="user" value="1" />
        
        
    </label> 
</form>
</div>
</div>

</div>
</body> 
 