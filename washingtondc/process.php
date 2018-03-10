

<?php 
session_start();
if(isset($_SESSION['logtrue'])){
if(isset($_GET['type'])){
	$type=$_GET['type'];
	if(!empty($type)){
	switch ($type) {
		case '1':
			require 'paying_radio.php';
			break;
		case '2':
		    require 'paying_tv.php';
		    break;
		default:
		case '3':
            require 'paying_print.php';
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
}

}else{
?>
	 <script>
                   window.location="http://www.demosunited.com/board";
                  </script>
                  <?php
}




?>