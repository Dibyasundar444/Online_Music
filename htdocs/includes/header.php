
<?php 
session_start();
require_once('includes/connect.php');
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
    <title>Music</title>

    <!-- Favicon -->
    <link rel="icon" href="img/core-img/favicon.ico">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="style.css" type="text/css" media="all">



</head>
<body>
    <!-- Preloader -->
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="lds-ellipsis">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

    <!-- ##### Header Area Start ##### -->
    <header class="header-area">
        <!-- Navbar Area -->
        <div class="oneMusic-main-menu">
            <div class="classy-nav-container breakpoint-off">
                <div class="container">
                    <!-- Menu -->
                    <nav class="classy-navbar justify-content-between" id="oneMusicNav">

                        <!-- Nav brand -->
                        <a href="index.php" class="nav-brand">Music</a>

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

                            <!-- Nav Start -->
                            <div class="classynav">
                                <ul>
                                    <li><a href="index.php">Home</a></li>
                                    <li><a href="album.php">Albums</a></li>
                                   <!-- <li><a href="event.html">Events</a></li>--->
                                    <li><a href="aboutus.php">About Us</a></li>
                                    <?php if((isset($_SESSION['user_id']) && $_SESSION['name'] != ''&& $_SESSION['usertype']=='051' )){?>
                                    <li><a href="#">Profile</a>
                                        <ul class="dropdown">
                                            <li> <a href="profile.php">Hii,&nbsp;<?php echo $_SESSION['name']; ?></a>
                                            </li>
                                             <?php if((isset($_SESSION['user_id']) && $_SESSION['name'] != ''&& $_SESSION['usertype']=='051' )){?>  
                                        <li> <a href="logout.php">Logout</a></li>
                                     <?php } ?>
                                        <?php } else{ ?>
                                           <li> <a href="loginpage.php" id="loginBtn">Login / Register</a></li>
                                        <?php } ?>
                                    </ul>
                                </li>
                            </ul>
                         <!-- Nav End -->

                     </div>
                 </nav>
             </div>
         </div>
     </div>
 </header>

 <!-- ##### Header Area End ##### -->
