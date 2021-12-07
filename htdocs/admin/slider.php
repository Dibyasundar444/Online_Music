<?php include('includes/header.php'); ?>
<?php
$page="slider.php";
?>
<?php include('includes/sidebar.php'); ?>

 <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Slider Images</h4>
                    </div>
                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="add-slider.php" class="btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Slider</a>
                    </div>
                </div>
                <div class="row doctor-grid">
                     <?php
                    if(isset($_GET['success'])){
                        ?>
                        <div class="bg-success text-white mt-20 text-center" style="padding:2px 8px;">Delete Successfully</div>
                        <?php } ?>
                        
                     <?php 
                    $sql = mysqli_query($connect,"select id,image,imgtitle from tblslider");
                     while($rowslider = mysqli_fetch_array($sql)){
                    ?>
                    <div class="col-md-4 col-sm-4  col-lg-3">
                        <div class="profile-widget">
                            <div class="doctor-img">
                                <a class="avatar" href="#">
                                     <?php echo "<img src='upload_images/slider/$rowslider[image]' alt='' >"?>
                                    
                                </a>
                            </div>
                            <div class="dropdown profile-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="edit.php?link=<?php echo base64_encode($rowslider['id']);?>&name=<?php echo base64_encode("SliderEdit"); ?>" class="dropdown-item"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                    <a  href="delete.php?link=<?php echo base64_encode($rowslider['id']);?>&name=<?php echo base64_encode("Sliderdlt"); ?>&file=<?php echo base64_encode($rowslider['image']); ?>" class="dropdown-item" onclick=" return confirm('Are You Sure To Delete?')"><i class="fa fa-trash m-r-5"></i> Delete</a>
                                </div>
                            </div>
                            <h4 class="doctor-name text-ellipsis"><a href="#"><?php echo "$rowslider[imgtitle]"?></a></h4>                       
                        </div>
                    </div>
                      <?php } ?>
                </div>
               
            </div>
        </div>
<?php include('includes/footer.php')?>