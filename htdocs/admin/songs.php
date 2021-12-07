<?php include('includes/header.php'); ?>
<?php
$page="songs.php";
?>
<?php include('includes/sidebar.php'); ?>
<script src="bootstrap/js/jquery-1.12.2.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4 col-3">
                <h4 class="page-title">Songs</h4>
            </div>
            <div class="col-sm-8 col-9 text-right m-b-20">
                <a href="add-songs.php" class="btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Songs</a>
            </div>
        </div>

        <div class="row filter-row align-items-center">

         <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 col-12">
            <div class="form-group">
                <label class="label">Album Type</label>
                <?php
                $sql = "SELECT albumcode ,albumname from tblalbum order by albumcode ";
                $rs_result = mysqli_query ($connect,$sql);
                echo "<select  name='album' id='ddlalbum' class='select'>
                <option  disable value='000' >--Select Album--</option>";
                while ($rows = mysqli_fetch_assoc($rs_result)) {
                    echo "<option value=$rows[albumcode]>$rows[albumname]</option>";};
                    echo '</select>';
                    ?>
                </div>
            </div>

            <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 col-12">
                <div class="form-group">
                    <label class="label">From</label>
                   
                        <input type="date" id="date1" class="form-control" >
                   
                </div>
            </div>
            <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 col-12">
                <div class="form-group">
                    <label class="label">To</label>
                        <input type="date"  id="date2" class="form-control" >
                </div>
            </div>
            <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3  col-12">
                <span class="input-group-btn">
                 <button type="submit" id="btnsearch" name="search" class="btn btn-success ">Search</button>

                 <button type="submit" id="btnReset" name="Reset" onclick="location.reload();" class="btn btn-danger ">Reset</button>
             </span>
         </div>
     </div>
     <div id="content-pane" style="overflow-x: auto;">
     </div>
     <div class="row">
        <div class="col-md-12" id="visable">
         <?php
         if(isset($_GET['success'])){
            ?>
            <div class="bg-success text-white mt-20 text-center" style="padding:2px 8px; margin-bottom: 5px;">Delete Successfully</div>
        <?php } ?>

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table datatable">
                        <thead>
                            <tr>
                                <th>Album Details</th>
                                <th>Songs Name</th>
                                <th>Lisent Songs</th>
                                <th>Upload Date</th>
                                <th class="text-center">Status</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                         <?php 
                         $sql = mysqli_query($connect,"SELECT a.songcode,a.songname,a.song, date_format(a.UploadDt, '%d %M %Y') as UploadDt,a.status,c.Data,b.albumname,b.albumimage,b.albumwriter from tblsongs a,tblalbum b,tblhelp c Where a.albumcode=b.albumcode And a.status=c.Code order by songcode,UploadDt");
                         while($rowsong = mysqli_fetch_array($sql)){
                            ?>
                            <tr>
                                <td>
                                    <a href="javascript:Void(0);" class="avatar"><?php echo "<img src='upload_images/album/$rowsong[albumimage]' alt='' >"?></a>

                                    <h2><a href="#"><?php echo($rowsong['albumname']);?><span><?php echo($rowsong['albumwriter']);?></span></a></h2>
                                </td>
                                <td><?php echo($rowsong['songname']);?></td>
                                <td>
                                    <audio preload="auto" id="previewaudio" controls>
                                        <source  src="songs/<?php echo($rowsong['song']);?>" >
                                        </audio>
                                </td>
                                <td><?php echo($rowsong['UploadDt']);?></td>
                                <td class="text-center">
                                    <div class="dropdown action-label">
                                        <?php if($rowsong['status']=='001') {?>
                                            <a class="custom-badge status-green" aria-expanded="false">
                                                <?php echo($rowsong['Data']);?>

                                            </a>
                                        <?php  } else{ ?>
                                         <a class="custom-badge status-red" aria-expanded="false">
                                           <?php echo($rowsong['Data']);?>
                                       </a>
                                   <?php } ?>
                               </div>
                           </td>

                           <td class="text-right">
                            <div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">


                                    <a  href="delete.php?link=<?php echo base64_encode($rowsong['songcode']);?>&name=<?php echo base64_encode("Songsdlt"); ?>&file=<?php echo base64_encode($rowsong['song']); ?>"
                                       class="dropdown-item" title="Decline" onclick=" return confirm('Are You Sure To Delete?')"><i class="fa fa-trash-o m-r-5" ></i> Delete</a>
                                   </div>
                               </div>
                           </td>
                       </tr>
                   <?php } ?>
               </tbody>
           </table>
       </div>
   </div>
</div>
</div>
</div>
</div>
</div>
<script>
    $(document).ready(function(){
        $('#content-pane').load('<?php echo basename('nothing.php','.php'); ?>');
        $('#btnsearch').on('click',function(){
                    // Send query and load dynamically
                    var key = $('#ddlalbum').val();
                    var date1 = $('#date1').val();
                    var date2 = $('#date2').val();
                    var type="songs";
                    if(key=='000'){
                        alert("Please Select Album Name");
                        $('#ddlalbum').focus();
                        return false;
                    }
                    if(date1==''){
                        alert("Please Select Start Date");
                        $('#date1').focus();
                        return false;
                    }
                    if(date2==''){
                        alert("Please Select End Date");
                        $('#date2').focus();
                        return false;
                    }
                    var total = key + ":" + date1+ ":" +date2+ ":" +type;
                    $.post('<?php echo basename('search.php','.php'); ?>',{str:total},function(data){
                        $('div#content-pane').html(data);
                        $("#visable").css("display", "none");

                    });
                    
                });
    });
</script>

<?php include('includes/footer.php')?>