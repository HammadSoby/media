<?php 
   session_start();
	/* load settings */
	require 'connectdb.php';
	


$insss =  $_REQUEST['insss'];
if ($insss ==1) 
{
	$txtSlot =  $_POST['txtSlot'];
	
	$sSQL = "Insert Into SlotSizes ( Providers_ID , SlotSize )"; 
	$sSQL .= " Value(" . $_SESSION['Provider_ID'] . ",'" . $txtSlot . "')";
	//print($sSQL);
	mysql_query($sSQL);
}	

$insst =  $_REQUEST['insst'];
if ($insst ==1) 
{
	$txtSlot =  $_POST['txtSlot'];
	
	$sSQL = "Insert Into SlotTimes ( Providers_ID , SlotTime )"; 
	$sSQL .= " Value(" . $_SESSION['Provider_ID'] . ",'" . $txtSlot . "')";
	//print($sSQL);
	mysql_query($sSQL);
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
 

    include 'includes/leftmenu_providers.php'; ?>
      </div>
      <div id="menu">
         <nav>
                <span class="show_menu"></span>
            
            <ul class="ul">
                 <li><a href="http://www.mediaunited.co.uk/">Home</a></li>
                <li><a href="agencys.php?type=radio">Radio Provider</a></li>
                <li><a href="agencys.php?type=tv">Tv Provider</a></li>
                <li><a href="agencys.php?type=print">Print Provider</a></li>
                
                <li><a href="contactus?type=provider">Contact us</a></li>
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
	<br/>
	<table align="center" border="1"> 
	<tr>
	<th colspan="2">ABOUT US</th>
	</tr>
	<tr>
	<td width="100" align="center">About Us</td>
	<td>
	We recognize the need to offer a service to the public and organisations worldwide who want to access the black community. We will target the community across the United Kingdom , specifically in <strong>London & South East, Bristol, Birmingham & Midlands, Liverpool, Leeds, Manchester </strong>
	<br/> <br/>
	Our supporters are Black Links United Kingdom who have the largest, growing database of businesses that support the black community and the people and media outlets that make up our information networks. We invite all businesses and media outlets to join us and receive advertising revenue from our clients and offer them a service that is quality. <br/><br/>
	Our team are the production specialists who provide the advertisements to our clients that we broadcast via our media platform owners. These technicians and production specialists are the invisible link between our media providers and our clients. <br/><br/>
	We are contracting production specialists across the UK that can service our deliver creative work for Radio, Television, Papers and Publications.

	</td>
	</tr>
	<tr>
	<td width="100" align="center">What we offer</td>
	<td>
	<strong>Targeted Audience </strong> <br/><br/>
	<strong>Media United</strong> by virtue of its online presence has access to a global audience; here however advertising activity is targeted primarily at UK audiences. <br/><br/>
	Within the UK the population of London and the South East, the cities of Bristol, Birmingham, Liverpool, Leeds, Cardiff and Manchester form the bedrock for advertising activity. The total population reach is in excess of 25 million. <br/><br/>
	The diversity of these urban centres give rise to a multi cultural population made up of English, Black British, Caribbean, African and Asian people. <br/><br/>
 	<strong>Media United</strong> services are designed specifically to engage with a diverse  audience as reflected through our partner base.  <br/><br/>
	<strong>Targeted Areas </strong> <br/>
	<strong>Media United</strong> communication platforms targets audiences in the following geographical locations:<br/><br/>
<center>
•	London & South East<br/>
•	Bristol<br/>
•	Birmingham & Midlands<br/>
•	Liverpool<br/>
•	Leeds<br/>
•	Manchester &<br/>
•	Other Areas<br/>
</center>
	</td>
	</tr>
	</table>
	
    <div align="center"><a href="javascript:history.go(-1)">back</a> </div>
  </div>
  </div>

  </body>
    <?php }
    else{
      header("Location:login.php");
    }


    ?>