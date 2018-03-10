<?php 
  

   session_start();
function sanitize($data) 
{
	$data = ltrim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
		/* load settings */
	require 'connectdb.php';
function CheckBLUKID()
{
	$sSQL = "SELECT BlackLinkID FROM Settings WHERE Settings_ID =1"  ;
	//print($sSQL);
	$tmpAccs = mysql_query($sSQL);
	
	while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
	{
		$BlackLinkID = sanitize($thisAccs["BlackLinkID"]);
	}
	return $BlackLinkID;
}

	
$nwbth =  $_REQUEST['nwbth'];
if ($nwbth==1) //Client Details Update
{
	 $_SESSION['CurrentBatchID'] = 0;
}

  

	$sSQL = "SELECT ClientName, ClientEmail, ClientPostcode, ClientCompany, ClientNumber, ClientAddress, ClientPassword, Membership_ID, BlackLinkID FROM Clients WHERE Client_ID =" . $_SESSION['Client_ID'] ;
	//print($sSQL);
	$tmpAccs = mysql_query($sSQL);
	
	while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
	{
		$ClientName = sanitize($thisAccs["ClientName"]);
		$ClientAddress = sanitize($thisAccs["ClientAddress"]);
		$ClientEmail = sanitize($thisAccs["ClientEmail"]);
		$ClientNumber = sanitize($thisAccs["ClientNumber"]);
		$ClientPassword = sanitize($thisAccs["ClientPassword"]);
		$ClientPostcode = sanitize($thisAccs["ClientPostcode"]);
		$ClientCompany = sanitize($thisAccs["ClientCompany"]);
		
		$Membership_ID = sanitize($thisAccs["Membership_ID"]);
		$BlackLinkID = sanitize($thisAccs["BlackLinkID"]);
		
	}



if(isset($_SESSION['logtrue'])){
    ?><head>
  <title>Client Area </title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" name="viewport" content="width=device-width,initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="style/board.css" />
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
 <script>
function add_file(type){
var popurl='loadmedia.php?tp=' + type; 
winpops=window.open(popurl,'','width=500,height=300,scrollbars,resizable')
}
</script>
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
                 <li><a href="http://www.mediaunited.co.uk/">Home</a></li>
                <li><a href="viewproviders.php?mt=2">Radio Advertising</a></li>
                <li><a href="viewproviders.php?mt=3">Tv Advertising</a></li>
                <li><a href="viewproviders.php?mt=1">Print Advertising</a></li>
                <li><a href="#">Media Packages</a></li>
                <li><a href="contactus.php?type=client">Contact us</a></li>
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
      <div id="booking" class="booking">
      </div>
	  <?
	  if($Membership_ID == 3 And $BlackLinkID ==0)
	  {
		  ?>
		 <form action="board_client.php?up=1"  method="post">
		<table align="center" border="1" bgcolor="#FF0000">
		<tr>
		<td>Enter Black Links ID</td> 
		  <td><input type="text" name="txtBLUKID"></td>
		</tr>
		<tr> 
		  <td colspan="2" align="center"><input type="submit" name="Submit" value="Add ID"></td>
		</tr>
		</table>
		</form> 
		<?
	}
	$up =  $_REQUEST['up'];
	if ($up==1) //Client Details Update
	{
		$txtBLUKID =  $_POST['txtBLUKID'];
		if ($txtBLUKID == CheckBLUKID())
		{
		 $sSQL = "UPDATE Clients Set BlackLinkID =1  Where Client_ID = " . $_SESSION['Client_ID']; 
		//print($sSQL);
		mysql_query($sSQL); 
		}
		else
		{
			?>
			<p align="center">Invalid ID</p>
			<?
		}
		?>
		<script>
		window.location="board.php?board=client";
		</script>}
		<?
	}
if($Membership_ID == 3 And $BlackLinkID ==0)
	  {	}
else
{	  
	  ?>
      <div id="dashboard">
      <div id="client_info">
        <div id="book_in">
             <span id="b_title">Please Choose in which field you would like to advertise : </span></br></br>
            <a href="book.php?type=radio">Radio Advertising </a>
             <a href="book.php?type=tv">Tv Advertising</a>
            <a href="book.php?type=print">Print Advertising</a>
            <a href="book.php?type=board">Board Advertising</a></br>
           </div>
        <ul>
            <li><span id="client_info_tit">Name : </span><?php echo $ClientName; ?></li>
            <li><span id="client_info_tit">Email : </span> <?php echo $ClientEmail; ?></li>
            <li><span id="client_info_tit">Address : </span>
            <?php
            
             $adress=$ClientAddress;
            
             if($adress){
                echo ltrim($ClientAddress); 
                }
             ?>
             </li>
            <li><span id="client_info_tit">Phone Number :</span> 
              <?php

               $nemra=$ClientNumber;
               if($nemra==""){
                echo "No Phone";
               }

               if($nemra <>""){
                 echo $ClientNumber;
               }


              ?>

            </li>
        </ul>

     <?php

        
 if ($_SERVER["REQUEST_METHOD"] == "POST"){
   //new data
	 $newfullname=sanitize($_POST['fullname']);
	 $new_email=sanitize($_POST['email']);
	 $new_phone=sanitize($_POST['phone']);
	 $new_adress=sanitize($_POST['adress']);
	 $new_password=sanitize($_POST['password']);

	 if(empty($newfullname))
	 {
		$thenewfullname=$ClientName;
	 }
	 else
	 {
		$thenewfullname=$newfullname;
	 }
	
	 if(empty($new_email))
	 {
		$thenew_email=$ClientEmail;
	 }
	 else
	 {
		$thenew_email=$new_email;
	 }
	  if(empty($new_adress))
	  {
	  $thenew_adress=$ClientAddress;
	 }
	 else
	 {
	  $thenew_adress=$new_adress;
	 
	 }
	 if(empty($new_phone))
	 {
	  $thenew_phone=$ClientNumber;
	 }
	 else
	 {
	  $thenew_phone=$new_phone;
	 }
	
	 if(empty($password))
	 {
	  $thenew_password=$ClientPassword;
	 }
	 else
	 {
	  $thenew_password=$new_password;
	 }
	 
	 $sSQL = "UPDATE Clients Set ClientName =' " .  $thenewfullname . "', ClientPassword = '" . $thenew_password . "', ClientAddress = '" .  $thenew_adress . "', ClientEmail = '" .  $thenew_email . "', ClientNumber = '" . $thenew_phone . "' Where Client_ID = " . $_SESSION['Client_ID']; 
	//print($sSQL);
	mysql_query($sSQL); 
	?>
	<script>
	window.location="board.php?board=client";
	</script>}
	<?
}
       ?>

   <!--  <p> Media Files: <a href="javascript:add_file('3')">Upload Video File</a> &nbsp;  <a href="javascript:add_file('2')">Upload Audio File</a> &nbsp;  <a href="javascript:add_file('1')">Upload Image File</a> </p>&nbsp;--><small id="update_but">Update Information</small> 
      </div>
      <div id="update_div">
      
        <span id="ud_title">Update Your Details : </span></br></br>
        <hr/></br>
          <form method="post">
        <label for="fullname">New Full Name </label></br>
          <input type="text" name="fullname" /></br></br>
             <label for="newemail">New Email </label></br>
          <input type="text" name="email" /></br></br>
             <label for="fullname">New Phone Number </label></br>
          <input type="text" name="phone" /></br></br>
           <label for="fullname">New Address </label></br>
          <input type="text" name="adress" /></br></br>
           <label for="fullname" >New Password </label></br>
          <input type="text" name="password" /></br></br>
          <input id="change_button" type="submit" name="change" value="Update" />
        </form>

      </div>
      <div id="board_content">
        <h3 id="board_title">Media Orders</h3>
        <ul id="board_menu">
            <li>Order Date</li>
            <li>Total Order Price</li>            
            <li>Status</li>
        </ul>
        <ul id="board_data">
      <?php 
	$sSQL = "SELECT SlotOrders_ID, DateCreated, Total, Processed FROM SlotOrders WHERE  SlotOrders.Client_ID =" . $_SESSION['Client_ID'] ;
	//print($sSQL);
	$tmpAccs = mysql_query($sSQL);
	
	while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
	{
		$SlotOrders_ID = sanitize($thisAccs["SlotOrders_ID"]);
		$DateCreated = sanitize($thisAccs["DateCreated"]);
		$Total = $thisAccs["Total"];
		$Processed = sanitize($thisAccs["Processed"]);
		
		if($Processed ==0)
		{
			$ProcessedDetails = "Not Processed";
		}
		else
		{
			$ProcessedDetails = "Processed";
		}
		$DateCreated = date("D-d-M-y", strtotime($DateCreated));
			?>
			
             <li><?php echo $DateCreated;?></li>
            <li><?php echo "£" . $Total;?></li>
            <li><?php echo $ProcessedDetails;?></li>
            <li><a href="orderdetails.php?id=<?php echo $SlotOrders_ID; ?>">View Order Details</a></li>
			<br/>
			<?
		
	}


      ?>
			
            <?php 
              
            ?>
            </li>
        </ul>
      <?php ?>

        
      </div>
  </div>
<? } ?>
  </body>
    <?php }
    else{
      header("Location:login.php");
    }


    ?>