 <?php 





  if(isset($_GET['type'])){
  	$type=$_GET['type'];
  	switch ($type) {
  		case 'provider':
  	    
  	    die("provider");


  	    break;
  		case 'client';
  		require'aboutus.php';
  		break;
  		default:
  			
  			break;
  	}
  }else{
  	die("fuck you.");
  }


 ?>