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
session_start();
$request=$_REQUEST['st'];
if($request=='Completed'){
	$request=$_REQUEST['st'];
	$customId=$_REQUEST['cm'];
	$order_complete=1;
	$updatequery=$pdo->prepare("UPDATE orders SET order_status = ? WHERE id= ?");
	$updatequery->BindValue(1,$order_complete);
	$updatequery->BindValue(2,$customId);
	$updated=$updatequery->execute();
	if($updated){
		$resultquery=$pdo->prepare("SELECT * FROM orders WHERE id = ?");
		$resultquery->BindValue(1,$customId);
		$resultquery->execute();
		$results=$resultquery->fetchAll();
		$result_count=$resultquery->rowCount();
         if(isset($_SESSION['order'])){
		if($result_count>0){

              foreach ($results as $result) {
              	?>
              	  <link rel="stylesheet" type="text/css" href="style/board.css" />
              	   <div id="menu">
         <nav>
                <span class="show_menu"></span>
            
            <ul class="ul">
                 <li><a href="http://www.demosunited.com/">Home</a></li>
                <li><a href="book.php?type=radio">Radio Advertising</a></li>
                <li><a href="book.php?type=tv">Tv Advertising</a></li>
                <li><a href="book.php?type=print">Print Advertising</a></li>
                <li><a href="">Media Packages</a></li>
                <li><a href="contactus">Contact us</a></li>
            </ul>
            </nav>
      </div>
       <style>
      #dat{
             visibility: hidden;
      	      }
      </style>
       <style>
      #data{
       margin-left: 25%;
       width: 70%;
       background: white;
       float: left;
       margin-top: 2%;
       padding-top: 1%;
       padding-bottom: 1%;
       border:2px solid #E6E6E6;
       text-align: center;
      }
      #damta{
        padding-top: 2%;
        width: 92%;
        margin-left: 1%;
        float: left;
        background: white;
        padding-left: 3%;
        padding-right: 0.5%;
        line-height: 25px;
        background: #F4F4F4;
        border:6px solid #E6E6E6;

      }
      #da_title{
        font-family: "open sans";
        color:black;
        font-weight: bold;
        font-size: 17px;
      }
      #body{
        color:#353535;
        font-family: "open sans";
        font-weight: normal;
        font-size:15px;
        line-height: 35px;
        color:#006699;
      }
      #damta h4{
        font-family: "open sans";
        color:#556272;
        font-weight: bold;
        font-size:24px;
      }
      #suc{
      	color:green;
      	font-family: "open sans";
        font-size: 17px;
      }
      #body a{
      	font-weight:bold;
      	color:blue;
      	font-weight: 400;

      }
      a{
      	font-weight:bold;
      	color:blue;
      	font-weight: 400;
      }
      #done{
      	font-size:14px;
      	color:#353535;
      }
      </style>
      <div id="data">
      	<div id="damta">
      		<span id="suc">Your Order has been successfully processed. <span></br></br>
      		
  
          <span id="body">
            Congratulations , you have been successful in promoting your business! The combination of <a href="book?type=radio">Radio</a>, <a href="book?type=tv">Television</a> , <a href="book?type=print">Print</a> and Publications provides maximum exposure at great value for money.
        </span></br></br>
        <span id="done">Click <a href="board"> Here </a> to to access your Client Area..</span>
        </br></br>
      	</div>

      </div>
     
              	  <?php
               include 'includes/leftmenu.php';
               ?>
               	<small id="dat"><?php echo "<b> Order id:" .$result["id"]."</br> Username : ".$result["username"]."</br> Duration of your slot : ".$result["size"]."</br> Order status :".(($result["order_status"]==1)?'Completed':'Incomplete')."</br></br>"; ?></small>
               <?php
              }
		}else{
			echo "no results";
		}
	}else{
		echo "This is action cannot be done";
	}
	}
}
sleep(6);
?>

<?php
?>
</body>
</html> 