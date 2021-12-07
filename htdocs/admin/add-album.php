<?php include('includes/header.php')?>
<?php
$page="album.php";
?>
<?php 
if(isset($_POST['submit'])){

    $albumname = $_POST['albumname'];
    $writer = $_POST['writer'];
    $albumdesc = $_POST['albumdesc'];
    $artistcode = $_POST['artistcode'];
    $catcode = $_POST['catcode'];

if($artistcode==""){
     $msg = "Please Select Artist";
      $msg_class = "alert-danger";
}
elseif( $catcode==""){
  $msg = "Please Select Category";
      $msg_class = "alert-danger";
}
else{

     $res=mysqli_query($connect,"SELECT ifnull(max(albumcode),0) as id from tblalbum");
    $data =mysqli_fetch_assoc($res);
    $mMaxCode=$data['id'];
    $mdcode= $mMaxCode+1000+1;
    $mCode=substr($mdcode,1);


    $ImageName =  $mCode.'.'.pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
    $target_dir = "upload_images/album/";
    $target_file = $target_dir . basename($ImageName);

    if (empty($error)) {
        if($mCode>0){
          if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $sql = "INSERT INTO tblalbum (albumcode, catcode, albumname, artistcode, albumwriter, albumdesc, albumimage) values('$mCode','$catcode', '$albumname', '$artistcode', '$writer', '$albumdesc', '$ImageName')";
            if(mysqli_query($connect,$sql)){
                header("Location:album.php");
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
}
?>

<?php include('includes/sidebar.php')?>

<div class="page-wrapper">
    <div class="content">
       <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="page-title">Add Album</h4>
            </div>
        </div>
        <form method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                   <div class="form-group">
                    <label>Album Name <span class="text-danger">*</span></label>
                    <input name="albumname" id="albumname" class="form-control" type="text">
                </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Album Writer<span class="text-danger">*</span></label>
                <input class="form-control" name="writer" id="writer" type="text">
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label>Album Desc<span class="text-danger">*</span></label>
                <input class="form-control" name="albumdesc" id="albumdesc" type="text">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>Artist <span class="text-danger">*</span></label>
                <?php
                $sql = "SELECT artistcode,artistname from tblartist  order by artistcode";
                $rs_result = mysqli_query ($connect,$sql);
                echo "<select  name='artistcode' class='select' >
                <option hidden disable value=''>Select Artist</option>";
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
                $sql = "SELECT catcode,catname from tblcategory  order by catcode";
                $rs_result = mysqli_query ($connect,$sql);
                echo "<select  name='catcode' class='select' >
                <option hidden disable value=''>Select Category</option>";
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
                            <img id="previewImg"  src="assets/img/user.jpg"/>
                        </div>
                        <div class="upload-input">
                            <input type="file" name="image" id="image" onchange="previewFile(this);"  required="1"  class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <!---<div class="col-md-6">
               <div class="form-group">
                <label>Status <span class="text-danger">*</span></label>
                <select class="select">
                    <option>Active</option>
                    <option>Inactive</option>
                </select>
            </div>
        </div>--->


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