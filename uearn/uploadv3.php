<?php
	/* load settings */
	require 'connectdb.php';

UploadData("datafiles/ListingsExport2016February122128.csv");
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
			//	$ContactName = $data[1];
				$CategoryNmae = $data[1];
				$txtAdd11 = $data[2];
				//$txtCity = $data[4];				
				$txtEmail = $data[3];
				$txtTelephone = $data[4];
				
				$PackageID = $data[5];
				$BusinessDescription = $data[6];
				$IntroducerName = $data[7];
				$IntroducerSource = $data[8];
				$SkypeID = $data[9];
				$Facebook = $data[10];
				$Twitter = $data[11];
				$Linkedin = $data[12];
				$Country = $data[13];
				
				$sTempPassword = $txtCompany . "_TempPW" . date('H:s') ;
				$txtPassword =  $sTempPassword;
				
				if ($txtEmail =="")
				{	
					$txtEmail = "temp_login@blacklinksuk.co.uk";
				}
				
				if ($txtCompany <> "" And $txtEmail <> "")
				{
					 str_replace("'","",$txtCompany);
					 $txtCompany = string_sanitize($txtCompany);
					$NewClient = UpdateBusiness($txtCompany,$txtEmail);
				}
				else
				{
					$NewClient = 1;
				}	
				//die("Here");
				if ($NewClient == 1)
				{
					$Category_ID = 0;
					if ($CategoryNmae <> "")
					{
					 	$CategoryNmae = string_sanitize($CategoryNmae);
						$Category_ID = GetCatID($CategoryNmae);
					}
					
					$sSQL = "INSERT INTO Clients (Company, Address1, Telephone, Email, CompanyInfo, Category_ID,  ClientPassword, Package_ID, SkypeName, FacebookLink, TwitterName, Country, Linkedin )"; 
					$sSQL = $sSQL . " VALUES ('" .$txtCompany . "','" . $txtAdd11 . "','" . $txtTelephone . "','" . $txtEmail . "','" . $BusinessDescription . "'," . $Category_ID . ",'" . $txtPassword . "' , " . $PackageID . ", '" . $SkypeID . "','" . $Facebook . "', '" . $Twitter . "' , '" . $Country . "','" . $Linkedin . "')";
					
					//	 print($sSQL);
					mysql_query($sSQL); 
				}
			}
		}
	}
	fclose($handle);
}
	function string_sanitize($s) 
	{
		$result = preg_replace("/[^a-zA-Z0-9]+/", "", html_entity_decode($s, ENT_QUOTES));
		return $result;
	}

	function UpdateBusiness($BusinessName,$CompEmail)
	{
		$OldBusiness = 0;
		
		$sSQL = "SELECT Client_ID, Email, ContactEmail FROM Clients WHERE Company = '" . $BusinessName . "'" ;
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
	//die("Here");
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
		$Category_ID =  mysql_insert_id();
	
	}
	
	
	return $Category_ID;	

}		?>
	
	
