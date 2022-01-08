<?php
session_start();
include "koneksi.php";
$offer = 6000000;
$user_id = $_POST['user_id'];
$learn = $_POST['learn'];
$teamwork = $_POST['teamwork'];
$ethic = $_POST['ethic'];
$discipline = $_POST['discipline'];
$salary = $_POST['salary'];
$selisih = $salary%$offer;
$query = "SELECT * FROM interview";
$result = mysqli_query($conn,$query);
$matriks_learn = pow($learn,2);
$matriks_teamwork = pow($teamwork,2);
$matriks_ethic = pow($ethic,2);
$matriks_discipline = pow($discipline,2);
$matriks_selisih = pow($selisih,2);

while($data = mysqli_fetch_array($result)){
  $matriks_learn += pow($data["learn"],2);
  $matriks_teamwork += pow($data["teamwork"],2);
  $matriks_ethic += pow($data["ethic"],2);
  $matriks_discipline += pow($data["discipline"],2);
  $matriks_selisih += pow($data["salary"]%$offer,2);
}
$matriks_learn = sqrt($matriks_learn);
$matriks_teamwork = sqrt($matriks_teamwork);
$matriks_ethic = sqrt($matriks_ethic);
$matriks_discipline = sqrt($matriks_discipline);
$matriks_selisih = sqrt($matriks_selisih);

  $user_id = [$user_id];
  $matriks1_learn = [$learn/$matriks_learn];
  $matriks1_teamwork = [$teamwork/$matriks_teamwork];
  $matriks1_ethic = [$ethic/$matriks_ethic];
  $matriks1_discipline = [$discipline/$matriks_discipline];
  $matriks1_selisih = [$selisih/$matriks_selisih];
  $query = "SELECT * FROM interview";
  $result = mysqli_query($conn,$query);
  while($data = mysqli_fetch_array($result)){
    array_push($user_id,$data["user_id"]);
    array_push($matriks1_learn,$data["learn"]/$matriks_learn);
    array_push($matriks1_teamwork,$data["teamwork"]/$matriks_teamwork);
    array_push($matriks1_ethic,$data["ethic"]/$matriks_ethic);
    array_push($matriks1_discipline,$data["discipline"]/$matriks_discipline);
    array_push($matriks1_selisih,($data["salary"]%$offer)/$matriks_selisih);
  }
  print_r($matriks1_learn);
  print_r($matriks1_selisih);
  echo "<br>";

  //step2
  $matriks_learn = 0;
  $matriks_teamwork = 0;
  $matriks_ethic = 0;
  $matriks_discipline = 0;
  $matriks_selisih = 0;
  $matriks2_learn = [];
  $matriks2_teamwork = [];
  $matriks2_ethic = [];
  $matriks2_discipline = [];
  $matriks2_selisih = [];
  foreach($user_id as $x=>$val){
    $matriks_learn += pow($matriks1_learn[$x],2);
    $matriks_teamwork += pow($matriks1_teamwork[$x],2);
    $matriks_ethic += pow($matriks1_ethic[$x],2);
    $matriks_discipline += pow($matriks1_discipline[$x],2);
    $matriks_selisih += pow($matriks1_selisih[$x],2);
  }
  
  $matriks_learn = sqrt($matriks_learn);
  $matriks_teamwork = sqrt($matriks_teamwork);
  $matriks_ethic = sqrt($matriks_ethic);
  $matriks_discipline = sqrt($matriks_discipline);
  $matriks_selisih = sqrt($matriks_selisih);
  

  foreach($user_id as $x=>$val){
    array_push($matriks2_learn,$matriks1_learn[$x]/$matriks_learn);
    array_push($matriks2_teamwork,$matriks1_teamwork[$x]/$matriks_teamwork);
    array_push($matriks2_ethic,$matriks1_ethic[$x]/$matriks_ethic);
    array_push($matriks2_discipline,$matriks1_discipline[$x]/$matriks_discipline);
    array_push($matriks2_selisih,$matriks1_selisih[$x]/$matriks_selisih);
  }
  print_r($matriks2_learn);
  print_r($matriks2_selisih);
  echo "<br>";

  
  //step 3
  $plus = [max($matriks2_learn),max($matriks2_teamwork),max($matriks2_ethic),max($matriks2_discipline)];
  $minus = [min($matriks2_learn),min($matriks2_teamwork),min($matriks2_ethic),min($matriks2_discipline)];
  $plus_selisih = [min($matriks2_selisih)];
  $minus_selisih = [max($matriks2_selisih)];
  print_r($plus);
  print_r($plus_selisih);
  echo "<br>";

   //tahap 4
$dplus = [];
$dminus= [];
$dplus_selisih = [];
$dminus_selisih= [];

foreach($user_id as $x=>$val){
  $param = 0;
  $param += pow($plus[0]-$matriks2_learn[$x],2);
  $param += pow($plus[1]-$matriks2_teamwork[$x],2);
  $param += pow($plus[2]-$matriks2_ethic[$x],2);
  $param += pow($plus[3]-$matriks2_discipline[$x],2);
  array_push($dplus,sqrt($param));
  $param2 = 0;
  $param2 += pow($matriks2_learn[$x]-$minus[0],2);
  $param2 += pow($matriks2_teamwork[$x]-$minus[1],2);
  $param2 += pow($matriks2_ethic[$x]-$minus[2],2);
  $param2 += pow($matriks2_discipline[$x]-$minus[3],2);
  array_push($dminus,sqrt($param2));
  //nilai selisih
  $param3 = 0;
  $param3 += pow($plus_selisih[0]-$matriks2_selisih[$x],2);
  array_push($dplus_selisih,sqrt($param3));
  $param4 = 0;
  $param4 += pow($matriks2_selisih[$x]-$minus_selisih[0],2);
  array_push($dminus_selisih,sqrt($param4));
  

}
print_r($dplus);
print_r($dplus_selisih);
  echo "<br>";

//TAHAP 5
$hasil =  [];
$hasil_selisih =  [];

foreach($dminus as $x=>$val){
  array_push($hasil,$dminus[$x]/($dplus[$x]+$dminus[$x]));
}
foreach($dminus_selisih as $x=>$val){
  array_push($hasil_selisih,$dminus_selisih[$x]/($dplus_selisih[$x]+$dminus_selisih[$x]));
}
print_r($hasil);
print_r($hasil_selisih);

//tahap6
$learn = $_POST['learn'];
$teamwork = $_POST['teamwork'];
$ethic = $_POST['ethic'];
$discipline = $_POST['discipline'];
$salary = $_POST['salary'];
$selisih = $salary%$offer;

$ids = $user_id[0];
$query = "INSERT INTO interview SET user_id=$ids ,learn=$learn ,teamwork=$teamwork ,discipline=$discipline ,ethic=$ethic, salary=$salary";
$result = mysqli_query($conn,$query);
if(!$result){
  die();
}
foreach($user_id as $x=>$val){
  $query = "UPDATE user SET interview=$hasil[$x] , offering = $hasil_selisih[$x] ,step=4 WHERE id=$val";
  $result = mysqli_query($conn,$query);
}
  header("location:refresh.php");
 ?>