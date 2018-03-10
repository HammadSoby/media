<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>United Media File Upload</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

   
    </head>

<body>
  <div id="main">
  <?
  error_reporting(E_ERROR);
   session_start();
	/* load settings */
	require 'connectdb.php';

?>
  
  <div id="site_content">
  
  <div id="content">
<?php


if ($_FILES["file"]["error"] > 0) {
  echo "Error: " . $_FILES["file"]["error"] . "<br>";
} else {
  echo "Upload: " . $_FILES["file"]["name"] . "<br>";
  echo "Type: " . $_FILES["file"]["type"] . "<br>";
  echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
  echo "Stored in: " . $_FILES["file"]["tmp_name"];
}
?>

<?php
$allowedExts = array("gif", "jpeg", "jpg", "png","pdf");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);

if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "application/pdf")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < 950000)
&& in_array($extension, $allowedExts)) {
  if ($_FILES["file"]["error"] > 0) {
    echo "Error: " . $_FILES["file"]["error"] . "<br>";
  } else {
    echo "Upload: " . $_FILES["file"]["name"] . "<br>";
    echo "Type: " . $_FILES["file"]["type"] . "<br>";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    echo "Stored in: " . $_FILES["file"]["tmp_name"];
  }
} else {
  echo "Invalid file";
}
?>

<?php
$allowedExts = array("gif", "jpeg", "jpg", "png", "pdf");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);

if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "application/pdf")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < 950000)
&& in_array($extension, $allowedExts)) {
  if ($_FILES["file"]["error"] > 0) {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
  } else {
    echo "Upload: "   . $_FILES["file"]["name"] . "<br>";
    echo "Type: " . $_FILES["file"]["type"] . "<br>";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    echo "Temp file: " . $_SESSION['Provider_ID'] . $_FILES["file"]["tmp_name"] . "<br>";
    if (file_exists("images/"  . $_FILES["file"]["name"])) {
      echo $_FILES["file"]["name"] . " already exists. ";
    } else {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "images/" . $_SESSION['Provider_ID'] . $_FILES["file"]["name"]);
      echo "Stored in: " . "images/" .  $_FILES["file"]["name"];
	  $sSQL = "Update Providers Set MediaKitFile = 'images/" . $_SESSION['Provider_ID'] .  $_FILES["file"]["name"] . "' WHERE Providers_ID =" .$_SESSION['Provider_ID'];
	  mysql_query($sSQL); 

    }
  }
} else {
  echo "Invalid file";
}
?>
<br/>
</div><!--close site_content--> 
  </div><!--close main-->





</body>
</html>