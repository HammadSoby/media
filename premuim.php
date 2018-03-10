<head>
  <title>Dashboard | Demo </title>
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="style/board.css" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body>
 <div id="controls_remember">
   

     <?php 
if(isset($_SESSION['logtrue'])){
     include 'includes/leftmenu.php';
     } ?>
       
      </div>
      <?php 

      if(isset($_SESSION['logtrue'])){
        include 'includes/logmenu.php'; }else{
          include 'includes/nologmenu.php'; 
        }
     
      if(isset($_SESSION['logtrue'])){
        ?>
        <div id="">
        <?php include 'includes/booknewad.php';?>
      </div>
        <?php
      }
        ?>
     
      <?php 
      session_start();
         if(isset($_SESSION['logtrue'])){
          ?>
          <div>
          <?php include'includes/leftmenu.php';?>
        </div>
        <?php
             if(isset($_GET['purchase'])){
              $purchase=$_GET['purchase'];
              switch ($purchase) {
                case 'standard':
                  include'includes/get_core.php';
                  break;

                case 'standardplus':
                  include'includes/get_core_plus.php';
                 break;
                
                default:
                  header("location:premuim.php");
                  break;
              }
             } if(!isset($_GET['purchase'])){
              include 'includes/premuim_pages.php';
             }
         }

      ?>
