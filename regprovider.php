<html>
<head>
      <title>Register Media Provider Account </title>
      <meta name="viewport" content="width=device-width,initial-scale=1.0">
      <link rel="stylesheet" type="text/css" href="style/login.css" />
	  
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
#if{
  font-weight: normal;
  color:#006699;
}
</style>	  
</head>

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
$email_input="email";
$number="number";
    require_once 'core/token.php';
             include_once('core/connection.php');
              if ($_SERVER["REQUEST_METHOD"] == "POST"){
                $username=sanitize($_POST['username']);
                $password=sanitize($_POST['password']);
                $rpassword=sanitize($_POST['rpassword']);
                if(isset($_POST['token'],$_POST['user'],$_POST['username'],$_POST['password'])){
                $email=sanitize($_POST['email']);
                $remail=sanitize($_POST['remail']);
                $username=sanitize($_POST['username']);
                $password=sanitize($_POST['password']);
                $fullname=sanitize($_POST['fullname']);
                $org_name=sanitize($_POST['organisation']);
                $phone=sanitize($_POST['phone']);
                $created=date("l jS \of F Y ");
                $postadress=sanitize($_POST['postadress']);
                $streetno=sanitize($_POST['streetno']);
                $country=sanitize($_POST['country']);
                $postcode=sanitize($_POST['postcode']);

                if($email_input!=$email_input){
                 $email_input==$email_input;}
                 if($number!=$number){
                 $number==$number;
                }

             $checkingemail=$pdo->prepare("SELECT email FROM providers WHERE email = ? ");
             $checkingemail->BindValue(1,$email);
             $checkingemail->execute();
             $check_mail=$checkingemail->RowCount();

             $check_username=$pdo->prepare("SELECT username FROM providers WHERE username = ?");
             $check_username->BindValue(1,$username);
             $check_username->execute();
             $checkit=$check_username->RowCount();
             if($password==$rpassword){
             if($email==$remail){
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
              if($check_mail==0){
                    if($checkit==0){
                       if(strlen($fullname)>5){
                            if(strlen($org_name)>3){
                             
                                     require 'core/connection.php';
                                     $reg_user=$pdo->prepare("INSERT INTO providers (email,username,password,fullname,org_name,phone,time,postadress,streetno,country,postcode) 
                                                                    VALUES (?,?,?,?,?,?,?,?,?,?,?)");
                                    $reg_user->BindValue(1,$email);
                                    $reg_user->BindValue(2,$username);
                                    $reg_user->BindValue(3,$password);
                                    $reg_user->BindValue(4,$fullname);
                                    $reg_user->BindValue(5,$org_name);
                                    $reg_user->BindValue(6,$phone);
                                    $reg_user->BindValue(7,$created);
                                    $reg_user->BindValue(8,$postadress);
                                    $reg_user->BindValue(9,$streetno);
                                    $reg_user->BindValue(10,$country);
                                    $reg_user->BindValue(11,$postcode);
                                    if($reg_user->execute()){
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
                if(mail($to,$subject,$message,$headers)){
                  ?>
                  <script>
                   window.location="http://mediaunited.co.uk/login.php?login=provider";
                  </script>
                  <?php
                }
                                    }
                              
                            }else{
                              $org_error="Organisation name is too Short";
                            }
                       }else{
                        $fullname_error="Full Name is Too Short";
                       }
                    }else{
                           $username_error="Username already exists";
              }
              
              }else{
                          $email_error="Email Already exists";
              }
          }else{
                         $email_error= "Email Is Not valid";
          }
        }else{
          $email_error="Emails no not match";
        }
        }else{
          $password_error="Passwords Do not match";
        }
            
          }else{
            $required_error="All Fields With a star Are Required";
          }
        }
         


          function sanitize($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>

<form method="post" action="" class="form_01">
 
    <h1>Register A Media Provider Account
        <span> Please enter your details below.</br></br><span id="if"> Not the owner or representative of a Media Provider , please register using our <a href="register.php?register=client">Media Purchaser page</a></span> </span></br>
        
         <?php if(isset($username_error)){
            ?>
            <center><small id="theerror"><?php echo $username_error; ?> </small></center>
            <?php
          }
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
         </label>
          
         
    <span id="logmem">Enter Your  Details</span> 
</br></br>
  
     <label>
               
              <span>Decision Maker <small id="star">*</small>&nbsp;&nbsp; :</span> 
      
 
            
        <input id="password" type="name" value="<?php if ($_SERVER["REQUEST_METHOD"] == "POST"){if(isset($fullname)){echo $fullname;}}?>"name="fullname" placeholder="John Jordan" maxlength="20" >
    </label>
    <label>
             
              <span> Organization <small id="star">*</small>&nbsp;&nbsp; :</span>

         
            
        <input id="password" type="name" name="organisation" value="<?php if ($_SERVER["REQUEST_METHOD"] == "POST"){if(isset($org_name)){echo $org_name;}}?>" placeholder="Media United" maxlength="20"/>
    </label>


    <label>
      
            <span>Phone Number <small id="star">*</small>&nbsp;&nbsp; :</span>
           
        <input id="password" type="<?php echo $number; ?>" value="<?php if ($_SERVER["REQUEST_METHOD"] == "POST"){if(isset($phone)){echo $phone;}}?>"name="phone" placeholder="+175456654465" maxlength="20" >
    </label>
     
     <label>
   
              <span>Post Adress <small id="star">*</small>&nbsp;&nbsp; :</span>
  


        <input id="email" type="text"  value="<?php if ($_SERVER["REQUEST_METHOD"] == "POST"){if(isset($username)){echo $username;}}?>" name="postadress" placeholder="Post Adress"  required>
    </label>
     <label>
   
              <span>Street Number <small id="star">*</small>&nbsp;&nbsp; :</span>
  


        <input id="email" type="text"  value="<?php if ($_SERVER["REQUEST_METHOD"] == "POST"){if(isset($username)){echo $username;}}?>" name="streetno" placeholder="Post Adress"  required>
    </label>
    <label>
   
              <span>Country <small id="star">*</small>&nbsp;&nbsp; :</span>
  


        <input id="email" type="text"  value="<?php if ($_SERVER["REQUEST_METHOD"] == "POST"){if(isset($username)){echo $username;}}?>" name="country" placeholder="Post Adress"  required>
    </label>
      <label>
   
              <span>Post Code <small id="star">*</small>&nbsp;&nbsp; :</span>
  


        <input id="email" type="text"  value="<?php if ($_SERVER["REQUEST_METHOD"] == "POST"){if(isset($username)){echo $username;}}?>" name="postcode" placeholder="Post Adress"  required>
    </label></br></br>
     <span id="logmem">Login Details</span>&nbsp;&nbsp;
                

     <label>
   
              <span>Username <small id="star">*</small>&nbsp;&nbsp; :</span>
  


        <input id="email" type="text"  value="<?php if ($_SERVER["REQUEST_METHOD"] == "POST"){if(isset($username)){echo $username;}}?>" name="username" placeholder="Daniel54"  required>
    </label>

     <label>
            
              <span>Password <small id="star">*</small>&nbsp;&nbsp;:</span>
   
  
        <input id="password" type="password" name="password" placeholder="*****************" maxlength="20" required>
    </label></br>
    <label>
            
              <span>Repeat Password <small id="star">*</small>&nbsp;&nbsp;:</span>
   
  
        <input id="password" type="password" name="rpassword" placeholder="*****************" maxlength="20" required>
    </label></br>
      <label>

       <span>Email Address :<small id="star">*</small>&nbsp;&nbsp;</span>
      
        <input id="password" type="text" name="email" value="<?php if ($_SERVER["REQUEST_METHOD"] == "POST"){if(isset($email)){echo $email;}}?>" placeholder="President@gmail.com" >
    </label>
      <label>

       <span>Repeat Email Address :<small id="star">*</small>&nbsp;&nbsp;</span>
      
        <input id="password" type="text" name="remail" value="<?php if ($_SERVER["REQUEST_METHOD"] == "POST"){if(isset($email)){echo $email;}}?>" placeholder="President@gmail.com" >
    </label>


     <label>
        <span>&nbsp;</span> 
        <input type="submit" class="button" name="register" value="Register" /> 
        <input type="hidden" name="user" value="1" />
        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />
        
        
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
 