<?php include('includes/header.php')?>
<?php
if(isset($_POST['submit'])){

    $res=mysqli_query($connect,"SELECT ifnull(max(catcode),0) as id from tblcategory");
    $data =mysqli_fetch_assoc($res);
    $mMaxCode=$data['id'];
    $mdcode= $mMaxCode+1000+1;
    $mCode=substr($mdcode,1);

    $catname = $_POST['catname'];
    $catdesc = $_POST['catdesc'];
    $ImageName =  $mCode.'.'.pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
    $target_dir = "upload_images/category/";
    $target_file = $target_dir . basename($ImageName);
    
    if (empty($error)) {
        if($mCode>0){
          if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $sql = "INSERT INTO tblcategory (catcode, catname, catdesc, catimage) values('$mCode','$catname', '$catdesc', '$ImageName')";
            if(mysqli_query($connect,$sql)){
                header("Location:category.php");
            }

            else {
              $msg = "There was an error in the database";
              $msg_class = "alert-danger";
          }
      } 
      else {
        $error = "There was an erro uploading the file";
        $msg = "alert-danger";
    }
} 
} 
}
?>
<?php include('includes/sidebar.php')?>
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <h4 class="page-title">Add Category</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Category Name <span class="text-danger">*</span></label>
                                <input name="catname" id="catname" class="form-control" required="1" type="text">
                            </div>
                        </div>
                         <div class="col-sm-6">
                            <div class="form-group">
                                <label>Category Description <span class="text-danger">*</span></label>
                                <input name="catdesc" id="catdesc" class="form-control" required="1" type="text">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Upload Img <span class="text-danger">*</span></label>
                                <div class="profile-upload">
                                    <div class="upload-img">
                                        <img id="previewImg"  src="assets/img/user.jpg"/>
                                    </div>
                                    <div class="upload-input">
                                        <input name="image" id="image" onchange="previewFile(this);"  required="1" type="file" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="m-t-20 text-center">
                        <button type="submit" id="submit" name="submit" class="btn btn-primary submit-btn">Create Category</button>
                    </div>
                </form>
            </div>
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
<?php include('includes/footer.php')?>