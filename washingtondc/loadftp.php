<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>The united Media FTP Upload</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>

<?
//$imgid =  $_REQUEST['imgid'];
$imgid = $_REQUEST['id'];

?>
    <p align="center"><font face="Arial, Helvetica, sans-serif"><strong>Select the 
      PDF to upload</strong></font></p>		  
  <form action="uploadpdffile.php" method="post"
enctype="multipart/form-data">
<label for="file">Filename:</label>
<input type="file" name="file" id="file"><br>
<input type="submit" name="submit" value="Submit">
</form>

</body>
</html>
