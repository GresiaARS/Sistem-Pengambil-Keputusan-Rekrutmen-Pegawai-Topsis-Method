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
<style>
    .form_id{
      display: none;
    }
  </style>
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
            <!-- ** Logo Start ** -->
            <a href="index.html" class="logo">
              <img src="img/logo.png" style=" height: 80px; margin-top: -20px;" >
             
            </a>
            <!-- ** Logo End ** -->
 <ul class="nav">
              <li class="scroll-to-section"><a href="#top" class="active">Hasil Perankingan</a></li>
              <li class="scroll-to-section"><a href="interview.php">Interview</a></li>
              <li class="scroll-to-section"><div class="main-red-button"><a href="logout.php">Logout</a></div></li> 
            </ul>   
          </nav>
        </div>
      </div>
    </div>
  </header>
  <!-- ** Header Area End ** -->

  <div class="main-banner wow fadeIn" id="top" data-wow-duration="1s" data-wow-delay="0.5s">
    <div id="portfolio" class="our-portfolio section" >
      <div class="container">
        <div class="row">
          <div class="col-lg-6 offset-lg-3">
            <div style="margin-top: -200px;"  class="section-heading wow bounceIn" data-wow-duration="1s" data-wow-delay="0.2s">
              <h2>Real-time update hasil <em>Rekrutmen</em> Pegawai untuk Posisi <span>Back-End Developer</span></h2>
            </div>
          </div>
        
      <table class="table table-hover" style="margin-left: 20px;margin-right: 20px;font-family:cursive; background-color: white; border-color: black;">
    <thead>
    <tr style="background-color: skyblue; border-width: 2px ;">
      <th>Ranking</th>
      <th>Nama </th>
      <th>Telp</th>
      <th>Email</th>
      <th>CV</th>
    </tr>
      </thead>  
          <tbody>
 <?php 
    $query = "SELECT * FROM user WHERE step = 4 order by nilai DESC";
    $result = mysqli_query($conn,$query);
    $x = 1;
    while($data = mysqli_fetch_array($result)){

    ?>

      <tr>
      <th scope="row"><?=$x?></th>
      <td><?=$data["nama"]?></td>
      <td><?=$data["telp"]?></td>
      <td><?=$data["email"]?></td>
      <td><button class="btn-btn danger"><a href="file/<?=$data["cv"]?>" target="blank">Unduh</a></button>   </td>
      </form>
    </tr>
    <?php $x++;
   }?>
  </tbody>
</table>




        </div>
      </div>
    </div>
  </div>