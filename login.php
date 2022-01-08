 <?php 
if(isset($_GET['pesan'])){
  if($_GET['pesan'] == "gagal"){
    echo "Login gagal! username dan password salah!";
  }else if($_GET['pesan'] == "logout"){
    echo "Anda telah berhasil logout";
  }else if($_GET['pesan'] == "belum_login"){
    echo "Anda harus login untuk mengakses halaman admin";
  }
}
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

    <title>LOGIN-SPK</title>

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

<body>

  <!-- ***** Preloader Start ***** -->
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
  <!-- ***** Preloader End ***** -->

  <!-- ***** Header Area Start ***** -->
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

          </nav>
        </div>
      </div>
    </div>
  </header>
  <!-- ***** Header Area End ***** -->


  <div id="about" class="about-us section">
    <div class="container">
      <div class="row">

        <div class="col-lg-4">
          <div class="left-image wow fadeIn" data-wow-duration="1s" data-wow-delay="0.2s">
            <img src="assets/images/about-left-image.png" alt="person graphic">
          </div>
        </div>

          <div class="col-lg-8 align-self-left">
            <div class="services">
              <div id="row">
                <?php if (isset($_GET['error'])) {echo "$_GET[error]";} else { echo "";} ?>
                 <div class="wow fadeIn" data-wow-duration="1s" data-wow-delay="0.2s">

        <form id="contact" style="width: 500px; height: 450px; ; margin-left: 350px;" action="ceklogin.php" method="post">
            <div>
              <center><h3>L O G I N</h3></center>
            </div>

            <div class="form-group">
                <label style="margin-top:10px;" >Username</label>
                <input style="margin-top: 10px;" type="text" class="form-control" name="username" id="username" placeholder="Username" required="" id="username" autocomplete="off" />
            </div>
            <div  class="form-group">
              <label style="margin-top:10px;">Password</label>
                <input style="margin-top: 10px;" type="password" class="form-control" name="password" id="password" placeholder="Password" required="" id="password" autocomplete="off" />
            </div>
            <div style="margin-top: 20px;">
                <button class="btn btn-primary" type="submit" value="Log in" />Login</button> 
            </div>
            <div>
                <h6 style="margin-top: 10px;"> Belum punya akun? <a href="register.php">Register</a></h6>
            </div>
        </form>
      </div>
          </div>
        </div>
      </div>


     </div>
    </div>
  </div>







  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>
  <script src="assets/js/animation.js"></script>
  <script src="assets/js/imagesloaded.js"></script>
  <script src="assets/js/templatemo-custom.js"></script>

</body>
</html>