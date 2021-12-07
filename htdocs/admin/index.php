<?php
require_once('includes/connect.php');
session_start();
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $check = mysqli_query($connect,"SELECT * FROM tblusers WHERE username = '$username' AND  password = '$password' AND usertype='050' And Status='001'") or die(mysql_error());
    if(mysqli_num_rows($check) >= 1){
        while($row = mysqli_fetch_array($check)){
            session_start();
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['usertype'] = $row['usertype'];
            $_SESSION['image'] = $row['image'];
            if($_SESSION['usertype']=='050'){
                header("Location:dashboard.php"); 
            }
            else{
               header("Location:../index.php"); 
           }

       }

   }else{
       header("Location:index.php?error_log=1");   
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>Admin Login</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>

<body style="background: #000;">
    <div class="main-wrapper account-wrapper bg-primary">
        <div class="account-page">
            <div class="account-center">
                <div class="account-box">
                    <form method="post" class="form-signin">
                        <div class="account-logo">
                            <a href="index.php"><h4 class="font-weight-bold">Admin Login</h4></a>
                        </div>
                        <div class="form-group shadow">
                            <label>Username</label>
                            <input type="text" name="username" id="username" placeholder="Enter Username" autofocus="" class="form-control">
                        </div>
                        <div class="form-group shadow">
                            <label>Password</label>
                            <input type="password" name="password" id="password" placeholder="Enter Password" class="form-control">
                        </div>
                        <div class="form-group text-center ">
                            <button type="submit" name="login" id="login" class="btn btn-dark account-btn shadow">Login</button>
                        </div>
                    </form>
                    <?php
                    if(isset($_GET['error_log'])){
                        ?>
                        <div class="bg-danger text-white mt-30 text-center">Invalid Username or Password!</div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>
</html>