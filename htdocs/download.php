<?php
if($_GET['link']==""){
	header("Location:index.php");
	die();
}

else{
$link = base64_decode($_GET['link']);
if (isset($_GET['file_id'])) {
    $id = base64_decode($_GET['file_id']);

    // fetch file to download from database
   $sql = "SELECT songcode, song, dwncount FROM tblsongs WHERE songcode='$id' and albumcode='$link'";
    $result = mysqli_query($connect, $sql);

    $file = mysqli_fetch_assoc($result);
    $filepath = 'admin/songs/'.$file['song'];

    if (file_exists($filepath)) {

    	echo $filepath;
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('admin/songs/'.$file['song']));
        readfile('admin/songs/'.$file['song']);

        // Now update downloads count
  $newCount = $file['dwncount'] + 1;
  $updateQuery = "UPDATE tblsongs SET dwncount=$newCount WHERE songcode='$id' and albumcode='$link' ";
  mysqli_query($connect, $updateQuery);
      //  exit;
 }
}
}
?>