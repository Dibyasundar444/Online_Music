<?php include("includes/header.php"); ?>
<?php
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $check = mysqli_query($connect,"SELECT * FROM tblusers WHERE username = '$username' AND  password = '".base64_encode($password)."' And usertype='051'") or die(mysql_error());
    if(mysqli_num_rows($check) >= 1){
        while($row = mysqli_fetch_array($check)){ 
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['usertype'] = $row['usertype'];
            header("Location:index.php"); 
            
        }

    }else{
       header("Location:loginpage.php?error_log=1");   
   }
}
?>
<section class="breadcumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/breadcumb3.jpg);">
    <div class="bradcumbContent">
        <p>See what’s new</p>
        <h2>Login</h2>
        <?php
        if(isset($_GET['error_log'])){
            ?>
            <div class="bg-danger text-white mt-30">Invalid Username or Password!</div>
            <?php
        }
        ?>
        <?php
        if(isset($_GET['success'])){
            ?>
            <div class="bg-success text-white mt-30">Successfully Registered!</div>
            <?php
        }
        ?>
    </div>
</section>
<!-- ##### Login Area Start ##### -->
<section class="login-area section-padding-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="login-content">
                    <h3>Welcome Back</h3>
                    <!-- Login Form -->
                    <div class="login-form">
                     <form method="post" id="form">
                         <div class="form-group">
                            <label for="exampleInputEmail1">User Id</label>
                            <input type="text" class="form-control"  name="username" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter User Id">
                            <small id="emailHelp" class="form-text text-muted"><i class="fa fa-lock mr-2"></i>We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
                        </div>
                        <input type="submit" name="login" id="login" class="btn oneMusic-btn mt-30" value="Login" /> <br> <br>
                        <a href="signup.php">Not a Member? Sign Up Now!!</a>
                    </form>
                </div>
            </div>
        </div><!--End Container-->
    </form>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- ##### Login Area End ##### -->
<?php 
include("includes/footer.php")
?>