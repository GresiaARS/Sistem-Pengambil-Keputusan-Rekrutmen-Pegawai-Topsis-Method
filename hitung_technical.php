<?php
session_start();
include "koneksi.php";

$user_id = $_POST['user_id'];
$php = $_POST['php'];
$python = $_POST['python'];
$golang = $_POST['golang'];
$js = $_POST['js'];
$query = "SELECT * FROM technical";
$result = mysqli_query($conn,$query);
$matriks_php = pow($php,2);
$matriks_golang = pow($golang,2);
$matriks_python = pow($python,2);
$matriks_js = pow($js,2);

while($data = mysqli_fetch_array($result)){
  $matriks_php += pow($data["php"],2);
  $matriks_golang += pow($data["golang"],2);
  $matriks_python += pow($data["python"],2);
  $matriks_js += pow($data["js"],2);
}
$matriks_php = sqrt($matriks_php);
$matriks_golang = sqrt($matriks_golang);
$matriks_python = sqrt($matriks_python);
$matriks_js = sqrt($matriks_js);

  $user_id = [$user_id];
  $matriks1_php = [$php/$matriks_php];
  $matriks1_golang = [$golang/$matriks_golang];
  $matriks1_python = [$python/$matriks_python];
  $matriks1_js = [$js/$matriks_js];
  $query = "SELECT * FROM technical";
  $result = mysqli_query($conn,$query);
  while($data = mysqli_fetch_array($result)){
    array_push($user_id,$data["user_id"]);
    array_push($matriks1_php,$data["php"]/$matriks_php);
    array_push($matriks1_golang,$data["golang"]/$matriks_golang);
    array_push($matriks1_python,$data["python"]/$matriks_python);
    array_push($matriks1_js,$data["js"]/$matriks_js);
  }
  print_r($matriks1_php);
  echo "<br>";
 //step2
  $matriks_php = 0;
  $matriks_golang = 0;
  $matriks_python = 0;
  $matriks_js = 0;
  $matriks2_php = [];
  $matriks2_golang = [];
  $matriks2_python = [];
  $matriks2_js = [];
  foreach($user_id as $x=>$val){
    $matriks_php += pow($matriks1_php[$x],2);
    $matriks_golang += pow($matriks1_golang[$x],2);
    $matriks_python += pow($matriks1_python[$x],2);
    $matriks_js += pow($matriks1_js[$x],2);
  }
  
  $matriks_php = sqrt($matriks_php);
  $matriks_golang = sqrt($matriks_golang);
  $matriks_python = sqrt($matriks_python);
  $matriks_js = sqrt($matriks_js);
  

  foreach($user_id as $x=>$val){
    array_push($matriks2_php,$matriks1_php[$x]/$matriks_php);
    array_push($matriks2_golang,$matriks1_golang[$x]/$matriks_golang);
    array_push($matriks2_python,$matriks1_python[$x]/$matriks_python);
    array_push($matriks2_js,$matriks1_js[$x]/$matriks_js);
  }
  print_r($matriks2_php);
  echo "<br>";

  //step 3
  $plus = [max($matriks2_php),max($matriks2_golang),max($matriks2_python),max($matriks2_js)];
  $minus = [min($matriks2_php),min($matriks2_golang),min($matriks2_python),min($matriks2_js)];
  print_r($plus);
  echo "<br>";

  //tahap 4
$dplus = [];
$dminus= [];

foreach($user_id as $x=>$val){
  $param = 0;
  $param += pow($plus[0]-$matriks2_php[$x],2);
  $param += pow($plus[1]-$matriks2_golang[$x],2);
  $param += pow($plus[2]-$matriks2_python[$x],2);
  $param += pow($plus[3]-$matriks2_js[$x],2);
  array_push($dplus,sqrt($param));
  $param2 = 0;
  $param2 += pow($matriks2_php[$x]-$minus[0],2);
  $param2 += pow($matriks2_golang[$x]-$minus[1],2);
  $param2 += pow($matriks2_python[$x]-$minus[2],2);
  $param2 += pow($matriks2_js[$x]-$minus[3],2);
  array_push($dminus,sqrt($param2));
}
print_r($dplus);
  echo "<br>";

  //tahap 5
$hasil =  [];

foreach($dminus as $x=>$val){
  array_push($hasil,$dminus[$x]/($dplus[$x]+$dminus[$x]));
}
print_r($hasil);

$ids = $user_id[0];
$query = "INSERT INTO technical SET user_id=$ids ,php=$php ,golang=$golang ,python=$python ,js=$js";
$result = mysqli_query($conn,$query);
if(!$result){
  die();
}
foreach($user_id as $x=>$val){
  $query = "UPDATE user SET technical=$hasil[$x] ,step=3 WHERE id=$val";
  $result = mysqli_query($conn,$query);
}
  header("location:technical.php");
?>