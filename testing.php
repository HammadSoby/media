<?php
$products_prices= array("Champoing"=>"34$", "BMW"=>"37.000$", "Massage Session"=>"200$");
asort($products_prices);
foreach($products_prices as $producut=> $price) {
     echo $price,'</br>';
}
?>
