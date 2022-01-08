<?php
include ("koneksi.php");
date_default_timezone_set('Asia/Jakarta');

session_start();

$username2 = $_POST['username'];
$password1 = $_POST['password'];
// $password2 = sha1($password1);

$username = mysqli_real_escape_string($conn, $username2);
$password = mysqli_real_escape_string($conn, $password1);

if (empty($username) && empty($password)) {
    header('location:../login.php?error=Username dan Password Kosong!');
} else if (empty($username)) {
    header('location:../login.php?error=Username Kosong!');
} else if (empty($password)) {
    header('location:../login.php?error=Password Kosong!');
}


$q = mysqli_query($conn, "select * from users where username='$username'");
$row = mysqli_fetch_array ($q);

$hash   = mysqli_fetch_assoc($q)['password'];
if (password_verify($password, $hash)) {
    $_SESSION['username'] = $username;
                
    header('Location: index.php');
}

if (mysqli_num_rows($q) == 1) {
    $_SESSION['id'] = $row['id'];
    $_SESSION['username'] = $username;
    $_SESSION['fullname'] = $row['fullname'];
    $_SESSION['level']    = $row['level'];
    
    if ($_SESSION['level'] == 'admin'){
        header('location:portofolio.php');
    } else if ($_SESSION['level'] == 'hrd'){
        header('location:final.php');
    } else if ($_SESSION['level'] == 'senpro'){
        header('location:technical.php');
    }

    
} else {
    header('location:../login.php?error=Anda Belum Terdaftar!');
}
?>