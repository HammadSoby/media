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
                <li><a href="agencys.php?type=radio">Radio Provider</a></li>
                <li><a href="agencys.php?type=tv">Tv Provider</a></li>
                <li><a href="agencys.php?type=print">Print Provider</a></li>
                
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
       margin-top: 0%;
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
            height: 20%;
            margin-left: 1%;

       }
       #datain_logo{
        width: 18%;
        height: 100%;
        float: left;
        border-radius: 10px;
        border:1px solid #ccc;
       }
       #datainside{
        float: left;
        margin-left: 2%;
        width: 70%;
        line-height: 24px;
       }
       #agency_name{
        color:#F96E5B;
        font-family: "open sans";
        font-size:15px;
        font-weight: bold;
        text-decoration: none;
       }
       #agency_name:hover{
       text-decoration:underline; cursor:pointer }
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
       #alf{
       color:#353535;
       font-family:"open sans";
       font-weight:bold;
       margin-left: 25%;
       font-size:30px;
       width: 70%;
       float: left;
       margin-top: 2%;
       padding-top: 1%;
       
       }
      
      </style>
      <h3 id="alf">Tv Agencys : </h3>
     <?php              $type_now="Tv Agency";
                        include 'core/connection.php'; 
                        $getagencys=$pdo->prepare("SELECT * FROM providers WHERE agency_type = ? ");
                        $getagencys->BindValue(1,$type_now);
                        $getagencys->execute();
                        $agencys=$getagencys->fetchAll();
                        foreach($agencys as $agency){

						?>
      <div id="data">
       
      	            <div id="indata">
      	            <img src="http://www.mediaunited.co.uk/images/soul.png" id="datain_logo"></img>
                    <div id="datainside">
                      <a href="profile.php?id=<?php echo $agency['id']; ?>" id="agency_name"><?php echo $agency['org_name']; ?></a></br>
                      <span id="agencytype"><?php echo $agency['agency_type']; ?></span></br>
                      <span id="agencydescription">Soul  is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</span>
                    </div>
                    </div>
      	

      </div>
      <?php } ?>
    