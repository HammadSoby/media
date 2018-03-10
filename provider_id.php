<?php 

session_start();
if(isset($_SESSION['logtrue'])){


   require "core/connection.php";
   $user_loggedin=$_SESSION['user_logged'];
   $user_logged=$pdo->prepare("SELECT * FROM providers WHERE username=?");
   $user_logged->BindValue(1,$user_loggedin);
   $user_logged->execute();
   $user_loggedin_data=$user_logged->fetchAll();


?>
<head>
  <title>Provider Panel </title>
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="style/details.css" />
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body>
 <div id="controls_remember">
   
    <?php include 'includes/leftmenu_providers.php'; ?>
      </div>
      <div id="menu">
         <nav>
                <span class="show_menu"></span>
            
            <ul class="ul">
                 <li><a href="http://www.mediaunited.co.uk/">Home</a></li>
                <li><a href="agency.php?type=radio">Radio Advertising</a></li>
                <li><a href="agency.php?type=tv">Tv Advertising</a></li>
                <li><a href="agency.php?type=print">Print Advertising</a></li>
                
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
      <div id="dashboard">
         <div id="client_info">
         <?php foreach($user_loggedin_data as $user_in) {?>
        <ul>
            <li><span id="client_info_tit">Name : </span><?php echo $user_in['fullname']; ?></li>
            <li><span id="client_info_tit">Email : </span> <?php echo $user_in['email']; ?></li>
            <li><span id="client_info_tit">Address : </span>
            <?php
            
             $adress=$user_in['adress'];
            
             if($adress){
                echo ltrim($user_in['adress']); 
                }
             ?>
             </li>
            <li><span id="client_info_tit">Phone Number :</span> 
              <?php

               $nemra=$user_in['phone'];
               if($nemra==0){
                echo "No Phone";
               }

               if($nemra!=0){
                 echo $user_in['phone'];
               }


              ?>

            </li>
        </ul>
        <?php }?>

     <?php
              function sanitize($data) {
  $data = ltrim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
         $get_data=$pdo->prepare("SELECT * FROM providers WHERE username = ?");
         $get_data->BindValue(1,$user_loggedin);
         $get_data->execute();
         $data=$get_data->fetchAll();
         foreach($data as $user_data){
          //existed data
         $user_username=sanitize($user_data['username']);
         $user_fullname=sanitize($user_data['fullname']);
         $user_email=sanitize($user_data['email']);
         $user_phonenumber=sanitize($user_data['phone']);
         $user_adress=sanitize($user_data['adress']);
         $user_password=sanitize($user_data['password']);
        
         if(isset($_POST['change'])){
           //new data
         $newfullname=sanitize($_POST['fullname']);
         $new_email=sanitize($_POST['email']);
         $new_phone=sanitize($_POST['phone']);
         $new_adress=sanitize($_POST['adress']);
         $new_password=sanitize($_POST['password']);
         if(empty($newfullname)){
            $thenewfullname=$user_fullname;
         }else{
            $thenewfullname=$newfullname;
         }

         if(empty($new_email)){
            $thenew_email=$user_email;
         }else{
            $thenew_email=$new_email;
         }
          if(empty($new_adress)){
          $thenew_adress=$user_adress;
         }else{
          $thenew_adress=$new_adress;
         }
         if(empty($new_phone)){
          $thenew_phone=$user_phonenumber;
         }else{
          $thenew_phone=$new_phone;
         }
         
         

         if(empty($password)){
          $thenew_password=$user_password;
         }else{
          $thenew_password=$new_password;
         }
        
         $update_user=$pdo->prepare("UPDATE users SET fullname= ? , email = ? ,adress= ?, phone = ? , password = ? WHERE username = ?");
         $update_user->BindValue(1,$thenewfullname);
         $update_user->BindValue(2,$thenew_email);
         $update_user->BindValue(3,$thenew_adress);
         $update_user->BindValue(4,$thenew_phone);
         $update_user->BindValue(5,$thenew_password);
         $update_user->BindValue(6,$user_loggedin);
         $update_user->execute();
         }


       }
       

        

       ?>

        <small id="update_but">Update Information</small>
      </div>
      <div id="update_div">
      
        <span id="ud_title">Update Your Details : </span></br></br>
        <hr/></br>
          <form method="post">
        <label for="fullname">New Full Name </label></br>
          <input type="text" name="fullname" /></br></br>
             <label for="newemail">New Email </label></br>
          <input type="text" name="email" /></br></br>
             <label for="fullname">New Phone Number </label></br>
          <input type="text" name="phone" /></br></br>
           <label for="fullname">New Adress </label></br>
          <input type="text" name="adress" /></br></br>
           <label for="fullname" >New Password </label></br>
          <input type="text" name="password" /></br></br>
          <input id="change_button" type="submit" name="change" value="Update" />
        </form>

      </div>
      </div>
  </div>
  <?php
             if(isset($_GET['id'])){
               $id= $_GET['id'];
              if(!empty($id)){
               $get_order=$pdo->prepare("SELECT * FROM agencys WHERE id= ?");
               $get_order->BindValue(1,$id);
               $get_order->execute();
               $details=$get_order->fetchAll();
               $count_details=$get_order->RowCount();
               if($count_details>0){
                 ?>
                 <style>
                 #deta{
                  font-family: "open sans";
                  color:#aa0000;
                  font-size:12px;
                 }
                 </style>
                 <div id="details">
                 <div id="order_details"></br>
            <span id="de">Media Slot Details: </span>&nbsp;&nbsp;
               <style>
            #print{
              color:white;
              font-family: "open sans";
              margin-left: 60%;
             
              font-weight: bold;
              font-size: 13px;
              padding-left: 3%;
              padding-right: 3%;
              padding-top: 0.5%;
              padding-bottom: 1.6%;
              border-radius: 10px;              
              background-image:url("https://cdn0.iconfinder.com/data/icons/ballicons/128/printer-32.png");
              background-repeat:no-repeat;
              padding-left:5%;
              color:#353535;
            }
            #print:hover{
              opacity: 0.8;
              transition:1s;
            }
            </style>
            <a id="print" onclick="window.print();" target="_blank" style="cursor:pointer" >Print</a>
            <?php foreach($details as $detail) {?>
        <ul>
            <li><span id="client_info_tit">Transaction Id : </span><?php echo $detail['id']; ?></li>
            <li><span id="client_info_tit">Ad Status : </span>
              <?php 
            $leorder_status=$detail['order_status'];
              if($leorder_status==0){
                echo "Incomplete","<small id='deta'>&nbsp; &nbsp; &nbsp;Under Review.</small>";
            
              }
              if($leorder_status==3){
                 echo "Accepted","<small id='deta'>&nbsp; &nbsp; &nbsp;  Your Ad Slot Has Been Validated. </small>";
              }
            ?></li>
            
            <li><span id="client_info_tit">Media Email :</span> <?php echo $detail['media_email'];?> </li>
            <li><span id="client_info_tit">Entity Type  : </span> <?php echo $detail['entity_type']; ?></li>
      
            <li><span id="client_info_tit">Media Type :</span> <?php echo $detail['media_type'];?> </li>
            <li><span id="client_info_tit">Media Postal Adress :</span> <?php echo $detail['media_postal_adress'];?></li>
            <?php 
            if($detail['type']!="Tv Advertising"){
              ?>
              <li><span id="client_info_tit">Telephone Number :</span> <?php echo $detail['telephone_number'];?></li>
              <?php
            }
            ?>
            
            <li><span id="client_info_tit">Size & Prices :</span> <?php echo $detail['price'];?></li>
        </ul>
        <?php }?>
        </div></div>
                 <?php
                 
               }
           }
       }
               

   

}else{
  include 'includes/404.php';
}



?>