<?php 

session_start();
if(isset($_GET['type'],$_GET['id'])){
$type=$_GET['type'];
$id=$_GET['id'];
$order_status=1;
             switch ($type) {
             	case 'RA':
             		require '../core/connection.php';
             		$thecon=$pdo->prepare("UPDATE orders SET order_status = ? WHERE id= ?");
             		$thecon->BindValue(1,$order_status);
             		$thecon->BindValue(2,$id);
             		$thedone=$thecon->execute();
             		
             		break;
             	case 'PA':
             		require '../core/connection.php';
             		$thecon=$pdo->prepare("UPDATE orders SET order_status = ? WHERE id= ?");
             		$thecon->BindValue(1,$order_status);
             		$thecon->BindValue(2,$id);
             		$thedone=$thecon->execute();
             		
             		break;
             	case 'TA':
             		require '../core/connection.php';
             		$thecon=$pdo->prepare("UPDATE orders SET order_status = ? WHERE id= ?");
             		$thecon->BindValue(1,$order_status);
             		$thecon->BindValue(2,$id);
             		$thedone=$thecon->execute();
             		
             		break;
             	case 'slots':
             		require '../core/connection.php';
             		$thecon=$pdo->prepare("UPDATE agencys SET status = ? WHERE id= ?");
             		$thecon->BindValue(1,$order_status);
             		$thecon->BindValue(2,$id);
             		$thedone=$thecon->execute();
             		
             		break;
             	
             	default:
             		# code...
             		break;
             }
}else{
	echo "C'mon man , What are you doing ? do i look that stupid ?";
}

header("Location:manage.php");

?>