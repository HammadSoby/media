<html>
<head>
      <title>Mediaunited | Login </title>
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
       session_start();
	/* load settings */
	require 'connectdb.php';
	   
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
	
		$txtEmail =  $_POST['txtEmail'];
		$txtPass =  $_POST['txtPassword'];
		
		$sSQL = "SELECT Client_ID, Membership_ID, BlackLinkID FROM Clients WHERE ClientEmail ='" . $txtEmail . "' and ClientPassword ='" . $txtPass . "'" ;
		//print($sSQL);
		$tmpAccs = mysql_query($sSQL);
		$_SESSION['Provider_ID'] = 0;
		while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
			$Client_ID = $thisAccs["Client_ID"];
			$Membership_ID = $thisAccs["Membership_ID"];
			$BlackLinkID = $thisAccs["BlackLinkID"];
			
			$_SESSION['ClientPercent'] = GetMembershipPercent($Membership_ID);
			$_SESSION['Client_ID'] = $Client_ID;
			$_SESSION['logtrue']=true;
			?>
			<script>
			window.location="board.php?board=client";
			</script>
			<?php
			
		}
    
		?>
		<?php
		
    }
	function GetMembershipPercent($memID)		
	{
			$sSQL = "SELECT Discount FROM Memberships Where Membership_ID = " . $memID ;
			//print($sSQL);
			$tmpAccs = mysql_query($sSQL);
			
			while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
			{
				$Discount = $thisAccs["Discount"];
			}	
			return $Discount;
	}  

       ?>
       <style>
       #error_no{
        color:red;
        font-family: "open sans";
        font-size: 15px;

       }
       #ifa{
       color:#aa0000; }
       </style>
<form method="post" action="" class="form_01">
    <h1>Login In To Your Media United Account
        <span>Please enter your details below. &nbsp;&nbsp;&nbsp; <small id="ifa">if you have a media provider account , Click <a href="login.php?login=provider">Here</a> to login</small></span>
    </h1>
         </label>
          <span id="logmem">Login Details</span></br>
     <label>
      <?php if(isset($error_no)){
        ?>
       <center> <small id="error_no"><?php echo $error_no; ?> </small></center></br>
        <?php
      }?>
         <span>Email :</span>
        <input id="email" type="text"  name="txtEmail"  />
    </label>

     <label>
        <span>Password :</span>
        <input id="password" type="password" name="txtPassword"  />
    </label>
    
     <label>
        <span>&nbsp;</span> 
        <input type="submit" class="button" name="login" value="Login" /> 
        <input type="hidden" name="user" value="1" />
    </label> 
    <div id="dha">
        <span id="dtext">
            Don't have an account? <a href="register.php?register=client">Sign Up </a> </span>
        </div>
</form>
</div>
</div>

</div>
</body> 
        
