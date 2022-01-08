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
             
            <li class="scroll-to-section"><a href="final.php" >Hasil Perankingan</a></li>
             <li class="scroll-to-section"><a href="#top" class="active">Interview</a></li>
              <li class="scroll-to-section"><div class="main-red-button"><a href="logout.php">Logout</a></div></li> 
            </ul>   
          </nav>
        </div>
      </div>
    </div>
  </header>
  <!-- ** Header Area End ** -->
<body>
  <div class="main-banner wow fadeIn" id="top" data-wow-duration="1s" data-wow-delay="0.5s">
    <div class="container">
      <div class="row">
       <div class="col-lg-6 offset-lg-3">
            <div style="margin-top: -70px;"  class="section-heading wow bounceIn" data-wow-duration="1s" data-wow-delay="0.2s">
              <center><h2>Form <em>Penilaian</em> <span>Tahap Interview</span> Calon Pegawai  </h2></center>
            </div>
          </div>
<center><table class="table table-hover" style="margin-right: 20px; margin-top: 30px ;font-family:cursive; background-color: white; border-color: black; width: 100px;">
  <thead>
    <tr>
      <!-- <th scope="col">#</th> -->
      <th scope="col">Nama</th>
      <th scope="col">Telp</th>
      <th scope="col">Email</th>
      <th scope="col">Learn</th>
      <th scope="col">Teamwork</th>
      <th scope="col">Ethic</th>
      <th scope="col">Discipline</th>
      <th scope="col">Salary</th>
      <th  scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $query = "SELECT * FROM user WHERE step = 3";
    $result = mysqli_query($conn,$query);

    while($data = mysqli_fetch_array($result)){

    ?>
    <tr>
     <!--  <th scope="row">1</th> -->
      <td><?=$data["nama"]?></td>
      <td><?=$data["telp"]?></td>
      <td><?=$data["email"]?></td>
      <form action="hitung_interview.php" method="post">
      <td class="form_id"><input type="number" name="user_id" value="<?=$data["id"]?>"></td>
      <td><center><input style="width: 45px;" type="number" name="learn"></td></center>
      <td><center><input style="width: 45px;" type="number" name="teamwork"></td></center>
      <td><center><input style="width: 45px;" type="number" name="ethic"></td></center>
      <td><center><input style="width: 45px;" type="number" name="discipline"></td></center>
      <td><center><input style="width: 145px;" type="number" name="salary"></td></center>
      <td >
        <input class="btn btn-primary" type="submit" name="submit" value="submit" href= "final.php">
        <a href="hapus.php?id=<?=$data['id']?>&back=http://localhost/SPK/interview.php" class="btn btn-danger">Tolak</a>
      </td>
      </form>
    </tr>
    <?php }?>
  </tbody>
</table></center>


<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>