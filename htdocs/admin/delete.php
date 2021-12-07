<?php
session_start();
if(!(isset($_SESSION['user_id']) && $_SESSION['name'] != ''  || $_SESSION['usertype']!='')){
    header ("Location: index.php");
    die();
}

$link = base64_decode($_GET['link']); 
$name = base64_decode($_GET['name']);
$file = base64_decode($_GET['file']);

require_once('includes/connect.php');
if($name=='Artistdlt'){

 $result = mysqli_query($connect, "SELECT * FROM tblalbum where  artistcode= '$link'");
 if (mysqli_num_rows($result) > 0)
 {
  echo "<script>alert('Can Not Delete Artist!!!');window.location='artists.php' </script>";
   die();
   exit();
 }

 else{
  $target_dir = "upload_images/artist/";
  unlink($target_dir.$file);
    $del = mysqli_query($connect,"DELETE from tblartist where artistcode = '$link'"); // delete query
    if($del)
    {
     mysqli_close($connect); 
    // header("location:artists.php"); 
     header("Location:artists.php?success=1");  
     die(); 
   }
   else
   {
    echo "Error deleting record"; 
  }
}
}

if($name=='CategoryDlt'){

 $result = mysqli_query($connect, "SELECT * FROM tblalbum where  catcode= '$link'");
 if (mysqli_num_rows($result) > 0)
 {
  echo "<script>alert('Can Not Delete Category!!!');window.location='category.php' </script>";
   die();
   exit();
 }

 else{
  $target_dir = "upload_images/category/";
  unlink($target_dir.$file);
    $del = mysqli_query($connect,"DELETE from tblcategory where catcode = '$link'"); // delete query
    if($del)
    {
     mysqli_close($connect); 
    // header("location:artists.php"); 
     header("Location:category.php?success=1");  
     die(); 
   }
   else
   {
    echo "Error deleting record"; 
  }
}
}

if($name=='Albumdlt'){

 $result = mysqli_query($connect, "SELECT * FROM tblsongs where  albumcode= '$link'");
 if (mysqli_num_rows($result) > 0)
 {
  echo "<script>alert('Can Not Delete Album!!!');window.location='category.php' </script>";
   die();
   exit();
 }

 else{
  $target_dir = "upload_images/album/";
  unlink($target_dir.$file);
    $del = mysqli_query($connect,"DELETE from tblalbum where albumcode = '$link'"); // delete query
    if($del)
    {
     mysqli_close($connect); 
    // header("location:artists.php"); 
     header("Location:album.php?success=1");  
     die(); 
   }
   else
   {
    echo "Error deleting record"; 
  }
}
}

if($name=='Songsdlt'){
  $target_dir = "songs/";
  unlink($target_dir.$file);
    $del = mysqli_query($connect,"DELETE from tblsongs where songcode = '$link'"); // delete query
    if($del)
    {
     mysqli_close($connect); 
     header("Location:songs.php?success=1");  
     die(); 
   }
   else
   {
    echo "Error deleting record"; 
  }
}

if($name=='UserRegsdlt'){
 // $target_dir = "songs-1/";
 // unlink($target_dir.$file);
    $del = mysqli_query($connect,"DELETE from tblusers where user_id = '$link' And usertype='051'"); // delete query
    if($del)
    {
     mysqli_close($connect); 
     header("Location:dashboard.php?success=1");  
     die(); 
   }
   else
   {
    echo "Error deleting record"; 
  }
}

if($name=='Sliderdlt'){
  $target_dir = "upload_images/slider/";
  unlink($target_dir.$file);
    $del = mysqli_query($connect,"DELETE from tblslider where id = '$link'"); 
    // delete query
    if($del)
    {
     mysqli_close($connect); 
     header("Location:slider.php?success=1");  
     die(); 
   }
   else
   {
    echo "Error deleting record"; 
  }
}


  ?> 