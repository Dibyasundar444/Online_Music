<?php include('includes/header.php'); ?>
<?php $page="dashboard.php"; ?>
<?php include('includes/sidebar.php'); ?>
<script src="bootstrap/js/jquery-1.12.2.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<div class="page-wrapper">
   <div class="content">
    <div class="row">
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="dash-widget">
                <span class="dash-widget-bg1"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                <div class="dash-widget-info text-right">
                    <?php 
                    $sql = mysqli_query($connect,"select count(*) as artist from tblartist");
                    while($rowartist = mysqli_fetch_array($sql)){
                        ?>
                        <?php echo "<h3>$rowartist[artist]</h3>" ?>
                    <?php } ?>
                    <span class="widget-title1">Artist <i class="fa fa-check" aria-hidden="true"></i></span>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="dash-widget">
                <span class="dash-widget-bg2"><i class="fa fa-file-audio-o"></i></span>
                <div class="dash-widget-info text-right">
                    <?php 
                    $sql = mysqli_query($connect,"SELECT count(*) as songs FROM tblsongs");
                    while($rowsongs = mysqli_fetch_array($sql)){
                        ?>
                        <?php echo "<h3>$rowsongs[songs]</h3>" ?>
                    <?php } ?>
                    <span class="widget-title2">Songs <i class="fa fa-check" aria-hidden="true"></i></span>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="dash-widget">
                <span class="dash-widget-bg3"><i class="fa fa-music" aria-hidden="true"></i></span>
                <div class="dash-widget-info text-right">
                   <?php 
                   $sql = mysqli_query($connect,"SELECT count(*) as album FROM tblalbum");
                   while($rowalbum = mysqli_fetch_array($sql)){
                    ?>
                    <?php echo "<h3>$rowalbum[album]</h3>" ?>
                <?php } ?>
                <span class="widget-title3">Album <i class="fa fa-check" aria-hidden="true"></i></span>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
        <div class="dash-widget">
            <span class="dash-widget-bg4"><i class="fa fa-user-o" aria-hidden="true"></i></span>
            <div class="dash-widget-info text-right">
             <?php 
             $sql = mysqli_query($connect,"SELECT count(*) as user FROM tblusers where usertype='051'");
             while($rowuser = mysqli_fetch_array($sql)){
                ?>
                <?php echo "<h3>$rowuser[user]</h3>" ?>
            <?php } ?>
            <span class="widget-title4">Users <i class="fa fa-check" aria-hidden="true"></i></span>
        </div>
    </div>
</div>
</div>

<div class="row">
    <div class="col-sm-8 col-6">
        <h4 class="page-title">Search User</h4>
    </div>

</div>
<div class="row filter-row align-items-center">
    <div class="col-sm-6 col-md-4 col-lg-4 col-xl-3 col-12">
        <div class="form-group">
            <label class="label">User Name</label>
            <input type="text" id="txtsearch" class="form-control floating">
        </div>
    </div>
   <!-- <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
        <div class="form-group form-focus select-focus">
            <label class="focus-label">Leave Type</label>
            <select class="select floating">
                <option> -- Select -- </option>
                <option>Casual Leave</option>
                <option>Medical Leave</option>
                <option>Loss of Pay</option>
            </select>
        </div>
    </div>-->
   <!--   <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
        <div class="form-group form-focus select-focus">
            <label class="focus-label">Leave Status</label>
            <select class="select floating">
                <option> -- Select -- </option>
                <option> Pending </option>
                <option> Approved </option>
                <option> Rejected </option>
            </select>
        </div>
    </div>-->
    <div class="col-sm-6 col-md-4 col-lg-4 col-xl-3 col-12">
        <div class="form-group ">
            <label class="label">From</label>
                <input type="date" id="date1" class="form-control" >
           
        </div>
    </div>
    <div class="col-sm-6 col-md-4 col-lg-4 col-xl-3  col-12">
        <div class="form-group">
            <label class="label">To</label>
                <input type="date"  id="date2" class="form-control">
        </div>
    </div>
     <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2  col-12">
    <span class="input-group-btn">
       <button type="submit" id="btnsearch" name="btnsearch" class="btn btn-success ">Search</button>
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
    <div class="table-responsive">
        <table class="table table-striped custom-table mb-0 datatable">
            <thead>
                <tr>
                    <th>Sl No.</th>
                    <th>Name</th>
                    <th>Contact No.</th>
                    <th>User ID</th>
                    <th>Password</th>
                    <th>Regstation Date</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $sql = mysqli_query($connect,"SELECT a.user_id,a.name,a.username,a.mobileno,a.password,date_format(a.regdt, '%d %M %Y') as regdate From tblusers a Where a.usertype='051' And a.Status='001' order by a.user_id,a.regdt");
                $count=0;
                while($rowRegData = mysqli_fetch_array($sql)){
                    $count++;
                    ?>
                    <tr>
                        <td><?php echo $count;?></td>
                        <td>
                            <h2><?php echo($rowRegData['name']);?></h2>
                        </td>
                        <td><?php echo($rowRegData['mobileno']);?></td>
                        <td><?php echo($rowRegData['username']);?></td>
                        <td><?php echo base64_decode($rowRegData['password']);?></td>
                        <td><?php echo($rowRegData['regdate']);?></td>
                        <td class="text-right">
                            <div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                 <a  href="delete.php?link=<?php echo base64_encode($rowRegData['user_id']);?>&name=<?php echo base64_encode("UserRegsdlt"); ?>"
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

<script>
    $(document).ready(function(){
        $('#content-pane').load('nothing.php');

        $('#btnsearch').on('click',function(){

                    // Send query and load dynamically
                    var key = $('#txtsearch').val();
                    var date1 = $('#date1').val();
                    var date2 = $('#date2').val();
                    var type="Duser";
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


                    $.post('search.php',{str:total},function(data){
                        $('div#content-pane').html(data);
                        $("#visable").css("display", "none");

                    });
                    
                });

    });
</script>
<?php include('includes/footer.php')?>