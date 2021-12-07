<?php 
include('includes/connect.php');
include('includes/header.php');
?>
<script src="admin/bootstrap/js/jquery-1.12.2.js"></script>
<script src="admin/bootstrap/js/bootstrap.min.js"></script>
<section class="hero-area">
    <div class="hero-slides owl-carousel">
        <!-- Single Hero Slide -->
        <?php
        $sql = mysqli_query($connect,"Select image, imgtitle, imgdesc from tblslider");
        while($rowslider = mysqli_fetch_array($sql)){
            ?>
            <div class="single-hero-slide d-flex align-items-center justify-content-center">
                <!-- Slide Img -->
                <div class="slide-img bg-img">
                    <?php echo "<img src=admin/upload_images/slider/$rowslider[image]>"?>
                </div>
                <!-- Slide Content -->
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="hero-slides-content text-center">
                                <h6 data-animation="fadeInUp" data-delay="100ms"><?php echo $rowslider['imgtitle'] ?></h6>
                                <h2 data-animation="fadeInUp" data-delay="300ms"><?php echo $rowslider['imgdesc'] ?> </h2>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</section>

<div class="container mysearh ">

    <div class="card col-12 mt-4 p-4">
        <div class="input-group mb-3"> <input type="text" class="form-control" id="search" placeholder="Search Songs....">
            <div class="input-group-append"><button class="btn btn-primary" id="btnsearch" name="btnsearch" ><i class="fa fa-search"></i></button></div>
        </div> <span class="text mb-3"></span>
        <div class="d-flex flex-row justify-content-between mb-2" id="content-pane" style="overflow:auto!important;">

        </div>
    </div>

</div>

<section class="latest-albums-area section-padding-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading style-2">
                    <p>See what’s new</p>
                    <h2>Latest Artist</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="albums-slideshow owl-carousel">
                    <?php 
                    
                    $sql1 = mysqli_query($connect,"Select  a.artistcode, a.artistname, a.image From tblartist a order by artistcode DESC");
                    while($rowartist = mysqli_fetch_array($sql1)){
                        ?>
                        <!-- Single Album -->
                        <?php echo "<div class='single-album'><img src='admin/upload_images/artist/$rowartist[image]' alt='artist' >"?>
                        <div class="album-info">
                            <?php
                            echo '<a href=album.php?link='.base64_encode($rowartist['artistcode']).'&artist='.base64_encode("artist").' >Artist Name
                            <h6>'.$rowartist['artistname'].'</h6>
                            </a>';
                            ?>
                            
                        </div>
                    </div>
                <?php } ?>   
            </div>
        </div>
    </div>
</section>
<section class="latest-albums-area section-padding-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading style-2">
                    <p>See what’s new</p>
                    <h2>Latest Albums</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="albums-slideshow owl-carousel">
                    <?php 
                    
                    $sql = mysqli_query($connect,"SELECT * FROM tblalbum a, tblartist b where a.artistcode=b.artistcode ORDER BY albumcode Asc");
                    while($rowAlbum = mysqli_fetch_array($sql)){
                        ?>
                        <!-- Single Album -->
                        <?php echo "<div class='single-album'><img src='admin/upload_images/album/$rowAlbum[albumimage]' alt='' >"?>
                        <div class="album-info">
                            <?php
                            echo '<a href=viewSongs.php?link='.base64_encode($rowAlbum['albumcode']).' >'.$rowAlbum['albumname'].'
                            <h5>'.$rowAlbum['artistname'].'</h5>
                            </a>';
                            ?>
                            <?php echo '<p>'.$rowAlbum['albumwriter'].'</p>';?>
                        </div>
                    </div>
                <?php } ?>   
            </div>
        </div>
    </div>
</section>



<!-- ##### Miscellaneous Area Start ##### -->
<section class="miscellaneous-area section-padding-100-0">
    <div class="container">
        <div class="row">
            <!-- ***** Weeks Top ***** -->
            <div class="col-12 col-lg-4">
                <div class="weeks-top-area mb-100">
                    <div class="section-heading text-left mb-50 wow fadeInUp" data-wow-delay="50ms">
                        <p>See what’s new</p>
                        <h2>This week’s top</h2>
                    </div>
                    <?php 
                    $sql = mysqli_query($connect,"SELECT a.albumcode,a.albumwriter,a.albumimage, a.albumname, a.albumimage FROM  tblalbum a ORDER BY albumcode DESC LIMIT 6");
                    $count=0;
                    while($rowAlbum = mysqli_fetch_array($sql)){
                        $count++;
                        ?>
                        <!-- Single Top Item -->

                        <div class="single-top-item d-flex wow fadeInUp" data-wow-delay="100ms">
                            <div class="thumbnail">
                              <?php echo "<img src=admin/upload_images/album/$rowAlbum[albumimage] height=50 width=60>"?> 
                          </div>

                          <div class="content-">
                             <?php
                             if((isset($_SESSION['user_id']) && $_SESSION['name'] != ''&& $_SESSION['usertype']=='051' )){
                               ?>
                               <?php
                               echo '<a href=viewSongs.php?link='.base64_encode($rowAlbum['albumcode']).' >'.$rowAlbum['albumname'].'
                               <h6>'.$rowAlbum['albumwriter'].'</h6> </a>';
                               ?>
                           <?php } else{ ?>
                            <?php if($count>=2 && $count<=3){ ?>

                                <a href="viewSongs.php?link=<?php echo base64_encode($rowAlbum['albumcode']);?>">


                                   <?php
                                   echo $rowAlbum['albumname'] ?>
                                   <h6><?php
                                   echo $rowAlbum['albumwriter'] ?></h6>
                               </a>
                           <?php } else{ ?>
                             <?php
                             echo '<a href="loginpage.php">
                             '.$rowAlbum['albumname'].'
                             <h6>'.$rowAlbum['albumwriter'].'</h6> </a>';
                             ?>
                         <?php } ?>
                     <?php }  ?>
                 </div>
             </div>
         <?php } ?>
     </div>
 </div>

 <!-- ***** New Hits Songs ***** -->
 <div class="col-12 col-lg-4">
    <div class="new-hits-area  mb-100">
        <div class="section-heading text-left mb-50 wow fadeInUp" data-wow-delay="50ms">
            <p>See what’s new</p>
            <h2>New Hits</h2>
        </div>

        <!-- Single Top Item -->
        <?php 
        $sql = mysqli_query($connect,"SELECT a.songcode,a.song,a.songname FROM tblsongs a ORDER BY songcode Asc limit 6");
        $count=0;
        while($rowSong = mysqli_fetch_array($sql)){
            $count++;
            ?>
            <div class="single-new-item d-flex align-items-center justify-content-between wow fadeInUp" data-wow-delay="100ms">

                <div class="first-part d-flex align-items-center">
                    <div class="content-">
                       <?php
                       echo '<h6>'.$rowSong['songname'].'</h6> ';
                       ?>

                   </div>
               </div>

               <?php
               if((isset($_SESSION['user_id']) && $_SESSION['name'] != ''&& $_SESSION['usertype']=='051' )){
                   ?>
                   <audio preload="auto" controls>
                       <?php echo '<source src="admin/songs/'.$rowSong[song].'">' ?> 
                   </audio>
               <?php } else{ ?>
                <?php if($count>=2 && $count<=3){ ?>
                    <audio preload="auto" controls>
                        <?php echo '<source src="admin/songs/'.$rowSong[song].'">' ?>
                    </audio>
                <?php } else{ ?>
                    <a href="loginpage.php">
                        <audio preload="auto" controls>
                            <?php echo '<source src="#">' ?>
                        </audio>
                    </a>
                <?php } ?>
            <?php } ?>

        </div>
    <?php }?>
</div>
</div>

<!-- ***** Popular Artists ***** -->
<div class="col-12 col-lg-4">
    <div class="popular-artists-area mb-100">
        <div class="section-heading text-left mb-50 wow fadeInUp" data-wow-delay="50ms">
            <p>See what’s new</p>
            <h2>Popular Artist</h2>
        </div>

        <!-- Single Artist -->
        <?php 
        $sql = mysqli_query($connect,"SELECT a.artistcode,a.artistname,a.image FROM tblartist a ORDER BY artistcode");
        while($rowArtist = mysqli_fetch_array($sql)){
            ?>
            <div class="single-artists d-flex align-items-center wow fadeInUp" data-wow-delay="100ms">
                <div class="thumbnail">
                   <?php echo "<img src=admin/upload_images/artist/$rowArtist[image] >"?> 
               </div>
               <div class="content-">
                <?php
                echo '<p>'.$rowArtist['artistname'].'</p>'
                ?>
            </div>
        </div>
    <?php } ?>
</div>
</div>
</div>
</div>
</section>
<!-- ##### Miscellaneous Area End ##### -->

<script>
    $(document).ready(function(){
        $('#content-pane').load('nothing.php');

        $('#btnsearch').on('click',function(){

                    // Send query and load dynamically
                    var key = $('#search').val();
                    var type="songs";
                    if(key==''){
                        alert("Please Enter Song Name..");
                        $('#search').focus();
                        return false;
                    }

                    var total = key + ":" + type;

                    $.post('search.php',{str:total},function(data){
                        $('div#content-pane').html(data);
                    });
                    
                });

    });
</script>


<?php include('includes/footer.php') ?>

