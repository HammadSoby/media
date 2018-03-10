<?php
session_start();
if($_SESSION['logtrue'] =true)
{
  	$board=$_GET['board'];
  	switch ($board) 
	{
  		case 'provider':
  			include 'board_providers.php';
  			break;
  		case 'client':
  		include 'board_client.php';
  		break;
  		default:
  		?>
      <script>window.location="404.php"; </script>
      <?php
  			break;
  	}
}
