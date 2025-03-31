<html>
<div class="content">
<?php
include_once 'db_connect.php';
$error_msg = "";
if (!isset($_COOKIE['sid'])){
  if (isset($_POST['submit'])){


    $username = mysqli_real_escape_string($conn, trim($_POST['username']));
    $password = mysqli_real_escape_string($conn, trim($_POST['password']));
    //echo $username;
    //echo $password;


    if (!empty($username) && !empty($password)){
      $query = "select username,sid from student_register where username='$username' and password = PASSWORD('$password')";
      $data = mysqli_query($conn, $query);

      if (mysqli_num_rows($data) == 1){
        $row = mysqli_fetch_array($data);
        setcookie('sid', $row['sid']);
        setcookie('username', $row['username']);
        $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/profile.php';
        header('Location: ' . $home_url);

      }
      else{
        $error_msg = "Sorry, You have entered invalid username or password.";
        echo '<a style="color:red;" href="hep_signup.php">Not a registered user? Please register here</a><br />';
        echo $error_msg;
      }
    }
    else{
      $error_msg = "Sorry, You must enter username and password to login.";
      echo $error_msg;
      echo '<br /><a href="hep_signup.php">Not a registered user? Please register here</a><br />';

    }
  }
}
else {
  header("Location: http://localhost/wt_mini_proj/profile.php");
}

 ?>
</div>

  <head>
    <title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/styles.css">
  <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <style type="text/css">
    input[type="submit"] {
  font-family: 'PT Sans', sans-serif;
  text-transform: uppercase;
  outline: 0;
  background: #574F4F;
  width: 100%;
  border: 0;
  padding: 15px;
  color: #FFFFFF;
  font-size: 14px;
  -webkit-transition: all 0.3 ease;
  transition: all 0.3 ease;
  cursor: pointer;
}
input[type="submit"]:hover,input[type="submit"]:active,input[type="submit"]:focus {
  background: #382F2F;
}
  </style>

  </head>
  <body class="signup">
    <div class="container">
      <div class="login-page">
    <div class="form">
    <h3>Student Log In</h3>


    <form id="login" class="login-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <fieldset>
        <div class="input-container">
          <i class="fa fa-user-circle-o icon"></i>
          <input type="text" id="username" name="username" placeholder="Enter Username..."/>
        </div>
        <div class="input-container">
          <i class="fa fa-lock icon"></i>
          <input type="password" id="password" name="password" placeholder="Enter Password..."/>
        </div>
      </fieldset>
      <input type="submit" class="registerbutton" name="submit" value="Log In"/>



<p class="message"><a href='hep_home.html'>Home</a><br></p>
<p class="message"><a href='hep_signup.php'>New user? Please Signup here</a></p>
</form>
</div>
</div>
</div>
  </body>
</html>
