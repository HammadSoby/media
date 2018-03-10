<?php
error_reporting(E_ERROR);
session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Media United | Home</title>
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
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
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
                                        if(isset($_GET['type']))
                                        {
                                            $type=$_GET['type'];
                                            $_SESSION['type']=$type;
                                            if(!empty($type)){

                                                switch ($type) {
                                                    case 'radio':
                                                        $_SESSION['mediatype']=	2;
                                                        require'sales.php';

                                                        break;
                                                    case 'print':
                                                        $_SESSION['mediatype']=	1;
                                                        require'sales.php';

                                                        break;

                                                    case 'board':
                                                        $_SESSION['mediatype']=	4;
                                                        require'sales.php';

                                                        break;


                                                    case 'dj':
                                                        $_SESSION['mediatype']=	5;
                                                        require'sales.php';
                                                        break;

                                                    case 'os':
                                                        $_SESSION['mediatype']=	6;
                                                        require'sales.php';
                                                        break;

                                                    case 'tv':
                                                        $_SESSION['mediatype']=	3;
                                                        require'sales.php';

                                                        break;

                                                    default:
                                                        ?>
                                                        <script>
                                                            window.location="http://www.demosunited.com/board";
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
                    </nav>
                    <!-- Main Menu End-->
                    <div class="outer-box">

                        <!--Cart Box-->
                        <div class="cart-box">
                            <div class="dropdown">
                                <button class="cart-box-btn dropdown-toggle" type="button" id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-shopping-cart"></span></button>
                                <div class="dropdown-menu pull-right cart-panel" aria-labelledby="dropdownMenu3">

                                    <div class="cart-product">
                                        <div class="inner">
                                            <div class="cross-icon"><span class="icon fa fa-remove"></span></div>
                                            <div class="image"><img src="assets/images/resource/post-thumb-3.jpg" alt="" /></div>
                                            <h3><a href="#">Woolen T-shirt</a></h3>
                                            <div class="quantity-text">Quantity 1</div>
                                            <div class="price">$99.00</div>
                                        </div>
                                    </div>
                                    <div class="cart-product">
                                        <div class="inner">
                                            <div class="cross-icon"><span class="icon fa fa-remove"></span></div>
                                            <div class="image"><img src="assets/images/resource/post-thumb-4.jpg" alt="" /></div>
                                            <h3><a href="#">Woolen T-shirt</a></h3>
                                            <div class="quantity-text">Quantity 1</div>
                                            <div class="price">$99.00</div>
                                        </div>
                                    </div>
                                    <div class="cart-total">Sub Total: <span>$198</span></div>
                                    <ul class="btns-boxed">
                                        <li><a href="#">View Cart</a></li>
                                        <li><a href="#">CheckOut</a></li>
                                    </ul>

                                </div>
                            </div>
                        </div>

                        <!--Search Box-->
                        <div class="search-box-outer">
                            <div class="dropdown">
                                <button class="search-box-btn dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-search"></span></button>
                                <ul class="dropdown-menu pull-right search-panel" aria-labelledby="dropdownMenu1">
                                    <li class="panel-outer">
                                        <div class="form-container">
                                            <form method="post" action="http://ninzio.com/html/quebec/blog.html">
                                                <div class="form-group">
                                                    <input type="search" name="field-name" value="" placeholder="Search Here" required>
                                                    <button type="submit" class="search-btn"><span class="fa fa-search"></span></button>
                                                </div>
                                            </form>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

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
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
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
                                        if(isset($_GET['type']))
                                        {
                                            $type=$_GET['type'];
                                            $_SESSION['type']=$type;
                                        if(!empty($type)){

                                        switch ($type) {
                                            case 'radio':
                                                $_SESSION['mediatype']=	2;
                                                require'sales.php';

                                                break;
                                            case 'print':
                                                $_SESSION['mediatype']=	1;
                                                require'sales.php';

                                                break;

                                            case 'board':
                                                $_SESSION['mediatype']=	4;
                                                require'sales.php';

                                                break;


                                            case 'dj':
                                                $_SESSION['mediatype']=	5;
                                                require'sales.php';
                                                break;

                                            case 'os':
                                                $_SESSION['mediatype']=	6;
                                                require'sales.php';
                                                break;

                                            case 'tv':
                                                $_SESSION['mediatype']=	3;
                                                require'sales.php';

                                                break;

                                        default:
                                            ?>
                                            <script>
                                                window.location="http://www.demosunited.com/board";
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
                            if(isset($_GET['type']))
                            {
                                $type=$_GET['type'];
                                $_SESSION['type']=$type;
                            if(!empty($type)){

                            switch ($type) {
                                case 'radio':
                                    $_SESSION['mediatype']=	2;
                                    require'sales.php';

                                    break;
                                case 'print':
                                    $_SESSION['mediatype']=	1;
                                    require'sales.php';

                                    break;

                                case 'board':
                                    $_SESSION['mediatype']=	4;
                                    require'sales.php';

                                    break;


                                case 'dj':
                                    $_SESSION['mediatype']=	5;
                                    require'sales.php';
                                    break;

                                case 'os':
                                    $_SESSION['mediatype']=	6;
                                    require'sales.php';
                                    break;

                                case 'tv':
                                    $_SESSION['mediatype']=	3;
                                    require'sales.php';

                                    break;

                            default:
                                ?>
                                <script>
                                    window.location="http://www.demosunited.com/board";
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

    <!--Main Slider Two-->
    <section class="main-slider-two">
        <div class="single-item-carousel owl-carousel owl-theme">

            <!--Slide-->
            <div class="slide">
                <div class="clearfix">
                    <!--Slide Column-->
                    <div class="slide-column col-md-6 col-sm-12 col-xs-12">
                        <!--News Block Three-->
                        <div class="news-block-three style-two">
                            <div class="inner-box">
                                <div class="image">
                                    <img class="wow fadeIn" data-wow-delay="0ms" data-wow-duration="2500ms" src="assets/images/resource/radio.jpg" alt="" />
                                    <div class="overlay-box">
                                        <div class="content">
                                            <div class="tag"><a href="<?php echo($Action); ?>?type=radio">Get Started</a></div>
                                            <h3><a href="<?php echo($Action); ?>?type=radio">Radio Advertising</a></h3>
<!--                                            <ul class="post-meta">-->
<!--                                                <li><span class="icon qb-clock"></span>March 17, 2016</li>-->
<!--                                                <li><span class="icon fa fa-comment-o"></span>9</li>-->
<!--                                                <li><span class="icon qb-eye"></span>2470</li>-->
<!--                                            </ul>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Slide Column-->
                    <div class="slide-column col-md-6 col-sm-12 col-xs-12">
                        <div class="row clearfix">
                            <div class="inner-slide col-md-12 col-sm-12 col-xs-12">
                                <!--News Block Three-->
                                <div class="news-block-three style-three">
                                    <div class="inner-box">
                                        <div class="image">
                                            <img class="wow fadeIn" data-wow-delay="0ms" data-wow-duration="2500ms" src="assets/images/resource/tv.jpg" alt="" />
                                            <div class="overlay-box">
                                                <div class="content">
                                                    <div class="tag"><a href="<?php echo($Action); ?>?type=tv">Get Started</a></div>
                                                    <h3><a href="<?php echo($Action); ?>?type=tv">TV Advertising</a></h3>
<!--                                                    <ul class="post-meta">-->
<!--                                                        <li><span class="icon qb-clock"></span>March 17, 2016</li>-->
<!--                                                        <li><span class="icon fa fa-comment-o"></span>9</li>-->
<!--                                                        <li><span class="icon qb-eye"></span>2470</li>-->
<!--                                                    </ul>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="inner-slide col-md-6 col-sm-6 col-xs-12">
                                <!--News Block Three-->
                                <div class="news-block-three style-four">
                                    <div class="inner-box">
                                        <div class="image">
                                            <img class="wow fadeIn" data-wow-delay="0ms" data-wow-duration="2500ms" src="assets/images/resource/news_paper.jpg" alt="" />
                                            <div class="overlay-box">
                                                <div class="content">
                                                    <div class="tag"><a href="<?php echo($Action); ?>?type=print">Get Started</a></div>
                                                    <h3><a href="<?php echo($Action); ?>?type=print">Print Advertising</a></h3>
<!--                                                    <ul class="post-meta">-->
<!--                                                        <li><span class="icon qb-clock"></span>March 17, 2016</li>-->
<!--                                                        <li><span class="icon fa fa-comment-o"></span>9</li>-->
<!--                                                        <li><span class="icon qb-eye"></span>2470</li>-->
<!--                                                    </ul>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="inner-slide col-md-6 col-sm-6 col-xs-12">
                                <!--News Block Three-->
                                <div class="news-block-three style-four">
                                    <div class="inner-box">
                                        <div class="image">
                                            <img class="wow fadeIn" data-wow-delay="0ms" data-wow-duration="2500ms" src="assets/images/resource/outdoor.jpg" alt="" />
                                            <div class="overlay-box">
                                                <div class="content">
                                                    <div class="tag"><a href="<?php echo($Action); ?>?type=board">Get Started</a></div>
                                                    <h3><a href="<?php echo($Action); ?>?type=board">Outdoor Advertising</a></h3>
<!--                                                    <ul class="post-meta">-->
<!--                                                        <li><span class="icon qb-clock"></span>March 17, 2016</li>-->
<!--                                                        <li><span class="icon fa fa-comment-o"></span>9</li>-->
<!--                                                        <li><span class="icon qb-eye"></span>2470</li>-->
<!--                                                    </ul>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>
    <!--End Main Slider Two-->

    <!--Sidebar Page Container-->
    <div class="sidebar-page-container">
        <div class="auto-container">
            <div class="row clearfix">

                <!--Content Side-->
                <div class="content-side col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <!--Economics Blog Boxed-->
                    <div class="economics-category">
                        <!--Skill Section-->
                        <div class="skill-section grey-bg">
                            <div class="auto-container">
                                <div class="row clearfix">
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <div class="text">
                                            <h2><strong>What We Do?</strong></h2><br>
                                            <h4>We work to get you the lowest quotes for your advertising requirements. Traditional costs are reduced by our &ldquo;self-serve&rdquo; and &ldquo;one-stop-shop&rdquo; service.</h4><br>
                                            <p>Media United is an online website for people to buy advertising spaces across available media platforms i.e. Radio, Television, Newspapers, Magazines, Outdoor Advertising ( Billboards, Railway and Underground, Supermarkets, Buses, Telephone Boxes etc) and other services i.e. Printing and Media Production.</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <!--Progress Levels-->
                                        <div class="skill-progress">
                                            <iframe width="100%" height="300" src="https://www.youtube.com/embed/049hkBQncyc?feature=oembed" frameborder="0" allowfullscreen></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End Skill Section-->

                    </div>
                    <!--End Category-->

                    <!--Latest News-->
<!--                    <div class="latest-news-section">-->
<!--                        <!--Sec Title-->
<!--                        <div class="sec-title">-->
<!--                            <h2>Latest News</h2>-->
<!--                        </div>-->
<!--                        <div class="row clearfix">-->
<!---->
<!--                            <!--News Block Two-->
<!--                            <div class="news-block-two with-margin col-md-6 col-sm-6 col-xs-12">-->
<!--                                <div class="inner-box">-->
<!--                                    <div class="image">-->
<!--                                        <a href="blog-single.html"><img class="wow fadeIn" data-wow-delay="0ms" data-wow-duration="2500ms" src="assets/images/resource/news-5.jpg" alt="" /></a>-->
<!--                                        <div class="category"><a href="blog-single.html">Sports</a></div>-->
<!--                                    </div>-->
<!--                                    <div class="lower-box">-->
<!--                                        <h3><a href="blog-single.html">Wooden skyscrapers are springing up across the world universal</a></h3>-->
<!--                                        <ul class="post-meta">-->
<!--                                            <li><span class="icon fa fa-clock-o"></span>March 01, 2016</li>-->
<!--                                            <li><span class="icon fa fa-comment-o"></span>7</li>-->
<!--                                            <li><span class="icon fa fa-eye"></span>2740</li>-->
<!--                                        </ul>-->
<!--                                        <div class="text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit doli. Aenean commodo ligula eget dolor. Aenean massa. Cumtipsu sociis natoque penatibus et magnis dis montesti, nascetur ridiculus mus. Donec quam…</div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!---->
<!--                            <!--News Block Two-->
<!--                            <div class="news-block-two with-margin col-md-6 col-sm-6 col-xs-12">-->
<!--                                <div class="inner-box">-->
<!--                                    <div class="image">-->
<!--                                        <a href="blog-single.html"><img class="wow fadeIn" data-wow-delay="0ms" data-wow-duration="2500ms" src="assets/images/resource/news-21.jpg" alt="" /></a>-->
<!--                                        <div class="category"><a href="blog-single.html">Design</a></div>-->
<!--                                    </div>-->
<!--                                    <div class="lower-box">-->
<!--                                        <h3><a href="blog-single.html">Does this doctor hold the secret to ending malaria applications?</a></h3>-->
<!--                                        <ul class="post-meta">-->
<!--                                            <li><span class="icon fa fa-clock-o"></span>March 04, 2016</li>-->
<!--                                            <li><span class="icon fa fa-comment-o"></span>4</li>-->
<!--                                            <li><span class="icon fa fa-eye"></span>5740</li>-->
<!--                                        </ul>-->
<!--                                        <div class="text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit doli. Aenean commodo ligula eget dolor. Aenean massa. Cumtipsu sociis natoque penatibus et magnis dis montesti, nascetur ridiculus mus. Donec quam…</div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!---->
<!--                            <!--News Block Two-->
<!--                            <div class="news-block-two with-margin col-md-6 col-sm-6 col-xs-12">-->
<!--                                <div class="inner-box">-->
<!--                                    <div class="image">-->
<!--                                        <a href="blog-single.html"><img class="wow fadeIn" data-wow-delay="0ms" data-wow-duration="2500ms" src="assets/images/resource/news-22.jpg" alt="" /></a>-->
<!--                                        <div class="category"><a href="blog-single.html">fashion</a></div>-->
<!--                                    </div>-->
<!--                                    <div class="lower-box">-->
<!--                                        <h3><a href="blog-single.html">The Hyperloop dream just got one step closer to universal reality</a></h3>-->
<!--                                        <ul class="post-meta">-->
<!--                                            <li><span class="icon fa fa-clock-o"></span>March 03, 2016</li>-->
<!--                                            <li><span class="icon fa fa-comment-o"></span>4</li>-->
<!--                                            <li><span class="icon fa fa-eye"></span>1740</li>-->
<!--                                        </ul>-->
<!--                                        <div class="text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit doli. Aenean commodo ligula eget dolor. Aenean massa. Cumtipsu sociis natoque penatibus et magnis dis montesti, nascetur ridiculus mus. Donec quam…</div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!---->
<!--                            <!--News Block Two-->
<!--                            <div class="news-block-two with-margin col-md-6 col-sm-6 col-xs-12">-->
<!--                                <div class="inner-box">-->
<!--                                    <div class="image">-->
<!--                                        <a href="blog-single.html"><img class="wow fadeIn" data-wow-delay="0ms" data-wow-duration="2500ms" src="assets/images/resource/news-23.jpg" alt="" /></a>-->
<!--                                        <div class="category"><a href="blog-single.html">tech</a></div>-->
<!--                                    </div>-->
<!--                                    <div class="lower-box">-->
<!--                                        <h3><a href="blog-single.html">Elon Musk's Hyperloop vision races toward first public test</a></h3>-->
<!--                                        <ul class="post-meta">-->
<!--                                            <li><span class="icon fa fa-clock-o"></span>March 04, 2016</li>-->
<!--                                            <li><span class="icon fa fa-comment-o"></span>9</li>-->
<!--                                            <li><span class="icon fa fa-eye"></span>3970</li>-->
<!--                                        </ul>-->
<!--                                        <div class="text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit doli. Aenean commodo ligula eget dolor. Aenean massa. Cumtipsu sociis natoque penatibus et magnis dis montesti, nascetur ridiculus mus. Donec quam…</div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!---->
<!--                            <!--News Block Two-->
<!--                            <div class="news-block-two with-margin col-md-6 col-sm-6 col-xs-12">-->
<!--                                <div class="inner-box">-->
<!--                                    <div class="image">-->
<!--                                        <a href="blog-single.html"><img class="wow fadeIn" data-wow-delay="0ms" data-wow-duration="2500ms" src="assets/images/resource/news-24.jpg" alt="" /></a>-->
<!--                                        <div class="category"><a href="blog-single.html">Politics</a></div>-->
<!--                                    </div>-->
<!--                                    <div class="lower-box">-->
<!--                                        <h3><a href="blog-single.html">A modern day security strategy for your computer antivirus</a></h3>-->
<!--                                        <ul class="post-meta">-->
<!--                                            <li><span class="icon fa fa-clock-o"></span>March 05, 2016</li>-->
<!--                                            <li><span class="icon fa fa-comment-o"></span>9</li>-->
<!--                                            <li><span class="icon fa fa-eye"></span>7420</li>-->
<!--                                        </ul>-->
<!--                                        <div class="text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit doli. Aenean commodo ligula eget dolor. Aenean massa. Cumtipsu sociis natoque penatibus et magnis dis montesti, nascetur ridiculus mus. Donec quam…</div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!---->
<!--                            <!--News Block Two-->
<!--                            <div class="news-block-two with-margin col-md-6 col-sm-6 col-xs-12">-->
<!--                                <div class="inner-box">-->
<!--                                    <div class="image">-->
<!--                                        <a href="blog-single.html"><img class="wow fadeIn" data-wow-delay="0ms" data-wow-duration="2500ms" src="assets/images/resource/news-25.jpg" alt="" /></a>-->
<!--                                        <div class="category"><a href="blog-single.html">Business</a></div>-->
<!--                                    </div>-->
<!--                                    <div class="lower-box">-->
<!--                                        <h3><a href="blog-single.html">Fix an Exchange Rate now with a  New Business Forward Contract App</a></h3>-->
<!--                                        <ul class="post-meta">-->
<!--                                            <li><span class="icon fa fa-clock-o"></span>March 06, 2016</li>-->
<!--                                            <li><span class="icon fa fa-comment-o"></span>4</li>-->
<!--                                            <li><span class="icon fa fa-eye"></span>5740</li>-->
<!--                                        </ul>-->
<!--                                        <div class="text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit doli. Aenean commodo ligula eget dolor. Aenean massa. Cumtipsu sociis natoque penatibus et magnis dis montesti, nascetur ridiculus mus. Donec quam…</div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!---->
<!--                        </div>-->
<!---->
<!--                        <!-- Styled Pagination -->
<!--                        <div class="styled-pagination">-->
<!--                            <ul class="clearfix">-->
<!--                                <li><a href="#" class="active">1</a></li>-->
<!--                                <li><a href="#">2</a></li>-->
<!--                                <li><a href="#">3</a></li>-->
<!--                                <li><a class="next" href="#"><span class="fa fa-angle-right"></span></a></li>-->
<!--                            </ul>-->
<!--                        </div>-->
<!---->
<!--                    </div>-->

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
                            Media United specialises in providing a “One Stop Shop” that allows your advertising to be placed across Radio, Television , Print, Outdoor and Other Services in an instant. We have 1000’s of individuals and businesses who appreciate affordable advertising. Our Media Packages allow advertising across all media at crazy prices.
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
