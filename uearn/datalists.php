		<? 
	 error_reporting(E_ERROR);
 	 session_start(); ?>
	<!DOCTYPE html>
	<html>
	<head>
	<title>Black Links UK - Admin</title>
	<script src="ckeditor/ckeditor.js"></script>
	<SCRIPT LANGUAGE="JavaScript">

function ClipBoard() 
{
holdtext.innerText = copytext.innerText;
Copied = holdtext.createTextRange();
Copied.execCommand("Copy");
}

</SCRIPT>
	</head>
	<body>
	
	<table align="center" bgcolor="#FFFFFF">
	<tr>
	<td><img src="images/logo.png" width="147" height="147"></td>
	<td width="690"><div align="center"><strong><font size="+4">Mass Email System</font></strong></div></td>
		
	</tr>
	</table>
	<br/>
		<?
	  /* load settings */
require 'connectdb.php';


?>	
	<br/> <br/>
			<form action="datalists.php?rt=2" method="post" >
			
			<table align="center" border="1">
			<tr>
			<th colspan="2">Name Data List</th>
			</tr>
			<tr>
			
      <td><div align="center">List Title: 
          <input name="txtTitle" type="text" id="txtTitle">
        </div></td>
			</tr>
			<tr>
			  <td colspan="2"> <div align="center">
				  <input type="submit" name="Submit2" value="Create List">
		        <a href="emailsystem.php">back</a></div></td>
			</tr>
			</table>
			</form>

			<?
 		$rt =  $_REQUEST['rt'];
		 if ( $rt ==2)
		 {		 
			$txtTitle =  $_POST['txtTitle'];
			
			$sSQL = "INSERT INTO DataLists  (DataListName )" ;
			$sSQL = $sSQL . " VALUES ('" .$txtTitle . "' )";
			//print($sSQL);
			mysql_query($sSQL);
			$_SESSION['CurrentDataID'] = mysql_insert_id()
			?>
            <table align="center">
            <tr>
            <th>
            Select File For Data List: &nbsp; <? echo $txtTitle; ?>
            </th>
            </tr>
            <tr>
            <td>
            <form action="uploaddatalist.php" method="post"
            enctype="multipart/form-data">
            <label for="file">Filename:</label>
            <input type="file" name="file" id="file"><br>
            <input type="submit" name="submit" value="Submit">
            </form> 
            </td>
            </tr>
            </table>
                      
             <?
          }
 		$fn2 =  $_REQUEST['fn2'];
		 if ( $fn2 <> "")
		 {	
		 	$FiletoUpload = "datafiles/" . $fn2;
		 
			UploadData ($FiletoUpload);
			print("Data Uploaded!");	
		 
		 }
		 
	function UploadData ($flName)
	{
	
		$row = 1;
		if (($handle = fopen($flName, "r")) !== FALSE) 
		{
			while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) 
			{
				$num = count($data);
				//    echo "<p> $num fields in line $row: <br /></p>\n";
				$row++;
				if ( $row >2)
				{
					$txtCompany = $data[0];
					//	print("txtAdd11" . $txtAdd11 . " Data " .  $data[0]);
					$txtTelephone = $data[1];
					$txtEmail = $data[2];
					$NewID = 0;
					
					$sSQL = "INSERT INTO Lists (Name, Email, Number, DataList_ID)"; 
					$sSQL = $sSQL . " VALUES ('" .$txtCompany . "','" . $txtEmail . "','" . $txtTelephone . "', " . $_SESSION['CurrentDataID'] . ")";
					
						// print($sSQL);
					mysql_query($sSQL); 
					$NewID =  mysql_insert_id();
					
					if ($NewID == 0)
					{
							 print($sSQL);
							 die("No DB Update");
					
					}
				}
			}
		}
		
		fclose($handle);
	}
		 
		?>	
	</body>
	</html>					
