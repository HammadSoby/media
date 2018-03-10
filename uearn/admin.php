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
	
	$lg =  $_REQUEST['lg'];

	if ( $lg ==1)
	{
		$txtEmail =  $_POST['txtEmail'];
		$txtPass =  $_POST['txtPass'];
		
		$sSQL = "SELECT Admin_id FROM Admin WHERE Email	 ='" . $txtEmail . "' and Pass ='" . $txtPass . "'" ;
		//print($sSQL);
		$tmpAccs = mysql_query($sSQL);
	
	
		while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
		{
			$admin_id = $thisAccs["Admin_id"];
			$_SESSION['AdminID'] = $admin_id;
			?>
			<script>
			window.location="admin.php";
			</script>
			<? 
		} 
	}
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
		<?
		if ($_SESSION['AdminID'] > 0)
		{
		?>
		<h2>Admin Menu</h2>
		 <p><a href="createcampaign.php">Create New Campaign</a></p>
		<p><a href="viewmycampaign.php">View &amp; Edit Campaigns</a></p>
		 <p><a href="">Agents</a></p></td>
		 <p><a href="">Sales &amp; Payments</a></p>
		  <p><a href="emailsystem.php">Mass Email System</a></p>
		 <p><a href="">Reports</a></p>
		 
		 <p><a href="">Sign Out</a></p
         ><?
		 }
		 else
		 {
		?>
	<script>
	window.location="index.php";
	</script>
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
