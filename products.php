<?php 
   session_start();
	/* load settings */
	require 'connectdb.php';
	
	function sanitize($data) 
	{
		$data = ltrim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
	$ins =  $_REQUEST['ins'];
	if ($ins ==1) 
	{
		$txtBrand =  $_POST['txtBrand'];
		$optmedia =  $_POST['optmedia'];
		$optdur =  $_POST['optdur'];
		
		$txtContactName =  $_POST['txtContactName'];
		$txtContactEmail =  $_POST['txtContactEmail'];
		
		
		$sSQL = "Insert Into Products ( Providers_ID , ProductName ,MediaType_ID, PubDuration, 	ContactName, ContactEmail )"; 
		$sSQL .= " Value(" . $_SESSION['Provider_ID'] . ",'" . $txtBrand . "'," . $optmedia . ", '" . $optdur . "','" . $txtContactName . "','" . $txtContactEmail . "' )"; 
		//print($sSQL);
		mysql_query($sSQL);
		$_SESSION['PubDuration'] = $optdur;
	}	






if(isset($_SESSION['logtrue'])){
    ?><head>
  <title>Media Provider Panel </title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" name="viewport" content="width=device-width,initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="style/board_providers.css" />
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
function add_file(pid){
var popurl='loadpdf.php?id=' + pid; 
winpops=window.open(popurl,'','width=500,height=300,scrollbars,resizable')
}
</script></head>
<body>
 <div id="controls_remember">
   
   <?php   
 

    include 'includes/leftmenu_providers.php'; ?>
      </div>
      <div id="menu">
         <nav>
                <span class="show_menu"></span>
            
            <ul class="ul">
                <li><a href="aboutradio.php">Radio Ads</a></li>
                <li><a href="abouttv.php">Tv Ads</a></li>
                <li><a href="aboutprint.php">Print Ads</a></li>
                <li><a href="aboutod.php">Outdoor Ads</a></li>
                <li><a href="aboutmp.php">Media Packages</a></li>
                <li><a href="contactus.php">Contact us</a></li>
            </ul>
            </nav>
      </div>
      <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
     <script>
$(document).ready(function(){
  $("#booknow").click(function(){
    $("#booking").toggle();
  });
});
$(document).ready(function(){
  $("#update_but").click(function(){
    $("#update_div").toggle();
  });
});
</script>

      <div id="dashboard">

      <div id="client_info">
			 
			 <table align="center"  >
			 <tr>
			 <td>
				<form action="products.php?ins=1" method="post">
				 <table  border="1">
				 <tr>
				 <th colspan="2" align="center">Add Product Brand Details</th>
				 </tr>
				 <tr>		
				 <td><font size="+1">Brand Name:</font></td>    <td><input name="txtBrand" type="text" id="txtBrand" /></td>
				</tr>
                <tr>
                <td>Media Type</td>
                <td>
                 <input type="radio" name="optmedia" value="1" checked> Print   
                  <input type="radio" name="optmedia" value="2"> Radio 
                   <input type="radio" name="optmedia" value="3"> TV
                   <input type="radio" name="optmedia" value="4"> Outdoor Advertising
                   <input type="radio" name="optmedia" value="5"> DJ Services  
                   <input type="radio" name="optmedia" value="6"> Other Services  
                   </td>
                    </tr>
                    <tr>
                    <td>Production Duration</td>
                    <td>
                    <input type="radio" name="optdur" value="D" checked> Daily  
                    <input type="radio" name="optdur" value="W"> Weekly   
                    <input type="radio" name="optdur" value="F"> Fortnightly
                    <input type="radio" name="optdur" value="M"> Monthly                   
                    </td>
                </tr>
				 <tr>
				 <th colspan="2" align="center">Add Production Contact Details</th>
				 </tr>
				 <tr>		
				 <td><font size="+1">Contact Name:</font></td>    <td><input name="txtContactName" type="text" id="txtContactName" /></td>
				</tr>
				 <tr>		
				 <td><font size="+1">Contact Email:</font></td>    <td><input name="txtContactEmail" type="text" id="txtContactEmail" /></td>
				</tr>
				<tr>
					<td colspan="2" align="center"><input type="submit" name="Submit" value="Add"></td>
				</tr>
				</table> 
				</form>
                
				<br/> <hr/>
				<table align="center"  border="1">
				<tr>
				<th>Current Brand Names</th> <th>Media Type</th> <th>Production Duration</th> 
                     <?
					if ($MediaType_ID == 6)
				 	{
						?>
                <th>Promotional Pack</th>
                     	<?
					}
					else
				 	{
						?>
                <th>Media Pack</th>
                     	<?
					}
					?>
				</tr>
			
			
				<?	
				$sSQL = "SELECT Product_ID, ProductName, MediaType_ID, PubDuration, MediaKitFile FROM Products Where Providers_ID	 ="  . $_SESSION['Provider_ID'] ;
				//print($sSQL);
				$tmpAccs = mysql_query($sSQL);
				
				while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
				{
					$Product_ID = $thisAccs["Product_ID"];
					$ProductName = $thisAccs["ProductName"];
					$MediaType_ID = $thisAccs["MediaType_ID"];
					$PubDuration = $thisAccs["PubDuration"];
					$MediaKitFile = $thisAccs["MediaKitFile"];
					
					if ($MediaType_ID == 1)
					{
						$Media = "Print";
					}
					if ($MediaType_ID == 2)
					{
						$Media = "Radio";
					}
					if ($MediaType_ID == 3)
					{
						$Media = "TV";
					}
					if ($MediaType_ID == 4)
					{
						$Media = "Outdoor Advertising";
					}

					if ($MediaType_ID == 5)
					{
						$Media = "DJ Services";
					}
					
					if ($MediaType_ID == 6)
					{
						$Media = "Other Services";
					}
					
					switch ($PubDuration ) 
					{
						case 'D':
							$Duration ="Daily";			  
						  break;
						  
						   case 'W':
							$Duration ="Weekly";			  
						  break;
								 
						   case 'F':
							$Duration ="Fortnight";			  
						  break;
						  
						   case 'M':
							$Duration ="Monthly";			  
						  break;		 
					 }

					echo("<tr>");
					echo("<td>" . $ProductName . "</td>");
					echo("<td>" . $Media . "</td>");
					echo("<td>" . $Duration . "</td>");
					echo("<td>" . $MediaKitFile . "<br/><a href='javascript:add_file(" . $Product_ID . ")'>Click to upload Media Kit PDF file</a></td>");
					echo("</tr>");
				}
				?>
			
					 
			
    </table> 
    </td>
    </tr>
    </table>
    <div align="center"><a href="board_providers.php">back</a></div>
  </div>
  </div>

  </body>
    <?php }
    else{
      header("Location:login.php");
    }


    ?>