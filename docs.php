	
	<!DOCTYPE html>
	<html>
	<head>
	<title>Black Links UK - Admin</title>
	<script src="ckeditor/ckeditor.js"></script>
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

	$tmpQuery = "SELECT Document_ID, DocumentTitle";
	$tmpQuery .= " FROM Documents order by DocumentTitle";
	//print($tmpQuery);
	$tmpAccs = mysql_query($tmpQuery);

?>	
<form action="docs.php?rt=1" method="post" >
	
	<table align="center" border="1">
	<tr>
	<th colspan="2">Email Documents</th>
	</tr>
	<tr>
	<td><div align="center">
          <p>Select Document <br/>
            <select name="cboDoc" id="cboDoc" >
              <option value="0">New Document</option>
              <?
			while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
			$iloop = $iloop + 1;

			$Document_ID = $thisAccs["Document_ID"];
			$DocumentTitle = $thisAccs["DocumentTitle"];
			
			echo("<option value=". $Document_ID . ">" . $DocumentTitle . "</option>");

			
		}
	?>
            </select>
            <br/>
            <input type="submit" name="Submit" value="Select">
          </p>
          <p><a href="emailsystem.php">back</a></p>
        </div></td>
	
	</tr>
	</table>
	</form>
	<br/> <br/>
	<?
	 $rt =  $_REQUEST['rt'];
	
	 if ( $rt ==1)
	 {
		$cboDoc =  $_POST['cboDoc'];	 
		
		if ($cboDoc ==0)
		{
			?>
			<form action="docs.php?rt=2" method="post" >
			
			<table align="center" border="1">
			<tr>
			<th colspan="2">Email Documents</th>
			</tr>
			<tr>
			
      <td><div align="center">Document Title: 
          <input name="txtTitle" type="text" id="txtTitle">
        </div></td>
			</tr>
			<tr>
			
			<td><p align="center">Document<br/>
				  <textarea  class="ckeditor" name="txtDoc" cols="60" rows="10" id="txtDoc"></textarea>
			  </td>
			</tr>
			<tr>
			  <td colspan="2"> <div align="center">
				  <input type="submit" name="Submit2" value="Create Document">
				</div></td>
			</tr>
			</table>
			</form>
			<?
			}
		
			if ($cboDoc >0)
			{
				$tmpQuery = "SELECT DocumentTitle, DocumentText";
				$tmpQuery .= " FROM Documents Where Document_ID = " . $cboDoc ;
				//print($tmpQuery);
				$tmpAccs = mysql_query($tmpQuery);
				
				while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
			{
				$DocumentText = $thisAccs["DocumentText"];
				$DocumentTitle = $thisAccs["DocumentTitle"];
			}
			
			?>
			<form action="docs.php?rt=3" method="post" >
				
				<table align="center" border="1">
			<tr>
				<th colspan="2">Email Documents</th>
				</tr>
					<tr>
			
      <td><div align="center">Document Title: 
          <input name="txtTitle" type="text" id="txtTitle" value="<? echo($DocumentTitle) ?>">
        </div></td>
			</tr>
					<tr>
				
				<td><p align="center">Document<br/>
					  <textarea class="ckeditor" name="txtDoc" cols="60" rows="10" id="txtDoc"><? echo($DocumentText) ?></textarea>
				  </td>
				</tr>
				<tr>
				  <td colspan="2"> <div align="center">
					  <input type="submit" name="Submit2" value="Update Document">
					</div></td>
				</tr>
				</table>
				<input type="hidden" name="txtDocID" value="<? echo($cboDoc) ?>">;
				</form>
			<?
			}
	}
	
		 if ( $rt ==2)
		 {		 
			$txtTitle =  $_POST['txtTitle'];
			$txtDoc =  $_POST['txtDoc']; 
			$sSQL = "INSERT INTO Documents  (DocumentTitle, DocumentText )" ;
			$sSQL = $sSQL . " VALUES ('" .$txtTitle . "' ,'" . $txtDoc . "' )";
			
			mysql_query($sSQL);
		 }
	
		 if ( $rt ==3)
		 {
			$txtTitle =  $_POST['txtTitle'];
			$txtDoc =  $_POST['txtDoc'];
			$txtDocID =  $_POST['txtDocID'];
			$sSQL = "Update  Documents Set DocumentTitle ='" .$txtTitle . "', DocumentText = '" . $txtDoc . "' Where Document_ID =  " . $txtDocID ;
	//	 print ($sSQL);		 
			mysql_query($sSQL);
		 }
		?>	
	</body>
	</html>					
