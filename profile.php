<?php include_once 'db_connect.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <title>HigherEduGuide</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/styles.css"> </head>
<body>

<div class="container">
  <nav class="navbar navbar-expand-lg">
      <div class="navbar-header">
            <a class="navbar-brand" href="hep_home.html">HigherEduGuide.com</a>
            <div class=" hamb">
        <button data-toggle="collapse" data-target="#navbarSupportedContent">
          <span class="glyphicon glyphicon-menu-hamburger visible-xs"></span>
                </button>
      </div>
      </div>
    <div class="collapse navbar-collapse newnavtop" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto nav nav-stack newnav" style="float: right; margin-top: 1%;">
            <li class="nav-item">
              <a class="nav-link" style="border-radius: 0px;border:none; padding:10px;" href="hep_home.html">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" style="border-radius: 0px;border:none;padding:10px;" href="map.php">Universities</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" style="border-radius: 0px;border:none;padding:10px;" href="hep_logout.php">Logout</a>
            </li>
        </ul>
      </div>
  </nav>
</div>
    

    <?php

    if (!isset($_COOKIE['sid'])){
      echo '<p class="login"> Please <a href="hep_login.php">log in</a> to access this page';}
    else{      

     echo "<div class='profile-image'>";
      $sql = "SELECT fname,lname FROM student_register WHERE sid='" . $_COOKIE['sid'] ."'";
      $result = $conn->query($sql);
      while($row = $result->fetch_assoc())
      {
        echo"<h1>Welcome"." ".$row['fname']." ".$row['lname']."!</h1>";
      }

     echo "</div><div class='profile-content'><div class='container'><div class='row'>";
     echo "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 general'>";
     $sql = "SELECT du,foi,cgpa FROM student_register WHERE sid='" . $_COOKIE['sid'] ."'";
      $result = $conn->query($sql);
      while($row = $result->fetch_assoc())
      {
        echo"<h3>Interested in"." ".$row['foi']."</h3>";
        echo"<h3>".$row['du']." "."aspirant"."</h3>";
        echo"<h3>CGPA :"." ".$row['cgpa']."</h3>";
      }
     echo"</div></div></div>";
      echo "</div><div class='profile-content'><div class='container'><div class='row'>";
      $sql = "SELECT favorite_course FROM student_favorites WHERE sid='" . $_COOKIE['sid'] ."'";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
  // output data of each row
  echo"<div class='col-md-6 col-sm-12 col-xs-12'>
                        <div class='info'>
                            <section>";
  echo "<h3> Your Favorite Programmes</h3>";
  echo "<form action='profile_fav_delete.php' method='GET'>";
  echo "<ul>";
  while($row = $result->fetch_assoc()) {
    //echo "course: " . $row["favorite_course"]. "<br>";
    $email = str_replace(' ','!',$row['favorite_course']);


    echo "<li class='courses'><input name='delete[]' value= ". $email ." type='checkbox'><label  class='strikethrough'>".$row["favorite_course"]."</label></li>";

  }
  echo "<ul>";
  echo "<br><button type='submit'>Delete selected from favorites</button> </form></section></div></div>";
} else {
  echo "<h3>No favorite programmes added yet.</h3>";
}

echo "<div class='col-md-6 col-sm-12 col-xs-12'><div class='info'><section>";

$query = "SELECT University from deadlines";
$result = mysqli_query($conn,$query);
echo "<h5>Select a university to see application deadlines</h5>";
echo "<form method='post'>";
echo "<div class='select'>";
echo "<select name='University'>";
while ($row = mysqli_fetch_array($result)) {
    echo "<option value='" . $row['University'] ."'>" . $row['University'] ."</option>";
}
echo "</select></div>";
echo "<button type='submit' name='submit_dates'> Get application deadlines </button> </form>";
if(isset($_POST['University'])) {
  $coll = $_POST['University'];


$sql = "SELECT Deadline, Deadline_fa FROM deadlines WHERE University='$coll' ";
$result = $conn->query($sql);

  while($row = $result->fetch_assoc()) {
      echo "<br><h4 class='deadline'>Deadline with financial aid: ".$row['Deadline_fa']."</h4>";
      echo "<h4 class='deadline'>Regular Deadline: ".$row['Deadline']."</h4><br>";
  }

}
echo "</section></div></div>";

$conn->close();
}

 ?>
        </div>
    </div>
</div>



    <script>
        function openNav() {
            document.getElementById("myNav").style.height = "100%";

        }

        function closeNav() {
            document.getElementById("myNav").style.height = "0%";
        }

        function openSearch() {
            document.getElementById("search").style.height = "100px";
        }

        function closeSearch() {
            document.getElementById("search").style.height = "0%";
        }

        function myFunction() {
            var x = document.getElementById("myTopnav");
            if (x.className === "topnav") {
                x.className += " responsive";
            } else {
                x.className = "topnav";
            }
        }
    </script>

</body>
</html>