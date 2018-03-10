<?php 

if(isset($_GET['type'])){
$type=$_GET['type']; 

               switch ($type) {
           case 'print':
            include 'agencys_print.php'; 
             break;
           case 'tv':
            include 'agencys_tv.php'; 
            break; 
           
           case 'radio':
            include 'agencys_radio.php'; 
           brea;
           default:
             # code...
             break;
         }
}




?>