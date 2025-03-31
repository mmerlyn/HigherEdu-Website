<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    include_once 'db_connect.php';
    if (!isset($_COOKIE['sid'])){
      echo '<p class="login"> Please <a href="hep_login.php">log in</a> to access this page';}
    else{

      echo '<a href="hep_logout.php">Log Out (' . $_COOKIE['username'] . ')</a>';
      //echo '<p>"Welcome ".$farmer_name.</p>';
}

    if(isset($_GET['cat']))
{
    echo print_r(array_values($_GET['cat']));
    echo "<p>Congratulations!!! you have succeded in your mission!</p>";
    //$fav_courses = implode("', '", array_values($_GET['cat']));
    $fav_courses = $_GET['cat'];
    $student_id = $_COOKIE['sid'];
    //$conn = mysqli_connect($servername, $username, $password, $database);
    // Check connection
    //if ($conn->connect_error) {
    //die("Connection failed: " . $conn->connect_error);}
    foreach ($fav_courses as $fc) {
      echo $fc;
      echo '<br>';
      $fcourse = mysqli_real_escape_string($conn,$fc);
      $query = "INSERT into student_favorites (sid, favorite_course) values('$student_id','$fcourse')";
      $data = mysqli_query($conn,$query) or die('Error, insert query failed');
    }

    //$query = "INSERT into student_favorites (sid, favorite_course) values(22,'$fav_courses')";


    echo ('Courses added to database');
    echo('<p><a href="profile.php">Profile</a></p>');

    // Do whatever you want with the $uid
} else {
  echo "<p>No favorites</p>";
}

     ?>

  </body>
</html>
