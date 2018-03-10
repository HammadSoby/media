<?php
	/* load settings */
	require 'connectdb.php';

UploadData("event2.csv");
print("Completed!");	
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
				
					$sSQL = "INSERT INTO Lists (Name, Email, Number)"; 
					$sSQL = $sSQL . " VALUES ('" .$txtCompany . "','" . $txtEmail . "','" . $txtTelephone . "')";
					
					//	 print($sSQL);
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
	
	function UpdateBusiness($BusinessName,$CompEmail)
	{
		$OldBusiness = 0;
		
		$sSQL = "SELECT Client_ID, Email, ContactEmail FROM Clients WHERE Company = '" . $BusinessName . "' " ;
		//print($sSQL);
			$tmpAccs = mysql_query($sSQL);
		
			while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
			{
				$Client_ID = $thisAccs["Client_ID"];
				$Email = $thisAccs["Email"];
				$ContactEmail = $thisAccs["ContactEmail"];
				$OldBusiness = 1;
			}
			
			if ($OldBusiness == 1)
			{
				if($CompEmail <> $Email )
				{
					$sSQL = "Update Clients Set Email = '" . $CompEmail . "' Where Client_ID = " . $Client_ID;
					//Print("SQL = " .  $sSQL);
					mysql_query($sSQL); 
				}
				return 0;
			}
			else
			{
				return 1;
			}
	}
	
function GetCatID ($CatName)
{
	$Category_ID = 0;
	$tmpQuery = "SELECT Category_ID";
	$tmpQuery .= " FROM Categories Where CategoryName = '" .  $CatName . "'";
	//print($tmpQuery);
	$tmpAccs = mysql_query($tmpQuery);
	

			while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{

			$Category_ID = $thisAccs["Category_ID"];
			
		}
		
	if ($Category_ID == 0 )
	{
	
		$sSQL = "INSERT INTO Categories (CategoryName)"; 
		$sSQL = $sSQL . " VALUES ('" . $CatName . "')";

		mysql_query($sSQL); 
		
		$tmpQuery = "SELECT Category_ID";
		$tmpQuery .= " FROM Categories Where CategoryName = '" .  $CatName . "'";
		//print($tmpQuery);
		$tmpAccs = mysql_query($tmpQuery);
	

			while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{

			$Category_ID = $thisAccs["Category_ID"];
			
		}

	
	}
	
	
	return $Category_ID;	

}		?>
	
	
