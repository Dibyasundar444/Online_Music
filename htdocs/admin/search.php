<?php
session_start();
if(!(isset($_SESSION['user_id']) && $_SESSION['name'] != ''||$_SESSION['image'] != ''  || $_SESSION['usertype']!='')){
	header ("Location: index.php");
	die();
}
?>
<?php 
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
	list($key,$date1,$date2,$type) = explode(":",$_POST['str']);
    $date11=date_format(date_create($date1),'Y-m-d ');
   $date22=date_format(date_create($date2),'Y-m-d ');
	?>
	<?php
	if($type=="Duser"){
		$key1=trim(strtolower($key));
		$result =  mysqli_query($connect," SELECT a.name,a.mobileno,a.username,a.password,date_format(a.regdt, '%d/%M/%Y') as regdate From tblusers a Where a.regdt >= '$date11' AND a.regdt <='$date22' And a.username like '%$key1%'  And a.usertype='051' ") or die("Error " . mysqli_error());

		if(!$result || mysqli_num_rows($result)==0)
		{
			?>
			<div class="col-md-12">
				<div class="bg-danger text-white text-center p-10"  style="padding:4px 8px;"> No Results Found !</div>
			</div>

			<?php
		}
		else
			{?>
				<table class="table table-bordered" style="overflow-x: auto;">
					<tr>
						<th>Name</th>
						<th>Contact No.</th>
						<th>User ID</th>
						<th>Password</th>
						<th>Regstation Date</th>
						<!--<th> Action </th>-->
					</tr>
					<?php
					while($data=mysqli_fetch_Array($result))
					{
						echo "<tr>";
						echo "<td> $data[0] </td> ";
						echo "<td> $data[1] </td> ";
						echo "<td> $data[2] </td> ";
						echo "<td> $data[3] </td> ";
						echo "<td> $data[4] </td> ";

						echo "</tr>";
					}
					?></table><?php
				}

				mysqli_close($connect);
			}
			
if($type=="songs"){

				$result = mysqli_query($connect,"SELECT a.songname,a.song, date_format(a.UploadDt, '%d %M %Y') as UploadDt,b.albumname,b.albumimage,b.albumwriter,c.Data,a.songcode from tblsongs a,tblalbum b,tblhelp c Where a.albumcode='$key' And a.albumcode=b.albumcode And a.status=c.Code And a.UploadDt >= '$date11' And a.UploadDt <= '$date22' order by a.songcode") or die("Error " . mysqli_error());





				if(!$result || mysqli_num_rows($result)==0)
				{
					?>
					<div class="col-md-11 mr-auto p-0">
						<div class="bg-danger text-white text-center p-10"  style="padding:4px 8px;"> No Songs Add !</div>
					</div>

					<?php
				}
				else
					{?>
						<table class="table table-striped custom-table datatable" style="overflow-x: auto;">
							<thead>
								<tr>
									<th>Album Details</th>
									<th>Songs Name</th>
									<th>Lisent Songs</th>
									<th>Upload Date</th>
									<th class="text-right">Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php
								while($data=mysqli_fetch_Array($result))
								{
									echo "<tr>";

									echo "<td> 
									<a href='javascript:Void(0);'' class='avatar'><img src='upload_images/album/$data[4]'></a>
									<h2><a href='#'>$data[3] <span>$data[5]</span></a></h2>
									
									</td> ";

									echo "<td> $data[0] </td> ";

									echo "<td>  
									<audio preload='auto' id='previewaudio' controls>
									<source  src='songs/$data[1]' >
									</audio>
									</td> ";

									echo "<td> $data[2] </td> ";
									echo "<td> 

									<div class='dropdown dropdown-action'>
									<a href='#' class='action-icon dropdown-toggle' data-toggle='dropdown'
									aria-expanded='false'><i class='fa fa-ellipsis-v'></i></a>
									<div class='dropdown-menu dropdown-menu-right'>

									<a  href='delete.php?link=".base64_encode($data[7])."&name=".base64_encode('Songsdlt')."&file=".base64_encode($data[1])."'
									class='dropdown-item' title='Decline' onclick='return confirm('Are You Sure To Delete?')'>
									<i class='fa fa-trash-o m-r-5' ></i> 
									Delete
									</a>
									</div>
									</div>



									</td> ";

									echo "</tr>";
								}
								?></tbody></table>
								<?php
							}

							mysqli_close($connect);
						}
						?>
					</body>
					</html>