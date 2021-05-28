<?php
    switch($currentWebPage){
        case 'home':
            $title = 'Home';
            break;
        case 'about':
            $title = 'About';
            break;
        case 'products':
            $title = 'Our Products';
            break;
        case 'shop':
            $title = 'Shop';
            break;
        case 'gallery':
            $title = 'Gallery';
            break;
        case 'news':
            $title = 'News';
            break;
        case 'contact':
            $title = 'Contact Us';
            break;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="description" content="">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <!-- Title -->
  <title>Green Crop | <?php echo $title; ?></title>
  <!-- Favicon -->
  <link rel="icon" href="img/core-img/favicon.ico">
  <!-- Core Stylesheet -->
  <link rel="stylesheet" href="style.css"> 
</head>

<body>
    <!-- Preloader -->
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="spinner"></div>
    </div>

    <!-- ##### Header Area Start ##### -->
   

        <!-- Navbar Area -->
        <div class="famie-main-menu">
        <div class="classy-nav-container breakpoint-off">
            <div class="container">
            <!-- Menu -->
            <nav class="classy-navbar justify-content-between" id="famieNav">
                <!-- Nav Brand -->
                <h1><font color="brown" ><center>GREEN CROP </center></font> </h1>
                <!-- Navbar Toggler -->
                <div class="classy-navbar-toggler">
                <span class="navbarToggler"><span></span><span></span><span></span></span>
                </div>
                <!-- Menu -->
                <div class="classy-menu">
                <!-- Close Button -->
                <div class="classycloseIcon">
                    <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                </div>
                <!-- Navbar Start -->
                <div class="classynav">
                    <ul>
                        <li class="<?php if($currentWebPage =='home'){echo 'active';}?>"><a href="index.php">Home</a></li>
                        <li class="<?php if($currentWebPage =='about'){echo 'active';}?>"><a href="views/about.php">About</a></li>
                        <li class="<?php if($currentWebPage =='products'){echo 'active';}?>"><a href="views/our-product.php">Our Products</a></li>
                        <li class="<?php if($currentWebPage =='shop'){echo 'active';}?>"><a href="views/shop.php">Shop</a></li>
                        <li class="<?php if($currentWebPage =='gallery'){echo 'active';}?>"><a href="views/gallery.php">Gallery</a></li>
                        <li class="<?php if($currentWebPage =='news'){echo 'active';}?>"><a href="views/news.php">News</a></li>
                        <li class="<?php if($currentWebPage =='contact'){echo 'active';}?>"><a href="views/contact.php">Contact</a></li>
                        <li><a href="../views/login.php">Login</a></li>
                    </ul>
                </div>
                <!-- Navbar End -->
                </div>
            </nav>

            <!-- Search Form -->
            <div class="search-form">
                <form action="#" method="get">
                <input type="search" name="search" id="search" placeholder="Type keywords &amp; press enter...">
                <button type="submit" class="d-none"></button>
                </form>
                <!-- Close Icon -->
                <div class="closeIcon"><i class="fa fa-times" aria-hidden="true"></i></div>
            </div>
            </div>
        </div>
        </div>
    </header>
    <!-- ##### Header Area End ##### -->
        
</body>
</html>
