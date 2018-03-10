<?session_start();?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<title>uearnunited</title>
<meta charset="iso-8859-1">
<link rel="stylesheet" href="styles/layout.css" type="text/css">
<!--[if lt IE 9]><script src="scripts/html5shiv.js"></script><![endif]-->
</head>
<body>
<?
	/* load settings */
	require 'connectdb.php';
	
	?>	
		
<div class="wrapper row1">
  <header id="header" class="clear">
    <div id="hgroup">
      <h1><a href="index.php">uearnunited.com</a></h1>
      <h2>U Earn United</h2>
    </div>
    <form action="#" method="post">
      <fieldset>
        <legend>Search:</legend>
        <input type="text" value="Search Our Website&hellip;" onFocus="this.value=(this.value=='Search Our Website&hellip;')? '' : this.value ;">
        <input type="submit" id="sf_submit" value="submit">
      </fieldset>
    </form>
    <nav>
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="agents.php">Agents</a></li>
        <li><a href="campaigns.php ">Campaigns </a></li>
        <li class="last"><a href="admin.php">Admin</a></li>
      </ul>
    </nav>
  </header>
</div>
<!-- content -->
<div class="wrapper row2">
  <div id="container" class="clear">
    <!-- Slider -->
    <!-- main content -->
    <div id="intro">
      <section class="clear">
        <!-- article 1 -->
        <article class="two_quarter">
		<h2>Agent Details</h2>
	<?	
	$reg =  $_REQUEST['reg'];

	if ( $reg ==1)
	{
		$txtName =  $_POST['txtName'];
		$txtCompname =  $_POST['txtCompname'];
		$txtEmail =  $_POST['txtEmail'];
		$txtNumber =  $_POST['txtNumber'];
		$txtAddress =  $_POST['txtAddress'];
		$txtCity =  $_POST['txtCity'];
		$txtpCode =  $_POST['txtpCode'];
		$txtPass =  $_POST['txtPass'];
		
		$sSQL = "Insert Into agents ( name, passwd, company_name, contact_no, email, address, city, postcode )"; 
		$sSQL .= " Value ('" .$txtName . "','". $txtPass . "','". $txtCompname . "','" .  $txtNumber . "', '" . $txtEmail . "', '" .  $txtAddress ."', '" .  $txtCity . "', '" . $txtpCode .  "')";
		//print($sSQL);
		mysql_query($sSQL); 
		$_SESSION['AgentID'] =  mysql_insert_id();
		
	}
	
	$upd =  $_REQUEST['upd'];

	if ( $upd ==1)
	{
		$txtName =  $_POST['txtName'];
		$txtCompname =  $_POST['txtCompname'];
		$txtEmail =  $_POST['txtEmail'];
		$txtNumber =  $_POST['txtNumber'];
		$txtAddress =  $_POST['txtAddress'];
		$txtCity =  $_POST['txtCity'];
		$txtpCode =  $_POST['txtpCode'];
		$txtPass =  $_POST['txtPass'];
		
		$sSQL = "Update agents Set name = '" .  $txtName . "', passwd = '" .  $txtPass . "', company_name = '" .  $txtCompname . "', contact_no = '" .  $txtNumber . "', email = '" .  $txtEmail . "', address = '" .  $txtAddress . "', city = '" .  $txtCity . "', postcode = '" .  $txtpCode . "' Where agent_id =" . $_SESSION['AgentID']  ; 
		//print($sSQL);
		mysql_query($sSQL); 
		
	}
	
	
	$lg =  $_REQUEST['lg'];

	if ( $lg ==1)
	{
		$txtEmail =  $_POST['txtEmail'];
		$txtPass =  $_POST['txtPass'];
		
		$sSQL = "SELECT agent_id FROM agents WHERE email	 ='" . $txtEmail . "' and passwd ='" . $txtPass . "'" ;
		$tmpAccs = mysql_query($sSQL);
	
	
		while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
			$admin_id = $thisAccs["agent_id"];
			$_SESSION['AgentID'] = $admin_id;
				?>
  			<script>
                   window.location= "agents.php";
			 </script>	  
				<?
		}
		
	}
	?>	
        <h1>Sales Agents</h1>
	<?	
	  if ( $_SESSION['AgentID'] > 0)
	  {
	  
		$sSQL = "SELECT email, passwd, name, company_name, contact_no, address, postcode, city, total_amt_earned  FROM agents WHERE agent_id	 =" . $_SESSION['AgentID']   ;
		//print($sSQL);
		$tmpAccs = mysql_query($sSQL);
	
	
		while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
			$email = $thisAccs["email"];
			$passwd = $thisAccs["passwd"];
			$name = $thisAccs["name"];
			$company_name = $thisAccs["company_name"];
			$contact_no = $thisAccs["contact_no"];
			$address = $thisAccs["address"];
			$postcode = $thisAccs["postcode"];
			$city = $thisAccs["city"];
			$total_amt_earned = $thisAccs["total_amt_earned"];
		}
	  
	  ?>
	  
		<form action="agents.php?upd=1" method="post">
		<table align="center" >
		<tr>
		  <th bgcolor="#66CCFF" colspan="2" align="center">Agent Account Details</th>
		</tr>
		<tr>
		  <td align="center">Agent Name:*</td> 
		  <td ><input name="txtName" type="text" id="txtName" required value="<? echo($name); ?>"></td>
		</tr>
		<tr>
		<td align="center">Company Name:</td> 
		  <td ><input name="txtCompname" type="text" id="txtCompname" value="<? echo($company_name); ?>"></td>
		</tr>
		<tr>
		  <td align="center">Email:*</td> 
		  <td ><input name="txtEmail" type="text" id="txtEmail" required value="<? echo($email); ?>"></td>
		</tr>
		<tr>
		  <td align="center">Contact Number:*</td> 
		  <td ><input name="txtNumber" type="text" id="txtNumber" required value="<? echo($contact_no); ?>"></td>
		</tr>
		<tr>
		  <td align="center">Address:*</td> 
		  <td ><textarea name="txtAddress" id="txtAddress" required="required"><? echo($address); ?></textarea></td>
		</tr>
		<tr>
		  <td align="center">City:*</td> 
		  <td ><input name="txtCity" type="text" id="txtCity" required value="<? echo($city); ?>"></td>
		</tr>
		<tr>
		  <td align="center">Post Code:*</td> 
		  <td ><input name="txtpCode" type="text" id="txtpCode" required value="<? echo($postcode); ?>"></td>
		</tr>
	<tr>
		  <td align="center">Password:*</td> 
		  <td><input name="txtPass" type="password" id="txtPass" required value="<? echo($passwd); ?>"></td>
		</tr>
		
			
		<tr>
		  <td  align="center">&nbsp;</td> <td><input type="submit" name="Submit" value="Update"></td>
		</tr>
		</table>
		</form>	  
	  <?
	  
	  }
	  else
	  {
		  ?>
	

		 <img src="images/salesagent.jpeg" height="200" width="300" />
        <p>The Sales Agents Payment System uses a system known as affiliate marketing, which does not require telemarketing, expensive media advertising, or costly sales people. Through affiliate marketing, we are able to pursue the business and residential markets without incurring the costs associated with traditional marketing methods.</p>
        <p>Affiliate marketing allows you to use one of your most valuable assets, your casual and social acquaintances to develop a team of affiliates and service users. SAPS uses affiliate marketing because it is a profitable way to build a business.</p>
        <p>When you register you become an independant affiliate sales agent and are able to participate in campaigns. Campaigns show the product and/or service together with a compensation plan that allows you and your team to create and develop revenue streams from the products and services that campaigns offer.</p>
      </div>
		<form action="agents.php?lg=1" method="post">
		<table align="center" >
		<tr>
		<th bgcolor="#66CCFF" colspan="2" align="center">Sign In</th>
		</tr>
		<tr>
		<td align="center">Email:</td> 
		  <td ><input name="txtEmail" type="text" id="txtEmail"></td>
		</tr>
	<tr>
		<td align="center">Password:</td> 
		  <td><input name="txtPass" type="password" id="txtPass"></td>
		</tr>	
		<tr>
		  <td  align="center">&nbsp;</td> <td><input type="submit" name="Submit" value="Enter"></td>
		</tr>
		<tr>
		 <td  align="center">&nbsp;</td><td  align="center">Or <a href="reg.php"> Register</a></td>
		</tr>
		</table>
		</form>
		<?
	}
	?>
		
        </article>
        <!-- article 2 -->
      </section>
    </div>
    <!-- ########################################################################################## -->
    <!-- ########################################################################################## -->
    <!-- ########################################################################################## -->
    <!-- ########################################################################################## -->
    <div id="homepage" class="last clear">
    </div>
    <!-- / content body -->
  </div>
</div>
<!-- Footer -->
<div class="wrapper row3">
  <footer id="footer" class="clear">
    <p class="fl_left">Copyright &copy; 2012 - All Rights Reserved - <a href="#">Domain Name</a></p>
    <p class="fl_right">Template by <a href="http://www.os-templates.com/" title="Free Website Templates">OS Templates</a></p>
  </footer>
</div>
</body>
</html>
