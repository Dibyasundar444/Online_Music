<?php
include('includes/header.php');
?>
<?php 
$link = base64_decode($_GET['link']);
$regedit = base64_decode($_GET['name']);
?>
<?php
if($regedit=='Artistedit'){
	$page="artists.php";
}
else if ($regedit=='CategoryEdit') {
	$page="category.php";
}
else if ($regedit=='AlbumEdit') {
	$page="album.php";
}
else if ($regedit=='SliderEdit') {
	$page="slider.php";
}
?>


<?php 
if($regedit=='Artistedit'){

if(isset($_POST['submit'])){

	$name = $_POST['name'];
	$filename=$_FILES["image"]["name"];
	if($filename==""){
		$edit = mysqli_query($connect,"UPDATE tblartist SET artistname='$name' where artistcode=$link");
		if($edit){
        mysqli_close($connect); // Close connection
        echo "<script>alert('Succesfully Update Data!!!');window.location='artists.php' </script>";
        $link =""; 
        $regedit ="";
        exit;
    }
    else
    {
    	echo mysqli_error();
    } 
}
else{

	
	$ImageName =  $link.'.'.pathinfo($filename, PATHINFO_EXTENSION);
	$target_dir = "upload_images/artist/";
	$target_file = $target_dir . basename($ImageName);

	$edit = mysqli_query($connect,"UPDATE tblartist SET artistname='$name', image='$ImageName' where artistcode=$link");
	move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

	if($edit){
        mysqli_close($connect); // Close connection
        echo "<script>alert('Succesfully Update Data!!!');window.location='artists.php' </script>";
        $link =""; 
        $regedit ="";
        exit;
    }
    else
    {
    	echo mysqli_error();
    } 
}

}
}
?>



<?php 
if($regedit=='CategoryEdit'){

if(isset($_POST['update'])){

	$catname = $_POST['catname'];
	$catdesc=$_POST['catdesc'];
	$filename=$_FILES["image"]["name"];
	
	

	if($filename==""){

		$edit = mysqli_query($connect,"UPDATE tblcategory SET catname='$catname', catdesc='$catdesc' where catcode=$link");
		if($edit){
        mysqli_close($connect); // Close connection
        echo "<script>alert('Succesfully Update Data!!!');window.location='category.php' </script>";
        $link =""; 
        $regedit ="";
        exit;
    }
    else
    {
    	echo mysqli_error();
    } 
}
else{

	
	$ImageName =  $link.'.'.pathinfo($filename, PATHINFO_EXTENSION);
	$target_dir = "upload_images/artist/";
	$target_file = $target_dir . basename($ImageName);

	$edit = mysqli_query($connect,"UPDATE tblcategory SET catname='$catname', catdesc='$catdesc',image='$ImageName' where catcode=$link");
	move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

	if($edit){
        mysqli_close($connect); // Close connection
        echo "<script>alert('Succesfully Update Data!!!');window.location='category.php' </script>";
        $link =""; 
        $regedit ="";
        exit;
    }
    else
    {
    	echo mysqli_error();
    } 
}
}
}
?>
<?php 
if ($regedit=='AlbumEdit'){
if(isset($_POST['save'])){

$albumname = $_POST['albumname'];
$writer = $_POST['writer'];
$albumdesc = $_POST['albumdesc'];
$artistcode = $_POST['artistcode'];
$catcode = $_POST['catcode'];
$filename=$_FILES["image"]["name"];
	
	if($filename==""){

		$edit = mysqli_query($connect,"UPDATE tblalbum SET albumname='$albumname', albumwriter='$writer', albumdesc='$albumdesc', artistcode='$artistcode',  catcode='$catcode'  where albumcode='$link'");
		if($edit){
        mysqli_close($connect); // Close connection
        echo "<script>alert('Succesfully Update Data!!!');window.location='album.php' </script>";
        $link =""; 
        $regedit ="";
        exit;
    }
    else
    {
    	echo mysqli_error();
    } 
}
else{

	
	$ImageName =  $link.'.'.pathinfo($filename, PATHINFO_EXTENSION);
	$target_dir = "upload_images/album/";
	$target_file = $target_dir . basename($ImageName);

	$edit = mysqli_query($connect,"UPDATE tblalbum SET albumname='$albumname', albumwriter='$writer', albumdesc='$albumdesc', artistcode='$artistcode',  catcode='$catcode' ,albumimage='$ImageName' where albumcode='$link'");
	move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

	if($edit){
        mysqli_close($connect); // Close connection
        echo "<script>alert('Succesfully Update Data!!!');window.location='album.php' </script>";
        $link =""; 
        $regedit ="";
        exit;
    }
    else
    {
    	echo mysqli_error();
    } 
}
}
}
?>
<?php 
if ($regedit=='SliderEdit'){
if(isset($_POST['edit'])){

$imgtitle = $_POST['imgtitle'];
$imgdesc = $_POST['imgdesc'];
$filename=$_FILES["image"]["name"];
	
	if($filename==""){

		$edit = mysqli_query($connect,"UPDATE tblslider SET imgtitle='$imgtitle', imgdesc='$imgdesc' where id='$link'");
		if($edit){
        mysqli_close($connect); // Close connection
        echo "<script>alert('Succesfully Update Data!!!');window.location='slider.php' </script>";
        $link =""; 
        $regedit ="";
        exit;
    }
    else
    {
    	echo mysqli_error();
    } 
}
else{

	
	$ImageName =  "slider".'-'.$link.'.'.pathinfo($filename, PATHINFO_EXTENSION);
	$target_dir = "upload_images/slider/";
	$target_file = $target_dir . basename($ImageName);

	$edit = mysqli_query($connect,"UPDATE tblslider SET image='$ImageName', imgtitle='$imgtitle', imgdesc='$imgdesc' where id='$link'");
	move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

	if($edit){
        mysqli_close($connect); // Close connection
        echo "<script>alert('Succesfully Update Data!!!');window.location='slider.php' </script>";
        $link =""; 
        $regedit ="";
        exit;
    }
    else
    {
    	echo mysqli_error();
    } 
}
}
}
?>
<?php
include('includes/sidebar.php');
?>

