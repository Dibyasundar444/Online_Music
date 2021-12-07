
<?php 
session_start();
require_once('includes/connect.php');
?>
<html>
<body>
	<script>
		function f1()
		{
			alert("Nothing");
		}
	</script>

	<?php
	list($key,$type) = explode(":",$_POST['str']);
	?>
	
	<?php
	    if($type=="songs"){
	        
		$key1=trim(strtolower($key));
		$result =  mysqli_query($connect,"Select a.songcode, a.songname, b.albumname, a.song From tblsongs a, tblalbum b Where (a.songname LIKE '%$key1%' or b.albumname LIKE '%$key1%') and a.albumcode=b.albumcode") or die("Error " . mysqli_error());

		if(!$result || mysqli_num_rows($result)==0)
		{
			?>
			<div class="col-md-12">
				<div class="bg-danger text-white text-center p-10"  style="padding:4px 8px;"> No Data Found !!</div>
			</div>

	   <?php
		}
		else{
		?>
				<table class="table table-bordered" style="overflow-x: auto;">
					<tr>
						<th>Sl No.</th>
						<th>Song Name</th>
						<th>Album Name</th>
						<th width="10%">Action</th>
					</tr>
					<?php
					$count=0;
					while($data=mysqli_fetch_Array($result))
					{
					    $count++;
					    ?>
					    
						<tr>
						<td><?php echo $count; ?></td>
						<td><?php echo $data[1]; ?></td>
						<td><?php echo $data[2]; ?></td>
						
						<td>
						 <?php
                            if((isset($_SESSION['user_id']) && $_SESSION['name'] != ''&& $_SESSION['usertype']=='051' )){
                         ?>
                         <audio preload="auto" controls>
                        <?php echo '<source src="admin/songs/'.$data[3].'">' ?> 
                        </audio>
                        <?php } else{ ?>
                        <?php if($count>=2 && $count<=3){ ?>
                            <audio preload="auto" controls>
                        <?php echo '<source src="admin/songs/'.$data[3].'">' ?>
                          </audio>
                         <?php } else{ ?>
                         <a href="loginpage.php">
                         <audio preload="auto" controls>
                    <?php echo '<source src="#">' ?>
                     </audio>
                     </a>
                            <?php } } ?>
                      </td>
                      
						</tr>
			        	<?php	} ?>
					</table>
					<?php
				        }

				mysqli_close($connect);
			}
			
			?>
					</body>
					</html>