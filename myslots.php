<?php 
  

   session_start();



   require "core/connection.php";
   $user_loggedin=$_SESSION['user_logged'];
   $user_logged=$pdo->prepare("SELECT * FROM providers WHERE username= ? ");
   $user_logged->BindValue(1,$user_loggedin);
   $user_logged->execute();
   $user_loggedin_data=$user_logged->fetchAll();



if(isset($_SESSION['logtrue'])){
    ?><head>
  <title>Media Provider Panel </title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" name="viewport" content="width=device-width,initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="style/board.css" />
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body>
 <div id="controls_remember">
   
   <?php   
 

    include 'includes/leftmenu_providers.php'; ?>
      </div>
      <div id="menu">
         <nav>
                <span class="show_menu"></span>
            
            <ul class="ul">
                 <li><a href="http://www.mediaunited.co.uk/">Home</a></li>
                <li><a href="agencys.php?type=radio">Radio Provider</a></li>
                <li><a href="agencys.php?type=tv">Tv Provider</a></li>
                <li><a href="agencys.php?type=print">Print Provider</a></li>
                
                <li><a href="contactus?type=provider">Contact us</a></li>
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
      <span id="booknow" > Add Media Information </span>
      <div id="booking" class="booking">
        <div id="book_in">
             <span id="b_title">Please Choose type of Agency : </span></br></br>
             <small id="star">*</small>&nbsp;<a href="agency.php?type=radio">Radio Provider</a></br>
             <small id="star">*</small>&nbsp;<a href="agency.php?type=tv">TV Provider</a></br>
             <small id="star">*</small>&nbsp;<a href="agency.php?type=print">Print Provider</a></br>
           </div>
      </div>
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
        
         if ($_SERVER["REQUEST_METHOD"] == "POST"){
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
        
         $update_user=$pdo->prepare("UPDATE providers SET fullname= ? , email = ? ,adress= ?, phone = ? , password = ? WHERE username = ?");
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
           <label for="fullname">New Address </label></br>
          <input type="text" name="adress" /></br></br>
           <label for="fullname" >New Password </label></br>
          <input type="text" name="password" /></br></br>
          <input id="change_button" type="submit" name="change" value="Update" />
        </form>

      </div>
      <?php 
        
         
          $choice=$pdo->prepare("SELECT * FROM providers WHERE username = ?");
         $choice->BindValue(1,$user_loggedin);
         $choice->execute();
         $choices=$choice->fetchAll();
         foreach($choices as $thechoice);
         $user_loggedin_choice=$thechoice['org_name'];
       
         $myorders=$pdo->prepare("SELECT * FROM agencys WHERE username = ?");
         $myorders->BindValue(1,$user_loggedin);
         $myorders->execute();
         $orders=$myorders->fetchAll();
         $count_orders=$myorders->RowCount();

      ?>
      <div id="board_content">
        <h3 id="board_title">My Slots : </h3>
        <ul id="board_menu">
            <li>Slot Id</li>
            <li>Media type</li>
            <li>Slot Added Date</li>
            
            <li>Status</li>
        </ul>
        <?php foreach($orders as $order){?>
        <ul id="board_data">
             <li><?php echo $order['id'];?></li>
            <li><?php echo $order['media_type'];?></li>
            <li><?php echo $order['date'];?></li>
           
            
           
            <li>
            <?php 
            $leorder_status=$order['status'];
              if($leorder_status==0){
                echo "Under Review";
              }
              if($leorder_status==1){
                echo "Accepted";
              }
              if($leorder_status==3){
                 echo "Accepted";
              }
              
            ?>
            </li>
            <li><a href="slots_details.php?id=<?php echo $order['id']; ?>">View more Details</a></li>
        </ul>
      <?php } ?>

        
      </div>
  </div>

  </body>
    <?php }
    else{
      header("Location:login.php");
    }


    ?>