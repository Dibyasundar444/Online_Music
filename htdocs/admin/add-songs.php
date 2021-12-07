<?php include('includes/header.php')?>
<?php
$page="songs.php";
?>
<?php if(isset($_POST['submit'])){


    $namesong = $_POST['songname'];
    $songdesc = $_POST['songdesc'];
    $albumcode = $_POST['albumcode'];
    $lancode = $_POST['lancode'];
    $statcode = $_POST['statcode'];
    $filename=($_FILES["filesong"]["name"]);



if($albumcode==""){
     $msg = "Please Select Album";
      $msg_class = "alert-danger";
}
elseif($lancode==""){
  $msg = "Please Select Language";
      $msg_class = "alert-danger";
}

elseif($statcode==""){
  $msg = "Please Select Status";
      $msg_class = "alert-danger";
}

else{

    $res=mysqli_query($connect,"SELECT ifnull(max(songcode),0) as id from tblsongs");
    $data =mysqli_fetch_assoc($res);
    $mMaxCode=$data['id'];
    $mdcode= $mMaxCode+1000+1;
    $mCode=substr($mdcode,1);


    $SongName = 'Track-'.substr($mCode,1).'.'.pathinfo($filename, PATHINFO_EXTENSION);
    $target_dir = "./songs/";
    $target_file = $target_dir . basename($SongName);

    if (empty($error)) {
        if($mCode>0){
            if(move_uploaded_file($_FILES["filesong"]["tmp_name"], $target_file)){

                $sql = "INSERT INTO tblsongs (songcode, songname, songdesc, albumcode, songtype, song, status, UploadDt) values('$mCode','$namesong','$songdesc', '$albumcode', '$lancode', '$SongName','$statcode',CURDATE())";
               
            if(mysqli_query($connect,$sql)){
                header("Location:songs.php");
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
}
?>

<?php include('includes/sidebar.php')?>

<div class="page-wrapper">
    <div class="content">
     <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="page-title">Add Songs</h4>
            </div>
        </div>
        <form enctype="multipart/form-data" method="POST" >
            <div class="row">
                <div class="col-md-6">
                 <div class="form-group">
                    <label>Song Name <span class="text-danger">*</span></label>
                    <input name="songname" id="songname" class="form-control" type="text">
                </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Song Desc<span class="text-danger">*</span></label>
                <input class="form-control" name="songdesc" id="songdesc" type="text">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Album <span class="text-danger">*</span></label>
                <?php
                $sql = "SELECT albumcode,albumname from tblalbum order by albumcode";
                $rs_result = mysqli_query ($connect,$sql);
                echo "<select  name='albumcode' class='select' >
                <option hidden disable >Select Album</option>";
                while ($rows = mysqli_fetch_assoc($rs_result)) {
                    echo "<option value=$rows[albumcode]>$rows[albumname]</option>";};
                    echo '</select>';
                    ?>

                </div>
            </div>
            <div class="col-md-6">
             <div class="form-group">
                <label>Song Language<span class="text-danger">*</span></label>
                <?php
                $sql = "SELECT Code ,Data from tblhelp where Tag='05'order by Code ";
                $rs_result = mysqli_query ($connect,$sql);
                echo "<select  name='lancode' class='select' >
                <option hidden disable >Select Language</option>";
                while ($rows = mysqli_fetch_assoc($rs_result)) {
                    echo "<option value=$rows[Code]>$rows[Data]</option>";};
                    echo '</select>';
                    ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Upload Song <span class="text-danger">*</span></label>
                    <div class="profile-upload">
                        <div class="upload-img">
                            <audio preload="auto" id="previewaudio" controls>
                                <source  src="#" >
                                </audio>
                            </div>
                            <div class="upload-input">
                                <input type="file" name="filesong" id="filesong" onchange="previewFile(this);"  required="1"  class="form-control" accept="audio/mp3">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                   <div class="form-group">
                    <label>Status<span class="text-danger">*</span></label>
                    <?php
                 $sql = "SELECT Code,Data from tblhelp where Tag='01'order by Code ";
                    $rs_result = mysqli_query ($connect,$sql);
                    echo "<select  name='statcode' class='select' >
                    <option hidden disable >Select Status</option>";
                    while ($rows = mysqli_fetch_assoc($rs_result)) {
                        echo "<option value=$rows[Code]>$rows[Data]</option>";};
                        echo '</select>';
                        ?>
                    </div>
                </div>
                <div class="col-md-12 m-t-20 text-center">
                 <button type="submit" id="submit" name="submit" class="btn btn-primary submit-btn">Add</button>
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
        if(a>1024*10000){
            alert('Please select image size less than 10 MB');
            $("#filesong").css("background","red");
            $("#filesong").css("color","#fff");
            $("#filesong").val('');
            $("#previewaudio").attr("src", "#");
            return false;
        }
        else{
            if(file){
                var reader = new FileReader();
                reader.onload = function(){
                    $("#previewaudio").attr("src", reader.result);
                    $("#filesong").css("background","#09900e");
                    $("#filesong").css("color","#fff");
                }

                reader.readAsDataURL(file);
            }
        }
    }
</script>

<?php include('includes/footer.php')?>