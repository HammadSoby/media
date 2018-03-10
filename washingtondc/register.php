<?php
session_start();

  	$reg=$_GET['register'];
  	switch ($reg)
	 {
  		case 'provider':
  			include 'regme_provider.php';
  			break;
  		case 'client':
  		include 'showmemberoptions.php';
  		break;
  		default:
  		?>
      <script>window.location="404.php"; </script>
      <?php
  			break;
  	}
