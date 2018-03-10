<?php

try{
	$pdo = new PDO('mysql:host=localhost;dbname=mediadb','dbo_mediadb','12TGas44jdfSD');

} catch (PDOException $e){

	die('Something is wrong with your database');
}
  

define('siteurl','http://www.demosunited.com/');
define('paypal_email','Benlaksirevlog@gmail.com');



function pr($data){
echo "<pre>";
print_r($data);
echo "</pre>";
}
?>