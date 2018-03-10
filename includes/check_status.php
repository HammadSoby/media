<?php 



$username=$_SESSION['user_logged'];
$check_premuim=$pdo->prepare("SELECT * FROM premuim WHERE username = ?");
$check_premuim->BindValue(1,$username);
$check_premuim->execute();
$checking_now=$check_premuim->fetchAll();
foreach ($checking_now as $memberships);
$membership=$memberships['status'];


?>