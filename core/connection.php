<?php

try{
	$pdo = new PDO('mysql:host=10.169.0.33;dbname=mediauni_dbo','mediauni_dbo','2837THEsgdh');

} catch (PDOException $e){

	die('Something is wrong with your database');
}



 ?>