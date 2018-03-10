<?php
error_reporting(E_ERROR);
session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Media United | Help Book</title>
    <!-- Stylesheets -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/responsive.css" rel="stylesheet">

    <!--Color Switcher Mockup-->
    <link href="assets/css/color-switcher-design.css" rel="stylesheet">

    <!--Color Themes-->
    <link id="theme-color-file" href="assets/css/color-themes/default-theme.css" rel="stylesheet">

    <!--Favicon-->
    <link rel="shortcut icon" href="assets/assets/images/favicon.png" type="image/x-icon">
    <link rel="icon" href="assets/assets/images/favicon.png" type="image/x-icon">
    <!-- Responsive -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

</head>

<body>
<div class="page-wrapper">

    <!-- Preloader -->
    <div class="preloader"></div>

    <!-- Main Header -->
    <header class="main-header">
        <!--Header Top-->
        <div class="header-top">
            <div class="auto-container">
                <div class="clearfix">
                    <!--Top Left-->
                    <div class="top-left col-md-4 col-sm-12 col-xs-12">
                        <!--                        <div class="trend">Trending: </div>-->
                        <!--                        <div class="single-item-carousel owl-carousel owl-theme">-->
                        <!--                            <div class="slide">-->
                        <!--                                <div class="text">Croatia shocks Euro champion Spain Oops! _</div>-->
                        <!--                            </div>-->
                        <!--                            <div class="slide">-->
                        <!--                                <div class="text">Croatia champion Spain Oops! _</div>-->
                        <!--                            </div>-->
                        <!--                            <div class="slide">-->
                        <!--                                <div class="text">Croatia shocks Euro champion.</div>-->
                        <!--                            </div>-->
                        <!--                        </div>-->
                    </div>
                    <!--Top Right-->
                    <div class="top-right pull-right col-md-8 col-sm-12 col-xs-12">
                        <ul class="top-nav">
                            <li><a href="helpmebook-new.php">Help me book</a></li>
                            <li><a href="aboutus.php">About us</a></li>
                        </ul>
                        <ul class="social-nav">
                            <li><a href="javascript:void(0)"><span class="fa fa-facebook-square"></span></a></li>
                            <li><a href="javascript:void(0)"><span class="fa fa-twitter"></span></a></li>
                            <li><a href="javascript:void(0)"><span class="fa fa-google-plus"></span></a></li>
                            <li><a href="javascript:void(0)"><span class="fa fa-linkedin-square"></span></a></li>
                            <li><a href="javascript:void(0)"><span class="fa fa-pinterest-p"></span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--Header-Upper-->
        <div class="header-upper">
            <div class="auto-container">
                <div class="clearfix">

                    <div class="pull-left logo-outer">
                        <div class="logo"><a href="/"></a></div>
                    </div>

                    <div class="pull-right upper-right clearfix">
                        <div class="add-image">
                            <!--                            <a href="#"><img src="assets/images/resource/header-add.jpg" alt="" /></a>-->
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--End Header Upper-->

        <!--Header Lower-->
        <div class="header-lower">
            <div class="auto-container">
                <div class="nav-outer clearfix">
                    <!-- Main Menu -->
                    <nav class="main-menu">
                        <div class="navbar-header">
                            <!-- Toggle Button -->
                            <button type="button" class="navbar-toggle" data-toggle="collapse"
                                    data-target="#bs-example-navbar-collapse-1">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>

                        <div class="navbar-collapse collapse clearfix" id="bs-example-navbar-collapse-1">
                            <ul class="navigation clearfix">
                                <li><a href="/">Home</a></li>
                                <li class="dropdown"><a href="#">Book Ads In</a>
                                    <ul>
                                        <?php
                                        if (isset($_GET['type'])) {
                                            $type = $_GET['type'];
                                            $_SESSION['type'] = $type;
                                        if (!empty($type)) {

                                        switch ($type) {
                                            case 'radio':
                                                $_SESSION['mediatype'] = 2;
                                                require 'sales.php';

                                                break;
                                            case 'print':
                                                $_SESSION['mediatype'] = 1;
                                                require 'sales.php';

                                                break;

                                            case 'board':
                                                $_SESSION['mediatype'] = 4;
                                                require 'sales.php';

                                                break;


                                            case 'dj':
                                                $_SESSION['mediatype'] = 5;
                                                require 'sales.php';
                                                break;

                                            case 'os':
                                                $_SESSION['mediatype'] = 6;
                                                require 'sales.php';
                                                break;

                                            case 'tv':
                                                $_SESSION['mediatype'] = 3;
                                                require 'sales.php';

                                                break;

                                        default:
                                            ?>
                                            <script>
                                                window.location = "http://www.demosunited.com/board";
                                            </script>
                                        <?php
                                        break;
                                        }

                                        }
                                        }
                                        else
                                        {
                                        ?>
                                            <li><a href="<?php echo($Action); ?>?type=radio">Radio Advertising </a></li>
                                            <li><a href="<?php echo($Action); ?>?type=tv">Tv Advertising</a></li>
                                            <li><a href="<?php echo($Action); ?>?type=print">Print Advertising</a></li>
                                            <li><a href="<?php echo($Action); ?>?type=board">Outdoor Advertising</a>
                                            </li>
                                            <li><a href="<?php echo($Action); ?>?type=dj"> DJ Services</a></li>
                                            <li><a href="<?php echo($Action); ?>?type=os"> Other Services</a></li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                </li>
                                <li><a href="helpmebook-new.php">Help me book</a></li>
                                <li><a href="aboutus.php">About us</a></li>
                            </ul>
                        </div>
                    </nav>
                    <!-- Main Menu End-->
                    <div class="outer-box">

                        <nav class="main-menu">
                            <div class="navbar-header">
                                <!-- Toggle Button -->
                                <button type="button" class="navbar-toggle" data-toggle="collapse"
                                        data-target="#bs-example-navbar-collapse-1">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>

                            <div class="navbar-collapse collapse clearfix" id="bs-example-navbar-collapse-1">
                                <ul class="navigation clearfix">
                                    <li class="dropdown"><a href="#">Book New Ad</a>
                                        <ul>
                                            <li><a href="book-new.php?type=radio">Radio Advertising </a></li>
                                            <li><a href="book-new.php?type=tv">Tv Channel Advertising</a></li>
                                            <li><a href="book-new.php?type=print">Print Advertising</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </nav>

                    </div>

                    <!-- Hidden Nav Toggler -->
                    <div class="nav-toggler">
                        <button class="hidden-bar-opener"><span class="icon qb-menu1"></span></button>
                    </div>

                </div>
            </div>
        </div>
        <!--End Header Lower-->

        <!--Sticky Header-->
        <div class="sticky-header">
            <div class="auto-container clearfix">
                <!--Logo-->
                <div class="logo pull-left">
                    <a href="/" class="img-responsive" title=""></a>
                </div>

                <!--Right Col-->
                <div class="right-col pull-right">
                    <!-- Main Menu -->
                    <nav class="main-menu">
                        <div class="navbar-header">
                            <!-- Toggle Button -->
                            <button type="button" class="navbar-toggle" data-toggle="collapse"
                                    data-target=".navbar-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>

                        <div class="navbar-collapse collapse clearfix">
                            <ul class="navigation clearfix">
                                <li><a href="/">Home</a></li>
                                <li class="dropdown"><a href="#">Book Ads In</a>
                                    <ul>
                                        <?php
                                        if (isset($_GET['type'])) {
                                            $type = $_GET['type'];
                                            $_SESSION['type'] = $type;
                                        if (!empty($type)) {

                                        switch ($type) {
                                            case 'radio':
                                                $_SESSION['mediatype'] = 2;
                                                require 'sales.php';

                                                break;
                                            case 'print':
                                                $_SESSION['mediatype'] = 1;
                                                require 'sales.php';

                                                break;

                                            case 'board':
                                                $_SESSION['mediatype'] = 4;
                                                require 'sales.php';

                                                break;


                                            case 'dj':
                                                $_SESSION['mediatype'] = 5;
                                                require 'sales.php';
                                                break;

                                            case 'os':
                                                $_SESSION['mediatype'] = 6;
                                                require 'sales.php';
                                                break;

                                            case 'tv':
                                                $_SESSION['mediatype'] = 3;
                                                require 'sales.php';

                                                break;

                                        default:
                                            ?>
                                            <script>
                                                window.location = "http://www.demosunited.com/board";
                                            </script>
                                        <?php
                                        break;
                                        }

                                        }
                                        }
                                        else
                                        {
                                        ?>
                                            <li><a href="<?php echo($Action); ?>?type=radio">Radio Advertising </a></li>
                                            <li><a href="<?php echo($Action); ?>?type=tv">Tv Advertising</a></li>
                                            <li><a href="<?php echo($Action); ?>?type=print">Print Advertising</a></li>
                                            <li><a href="<?php echo($Action); ?>?type=board">Outdoor Advertising</a>
                                            </li>
                                            <li><a href="<?php echo($Action); ?>?type=dj"> DJ Services</a></li>
                                            <li><a href="<?php echo($Action); ?>?type=os"> Other Services</a></li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                </li>
                                <li><a href="helpmebook-new.php">Help me book</a></li>
                                <li><a href="aboutus.php">About us</a></li>
                            </ul>
                        </div>
                    </nav><!-- Main Menu End-->
                </div>

            </div>
        </div>
        <!--End Sticky Header-->

    </header>
    <!--End Header Style Two -->

    <!-- Hidden Navigation Bar -->
    <section class="hidden-bar left-align">

        <div class="hidden-bar-closer">
            <button><span class="qb-close-button"></span></button>
        </div>

        <!-- Hidden Bar Wrapper -->
        <div class="hidden-bar-wrapper">
            <div class="logo">
                <a href="/"></a>
            </div>
            <!-- .Side-menu -->
            <div class="side-menu">
                <!--navigation-->
                <ul class="navigation clearfix">
                    <li><a href="/">Home</a></li>
                    <li class="dropdown"><a href="#">Book Ads In</a>
                        <ul>
                            <?php
                            if (isset($_GET['type'])) {
                                $type = $_GET['type'];
                                $_SESSION['type'] = $type;
                            if (!empty($type)) {

                            switch ($type) {
                                case 'radio':
                                    $_SESSION['mediatype'] = 2;
                                    require 'sales.php';

                                    break;
                                case 'print':
                                    $_SESSION['mediatype'] = 1;
                                    require 'sales.php';

                                    break;

                                case 'board':
                                    $_SESSION['mediatype'] = 4;
                                    require 'sales.php';

                                    break;


                                case 'dj':
                                    $_SESSION['mediatype'] = 5;
                                    require 'sales.php';
                                    break;

                                case 'os':
                                    $_SESSION['mediatype'] = 6;
                                    require 'sales.php';
                                    break;

                                case 'tv':
                                    $_SESSION['mediatype'] = 3;
                                    require 'sales.php';

                                    break;

                            default:
                                ?>
                                <script>
                                    window.location = "http://www.demosunited.com/board";
                                </script>
                            <?php
                            break;
                            }

                            }
                            }
                            else
                            {
                            ?>
                                <li><a href="<?php echo($Action); ?>?type=radio">Radio Advertising </a></li>
                                <li><a href="<?php echo($Action); ?>?type=tv">Tv Advertising</a></li>
                                <li><a href="<?php echo($Action); ?>?type=print">Print Advertising</a></li>
                                <li><a href="<?php echo($Action); ?>?type=board">Outdoor Advertising</a></li>
                                <li><a href="<?php echo($Action); ?>?type=dj"> DJ Services</a></li>
                                <li><a href="<?php echo($Action); ?>?type=os"> Other Services</a></li>
                                <?php
                            }
                            ?>
                        </ul>
                    </li>
                    <li><a href="helpmebook-new.php">Help me book</a></li>
                    <li><a href="aboutus.php">About us</a></li>
                </ul>
            </div>
            <!-- /.Side-menu -->

            <!--Options Box-->
            <div class="options-box">
                <!--Sidebar Search-->
                <div class="sidebar-search">
                    <form method="post" action="#">
                        <div class="form-group">
                            <input type="search" name="text" value="" placeholder="Search ..." required="">
                            <button type="submit" class="theme-btn"><span class="fa fa-search"></span></button>
                        </div>
                    </form>
                </div>

                <!--Mobile Cart-->
                <div class="mobile-cart">
                    <a href="#" class="clearfix">
                        <div class="pull-left">
                            <div class="text">0 items 0.00$</div>
                        </div>
                        <div class="pull-right">
                            <span class="icon fa fa-shopping-cart"></span>
                        </div>
                    </a>
                </div>

                <!--Language Dropdown-->
                <!--                <div class="language dropdown"><a class="btn btn-default dropdown-toggle" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" href="#"> English <span class="icon fa fa-angle-down"></span></a>-->
                <!--                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">-->
                <!--                        <li><a href="#">English</a></li>-->
                <!--                        <li><a href="#">German</a></li>-->
                <!--                        <li><a href="#">Arabic</a></li>-->
                <!--                        <li><a href="#">Hindi</a></li>-->
                <!--                    </ul>-->
                <!--                </div>-->

                <!--Social Links-->
                <ul class="social-links clearfix">
                    <li><a href="#"><span class="fa fa-facebook-f"></span></a></li>
                    <li><a href="#"><span class="fa fa-twitter"></span></a></li>
                    <li><a href="#"><span class="fa fa-instagram"></span></a></li>
                    <li><a href="#"><span class="fa fa-pinterest"></span></a></li>
                </ul>

            </div>

        </div><!-- / Hidden Bar Wrapper -->

    </section>
    <!-- End / Hidden Bar -->

    <!--Sidebar Page Container-->
    <div class="sidebar-page-container">
        <div class="auto-container">
            <div class="row clearfix">
                <!--Content Side-->
                <div class="content-side col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="economics-category">
                        <!--Skill Section-->
                        <div class="skill-section grey-bg">
                            <div class="auto-container">
                                <div class="row clearfix">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="text" style="text-align: center;">
                                            <h2><strong>Learn How To Book A Slot :</strong></h2><br>
                                            <h3>Size of Slots ?</h3><br>
                                            <p>
                                                Your size of slot is the maximum duration of your broadcast and is
                                                normally for 15, 30 ,45or 60 seconds for Radio and Television but can
                                                change dependant on your media provider. If you require a mixture of
                                                slots you must create a new booking for each size.
                                            </p><br>

                                            <h3>Number of Slots</h3><br>
                                            <p>
                                                Enter a number up to any maximum . Each slot needs to be allocated a
                                                broadcast date and an optional “Time of Day”.
                                            </p><br>

                                            <h3>Size of Slots ?</h3><br>
                                            <p>
                                                Your size of slot is the maximum duration of your broadcast and is
                                                normally for 15, 30 ,45or 60 seconds for Radio and Television but can
                                                change dependant on your media provider. If you require a mixture of
                                                slots you must create a new booking for each size.
                                            </p><br>

                                            <h3>Discount on Price ? ?</h3><br>
                                            <p>
                                                Your discount on price is given as a % off the total amount payable for
                                                your booking. Where we can this does result in an additional saving of
                                                up to 25% on the price we offer. Please note that our price is already
                                                below the best
                                            </p><br>

                                            <h3>Size of Slots ?</h3><br>
                                            <p>
                                                Your size of slot is the maximum duration of your broadcast and is
                                                normally for 15, 30 ,45or 60 seconds for Radio and Television but can
                                                change dependant on your media provider. If you require a mixture of
                                                slots you must create a new booking for each size.
                                            </p><br>

                                            <h3>Your Price per Slot</h3><br>
                                            <p>
                                                Your Price per Slot normally reduces based on the number of slots
                                                selected and the discount given. The amount shown is calculated using
                                                the single slot price, discount and number of slots .
                                            </p><br>

                                            <h3>Comparison Price ?</h3><br>
                                            <p>
                                                The Comparison Price is the price that we would have to pay for the
                                                identical or similar item based on our last known data. If you are able
                                                to find a more current and competitive comparisons then please let us
                                                know. We constantly revise our details to remain competitive.
                                            </p><br>

                                            <h3>Saving ?</h3><br>
                                            <p>
                                                The Saving is the real savings you receive as a paid up member of Media
                                                United. We at Media United have with united with our partners, the Media
                                                Providers. They allow us to purchase space sold at a premium rate to the
                                                public. We through our affiliations with business owners and
                                                organisations sell at a discount to you. This discount is the saving you
                                                make in using our service.
                                            </p><br>

                                            <h3>Specify Date(s)</h3><br>
                                            <p>
                                                This is the date(s) you would like your advertisement to be broadcast
                                                and must equal the Number of Slots selected. Where the date selected is
                                                before the earliest deadline date for broadcast you should reselect a
                                                future date. Each Media Provider has a Deadline Date for every broadcast
                                                that is stated in their profile.
                                            </p><br>

                                            <h3>Optional: Specify Time of Day ?</h3><br>
                                            <p>
                                                This “Optional: Specify Time of Day” is a suggested time slot for the
                                                production to be broadcast. The Media Provider is under no obligation to
                                                comply but it is helpful in allocating a preferred time . Securing a
                                                specific time may be available by contacting the Media Provider direct
                                                and may attract additional costs.
                                            </p><br>

                                            <h3>Deadline Date(s) ? </h3><br>
                                            <p>
                                                This is the date(s) your advertisement in its final acceptable format to
                                                be broadcast must be with the Media Provider to ensure broadcast is
                                                possible. Please note that Media United will NOT be liable for failure
                                                to adhere to this stipulation
                                            </p><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End Skill Section-->

                    </div>
                    <!--End Category-->

                </div>

            </div>

        </div>
    </div>
    <!--End Sidebar Page Container-->

    <!--Main Footer-->
    <footer class="main-footer">
        <!--Footer Bottom-->
        <div class="footer-bottom">
            <div class="auto-container">
                <div class="row clearfix">
                    <!--Column-->
                    <div class="column col-md-3 col-sm-12 col-xs-12">
                        <div class="logo">
                            <a href="/"></a>
                        </div>
                    </div>
                    <!--Column-->
                    <div class="column col-md-6 col-sm-12 col-xs-12">
                        <div class="text">
                            Media United specialises in providing a “One Stop Shop” that allows your advertising to be
                            placed across Radio, Television , Print, Outdoor and Other Services in an instant. We have
                            1000’s of individuals and businesses who appreciate affordable advertising. Our Media
                            Packages allow advertising across all media at crazy prices.
                        </div>
                    </div>
                    <!--Column-->
                    <div class="column col-md-3 col-sm-12 col-xs-12">
                        <ul class="social-icon-one">
                            <li><a href="#"><span class="fa fa-facebook"></span></a></li>
                            <li class="twitter"><a href="#"><span class="fa fa-twitter"></span></a></li>
                            <li class="g_plus"><a href="#"><span class="fa fa-google-plus"></span></a></li>
                            <li class="linkedin"><a href="#"><span class="fa fa-linkedin"></span></a></li>
                            <li class="pinteret"><a href="#"><span class="fa fa-pinterest-p"></span></a></li>
                            <li class="android"><a href="#"><span class="fa fa-android"></span></a></li>
                            <li class="dribbble"><a href="#"><span class="fa fa-dribbble"></span></a></li>
                            <li class="rss"><a href="#"><span class="fa fa-rss"></span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--Copyright Section-->
            <div class="copyright-section">
                <div class="auto-container">
                    <div class="row clearfix">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <ul class="footer-nav">
                                <li><a href="/">Home</a></li>
                                <li><a href="helpmebook-new.php">Help me book</a></li>
                                <li><a href="aboutus.php">About us</a></li>
                            </ul>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="copyright">&copy; Media United 2016 | Website by Presidential Ideas</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--End Main Footer-->

</div>
<!--End pagewrapper-->

<!--Scroll to top-->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="icon fa fa-angle-double-up"></span></div>

<script src="assets/js/jquery.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.fancybox.pack.js"></script>
<script src="assets/js/jquery.fancybox-media.js"></script>
<script src="assets/js/owl.js"></script>
<script src="assets/js/appear.js"></script>
<script src="assets/js/wow.js"></script>
<script src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="assets/js/script.js"></script>
<script src="assets/js/color-settings.js"></script>

</body>

</html>
