 <?
 error_reporting(E_ERROR);
  session_start(); ?>
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


  include'includes/leftmenu.php';

  ?>
    </div>
      </div>
      <?php
           
          
		    include 'includes/logmenu.php';
			
			
           
           //   include 'includes/nologmenu.php';
           


              
                include 'includes/booknewad.php';
              
       ?>
      <div id="book">
       <?php 
     if(isset($_GET['type']))
	 {
            $type=$_GET['type'];
            $_SESSION['type']=$type;
            if(!empty($type)){

                  switch ($type) {
                    case 'radio':
					$_SESSION['mediatype']=	2;
                      require'sales.php';
                      
                      break;
                       case 'print':
					   $_SESSION['mediatype']=	1;
                      require'sales.php';
                      
                      break;
					  
                       case 'board':
					   $_SESSION['mediatype']=	4;
                      require'sales.php';
                      
                      break;
					  
                       case 'tv':
					   $_SESSION['mediatype']=	3;
                      require'sales.php';
                      
                      break;
                    
                    default:
                      ?>
                       <script>
                   window.location="http://www.demosunited.com/board";
                  </script>
                      <?php
                      break;
                  }

            }   
		}
		else
		{
		?>
        
  <div id="book_in"> 
    <div align="center"><span id="b_title">Please Choose in which field you would 
      like to advertise : </span></br></br> <a href="shop.php?type=radio">Radio 
      Advertising </a> <br/>
      <a href="shop.php?type=tv">Tv Advertising</a> <br/>
      <a href="shop.php?type=print">Print Advertising</a></br> 
      <a href="shop.php?type=board">Board Advertising</a></br> 
	  </div>
  </div>
		   <p>Please note that all slot price displayed will be the full recommended retail price until you register or sign in. </p>
		<?
		
		}	  
       ?>
      </div>