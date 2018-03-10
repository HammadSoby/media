
<head>
  
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="style/book.css" />
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
          <script type="text/javascript" src="http://www.demosunited/js/jquery.min.js"></script>
          <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
          <script type="text/javascript" src="http://www.demosunited/js/script.js"></script>
</head>
<body>
 <div id="controls_remember">
 <?php
 session_start();
if(isset($_SESSION['logtrue'])){
  include'includes/leftmenu_providers.php';
}
  ?>
    </div>
      </div>
      <?php
            if(isset($_SESSION['logtrue'])){
              include 'includes/logmenu_providers.php';
            }else{
              include 'includes/nologmenu.php';
            }


               if(isset($_SESSION['logtrue'])){
                include 'includes/newad_providers.php';
               }
       ?>
      <div id="book">
       <?php 
      if(isset($_SESSION['logtrue'])){


           if(isset($_GET['type'])){
            $type=$_GET['type'];
            $_SESSION['type']=$type;
            if(!empty($type)){

                  switch ($type) {
                    case 'radio':
                      require'includes/agency_radio.php';
                      
                      break;
                       case 'print':
                      require'includes/agency_print.php';
                      
                      break;
                       case 'tv':
                      require'includes/agency_tv.php';
                      
                      break;
                    
                    default:
                      ?>
                       <script>
                   window.location="http://www.demosunited.com/board";
                  </script>
                      <?php
                      break;
                  }

            }else{
              ?>
               <script>
                   window.location="http://www.demosunited.com/board";
                  </script>
              <?php
            }
           }else{
            ?>
             <script>
                   window.location="http://www.demosunited.com/board";
                  </script>
            <?php
           }}else{
                  if(isset($_GET['type'])){
            $type=$_GET['type'];
            $_SESSION['type']=$type;
            if(!empty($type)){

                  switch ($type) {
                    case 'radio':
                      require'includes/info_radio.php';
                      
                      break;
                       case 'print':
                      require'includes/info_print.php';
                      
                      break;
                       case 'tv':
                      require'includes/info_tv.php';
                      
                      break;
                    
                    default:
                      ?>
                       <script>
                   window.location="http://www.demosunited.com/";
                  </script>
                      <?php
                      break;
                  }

            }else{
             ?>
              <script>
                   window.location="http://www.demosunited.com/";
                  </script>
             <?php
           }
         }else{
          ?>
           <script>
                   window.location="http://www.demosunited.com";
                  </script>
          <?php
         }
       }
     
       ?>
      </div>