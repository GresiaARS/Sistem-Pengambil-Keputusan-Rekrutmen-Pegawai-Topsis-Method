<?php
session_start();
include "koneksi.php";
$query = "SELECT * FROM user where step=4";
$result = mysqli_query($conn,$query);

$matriks_resume = 0;
$matriks_technical = 0;
$matriks_interview = 0;
$matriks_offering = 0;
$matriks_selisih = 0;
while($data = mysqli_fetch_array($result)){
  $matriks_resume += pow($data["resume"],2);
  $matriks_technical += pow($data["technical"],2);
  $matriks_interview += pow($data["interview"],2);
  $matriks_offering += pow($data["offering"],2);
}
$matriks_resume = sqrt($matriks_resume);
$matriks_technical = sqrt($matriks_technical);
$matriks_interview = sqrt($matriks_interview);
$matriks_offering = sqrt($matriks_offering);

  $user_id = [];
  $matriks1_resume = [];
  $matriks1_technical = [];
  $matriks1_interview = [];
  $matriks1_offering = [];
  $query = "SELECT * FROM user where step=4";
  $result = mysqli_query($conn,$query);
  while($data = mysqli_fetch_array($result)){
    array_push($user_id,$data["id"]);
    array_push($matriks1_resume,$data["resume"]/$matriks_resume);
    array_push($matriks1_technical,$data["technical"]/$matriks_technical);
    array_push($matriks1_interview,$data["interview"]/$matriks_interview);
    array_push($matriks1_offering,$data["offering"]/$matriks_offering);
  }
  print_r($matriks1_resume);
  echo "<br>";

//step2
$matriks_resume = 0;
$matriks_technical = 0;
$matriks_interview = 0;
$matriks_offering = 0;
$matriks_selisih = 0;
$matriks2_resume = [];
$matriks2_technical = [];
$matriks2_interview = [];
$matriks2_offering = [];
foreach($user_id as $x=>$val){
  $matriks_resume += pow($matriks1_resume[$x],2);
  $matriks_technical += pow($matriks1_technical[$x],2);
  $matriks_interview += pow($matriks1_interview[$x],2);
  $matriks_offering += pow($matriks1_offering[$x],2);
}

$matriks_resume = sqrt($matriks_resume);
$matriks_technical = sqrt($matriks_technical);
$matriks_interview = sqrt($matriks_interview);
$matriks_offering = sqrt($matriks_offering);


foreach($user_id as $x=>$val){
  array_push($matriks2_resume,$matriks1_resume[$x]/$matriks_resume);
  array_push($matriks2_technical,$matriks1_technical[$x]/$matriks_technical*3);
  array_push($matriks2_interview,$matriks1_interview[$x]/$matriks_interview*5);
  array_push($matriks2_offering,$matriks1_offering[$x]/$matriks_offering*2);
}
print_r($matriks2_resume);
echo "<br>";

  //step 3
  $plus = [max($matriks2_resume),max($matriks2_technical),max($matriks2_interview),max($matriks2_offering)];
  $minus = [min($matriks2_resume),min($matriks2_technical),min($matriks2_interview),min($matriks2_offering)];
  print_r($plus);

  echo "<br>";

     //tahap 4
$dplus = [];
$dminus= [];

foreach($user_id as $x=>$val){
  $param = 0;
  $param += pow($plus[0]-$matriks2_resume[$x],2);
  $param += pow($plus[1]-$matriks2_technical[$x],2);
  $param += pow($plus[2]-$matriks2_interview[$x],2);
  $param += pow($plus[3]-$matriks2_offering[$x],2);
  array_push($dplus,sqrt($param));
  $param2 = 0;
  $param2 += pow($matriks2_resume[$x]-$minus[0],2);
  $param2 += pow($matriks2_technical[$x]-$minus[1],2);
  $param2 += pow($matriks2_interview[$x]-$minus[2],2);
  $param2 += pow($matriks2_offering[$x]-$minus[3],2);
  array_push($dminus,sqrt($param2));

}
print_r($dplus);

  echo "<br>";

//TAHAP 5
$hasil =  [];

foreach($dminus as $x=>$val){
  array_push($hasil,$dminus[$x]/($dplus[$x]+$dminus[$x]));
}
print_r($hasil);

foreach($user_id as $x=>$val){
  $query = "UPDATE user SET nilai=$hasil[$x] WHERE id=$val";
  $result = mysqli_query($conn,$query);
}

header("location:interview.php");

?>