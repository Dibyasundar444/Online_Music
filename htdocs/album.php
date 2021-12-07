<?php
include('includes/header.php');
?>
<?php
$artist="";
$link="";
if(isset($_GET["link"]) && isset($_GET["artist"])){
    $link=base64_decode($_GET["link"]);
    $artist=base64_decode($_GET["artist"]);
}

?>
<section class="breadcumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/breadcumb3.jpg);">
    <div class="bradcumbContent">
        <p>See what’s new</p>
        <h2>Latest Albums</h2>
    </div>
</section>

<section class="album-catagory section-padding-100-0">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="browse-by-catagories catagory-menu d-flex flex-wrap align-items-center mb-70">
                    <a href="#" class="active" data-filter="*">All</a>
                    <a href="#" data-filter=".a" >A</a>
                    <a href="#" data-filter=".b">B</a>
                    <a href="#" data-filter=".c">C</a>
                    <a href="#" data-filter=".d">D</a>
                    <a href="#" data-filter=".e">E</a>
                    <a href="#" data-filter=".f">F</a>
                    <a href="#" data-filter=".g">G</a>
                    <a href="#" data-filter=".h">H</a>
                    <a href="#" data-filter=".i">I</a>
                    <a href="#" data-filter=".j">J</a>
                    <a href="#" data-filter=".k">K</a>
                    <a href="#" data-filter=".l">L</a>
                    <a href="#" data-filter=".m">M</a>
                    <a href="#" data-filter=".n">N</a>
                    <a href="#" data-filter=".o">O</a>
                    <a href="#" data-filter=".p">P</a>
                    <a href="#" data-filter=".q">Q</a>
                    <a href="#" data-filter=".r">R</a>
                    <a href="#" data-filter=".s">S</a>
                    <a href="#" data-filter=".t">T</a>
                    <a href="#" data-filter=".u">U</a>
                    <a href="#" data-filter=".v">V</a>
                    <a href="#" data-filter=".w">W</a>
                    <a href="#" data-filter=".x">X</a>
                    <a href="#" data-filter=".y">Y</a>
                    <a href="#" data-filter=".z">Z</a>
                </div>
            </div>
        </div>

        <div class="row oneMusic-albums">
            <?php 
            if($artist=="artist"){
            $sql = mysqli_query($connect,"SELECT a.albumcode,a.albumname, a.albumwriter,a.albumimage, a.artistcode,c.artistname from tblalbum a, tblartist c where a.artistcode='$link' and a.artistcode=c.artistcode");
            }
            else{
            $sql = mysqli_query($connect,"SELECT a.albumcode,a.albumname, a.albumwriter,a.albumimage, a.artistcode,c.artistname from tblalbum a, tblartist c where a.artistcode=c.artistcode");
            }
           
            while($rowalbum = mysqli_fetch_array($sql)){
              
                $string=$rowalbum['albumname'];
                
                $firstCharacter = strtolower(substr($string, 0, 1));
              
                ?>
                <div class="col-12 col-sm-4 col-md-3 col-lg-2 single-album-item <?php echo $firstCharacter ?>">
                    <?php
                    echo '<a href=viewSongs.php?link='.base64_encode($rowalbum['albumcode']).' >'?>
                    <div class="single-album">
                     <?php echo "<img src=admin/upload_images/album/$rowalbum[albumimage] height=50 width=60>"?>
                     <div class="album-info">
                        <h5><?php echo $rowalbum['albumname'] ?></h5>
                        <p><?php echo $rowalbum['artistname'] ?></p>
                    </div>
                </div>
            </a>
        </div>
    <?php } ?>
</div>
</div>
</section>


<?php include('includes/footer.php') ?>
