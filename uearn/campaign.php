<?session_start();?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<title>uearnunited</title>
<meta charset="iso-8859-1">
<link rel="stylesheet" href="styles/layout.css" type="text/css">
<!--[if lt IE 9]><script src="scripts/html5shiv.js"></script><![endif]-->
<script src="ckeditor/ckeditor.js"></script>

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
		
		<h2>Campaign Details</h2>
<?
	/* load settings */
	require 'connectdb.php';
	 if ( $_SESSION['AdminID'] > 0)
	  {
		$campagtupd =  $_REQUEST['campagtupd'];
	
		if ( $campagtupd ==1)    
		{
				$optJoin =  $_POST['optJoin'];
				if ($optJoin == "Yes")
				{
					$Join = 1;
				}
				else
				{
					$Join = 0;
				}
				
				$txtAmount =  $_POST['txtAmount'];
				
				$optHire =  $_POST['optHire'];
				
				if ($optHire == "Yes")
				{
					$sSQL = "Update campaigns  Set allow_agent_join_noprompt =" . $Join . ", allow_agent_hirenow =1 Where campaign_id =" .   $_SESSION['CurrentCampaignID'] ; 
				}
				
				if ($optHire == "Over")
				{
					$sSQL = "Update campaigns  Set allow_agent_join_noprompt =" . $Join . ", allow_agent_hirenow =0, allow_agent_hire_over_val = " . $txtAmount . " Where campaign_id =" .   $_SESSION['CurrentCampaignID'] ; 
				}
				
				
			//	print($sSQL);
				mysql_query($sSQL); 
		}
		
		
		$lvup =  $_REQUEST['lvup'];
	
		if ( $lvup ==1)
		{
		
				$txtloop =  $_POST['txtloop'];
					//print(" txtloop = " .$txtloop);
				for ($loop = 1; $loop <= $txtloop ; $loop++) 
				{
					$txtLevel =  $_POST["txtLevel" .$loop ];
					$txtpercentage =  $_POST["txtpercentage" .$loop];
					$txtlevel_id =  $_POST["txtlevelid" .$loop];
					
				
					$sSQL = "Update campaigns_levels  Set level_no = '" . $txtLevel . "', percentage ='" . $txtpercentage . "'  Where level_id =" .  $txtlevel_id ; 
					//print($sSQL);
					mysql_query($sSQL); 
				}	
		}	  
	  
		$campupd =  $_REQUEST['campupd'];
	
		if ( $campupd ==1)
		{
				$txtName =  $_POST['txtName'];
				$txtSDate =  $_POST['txtSDate'];
				$txtEDate =  $_POST['txtEDate'];
				$txtDesc =  $_POST['txtDesc'];
			
			$sSQL = "Update campaigns  Set name = '" . $txtName . "', start_date ='" . $txtSDate . "' , end_date = '" . $txtEDate . "', description = '" .  $txtDesc . "'  Where campaign_id =" .   $_SESSION['CurrentCampaignID'] ; 
			//print($sSQL);
			mysql_query($sSQL); 
		}	  
	  
		$pageupd =  $_REQUEST['pageupd'];
	
		if ( $pageupd ==1)
		{
			$txtpage =  $_POST['txtpage'];
			
			$sSQL = "Update campaigns  Set page = '" . $txtpage . "'  Where campaign_id =" .   $_SESSION['CurrentCampaignID'] ; 
			//print($sSQL);
			mysql_query($sSQL); 
		}	  
	  
		$campid =  $_REQUEST['campid'];
	
		if ( $campid ==1)
		{
			$optcampaign =  $_POST['optcampaign'];
			if ($optcampaign > 0)
			{
				$_SESSION['CurrentCampaignID']  = $optcampaign;
			}
			
		}	
	  
	  
	  	if($_SESSION['CurrentCampaignID']  > 0)
		{
		
			$levadd =  $_REQUEST['levadd'];
			
			if ($levadd == 1) 
			{
				for ($loop = 1; $loop <= $_SESSION['NumLevels'] ; $loop++) 
				{
					$txtLName =  $_POST["txtLName" . $loop ];
					
					$sSQL = "Insert Into campaigns_levels ( campaign_id, percentage, level_no )"; 
					$sSQL .= " Value(" . $_SESSION['CurrentCampaignID'] . "," . $txtLName . "," .  $loop . " )";
					//print($sSQL);
					mysql_query($sSQL); 
				}	
					?>
					<script>
					window.location="campaign.php";
					</script>
					<?
				
			}
			
			
		
			$sSQL = "SELECT name, start_date, end_date, description, page, allow_agent_join_noprompt,  allow_agent_hirenow,  allow_agent_hire_over_val FROM campaigns Where campaign_id = " . $_SESSION['CurrentCampaignID']  ;
			//print($sSQL);
			$tmpAccs = mysql_query($sSQL);
			
			while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
			{
				$name = $thisAccs["name"];
				$start_date = $thisAccs["start_date"];
				$end_date = $thisAccs["end_date"];
				$description = $thisAccs["description"];
				$page = $thisAccs["page"];
				
				$allow_agent_join_noprompt = $thisAccs["allow_agent_join_noprompt"];
				$allow_agent_hirenow = $thisAccs["allow_agent_hirenow"];
				$allow_agent_hire_over_val = $thisAccs["allow_agent_hire_over_val"];
			}
			
				?>
				<form action="campaign.php?campupd=1" method="post">
				<table>
				<tr>
				<th colspan="2" align="center">Campaign Info</th>
				</tr>
				<tr>
				<td align="center" >Campaign Name:</td>  <td align="center"><input type="text" name="txtName" required size="30" value="<? echo($name); ?>"></td>
				</tr>
				<tr>
				<td align="center" >Campaign Start Date:</td>  <td align="center" ><input type="date" name="txtSDate" required   value="<? echo($start_date); ?>"></td> 
				</tr>
				<tr>
				<td align="center" >Campaign End Date:</td>  <td align="center" ><input type="date" name="txtEDate" required  value="<? echo($end_date); ?>"></td>
				</tr>
				<tr>
				<td align="center" >Campaign Description:</td>  <td align="center" ><textarea name="txtDesc" cols="30" rows="7" id="txtDesc" ><? echo($description); ?></textarea></td>
				</tr>
				
				<tr>
				<td>&nbsp;</td> <td> <input type="submit" name="Submit" value="Update Campaign Info"></td>
				</tr>
				</table>
				</form>
				
				<br/>
				<hr/>
				<form action="campaign.php?campagtupd=1" method="post">
				<table>
				<tr>
				<th colspan="2">Campaign Rules for Agents</th>
				</tr>
				<tr>
				<td>Allow Agents to Join Campaign:</td>
				
				 <td>
				 <?
				 if ($allow_agent_join_noprompt == 1)
				 {
					 ?>
					 Yes:<input name="optJoin" type="radio" value="Yes" checked> &nbsp; With our approval:<input name="optJoin" type="radio" value="No" >
					 <?
				 }
				 else
				 {
					 ?>
					 Yes:<input name="optJoin" type="radio" value="Yes" > &nbsp; With our approval:<input name="optJoin" type="radio" value="No"  checked>
					 <?
				 }
				 ?>
				 
				 </td>
				</tr>
				<tr>
				<td>Allow Agents to Recruit:</td> 
				
				<td>
				 <?
				 if ($allow_agent_hirenow == 1)
				 {
					 ?>
					Yes:<input name="optHire" type="radio" value="Yes" checked> &nbsp; When earned over :<input name="optHire" type="radio" value="Over" > &nbsp; <input type="text" name="txtAmount" />
					<?
				}
				else
				{
					 ?>
					Yes:<input name="optHire" type="radio" value="Yes" > &nbsp; When earned over :<input name="optHire" type="radio" value="Over"  checked> &nbsp; <input type="text" name="txtAmount"  value="<? echo($allow_agent_hire_over_val ); ?>"/>
					<?
				}
				?>
				
				
				</td>
				</tr>
				<tr>
				<td colspan="2"><input name="cmdSubmit" type="submit" value="Save"></td>
				</tr>
				</table>
				
				</form>
				<br/>
				<table >
				<tr>
				<th colspan="2">Campaign Levels</th>
				</tr>
				<?
				$iLoop = 1;
				$GotLevels = 0;
				echo("<form method='post' action='campaign.php?lvup=1' >");
				
				$sSQL = "SELECT level_id, level_no, percentage FROM campaigns_levels Where campaign_id = " . $_SESSION['CurrentCampaignID']  ;
				//print($sSQL);
				$tmpAccs = mysql_query($sSQL);
				
				while($thisAccs = mysql_fetch_array($tmpAccs, MYSQL_ASSOC))
				{
					$level_id = $thisAccs["level_id"];
					$level_no = $thisAccs["level_no"];
					$percentage = $thisAccs["percentage"];
					$GotLevels = 1;
					echo("<tr>");
					echo("<td>Level: <input name='txtLevel" . $iLoop . "' type='text' size='10' value='" . $level_no . "'/> </td><td> Percentage: <input size='15' name='txtpercentage" . $iLoop . "' type='text' value='" . $percentage . "'/></td>");
					echo("</tr>");
					echo(" <input name='txtlevelid" . $iLoop . "' type='hidden'  value='" . $level_id . "'/>");
					$iLoop = $iLoop + 1;
					
				}
				echo("<tr>");
				echo("<td align='center' colspan='2'><input name='cmdlve' type='submit' value='Update'></td>");
				echo("</tr>");
				echo(" <input name='txtloop' type='hidden'  value='" . $iLoop . "'/>");
				echo("</form>");
				if($GotLevels ==0)
				{
					$lev =  $_REQUEST['lev'];
				
					if ( $lev ==1)
					{
						$ddLevelnum =  $_POST['ddLevelnum'];
					//	print("ddLevelnum =  " . $ddLevelnum);
					}
					?>	
					
					<tr>
					<form name="frmCampLevels" method="post" action="campaign.php?lev=1">
					<td>Number of Levels:</td> 
				<td><select name="ddLevelnum" id="ddLevelnum" onchange='document.frmCampLevels.submit();'>
					<option value="0" selected>Select Number of levels to create</option>
					<option value="1" >1 Level</option>
					<option value="2">2 Levels</option>
					<option value="3">3 Levels</option>
					<option value="4">4 Levels</option>
					<option value="5">5 Levels</option>
					<option value="6">6 Levels</option>
					<option value="7">7 Levels</option>
					<option value="8">8 Levels</option>
					<option value="9">9 Levels</option>
					<option value="10">10 Levels</option>
				  </select></td>
				  </form>
					</tr>
					<?
						if ($ddLevelnum > 0)
						{
							$_SESSION['NumLevels'] = $ddLevelnum ;
						?>
							<form name="frmCampLevelsconf" method="post" action="campaign.php?levadd=1">
	<?
							for ($loop = 1; $loop <=$ddLevelnum; $loop++) 
							{
								switch ($loop) 
								{
								
									case '1':
										$NumText ="1st";			  
									  break;
									  
									case '2':
										$NumText ="2nd";			  
									  break;
									  
									   case '3':
										$NumText ="3rd";			  
									  break;
											 
									   case '4':
										$NumText ="4th";			  
									  break;
									  
									   case '5':
										$NumText ="5th";			  
									  break;
									  
									case '6':
										$NumText ="6th";			  
									  break;
									  
									   case '7':
										$NumText ="7th";			  
									  break;
											 
									   case '8':
										$NumText ="8th";			  
									  break;
									  
									   case '9':
										$NumText ="9th";			  
									  break;
											 
									case '10':
										$NumText ="10th";			  
									  break;
								 }
								echo("<tr>");
								echo("<td>Configure " .  $NumText  . " Level Percentage:</td>" . "<td><input type='text' name='txtLName" .  $loop . "' required ></td>");
								echo("</tr>");
								
						}
						?>
						<tr>
						<td>&nbsp;</td> <td> <input type="submit" name="Submit" value="Create Levels"></td>
						</tr>
						</form>
						<?
						
					}
					
					?>
					</table>
				<?
				}
				?>
				<br/>
				<hr/>
				<form action="campaign.php?pageupd=1" method="post">
				<table>
				<tr>
				<th colspan="2" align="center">				<hr/>
<br/><br/>Campaign Page Info</th>
				</tr>
				<tr>
				<td align="center" >Page: </td>  <td align="center"><textarea class="ckeditor" name="txtpage" cols="50" rows="15" id="txtpage" ><? echo($page); ?></textarea></td>
				</tr>
				
				<tr>
				<td>&nbsp;</td> <td> <input type="submit" name="Submit" value="Update Page"></td>
				</tr>
				</table>
				</form>
				
				<br/>
				<a href="admin.php">back</a>
				<?
			}
	  }
	  
	  else
	  {
	 	 ?>
  			<script>
                   window.location= "admin.php";
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
      <section class="one_quarter">
        <h2 class="title">From The Blog</h2>
        <article>
          <header>
            <h2>Post Title</h2>
            <address>
            <a href="#">Admin</a>, domainname.com
            </address>
            <time datetime="2000-04-06">Friday, 6<sup>th</sup> April 2000</time>
          </header>
          <p>Nulla facilisi. Ut fringilla. Suspendisse potenti. Nunc feugiat mi a tellus consequat imperdiet.</p>
          <footer class="more"><a href="#">Read More &raquo;</a></footer>
        </article>
      </section>
      <section class="one_quarter">
        <h2 class="title">Quick Links</h2>
        <nav>
          <ul>
            <li><a href="#">Lorem ipsum dolor sit</a></li>
            <li><a href="#">Amet consectetur</a></li>
            <li><a href="#">Praesent vel sem id</a></li>
            <li><a href="#">Curabitur hendrerit est</a></li>
            <li class="last"><a href="#">Sed a nulla urna</a></li>
          </ul>
        </nav>
      </section>
      <section class="two_quarter lastbox">
        <h2 class="title">About US</h2>
        <img class="imgl" src="images/demo/130x130.gif" width="130" height="130" alt="">
        <p>Nam nec ante. Sed lacinia, urna non tincidunt mattis, tortor neque adipiscing diam, a cursus ipsum ante quis turpis. Nulla facilisi. Ut fringilla. Suspendisse potenti. Nunc feugiat mi a tellus consequat imperdiet. Vestibulum sapien. Proin quam. Etiam ultrices. Suspendisse in justo eu magna luctus suscipit.</p>
        <footer class="more"><a href="#">Read More &raquo;</a></footer>
      </section>
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
