
<?php 
require_once('includes/connect.php');

if(isset($_POST['submit']))
{
	$name=($_POST['name']);
	$username=($_POST['username']);
	$password=base64_encode($_POST['password']);
	$mobileno=($_POST['mobileno']);
	$TempUsername=strtolower($username);

	$Sql=mysqli_query($connect,"SELECT COUNT(*) As Count from tblusers Where UPPER(username)='$TempUsername'");
	$data =mysqli_fetch_assoc($Sql);
	$mCount=$data['Count'];

	if($mCount>=1){
		echo "<script>alert('You are already Registered, Please Login');</script>";
	}

	else{

		$res=mysqli_query($connect,"SELECT ifnull(max(user_id),0) as user_id from tblusers");
		$datas =mysqli_fetch_assoc($res);
		$mMaxCode=$datas['user_id'];
		$mdcode= $mMaxCode+1000+1;
		$mCode=substr($mdcode,1);


		if($mCode>0){
			$query=mysqli_query($connect,"INSERT into tblusers(user_id,name,username,mobileno,password,usertype, regdt) 
				values('$mCode','$name','$username','$mobileno','$password', '051',now())");
		}
		header("Location:loginpage.php?success=1");  
	}
}
?>
<?php
include("includes/header.php");
?>
<?php
if((isset($_SESSION['user_id']) && $_SESSION['name'] != '' && $_SESSION['usertype']=='051')){
	header ("Location: index.php");
	die();
}
?>
<section class="breadcumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/breadcumb3.jpg);">
	<div class="bradcumbContent">
		<p>See what’s new</p>
		<h2>Sign Up</h2>
	</div>
</section>
<!-- ##### SignUp Area Start ##### -->
<section class="login-area section-padding-100">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12 col-lg-8">
				<div class="login-content">
					<!-- Login Form -->
					<div class="login-form">
						<form method="post" id="form">
							<div class="form-group">
								<label for="exampleInputName">Name</label>
								<input  class="form-control" required="1"  name="name" id="exampleInputName" aria-describedby="namehelp" placeholder="Enter Your Name">
							</div>
							<div class="form-group">
								<label for="exampleInputNumber">Mobile No.</label>
								<input type="text" required="1"  class="form-control"  name="mobileno" id="exampleInputNumber" aria-describedby="numberHelp" placeholder="Enter Mobile Number" maxlength="10">
								<small id="numberHelp" class="form-text text-muted"><i class="fa fa-lock mr-2"></i>We'll never share your number with anyone else.</small>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">User Id</label>
								<input type="text" required="1"  class="form-control"  name="username" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter User Id">
								<small id="emailHelp" class="form-text text-muted"><i class="fa fa-lock mr-2"></i>We'll never share your User Id with anyone else.</small>
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">Password</label>
								<input type="password" required="1" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
								<small id="emailHelp" class="form-text text-muted"><i class="fa fa-lock mr-2"></i>We'll never share your Password with anyone else.</small>
							</div>
							<input type="submit" name="submit" id="submit" class="btn oneMusic-btn mt-30" value="Submit" /> <br> <br>
							<a href="loginpage.php">Already a Member? Login In Now!!</a>
						</form>
						<?php
						if(isset($_GET['error_log'])){
							?>
							<div class="bg-danger text-white mt-30">Invalid Username or Password!</div>
							<?php
						}
						?>
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
<?php 
include("includes/footer.php")
?>