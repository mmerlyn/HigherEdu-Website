<?php

$servername = "localhost";
$database = "higher_education_universities";
$username = "root";
$password = "";

// Create connection

$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$score_rank = array();
$college_list = array();
$lats = array();
$longs = array();

function filter_mappoints(float $research=10, float $international=10, float $income=10 ,float $teaching=10, float $avg_tution_py=106601,float $acc_rate=0,float $placement=0, float $living_cost=10500) {
  global $conn;
  $sql = "SELECT Score_Rank,University,latitude_college,longitude_college FROM word_university_rank_2020_lat_lon WHERE International_Outlook
  >= '$international' AND Research >= '$research' AND Industry_Income >= '$income' AND
  Teaching>='$teaching' AND Avg_tutionfee_per_yr_e <= '$avg_tution_py' AND acc_rate_eng>='$acc_rate' AND Placements_Average_Salary >= '$placement' AND Living_cost_yr<='$living_cost' ";
  $result = $conn->query($sql);
  global $score_rank;
  global $college_list;
  global $lats;
  global $longs;
  if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      array_push($score_rank, $row['Score_Rank']);
      array_push($college_list, $row["University"]);
      //echo $row["University"];
      array_push($lats,$row["latitude_college"]);
      array_push($longs,$row["longitude_college"]);
    }
    $result -> free_result();
  }
}


?>
