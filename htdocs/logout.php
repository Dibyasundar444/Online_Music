<?php
//include("includes/config.php");
session_start();
if(!(isset($_SESSION['user_id'])&& $_SESSION['name'] != ''&& $_SESSION['usertype']=='051' )){
	header ("Location: index.php");
	die();
	exit();
}
 //date_default_timezone_set('Asia/Kolkata');
//$dat = date('Y-m-d H:i');
//$id=$_SESSION['id'];
//$edit = mysqli_query($con, "UPDATE admin SET Date='$dat' WHERE id='$id' ");
//if($edit){
	unset($_SESSION['user_id']);
	unset($_SESSION['name']);
	unset($_SESSION['usertype']);
	session_destroy();
	header ("Location: index.php");
	die();
//}
?>



