
<?php
include('includes/header.php');
?>
<?php
include 'download.php';
?>

<style type="text/css">
	.single-album-item{
		position:inherit!important;
		top:-5px!important;
	}
	.height-css{
		height: 800px;
		overflow-y: auto;
		box-shadow: inset 0 0 10px #000;
	}

	.fa-star{
		color: #efd039;
	}
</style>

<section class="breadcumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/breadcumb3.jpg);">
	<div class="bradcumbContent">
		<h2>Songs</h2>
	</div>
</section>
<div class="album-catagory blog-area section-padding-100 mb-5">
	<div class="container">
		<div class="row">
			<div class="col-lg-3  mb-5">
				
				<?php 
				$sql = mysqli_query($connect,"Select code, data from tblhelp where tag='05'");
				?>

				<!-- Widget Area -->
				<div class="single-widget-area">
					<div class="widget-title">
						<h5>Categories</h5>
					</div>
					<div class="widget-content">
						<ul class="catagory-menu">
							<li><a href="#" class="active" data-filter="*">All</a></li>
							<?php
							while($rowAlbum = mysqli_fetch_array($sql)){
								?>
								<li>   
									<a href="#" data-filter=".<?php echo $rowAlbum['code'] ?>" ><?php echo $rowAlbum['data']?></a>
								</li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-lg-9 col-md-9 height-css">
				<div class="single-blog-post mb-100 wow fadeInUp" data-wow-delay="100ms">
					<div class="container oneMusic-albums">
						<div class=" justify-content-center ">
							<?php 
							$sql = mysqli_query($connect,"SELECT a.albumcode,a.albumname,a.albumwriter,a.albumimage, a.artistcode,c.artistname,b.songcode,b.songname,b.songdesc, b.song, b.songtype,b.dwncount FROM tblalbum a, tblsongs b, tblartist c where a.albumcode=b.albumcode and a.artistcode=c.artistcode and a.albumcode='$link'");
							$count=0;
							$Totalrating=0;
							
							while($rowAlbum = mysqli_fetch_array($sql)){
								$count++;
								$Totalrating=$rowAlbum['dwncount'];	
								?>
								
								<div class="col-lg-3 col-md-3  pt-4">
									<?php if($count==1) {?>
										<div class="featured-artist-thumb">
											<?php echo "<img src=admin/upload_images/album/$rowAlbum[albumimage] class='img-fluid'>"?>
											<p class="font-weight-bold">Album Name:&nbsp;&nbsp;<?php echo "$rowAlbum[albumname] "?><br>Album Writer:&nbsp;&nbsp;<?php echo "$rowAlbum[albumwriter] "?></p>
										</div>
									<?php } ?>
								</div>
								<div  class="col-lg-9 col-md-9  <?php echo $rowAlbum['songtype']; ?> single-album-item" >
									<div class="featured-artist-content">
										<div class="song-play-area">
											<div class="song-name ">
												<p class="font-weight-bold"><?php echo $rowAlbum['songname'] ?>

												<span class="float-right"><!--Artist Name:&nbsp;
													<?php //echo $rowAlbum['artistname']?>-->
													<?php 
													if(floor($Totalrating/2)==5 || floor($Totalrating/2)>=5){
														$loop=5;
													}
													elseif(floor($Totalrating/2)==4 || floor($Totalrating/2)>=4 && floor($Totalrating/2)<5){
														$loop=4;
													}

													elseif(floor($Totalrating/2)==3 || floor($Totalrating/2)>=3 &&  floor($Totalrating/2)<4){
														$loop=3;
													}

													elseif(floor($Totalrating/2)==2 || floor($Totalrating/2)>=2 && floor($Totalrating/2)<3){
														$loop=2;
													}

													elseif(floor($Totalrating/2)==1 || floor($Totalrating/2)>=1 && floor($Totalrating/2)<2){
														$loop=1;
													}

													else{
														$loop=0;
													}

												for($i=1; $i<=$loop; $i++){

														echo"<i class='fa fa-star'></i>&nbsp;";
													} 

													?>



													&nbsp;&nbsp;

													<?php
													if((isset($_SESSION['user_id']) && $_SESSION['name'] != ''&& $_SESSION['usertype']=='051' )){
														?>

														<!--<a href="admin/songs/<?//php echo $rowAlbum['song'] ?>" download><i class="fa fa-download text-white"></i>
														</a>-->

														<a href="viewSongs.php?file_id=<?php echo base64_encode($rowAlbum['songcode']); ?>&link=<?php echo base64_encode($rowAlbum['albumcode']);?>" ><i class="fa fa-download text-white"></i></a>
													<?php } ?>
												</span>
											</p>
										</div>

										<?php
										if((isset($_SESSION['user_id']) && $_SESSION['name'] != ''&& $_SESSION['usertype']=='051' )){
											?>
											<audio preload="auto" controls>
												<?php echo '<source src="admin/songs/'.$rowAlbum['song'].'">' ?> 
											</audio>
										<?php } else{ ?>
											<?php if($count>=2){ ?>
												<audio preload="auto" controls>
													<?php echo '<source src="admin/songs/'.$rowAlbum['song'].'">' ?>
												</audio>
											<?php } else{ ?>
												<a href="loginpage.php">
													<audio preload="auto" controls>
														<?php echo '<source src="">' ?>
													</audio>
												</a>
											<?php } ?>
										<?php } ?>
									</div>
								</div>
							</div>

						<?php } ?>
					</div>
				</div>
			</div> 
		</div>


	</div>
</div>
</div>

<?php include('includes/footer.php') ?>


