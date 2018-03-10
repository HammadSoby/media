<!DOCTYPE html>
<html lang="en-US" class="no-js" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width" />
<title>Payments with PayPal Standrad method | Sanjay Sidana</title>
</head>
<body>
<?php include "config.php";
//pr($_REQUEST);die();
$request=$_REQUEST['st'];
if($request=='Completed'){
	$request=$_REQUEST['st'];
	$customId=$_REQUEST['cm'];
	$order_complete=3;
	$updatequery=$pdo->prepare("UPDATE premuim SET status = ? WHERE id= ?");
	$updatequery->BindValue(1,$order_complete);
	$updatequery->BindValue(2,$customId);
	$updated=$updatequery->execute();
	if($updated){
		$resultquery=$pdo->prepare("SELECT * FROM premuim WHERE id = ?");
		$resultquery->BindValue(1,$customId);
		$resultquery->execute();
		$results=$resultquery->fetchAll();
		$result_count=$resultquery->rowCount();

		if($result_count>0){
              foreach ($results as $result) {
              	echo "<b> Order id:" .$result["id"]."</br> Username : ".$result["username"]."</br> Duration of your slot : ".$result["duration"]."</br> Order status :".(($result["order_status"]==1)?'Completed':'Incomplete')."</br></br>";
              }
		}else{
			echo "no results";
		}
	}
}
sleep(6);
?>
<script>window.location="board"; </script>
<?php
?>
</body>
</html> 