<?php include('includes/header.php'); ?>

<?php
$page="dashboard.php";
$id=$_SESSION['user_id'];
?>
<?php 
if(isset($_POST['submit'])){

	$name = $_POST['name'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$Status = $_POST['Status'];
	$filename=$_FILES["image"]["name"];
	
	if($filename==""){

		$edit = mysqli_query($connect,"UPDATE tblusers SET name='$name', username='$username', password='$password', Status='$Status' where user_id='$id' And usertype='050'");
		if($edit){
        mysqli_close($connect); // Close connection
        echo "<script>alert('Succesfully Update Data!!!');window.location='edit-profile.php' </script>";
        $id =""; 
        exit;
    }
    else
    {
    	echo mysqli_error();
    } 
}
else{

	
	$ImageName =  'Adm-'.$id.'.'.pathinfo($filename, PATHINFO_EXTENSION);
	$target_dir = "upload_images/users/";
	$target_file = $target_dir . basename($ImageName);

	$edit = mysqli_query($connect,"UPDATE tblusers SET name='$name', username='$username', password='$password', Status='$Status',image='$ImageName' where user_id='$id' And usertype='050'");
	move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

	if($edit){
        mysqli_close($connect); // Close connection
        echo "<script>alert('Succesfully Update Data!!!');window.location='edit-profile.php' </script>";
        $id =""; 
        exit;
    }
    else
    {
    	echo mysqli_error();
    } 
}
}


?>

<?php include('includes/sidebar.php');?>
<div class="page-wrapper">
	<div class="content">
		<div class="row">
			<div class="col-sm-12">
				<h4 class="page-title">Edit Profile</h4>
			</div>
		</div>
		<form method="post" enctype="multipart/form-data">
			<div class="card-box">
				<h3 class="card-title">Basic Informations</h3>
				<div class="row">
					<div class="col-md-12">
						<?php   
$records = mysqli_query($connect,"SELECT a.user_id, a.name, a.username, a.password, a.usertype,a.image,b.Data,b.Code FROM tblusers a,tblhelp b where a.Status=b.Code And a.user_id='$id'"); // fetch data from database
while($data = mysqli_fetch_array($records))
{
	?>
	<div class="profile-img-wrap">
		<?php if($data['image']==''){ ?> 
			<img class="inline-block" id="previewImg" src="assets/img/user.jpg" alt="user">
		<?php } else{ ?> 
			<img class="inline-block" id="previewImg" src="upload_images/users/<?php echo $data['image']; ?>" alt="user">
		<?php } ?>
		<div class="fileupload btn" onchange="previewFile(this);">
			<span class="btn-text">edit</span>
			<input class="upload" name="image" id="image" type="file">
		</div>
	</div>
	<div class="profile-basic">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group form-focus">
					<label class="focus-label">Name</label>
					<input type="text" name="name" class="form-control floating" value="<?php echo $data['name']; ?>">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group form-focus">
					<label class="focus-label">User Name</label>
					<input type="text" name="username" class="form-control floating" value="<?php echo $data['username']; ?>" >
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group form-focus">
					<label class="focus-label">Password</label>
					<input type="password" name="password" class="form-control floating" value="<?php echo $data['password']; ?>" >
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group form-focus select-focus">
					 <label class="focus-label">Status</label>
					<?php
					$sql = "SELECT Code,Data from tblhelp where  Tag='01' And Code!='$data[Code]' order by Code";
					$rs_result = mysqli_query ($connect,$sql);
					echo "<select  name='Status' class='select floating' >
					<option value='$data[Code]' selected>$data[Data]</option>";
					while ($rows = mysqli_fetch_assoc($rs_result)) {
						echo "<option value=$rows[Code]>$rows[Data]</option>";};
						echo '</select>';
						?>
					</div>
				</div>
			</div>
		</div>
	<?php  } ?>
</div>
</div>
</div>
<div class="text-center m-t-20">
	<button type="submit" id="submit" name="submit" class="btn btn-primary submit-btn">Update</button>
</div>
</form>
</div>
</div>
<script type="text/javascript">
	function previewFile(input){
		var file = $("input[type=file]").get(0).files[0];
		var a= $("input[type=file]").get(0).files[0].size;
		if(a>1024*100){
			alert('Please select image size less than 100kb');
			$(".profile-img-wrap").css("border","3px solid red");
			$("#image").val('');
			$("#previewImg").attr("src", "assets/img/user.jpg");
			return false;
		}
		else{
			if(file){
				var reader = new FileReader();
				reader.onload = function(){
					$("#previewImg").attr("src", reader.result);
					$(".profile-img-wrap").css("border","3px solid #09900e");
				}

				reader.readAsDataURL(file);
			}
		}
	}
</script>

<?php include('includes/footer.php')?>





