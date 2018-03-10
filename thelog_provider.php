   <? session_start(); ?>
<!DOCTYPE html><head>
      <title> Media Provider Login  </title>
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
			else
			{
				?>
				<script>
				window.location="regme_providerpay.php";
				</script>
				<?php
			}
			
		}
     }
     ?>
       <style>
       #error_no{
        color:red;
        font-family: "open sans";
        font-size: 15px;
		}
       </style>
	   
<form method="post" action="" class="form_01">
    <h1>This Login Page Is For Media Providers
       <span>Please enter your details below. &nbsp;&nbsp;&nbsp; <small id="ifa">if your not a media provider , Click <a href="login.php?login=client">Here</a> to login</small></span>
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
        <input id="password" type="password" name="txtPassword" />
    </label>
    
     <label>
        <span>&nbsp;</span> 
        <input type="submit" class="button" name="login" value="Login" /> 
        <input type="hidden" name="user" value="1" />
    </label> 
    <div id="dha">
        <span id="dtext">
            Don't have an account? <a href="register.php?register=provider">Sign Up </a> Here. &nbsp <a href="providerpassword.php" target="_blank" onClick="window.open('providerpassword.php','name','width=600,height=400')" >Password Reminder</a></span>
        </div>
</form>
</div>
</div>

</div>
</body> 
        

 
 