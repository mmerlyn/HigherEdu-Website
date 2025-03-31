<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
     <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
    <title></title>
  </head>
  <body style="background-color: #C2CED5;">  
    <div id="main" style="background-color: white;">

        <div class="container">
  <nav class="navbar navbar-expand-lg">
      <div class="navbar-header">
            <a class="mapnav" href="hep_home.html">HIGHEREDUGUIDE.COM</a>
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
              <a class="nav-link" style="border-radius: 0px;border:none; padding:10px;" href="profile.php">Profile</a>
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
        </div>

        
    <div class="profile-content">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
        
<?php include_once 'db_connect.php';
echo "<br>";
if (!isset($_COOKIE['sid'])){
  echo '<h3 class="login"> Please <a href="hep_login.php">log in</a> to access this page<h3>';}
else{

echo "<br><br>";
 foreach($_GET['delete'] as $fcourse){
   $email = str_replace('!',' ',$fcourse);
     $sql = "DELETE FROM student_favorites WHERE sid ='". $_COOKIE['sid'] ."' and favorite_course='$email'";
     $result = $conn->query($sql);
     if(mysqli_query($conn, $sql))
     {
          echo '<h3 style="text-align:center;">'.$email. ' deleted from favorites <br></h3>';
     }
 }
 }
?>
</div>
      </div>
    </div>
  </div>
     <script>
        function openNav() {
            document.getElementById("myNav").style.height = "100%";
            document.getElementById("myNav").style.width = "100%";

        }

        function closeNav() {
            document.getElementById("myNav").style.height = "0%";
        }
    </script>
  </body>
</html>
