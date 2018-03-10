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
		<h2>My Campaigns</h2>
        <?
	/* load settings */
	require 'connectdb.php';
	
	  ?>
	<form action="campaign.php?campid=1" method="post">
	  <table>
	  <tr>
	  <th colspan="5">My Campaigns</th>
	  </tr>
	  <tr>
	  <th>Campaign Name</th> <th>Campaign Start Date</th> <th>Campaign End Date</th> <th>Campaign Description</th> <th>Select</th>
	  </tr>
	  <?
			$sSQL = "SELECT campaign_id, name, start_date, end_date, description, page FROM campaigns Where admin_id = " . $_SESSION['AdminID'] . " Order By date_created Desc " ;
			//print($sSQL);
			$tmpAccs = mysql_query($sSQL);
			
			while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
			{
				$name = $thisAccs["name"];
				$start_date = $thisAccs["start_date"];
				$end_date = $thisAccs["end_date"];
				$description = $thisAccs["description"];
				$campaign_id = $thisAccs["campaign_id"];
				
				echo("<tr>");
				echo("<td>" . $name  . "</td>" . "<td>" . $start_date  . "</td>". "<td>" . $end_date  . "</td>". "<td>" . $description  . "</td>" . "<td> <input type='radio' name='optcampaign' value='" . $campaign_id . "'></td>");
				echo("</tr>");
			}
			
			
	  ?>
	  <tr>
	 <td><a href="javascript:history.back()">back</a></td> <td  colspan="4"><input type="submit" name="Submit" value="Select Campaign"></td>
	  </tr>
	  </table>
	  </form>
     
      <?
	  
	  }
	  else
	  {
		?>
	<script>
	window.location="admin.php";
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