<?php if($regedit=='Artistedit'){ ?> 
	<div class="page-wrapper">
		<div class="content">
			<div class="row">
				<div class="col-lg-8 offset-lg-2">
					<h4 class="page-title">Update Artist Information</h4>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-8 offset-lg-2">
					<form method="post" enctype="multipart/form-data">
						<div class="row">
							<div class="col-sm-6">
								<?php   
$records = mysqli_query($connect,"select artistname,image from tblartist where  artistcode='$link'"); // fetch data from database
while($data = mysqli_fetch_array($records))
{
	?>
	<div class="form-group">
		<label>First Name <span class="text-danger">*</span></label>
		<input name="name" id="name" class="form-control" required="1" type="text" value="<?php echo $data['artistname']; ?>">
	</div>
</div>
<div class="col-sm-6">
	<div class="form-group">
		<label>Upload Img <span class="text-danger">*</span></label>
		<div class="profile-upload">
			<div class="upload-img">
				<img id="previewImg" src="<?php echo 'upload_images/artist/' . $data['image'] ?>">
			</div>
			<div class="upload-input">
				<input name="image" onchange="previewFile(this);" id="image"  type="file" class="form-control">
			</div>
		</div>
	</div>
</div>
<?php } ?>
</div>
<div class="m-t-20 text-center">
	<button type="submit" id="submit" name="submit" class="btn btn-primary submit-btn">Update</button>
</div>
</form>
</div>
</div>
</div>
</div>
<?php } ?>

<?php if($regedit=='CategoryEdit'){ ?> 
	<div class="page-wrapper">
		<div class="content">
			<div class="row">
				<div class="col-lg-8 offset-lg-2">
					<h4 class="page-title">Update Category Information</h4>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-8 offset-lg-2">
					<form method="post" enctype="multipart/form-data">
						<div class="row">
							<div class="col-sm-6">
								<?php   
$records = mysqli_query($connect,"select catname,catdesc,catimage from tblcategory where catcode='$link'"); // fetch data from database
while($data = mysqli_fetch_array($records))
{
	?>
	<div class="form-group">
		<label>Category Name <span class="text-danger">*</span></label>
		<input name="catname" id="catname" class="form-control" required="1" type="text" value="<?php echo $data['catname']; ?>">
	</div>
	<div class="form-group">
		<label>Category Description <span class="text-danger">*</span></label>
		<input name="catdesc" id="catdesc" class="form-control" required="1" type="text" value="<?php echo $data['catdesc']; ?>">
	</div>
</div>
<div class="col-sm-6">
	<div class="form-group">
		<label>Upload Img <span class="text-danger">*</span></label>
		<div class="profile-upload">
			<div class="upload-img">
				<img id="previewImg" src="<?php echo 'upload_images/category/' . $data['catimage'] ?>">
			</div>
			<div class="upload-input">
				<input name="image" onchange="previewFile(this);" id="image"  type="file" class="form-control">
			</div>
		</div>
	</div>
</div>
<?php } ?>
</div>
<div class="m-t-20 text-center">
	<button type="submit" id="update" name="update" class="btn btn-primary submit-btn">Update</button>
</div>
</form>
</div>
</div>
</div>
</div>
<?php } ?>

