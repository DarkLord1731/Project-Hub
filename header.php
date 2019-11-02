<?php include 'database.php'?>
<?php 
session_start();
$categories = get_category_list();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//ENhttp://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Project Hub</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="/img/favicon.png">

    <!-- CSS here -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/css/magnific-popup.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/themify-icons.css">
    <link rel="stylesheet" href="/css/nice-select.css">
    <link rel="stylesheet" href="/css/flaticon.css">
    <link rel="stylesheet" href="/css/gijgo.css">
    <link rel="stylesheet" href="/css/animate.css">
    <link rel="stylesheet" href="/css/slicknav.css">
    <link rel="stylesheet" href="/css/style.css">
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->
</head>

<body>
    <!-- header-start -->
    <header>
        <div class="header-area ">
            <div id="sticky-header" class="main-header-area">
                <div class="container-fluid p-0">
                    <div class="row align-items-center no-gutters">
                        <div class="col-xl-2 col-lg-2">
                            <div class="logo-img">
                                <a href="/index.html">
                                    <img src="/img/logo.png" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-7 col-lg-7">
                            <div class="main-menu  d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">
                                        <li><a href="/index.html">Home</a></li>
                                        <li><a href="#">Projects <i class="ti-angle-down"></i></a>
                                            <ul class="submenu">
                                            <?php foreach($categories as $category):?>
                                                <li>
                                                    <a href="/category/<?php echo $category['id']?>/<?php echo preg_replace('/\s+/', '-', $category['name'])?>"><?php echo $category['name']?></a>
                                                </li>
                                            <?php endforeach?>
                                            </ul>
                                        </li>
                                        <li><a href="/about.html">About</a></li>
                                        <li><a href="/contact.html">Contact</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 d-none d-lg-block">
                            <div class="log_chat_area d-flex align-items-center">
                                <?php if(isset($_SESSION['signed_in']) && $_SESSION['signed_in']):?>
                                    <a class="login"><i class="flaticon-user"></i><span><?php echo $_SESSION['user_name']?></span></a>
                                    <a href="/signout.php" class="login"><span>Sign Out</span></a>
                                <?php else:?>
                                    <a href="#test-form" class="login popup-with-form"><span>Sign In</span></a>
                                <?php endif?>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header-end -->

    <!-- form itself end-->
    <form id="test-form" class="white-popup-block mfp-hide" method="POST" action="/signin.php">
        <div class="popup_box ">
            <div class="popup_inner">
                <div class="logo text-center">
                    <a href="#">
                        <img src="/img/form-logo.png" alt="">
                    </a>
                </div>
                <h3>Sign in</h3>
                <form method="POST" action="/signin.php">
                    <div class="row">
                        <div class="col-xl-12 col-md-12">
                            <input type="text" name="email" placeholder="Email" required="true">
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <input type="password" name="password" placeholder="Password" required="true">
                        </div>
                        <div class="col-xl-12">
                            <button type="submit" class="boxed_btn_orange">Sign in</button>
                        </div>
                    </div>
                </form>
                <p class="doen_have_acc">Don’t have an account? <a class="dont-hav-acc" href="#test-form2">Sign Up</a></p>
            </div>
        </div>
    </form>
    <!-- form itself end -->

    <!-- form itself end-->
    <form id="test-form2" class="white-popup-block mfp-hide" method="POST" action="/signup.php">
        <div class="popup_box ">
            <div class="popup_inner">
                <div class="logo text-center">
                    <a href="#">
                        <img src="/img/form-logo.png" alt="">
                    </a>
                </div>
                <h3>Resistration</h3>
                <form>
                    <div class="row">
                        <div class="col-xl-12 col-md-12">
                            <input type="text" name="username" placeholder="Username" required="true">
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <input type="email" name="email" placeholder="Email" required="true">
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <input type="password" name="password" placeholder="Password" required="true">
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <input type="Password" name="password_check" placeholder="Confirm password" required="true">
                        </div>
                        <div class="col-xl-12">
                            <button type="submit" class="boxed_btn_orange">Sign Up</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </form>
    <!-- form itself end -->