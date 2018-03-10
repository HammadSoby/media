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


if(isset($_SESSION['logtrue'])){
    ?><head>
  <title>Media Provider Panel </title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" name="viewport" content="width=device-width,initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="style/board_providers.css" />
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body>
 <div id="controls_remember">
   
   <?php   
 

    include 'includes/leftmenu.php'; ?>
      </div>
      <div id="menu">
         <nav>
                <span class="show_menu"></span>
            
            <ul class="ul">
                <li><a href="viewproviders.php?mt=2">Radio Ads</a></li>
                <li><a href="viewproviders.php?mt=3">Tv Ads</a></li>
                <li><a href="viewproviders.php?mt=1">Print Ads</a></li>
                <li><a href="viewproviders.php?mt=4">Outdoor Ads</a></li>
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
	<p align="center">&nbsp; </p>
	<table align="center" >
	<tr>
	  <th colspan="8"><font size="+2"><font color="#FF00FF">Providers</font></font></th>
	</tr>
	<tr>
	    <th ><font size="+2">Name</font></th>
        <th><font size="+2">Production</font> <font size="+2">Duration</font></th>
        <th><font size="+2">Select To View</font></th>
	</tr>
	<? 
	/* load settings */
	require 'connectdb.php';
	$mt =  $_REQUEST['mt'];
	$sSQL = "SELECT  Product_ID, ProductName, PubDuration, MediaKitFile FROM Products Where MediaType_ID = " . $mt . " Order By ProductName" ;
	//print($sSQL);
	$tmpAccs = mysql_query($sSQL);
	
	while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
	{
		$ProductName = $thisAccs["ProductName"];
		$Product_ID = $thisAccs["Product_ID"];
		$PubDuration = $thisAccs["PubDuration"];
		$MediaKitFile = $thisAccs["MediaKitFile"];
		
		echo("<tr>");
		echo("<td align='center'><font size='+2'>" . $ProductName . "</font></td>" );
			
		switch ($PubDuration) {
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
			echo("<td align='center'><font size='+2'>" . $Duration . "</font></td>" );
			
			
			echo("<td align='center'><font size='+2'><a href = '" . $MediaKitFile . "' target='_blank'>Select</a></font></td>" );
			echo("</tr>");
		}	
		

?>
	</table>
    <div align="center"><a href="board_client.php">back</a> </div>
  </div>
  </div>

  </body>
    <?php }
    else{
      header("Location:login.php");
    }


    ?>