<?php if($regedit=='AlbumEdit'){ ?> 
	<div class="page-wrapper">
		<div class="content">
			<div class="row">
				<div class="col-lg-8 offset-lg-2">
					<h4 class="page-title">Update Album Information</h4>
				</div>
			</div>
			<form method="post" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-6">
						<?php   
$records = mysqli_query($connect,"SELECT a.albumcode,a.catcode,a.albumname,a.artistcode, a.albumwriter, a.albumdesc, a.albumimage,b.artistname,c.catname from tblalbum a,tblartist b,tblcategory c where a.albumcode='$link' And a.artistcode=b.artistcode And a.catcode=c.catcode"); // fetch data from database
while($data = mysqli_fetch_array($records))
{
	?>
						<div class="form-group">
							<label>Album Name <span class="text-danger">*</span></label>
							<input name="albumname" id="albumname" class="form-control" type="text" value="<?php echo $data['albumname']; ?> ">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Album Writer<span class="text-danger">*</span></label>
							<input class="form-control" name="writer" id="writer" type="text" value="<?php echo $data['albumwriter']; ?>">
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label>Album Desc<span class="text-danger">*</span></label>
							<input class="form-control" name="albumdesc" id="albumdesc" type="text" value="<?php echo $data['albumdesc']; ?>">
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label>Artist <span class="text-danger">*</span></label>
							<?php
							$sql = "SELECT artistcode,artistname from tblartist where artistcode!='$data[artistcode]' order by artistcode";
							$rs_result = mysqli_query ($connect,$sql);
							echo "<select  name='artistcode' class='select' >
							  <option value='$data[artistcode]' selected>$data[artistname]</option>";
							while ($rows = mysqli_fetch_assoc($rs_result)) {
								echo "<option value=$rows[artistcode]>$rows[artistname]</option>";};
								echo '</select>';
								?>

							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Category <span class="text-danger">*</span></label>
								<?php
								$sql = "SELECT catcode,catname from tblcategory where catcode!='$data[catcode]'  order by catcode";
								$rs_result = mysqli_query ($connect,$sql);
								echo "<select  name='catcode' class='select' >
							<option value='$data[catcode]' selected>$data[catname]</option>";
								while ($rows = mysqli_fetch_assoc($rs_result)) {
									echo "<option value=$rows[catcode]>$rows[catname]</option>";};
									echo '</select>';
									?>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label>Upload Img <span class="text-danger">*</span></label>
									<div class="profile-upload">
										<div class="upload-img">
											<img id="previewImg" src="<?php echo 'upload_images/album/' . $data['albumimage'] ?>">
										</div>
										<div class="upload-input">
											<input name="image" id="image" onchange="previewFile(this);"   type="file" class="form-control">
										</div>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
					<div class="m-t-20 text-center">
						<button type="submit" id="save" name="save" class="btn btn-primary submit-btn">Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php } ?>
<?php if($regedit=='SliderEdit'){ ?> 
	<div class="page-wrapper">
		<div class="content">
			<div class="row">
				<div class="col-lg-8 offset-lg-2">
					<h4 class="page-title">Update Slider Image Information</h4>
				</div>
			</div>
			<form method="post" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-6">
						<?php   
$records = mysqli_query($connect,"Select id, image, imgtitle, imgdesc from tblslider where id='$link'"); // fetch data from database
while($data = mysqli_fetch_array($records))
{
	?>						<div class="form-group">
							<label>Image Title <span class="text-danger">*</span></label>
							<input name="imgtitle" id="imgtitle" class="form-control" type="text" value="<?php echo $data['imgtitle']; ?> ">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Image Desc<span class="text-danger">*</span></label>
							<input class="form-control" name="imgdesc" id="imgdesc" type="text" value="<?php echo $data['imgdesc']; ?>">
						</div>
					</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Upload Img <span class="text-danger">*</span></label>
									<div class="profile-upload">
										<div class="upload-img">
											<img id="previewImg" src="<?php echo 'upload_images/slider/' . $data['image'] ?>">
										</div>
										<div class="upload-input">
											<input name="image" id="image" onchange="previewFile(this);"   type="file" class="form-control">
										</div>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
					<div class="m-t-20 text-center">
						<button type="submit" id="edit" name="edit" class="btn btn-primary submit-btn">Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php } ?>


<script type="text/javascript">
	function previewFile(input){
		var file = $("input[type=file]").get(0).files[0];
		var a= $("input[type=file]").get(0).files[0].size;
		if(a>100000){
			alert('Please select image size less than 90kb');
			$("#image").css("background","red");
			$("#image").css("color","#fff");
			$("#image").val('');
			$("#previewImg").attr("src", "assets/img/user.jpg");
			return false;
		}
		else{
			if(file){
				var reader = new FileReader();
				reader.onload = function(){
					$("#previewImg").attr("src", reader.result);
					$("#image").css("background","#09900e");
					$("#image").css("color","#fff");

				}

				reader.readAsDataURL(file);
			}
		}
	}
</script>

<?php
include('includes/footer.php')
?>