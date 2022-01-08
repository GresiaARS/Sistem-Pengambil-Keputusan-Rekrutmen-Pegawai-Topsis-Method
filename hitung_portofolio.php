<?php
session_start();
include "koneksi.php";

$user_id = $_POST['user_id'];
$pengalaman = $_POST['pengalaman'];
$umur = $_POST['umur'];
$portofolio = $_POST['portofolio'];
$pendidikan = $_POST['pendidikan'];
$query = "SELECT * FROM resume";
$result = mysqli_query($conn,$query);
$matriks_pengalaman = pow($pengalaman,2);
$matriks_portofolio = pow($portofolio,2);
$matriks_umur = pow($umur,2);
$matriks_pendidikan = pow($pendidikan,2);

while($data = mysqli_fetch_array($result)){
  $matriks_pengalaman += pow($data["pengalaman"],2);
  $matriks_portofolio += pow($data["portofolio"],2);
  $matriks_umur += pow($data["umur"],2);
  $matriks_pendidikan += pow($data["pendidikan"],2);
}
$matriks_pengalaman = sqrt($matriks_pengalaman);
$matriks_portofolio = sqrt($matriks_portofolio);
$matriks_umur = sqrt($matriks_umur);
$matriks_pendidikan = sqrt($matriks_pendidikan);

  $user_id = [$user_id];
  $matriks1_pengalaman = [$pengalaman/$matriks_pengalaman];
  $matriks1_portofolio = [$portofolio/$matriks_portofolio];
  $matriks1_umur = [$umur/$matriks_umur];
  $matriks1_pendidikan = [$pendidikan/$matriks_pendidikan];
  $query = "SELECT * FROM resume";
  $result = mysqli_query($conn,$query);
  while($data = mysqli_fetch_array($result)){
    array_push($user_id,$data["user_id"]);
    array_push($matriks1_pengalaman,$data["pengalaman"]/$matriks_pengalaman);
    array_push($matriks1_portofolio,$data["portofolio"]/$matriks_portofolio);
    array_push($matriks1_umur,$data["umur"]/$matriks_umur);
    array_push($matriks1_pendidikan,$data["pendidikan"]/$matriks_pendidikan);
  }

$matriks_pengalaman = 0;
$matriks_portofolio = 0;
$matriks_umur =0;
$matriks_pendidikan = 0;
foreach($user_id as $x => $val){
  $matriks_pengalaman += pow($matriks1_pengalaman[$x],2);
  $matriks_portofolio += pow($matriks1_portofolio[$x],2);
  $matriks_umur += pow($matriks1_umur[$x],2);
  $matriks_pendidikan += pow($matriks1_pendidikan[$x],2);
}
$matriks_pengalaman = sqrt($matriks_pengalaman);
$matriks_portofolio = sqrt($matriks_portofolio);
$matriks_umur = sqrt($matriks_umur);
$matriks_pendidikan = sqrt($matriks_pendidikan);

//disini perhitungan matriks ke 2
$matriks2_pengalaman = [];
$matriks2_portofolio = [];
$matriks2_umur = [];
$matriks2_pendidikan= [];

foreach ($user_id as $x=>$val){
  array_push($matriks2_pengalaman,($matriks1_pengalaman[$x]/$matriks_pengalaman)*5);
  array_push($matriks2_portofolio,$matriks1_portofolio[$x]/$matriks_portofolio*3);
  array_push($matriks2_umur,$matriks1_umur[$x]/$matriks_umur);
  array_push($matriks2_pendidikan,$matriks1_pendidikan[$x]/$matriks_pendidikan);
}


//tahap 3

$plus = [max($matriks2_pengalaman),max($matriks2_portofolio),min($matriks2_umur),max($matriks2_pendidikan)];
$minus = [min($matriks2_pengalaman),min($matriks2_portofolio),max($matriks2_umur),min($matriks2_pendidikan)];

//tahap4
$dplus = [];
$dminus= [];

foreach($user_id as $x=>$val){
  $param = 0;
  $param += pow($plus[0]-$matriks2_pengalaman[$x],2);
  $param += pow($plus[1]-$matriks2_portofolio[$x],2);
  $param += pow($plus[2]-$matriks2_umur[$x],2);
  $param += pow($plus[3]-$matriks2_pendidikan[$x],2);
  array_push($dplus,sqrt($param));
  $param2 = 0;
  $param2 += pow($matriks2_pengalaman[$x]-$minus[0],2);
  $param2 += pow($matriks2_portofolio[$x]-$minus[1],2);
  $param2 += pow($matriks2_umur[$x]-$minus[2],2);
  $param2 += pow($matriks2_pendidikan[$x]-$minus[3],2);
  array_push($dminus,sqrt($param2));
}
//tahap 5

$hasil =  [];

foreach($dminus as $x=>$val){
  array_push($hasil,$dminus[$x]/($dplus[$x]+$dminus[$x]));
}
print_r($hasil);

//tahap 6
$ids = $user_id[0];
$query = "INSERT INTO resume SET user_id=$ids ,pengalaman=$pengalaman ,portofolio=$portofolio ,umur=$umur ,pendidikan=$pendidikan";
$result = mysqli_query($conn,$query);
if(!$result){
  die();
}
foreach($user_id as $x=>$val){
  $query = "UPDATE user SET resume=$hasil[$x] ,step=2 WHERE id=$val";
  $result = mysqli_query($conn,$query);
}
  header("location:portofolio.php");
?>