<?php
include("includes/header.php");
?>
<?php
if(!(isset($_SESSION['user_id']) && $_SESSION['name'] != ''&& $_SESSION['usertype']=='051' )){
	header ("Location: index.php");
	die();
}
?>
<?php
$id=$_SESSION['user_id'];
$qry = mysqli_query($connect,"select * from tblusers where user_id='$id'"); // select query
$data = mysqli_fetch_array($qry); // fetch data

if(isset($_POST['update']))
{
	$password=($_POST['password']);
	$query=mysqli_query($connect,"UPDATE tblusers Set password = '$password' WHERE user_id = '$id'");
	echo "<script>Password Updated Sucessfully</script>";
	header("Location:logout.php");
}
	?>

<section class="breadcumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/breadcumb3.jpg);">
	<div class="bradcumbContent">
		<h2>Update Profile</h2>
	</div>
</section>
<section class="login-area section-padding-100 ">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12 col-lg-8">
				<div class="login-content">
					<h3>Welcome <?php echo $data["name"]; ?></h3>
					<!-- Login Form -->
					<div class="login-form">
						<form method="post" id="form">
							<div class="form-group">
								<label for="exampleInputEmail1">Email address</label>
								<input  class="form-control"  name="username" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $data["username"]?>" readonly="true" placeholder="Enter E-mail">
								<small id="emailHelp" class="form-text text-muted"><i class="fa fa-lock mr-2"></i>We'll never share your email with anyone else.</small>
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">Password</label>
								<input type="password" value="<?php echo $data["password"]?>" class="form-control" name="password" id="exampleInputPassword1"  placeholder="Password">
							</div>
							<input type="submit" name="update" id="update" class="btn oneMusic-btn mt-30" value="Update" /> <br> <br>
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
include("includes/footer.php");
?>