<?php
session_start();
if(!(isset($_SESSION['user_id']) && $_SESSION['name'] != ''||$_SESSION['image'] != ''  || $_SESSION['usertype']!='')){
    header ("Location: index.php");
    die();
}

?>
<?php 
require_once('includes/connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>Admin</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
     <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
</head>

<body class="bg-light">
    <div class="main-wrapper ">
        <div class="bg-dark header  shadow ">
            <div class="header-left">
                <a href="dashboard.php" class="logo">
                    <img src="upload_images/users/<?php echo $_SESSION['image']; ?>" width="35" height="35" alt=""> <span>admin</span>

                </a>
            </div>
            <a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i>&nbsp;<?php
                $today = date("F j, Y");
                echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Today '.$today;
                ?></a>
            <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
           <ul class="nav user-menu float-right">
               <!--- <li class="nav-item dropdown d-none d-sm-block">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"><i class="fa fa-bell-o"></i> <span class="badge badge-pill bg-danger float-right">3</span></a>
                  
                </li>--->
               <!--- <li class="nav-item dropdown d-none d-sm-block">
                    <a href="javascript:void(0);" id="open_msg_box" class="hasnotifications nav-link"><i class="fa fa-comment-o"></i> <span class="badge badge-pill bg-danger float-right">8</span></a>
                </li>-->
                <li class="nav-item dropdown has-arrow float-right">
                    <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <span class="user-img">
                            <img class="rounded-circle" src="upload_images/users/<?php echo $_SESSION['image']; ?>" width="24" alt="Admin">
                            <span class="status online"></span>
                        </span>
                             <span><?php echo $_SESSION['name']; ?></span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="edit-profile.php">Edit Profile</a>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu float-right">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="edit-profile.php">Edit Profile</a>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
            </div>
        </div>