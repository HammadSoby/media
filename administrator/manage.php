<meta http-equiv="Content-Type" content="text/html; charset=utf-8" name="viewport" content="width=device-width,initial-scale=1.0">
<style>@import url(http://fonts.googleapis.com/css?family=Open+Sans:400,700);</style>
<?php 
error_reporting(0);
if(isset($_GET['type'])){
	$type=$_GET['type'];
	if(!empty($type)){
	switch ($type) {
		case 'ra':
			require("includes/ra.php");
			break;
		case 'ra':
			require("includes/ra.php");
			break;
		case 'ta':
			require("includes/ta.php");
			break;
		case 'pa':
			require("includes/pa.php");
			break;
		case 'clients':
			require("includes/clients.php");
			break;
		case 'slots':
		        require("includes/slots.php");
		        break;
		        case 'providers':
		        require("includes/providers.php");
		        break;
		default:
			# code...
			break;
	}
}else{
	?>
	<script>window.location="manage.php?type=ra"; </script>
	<?php
}
}else{
	?>
	<script>window.location="manage.php?type=ra"; </script>
	<?php
}


?>