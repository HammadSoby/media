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
    <section id="slider" class="clear">
      <figure><img src="images/sales2.jpeg"  alt="">
        <figcaption>
          <h2>Sign In</h2>
		  <hr>
		  <form name="frmAgent" method="post" action="agent.php">
          <table>
		  <tr>
		  <th align="center" colspan="2">Agent Sign In</th>
		  </tr>
		  <tr>
		  <td>Email:</td>  <td><input name="txtEmail" type="text" required></td>
		  </tr>
		  <tr>
		  <td>Password:</td>  <td><input name="txtPass" type="password" required></td>
		  </tr>
		  <tr>
		  <td colspan="2"><input name="cmdsign" type="submit" value="Agent Sign In"> &nbsp; or <a href="reg.php"> register</a></td>
		  </tr>
		  </table>
		  </form>
		  
		  <hr>
		  
		  <form name="frmAdmin" method="post" action="admin.php?lg=1">
          <table>
		  <tr>
		  <th align="center" colspan="2">Admin Sign In</th>
		  </tr>
		  <tr>
		  <td>Email:</td>  <td><input name="txtEmail" type="text" required></td>
		  </tr>
		  <tr>
		  <td>Password:</td>  <td><input name="txtPass" type="password" required></td>
		  </tr>
		  <tr>
		  <td  colspan="2"><input name="cmdsign" type="submit" value="Admin Sign In"></td>
		  </tr>
		  </table>
		  </form>
        </figcaption>
      </figure>
    </section>
    <!-- main content -->
    <div id="intro">
      <section class="clear">
        <!-- article 1 -->
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
