  <? error_reporting(E_ERROR);
  session_start(); ?>
<head>
  <title> Media Provider</title>
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="style/board.css" />
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body>
 <div id="controls_remember">
   

     <?php 
if(isset($_SESSION['logtrue'])){
     include 'includes/leftmenu_providers.php';
     } ?>
       
      </div>
      <?php 

      if(isset($_SESSION['logtrue'])){
        include 'includes/logmenu.php'; }else{
          include 'includes/prov_topmenu.php'; 
        }
     
      if(isset($_SESSION['logtrue'])){
        include 'includes/booknewad.php';
      }
        ?>
     
      <?php 
   
         if(isset($_SESSION['logtrue'])){
          ?>
          <div>
          <?php include'includes/leftmenu_providers.php';?>
        </div>
        <?php
          include 'includes/mediaprovider_log.php';
         }else{
          include 'includes/mediaprovider_nolog.php';
         }

      ?>
