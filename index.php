<?php
session_start();
include "koneksi.php"
?>


<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>INDEX-SPK</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-space-dynamic.css">
    <link rel="stylesheet" href="assets/css/animated.css">
    <link rel="stylesheet" href="assets/css/owl.css">
<!--
    
TemplateMo 562 Space Dynamic

https://templatemo.com/tm-562-space-dynamic

-->
  </head>

<header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="main-nav">
            <!-- ***** Logo Start ***** -->
            <a href="index.html" class="logo">
              <img src="img/logo.png" style=" height: 80px; margin-top: -20px;" >
             
            </a>
            <!-- ***** Logo End ***** -->
             <ul class="nav">
             
              <li class="scroll-to-section"><div class="main-red-button"><a href="home.php">Home</a></div></li> 
            </ul>  
          </nav>
        </div>
      </div>
    </div>
  </header>

<div id="contact" class="contact-us section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 align-self-center wow fadeInLeft" data-wow-duration="0.5s" data-wow-delay="0.25s">
          <div class="section-heading">
            <h2>Silahkan mengisi formulir disamping dengan benar !</h2>
            <p>Seleksi penerimaan karyawan terdiri dari beberapa tahapan, mulai dari penilaian portofolio, kemampuan tecnhical dan wawancara</p>
           
          </div>
        </div>
        <div class="col-lg-6 wow fadeInRight" data-wow-duration="0.5s" data-wow-delay="0.25s">

          <form id="contact" action="" enctype="multipart/form-data" method="post">
            <div class="row">
              <div class="col-lg-6">
                <fieldset>
                  <input type="text" name="nama" id="nama" placeholder="Nama Lengkap" required>
                </fieldset>
              </div>
              <div class="col-lg-6">
                <fieldset>
                  <input type="number" name="telp" id="telp" placeholder="No. HP" required>
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <input type="email" name="email" id="email" placeholder="Email aktif anda" required="">
                </fieldset>
              </div>
             <div class="col-lg-12">
                <fieldset>
                  <label>Lampirkan CV Anda</label>
                  <input style="padding-top:12px;" type="file" name="cv" class="form-control" id="message" placeholder="Curiculum Vitae" required=""></textarea>  
                </fieldset>
              </div>
              <div class="col-lg-12" >
                <fieldset >
                  <button type="submit" name="submit" value="daftar"class="main-button ">Submit</button>
                </fieldset>
              </div>
            
          
          <div style="margin-top: 5px;"> <center>
          <?php
    if(isset($_POST['submit'])){
      $nama = $_POST['nama'];
      $telp = $_POST['telp'];
      $email = $_POST['email'];
      $cv = $_FILES['cv'];
      if(!empty($nama)&&!empty($telp)&&!empty($email)&&!empty($cv)){
          $temp = $cv["tmp_name"];
          $rand = random_int(0,10000);
          $name = $rand.$cv["name"];
          $cek = move_uploaded_file($temp,"file/".$name);
          if($cek){
            $query = "INSERT INTO user SET nama='$nama', telp=$telp, email='$email', cv='$name', step=1";
            $result = mysqli_query($conn,$query);
            if($result){
              echo "Lamaran anda berhasil dikirim, tim kami akan segera menghubungi anda";
            }else{
              echo "gagal memasukan data ke dalam database";
            }
          }else{
            echo "gagal mengupload file";          }
      }else{
        echo "form harus legkap";
      }
    }
    ?>
</center></div>
</div>
</form>


          
        </div>
      </div>
    </div>
  </div>