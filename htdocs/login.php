<?php
require_once('includes/connect.php');
$username = $_POST['username'];
$password = $_POST['password'];
$check = mysqli_query($connect,"SELECT * FROM tblusers WHERE username = '$username' AND password ='$password'") or die(mysql_error());
if(mysqli_num_rows($check) >= 1){
	while($row = mysqli_fetch_array($check)){
		session_start();
		$_SESSION['user_id'] = $row['user_id'];
		$_SESSION['name'] = $row['name'];
		header("Location:admin/index.php");	
	}
	
}else{
	header("Location:loginpage?error_log=1");	
}
?>