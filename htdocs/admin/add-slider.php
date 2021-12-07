<?php include('includes/header.php')?>
<?php
$page="slider.php";
?>
<?php if(isset($_POST['submit'])){
    $res=mysqli_query($connect,"SELECT ifnull(max(id),0) as id from tblslider");
    $data =mysqli_fetch_assoc($res);
    $mMaxCode=$data['id'];
    $mdcode= $mMaxCode+1000+1;
    $mCode=substr($mdcode,1);

    $imgtitle = $_POST['imgtitle'];
    $imgdesc = $_POST['imgdesc'];

    $ImageName = "slider".'-' .$mCode.'.'.pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
    $target_dir = "upload_images/slider/";
    $target_file = $target_dir . basename($ImageName);

    if (empty($error)) {
        if($mCode>0){
          if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $sql = "INSERT INTO tblslider (id, image, imgtitle, imgdesc) values('$mCode', '$ImageName','$imgtitle', '$imgdesc')";
            if(mysqli_query($connect,$sql)){
                header("Location:slider.php");
            }

            else {
              $msg = "There was an error in the database";
              $msg_class = "alert-danger";
          }
      } 
      else {
        $error = "There was an error uploading the file";
        $msg = "alert-danger";
    }
} 
} 
}
?>

<?php include('includes/sidebar.php')?>

<div class="page-wrapper">
    <div class="content">
     <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="page-title">Add Slider Image</h4>
            </div>
        </div>
        <form method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                 <div class="form-group">
                    <label>Image Title <span class="text-danger">*</span></label>
                    <input maxlength="50" name="imgtitle" id="imgtitle" class="form-control" type="text" required="1">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Image Desc<span class="text-danger">*</span></label>
                    <input class="form-control" name="imgdesc" id="imgdesc" type="text" maxlength="100" required="1">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Upload Img <span class="text-danger">*</span></label>
                    <div class="profile-upload">
                        <div class="upload-img">
                            <img id="previewImg"  src="assets/img/placeholder-thumb.jpg"/>
                        </div>
                        <div class="upload-input">
                            <input type="file" name="image" id="image" onchange="previewFile(this);"  required="1"  class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 m-t-20 text-center">
             <button type="submit" id="submit" name="submit" class="btn btn-primary submit-btn">Save</button>
         </div>


     </div>
 </form>
</div>
</div>
</div>
<script type="text/javascript">
    function previewFile(input){
        var file = $("input[type=file]").get(0).files[0];
        var a= $("input[type=file]").get(0).files[0].size;
        if(a>100000){
            alert('Please select image size less than 90kb');
            $("#image").css("background","red");
            $("#image").css("color","#fff");
            $("#image").val('');
            $("#previewImg").attr("src", "assets/img/placeholder-thumb.jpg");
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

<?php include('includes/footer.php')?>