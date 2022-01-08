<?php
//menyertakan file program koneksi.php pada register
require('koneksi.php');
//inisialisasi session
session_start();

$error = '';
$validate = '';
//mengecek apakah form registrasi di submit atau tidak
if( isset($_POST['submit']) ){
        // menghilangkan backshlases
        $username = stripslashes($_POST['username']);
        //cara sederhana mengamankan dari sql injection
        $username = mysqli_real_escape_string($conn, $username);
        $fullname  = stripslashes($_POST['fullname']);
        $fullname  = mysqli_real_escape_string($conn, $fullname);
        $nik    = stripslashes($_POST['nik']);
        $nik     = mysqli_real_escape_string($conn, $nik);
        $level    = stripslashes($_POST['level']);
        $level    = mysqli_real_escape_string($conn, $level);
        $password = stripslashes($_POST['password']);
        $password = mysqli_real_escape_string($conn, $password);
        $repass   = stripslashes($_POST['repassword']);
        $repass   = mysqli_real_escape_string($conn, $repass);
        //cek apakah nilai yang diinputkan pada form ada yang kosong atau tidak
        if(!empty(trim($fullname)) && !empty(trim($username)) && !empty(trim($nik)) && !empty(trim($level)) && !empty(trim($password)) && !empty(trim($repass))){
            //mengecek apakah password yang diinputkan sama dengan re-password yang diinputkan kembali
            if($password == $repass){
                //memanggil method cek_nama untuk mengecek apakah user sudah terdaftar atau belum
                if( cek_nama($fullname,$conn) == 0 ){
                    //hashing password sebelum disimpan didatabase
                    $pass  = password_hash($password, PASSWORD_DEFAULT);
                    //insert data ke database
                    $query = "INSERT INTO users (id, username, password, fullname, nik, level ) VALUES ('', '$username','$pass','$fullname','$nik','$level')";
                    $result   = mysqli_query($conn, $query);
                    //jika insert data berhasil maka akan diredirect ke halaman index.php serta menyimpan data username ke session
                    if ($result) {
                        $_SESSION['username'] = $username;
                        
                        header('Location: login.php');
                     
                    //jika gagal maka akan menampilkan pesan error
                    } else {
                        $error =  'Register User Gagal !!';
                    }
                }else{
                        $error =  'Username sudah terdaftar !!';
                }
            }else{
                $validate = 'Password tidak sama !!';
            }
             
        }else {
            $error =  'Data tidak boleh kosong !!';
        }
    } 
    //fungsi untuk mengecek username apakah sudah terdaftar atau belum
    function cek_nama($username,$conn){
        $nama = mysqli_real_escape_string($conn, $username);
        $query = "SELECT * FROM user WHERE username = '$username'";
        if( $result = mysqli_query($conn, $query) ) return mysqli_num_rows($result);
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

    <title>REGISTER-SPK</title>

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

        <form id="contact" style="width: 500px; height: 550px;  margin-left: 350px; margin-top: -53px;" action="register.php" method="post">
           <div>
              <center><h3 style="margin-top: -50px;">R E G I S T E R</h3></center>
            </div>

            <div style="margin-top: 10px;" class="row">
              <div class="col-lg-12">
                <fieldset>
                  <input type="text" name="nama" id="nama" placeholder="Nama Lengkap" required>
                </fieldset>
              </div>

              <div class="col-lg-12">
                <fieldset>
                  <input type="number" name="nik" id="nik" placeholder="NIK" required>
                </fieldset>
              </div>

              <div style="background-color: #D1FEFF; border-radius: 30px; height: 45px; margin-left: 14px; width: 435px;" class="col-lg-12">
                <fieldset>
                    <!-- <input style="margin-left: 10px;width: 15px; height: 15px;" type="radio" name="level" value="user">Pelamar -->
                     <input style="margin-top: 15px; width: 15px; height: 15px;" type="radio" name="level" value="admin">Admin
                    <input style="margin-left: 10px;width: 15px; height: 15px;" type="radio" name="level" value="z">HRD
                    <input style="margin-left: 10px;width: 15px; height: 15px;" type="radio" name="level" value="">Senior Programmer
                    <!-- <input style="margin-left: 10px;width: 15px; height: 15px;" type="radio" name="level" value="">Director -->
                </fieldset>
              </div>

              <div style="margin-top: 13px;" class="col-lg-12">
                <fieldset>
                  <input type="text" id="username" name="username" placeholder="Username" required>
                </fieldset>
              </div>

              <div class="col-lg-12">
                <fieldset>
                  <input type="password" name="password" placeholder="Password" id="InputPassword" required>
                  <?php if($validate != '') {?>
                    <p class="text-danger"><?= $validate; ?></p>
                  <?php }?>
                </fieldset>
              </div>

               <div class="col-lg-12">
                <fieldset>     
                  <input type="password" name="repassword" id="InputRePassword" placeholder="Re-password" required>
                    <?php if($validate != '') {?>
                      <p class="text-danger"><?= $validate; ?></p>
                    <?php }?>
                </fieldset>
              </div>

             <div class="col-lg-12" >
                <fieldset >
                  <button type="submit" name="submit" value="daftar"class="main-button ">Register</button>
                </fieldset>
              </div>
              <div class="form-footer mt-2">
                  <p> Sudah punya account? <a href="login.php">Login</a></p>
              </div>
            </div>
          </div>
        </form>
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