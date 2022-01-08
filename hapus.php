<?php
session_start();
include "koneksi.php";

if (!isset($_GET['id'])){
  header("location:index.php");
}
$id = $_GET['id'];
$query = "UPDATE user SET step=0 WHERE id=$id";
if(mysqli_query($conn,$query)){
  $back = "index.php";
  if(isset($_GET['back'])){
    $back = $_GET['back'];
  }
  header("location:".$back);
}
?>