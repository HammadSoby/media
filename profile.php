<?php
if(isset($_GET['id'])){
 ?>
 <title>Agencys</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" name="viewport" content="width=device-width,initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="style/board.css" /><?php 
session_start();
if(isset($_SESSION['logtrue'])){

                include 'includes/leftmenu_providers.php'; 
                
}


?>
 <div id="menu">
         <nav>
                <span class="show_menu"></span>
            
            <ul class="ul">
                 <li><a href="http://www.mediaunited.co.uk/">Home</a></li>
                <li><a href="agency.php?type=radio">Radio Provider</a></li>
                <li><a href="agency.php?type=tv">Tv Provider</a></li>
                <li><a href="agency.php?type=print">Print Provider</a></li>
                
                <li><a href="contactus?type=provider">Contact us</a></li>
            </ul>
            </nav>
      </div>
      
      <style>
      #data{
       margin-left: 25%;
       width: 70%;
       background: white;
       float: left;
       margin-top: 2%;
       padding-top: 1%;
       padding-bottom: 1%;
       border:2px solid #E6E6E6;
    
      }
      #damta{
        padding-top: 2%;
        width: 92%;
        margin-left: 1%;
        float: left;
        background: white;
        padding-left: 3%;
        padding-right: 0.5%;
        line-height: 25px;


      }
      #da_title{
        font-family: "open sans";
        color:black;
        font-weight: bold;
        font-size: 17px;
      }
      #body{
        color:#353535;
        font-family: "open sans";
        font-weight: normal;
        font-size:15px;
        line-height: 35px;
      }
      #damta h4{
        font-family: "open sans";
        color:#556272;
        font-weight: bold;
        font-size:24px;
      }
     #indata{
            color:red;
                  background: #F4F4F4;
        border:6px solid #E6E6E6;

            padding:10px;
            width: 90%;
            
            margin-left: 1%;
            text-align: center;

       }
        #indata_2{
            color:red;
            background: #F4F4F4;
            border:6px solid #E6E6E6;
            padding:10px;
            width: 90%;
            margin-left: 1%;
            text-align: left;
            margin-top: 1%;
            line-height:30px;

       }
       #datain_logo{
        width: 18%;
        height: 23%;
        
        border-radius: 10px;
        border:1px solid #ccc;
       }
       #datainside{
       
        text-align: center;
       
        line-height: 24px;
        width: 70%;
        margin-left: 15%;
        margin-top: 2%;
       }
       #agency_name{
        color:#F96E5B;
        font-family: "open sans";
        font-size:15px;
        font-weight: bold;
        text-decoration: none;
       }
       #agencytype{
        color:#888;
        font-family: "open sans";
        font-weight: normal;
        font-size: 12px;
       }
       #agencydescription{
        color:#006699;
        font-size: 14px;
        font-family: "open sans";

       }
       #em{
       color:#006699;
        font-size: 14px;
        font-family: "open sans";
       }
       #radio_f{
       color:#aa0000; 
       font-family:"open sans";
       font-weight:bold;
       }
      </style>
     
      <div id="data">        
     
      
       
      	            <div id="indata">
                    <img src="http://www.mediaunited.co.uk/images/soul.png" id="datain_logo"></img>
                     <?php
         require "core/connection.php"; 
         $id=$_GET['id'];
         $profileinfo=$pdo->prepare("SELECT * FROM providers WHERE id = ? ");
         $profileinfo->BindValue(1,$id);
         $profileinfo->execute();
         $profiledetails=$profileinfo->fetchAll();
         foreach($profiledetails as $profiledetail);
       ?>
                    <div id="datainside">
                      <a href="#" id="agency_name"><?php echo $profiledetail['org_name']; ?></a></br>
                      <span id="agencytype"><?php echo $profiledetail['agency_type']; ?></span></br></br>
                      
                      <a href="#"><img width="30" src="http://img3.wikia.nocookie.net/__cb20130219013954/walkingdead/images/4/44/Facebook_Logo.png" /></a> 
                       &nbsp;&nbsp;&nbsp;&nbsp;
                      <a href="#"><img width="30" src="http://ihao.deds.nl/templates/images/ihaoworldstudiesen/logo.png" /></a>
                    </div>
                   
                    </div>
                      <div id="indata_2">
                          <span id="Radio_f"> Descion Maker : </span><span id="em"><?php echo $profiledetail['fullname']; ?></span></br>
                          <span id="Radio_f"> Email : </span><span id="em"><?php echo $profiledetail['email']; ?></span></br>
                          <span id="Radio_f"> Phone Number : </span><span id="em"><?php echo $profiledetail['phone']; ?></span></br>
                          <span id="Radio_f"> Post Adress : </span><span id="em"><?php echo $profiledetail['postadress']; ?></span></br>
                          <span id="Radio_f"> Post Code  : </span><span id="em"><?php echo $profiledetail['postcode']; ?></span></br>
                          <span id="Radio_f"> Street No : </span><span id="em"><?php echo $profiledetail['streetno']; ?></span></br>
                          <span id="Radio_f"> Country : </span><span id="em"><?php echo $profiledetail['country']; ?></span></br>
                          
                    </div>
                  
      </div>
      
    
 <?php
 }

 ?>