	
	<!DOCTYPE html>
	<html>
	<head>
	<title>Black Links UK - Admin</title>
	</head>
	<body>
	
	<table align="center" bgcolor="#FFFFFF">
	<tr>
	<td><img src="images/logo.png" width="147" height="147"></td>
	<td width="690"><div align="center"><strong><font size="+4">Black Links UK 
        Admin System</font></strong></div></td>
		
	</tr>
	</table>
	<br/>
		<?
	  /* load settings */
require 'connectdb.php';



$rt =  $_REQUEST['rt'];

if ($rt==1) 
{	
	$title =  $_POST['title'];
	$valid_file = true;
	$target_dir = "/home/black/public_html/attechments";
//if they DID upload a file...
	if($_FILES['photo']['name'])
	{
		//if no errors...
		if(!$_FILES['photo']['error'])
		{
			//now is the time to modify the future file name and validate the file
			$new_file_name = strtolower($_FILES['photo']['tmp_name']); //rename file
			if($_FILES['photo']['size'] > (20480000)) //can't be larger than 1 MB
			{
				$valid_file = false;
				$message = 'Oops!  Your file\'s size is to large.';
			}
		
			//if the file has passed the test
			if($valid_file)
			{
				//move it to where we want it to be
				
				$tmp_name = $_FILES["photo"]["tmp_name"];
				$name = $_FILES["photo"]["name"];
				
				
				move_uploaded_file($tmp_name, "$target_dir/$name");
								
				$message = 'Congratulations!  Your file was accepted.';

			 $path =  "attechments/" . $name;
			$sSQL = "INSERT INTO Attechments  (AttechmentTitle, AttechmentPath )" ;
			$sSQL = $sSQL . " VALUES ('" .$title . "' ,'" . $path . "' )";
			
			mysql_query($sSQL);
				
			}
		}
		//if there is an error...
		else
		{
			//set that to be the returned message
			$message = 'Ooops!  Your upload triggered the following error:  '.$_FILES['photo']['error'];
		}
	}
	print("message = " . $message);
	
}


?>	
<table border="1" align="center">
<tr>
<td>
<form action="attech2.php?rt=1" method="post" enctype="multipart/form-data">
  Please choose a file: <input type="file" name="photo"><br>
  Please enter a title: <input type="text" name="title"><br>
  <input type="submit" value="Upload File"> &nbsp; <a href="emailsystem.php">back</a>
</form>
</td>
</tr>
</table>




	

			
	</body>
	</html>					
