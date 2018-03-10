<?php
session_start();
  if(!empty($_GET['login'])){
  if(isset($_GET['login'])){
  	$log=$_GET['login'];
  	switch ($log) {
  		case 'provider':
  			include 'thelog_provider.php';
  			break;
  		case 'client':
  		include 'thelog.php';
  		break;
  		default:
  		?>
      <script>window.location="404.php"; </script>
      <?php
  			break;
  	}
  }else{
      ?>
      <script>window.location="404.php"; </script>
      <?php
  }
}else{
    ?>
      <script>window.location="404.php"; </script>
      <?php
}
