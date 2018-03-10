<head>
  <title>Contact Us </title>
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="style/board.css" />
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
             if(isset($_GET['type'])){
        $type=$_GET['type'];
        switch ($type) {
	case 'client':
	include 'includes/nologmenu.php';
		break;
	
	case 'provider':
	include 'includes/prov_topmenu.php';
		break;
        default: 
        ?>
        <script>window.location="/"; </script>
        <?php
        break;
}
        }else{
         ?>
        <script>window.location="/"; </script>
        <?php
        
        }
        }
     
      if(isset($_SESSION['logtrue'])){
        ?>
        <div id="">
        <?php include 'includes/booknewad.php';?>
      </div>
        <?php
      }
        error_reporting(E_ERROR);
      session_start();
         if(isset($_SESSION['logtrue'])){
          ?>
          <div>
          <?php include'includes/leftmenu.php';?>
        </div>
        <?php
          include 'includes/contactus_log.php';
         }else{
          include 'includes/contactus_nolog.php';
         }

      ?>