<html>
<head>
  <title>Register</title>
  <link rel="stylesheet" type="text/css" href="css/styles.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
  <div class="register-page">
    <div class="form">
      <h3>REGISTER</h3>


<?php
include_once 'db_connect.php';
  if (isset($_POST['submit'])){
    $username = mysqli_real_escape_string($conn, trim($_POST['username']));
    $password1 = mysqli_real_escape_string($conn, trim($_POST['password1']));
    $password2 = mysqli_real_escape_string($conn, trim($_POST['password2']));
    $fname = mysqli_real_escape_string($conn, trim($_POST['fname']));
    $lname = mysqli_real_escape_string($conn, trim($_POST['lname']));
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $du = mysqli_real_escape_string($conn, trim($_POST['du']));
    $foi = mysqli_real_escape_string($conn, trim($_POST['foi']));
    $cgpa = mysqli_real_escape_string($conn, trim($_POST['cgpa']));
    //$username = $_POST{'username'};
    //$password1 = $_POST{'password1'};
    //$password2 = $_POST{'password2'};
    //$name = $_POST{'name'};
    //$phone = $_POST{'phone'};
    //$location = $_POST{'location'};
    //$dob = $_POST{'dob'};




    //&& (!empty($password1))&&(!empty($password2))&&(!empty($name))&&(!empty($phone))&&(!empty($location))&&(!empty($dob))
    //&&(!empty($name))&&(!empty($phone))&&(!empty($location))&&(!empty($dob))

    if (!empty($username)&&(!empty($password1))&&(!empty($password2))){
      //echo 'inside if 2';
      $query = "Select * from student_register where username = '$username'";
      $data = mysqli_query($conn, $query);
      //echo 'executed select <br/>';
      //echo 'New users name'.$username ;
      //echo '<br/>';
      //echo 'New users birthday'.$dob;
      //echo '<br/>';
      if(mysqli_num_rows($data) == 0){
        //, fname, flocation,fphoneno,fdob ,'$name','$location','$phone','$dob'

        $query = "INSERT into student_register (username,password, fname, lname, email, du, foi, cgpa)values('$username',PASSWORD('$password1'), '$fname', '$lname', '$email', '$du', '$foi', '$cgpa')";
        mysqli_query($conn,$query) or die("Error ");

        echo '<p> Success, Your account has been created. <a href="hep_login.php">Login</a>.</p>';
        mysqli_close($conn);


      }
      else {
        echo '<p class="error"> An account already exists for this username, please try another username </p>';
        $username="";
      }
    }
    else {
      echo '<p class="error"> Please enter data in all fields</p>';
    }
  }
?>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="register" class="register-form">
      <fieldset>
        <div class="input-container">
          <i class="fa fa-user-circle-o icon"></i>
          <input type="text" id="username" name="username" placeholder="Enter Username..."/>
        </div>
        <div class="input-container">
          <i class="fa fa-lock icon"></i>
          <input type="password" id="password1" name="password1" placeholder="Enter Password..."/>
        </div>
        <div class="input-container">
          <i class="fa fa-lock icon"></i>
          <input type="password" id="password2" name="password2" placeholder="Re-enter Password..."/>
        </div>

        <div class="input-container">
          <i class="fa fa-user icon"></i>
           <input type="text" id="fname" name="fname" placeholder="Enter First Name..."/>
        </div>
        <div class="input-container">
          <i class="fa fa-user icon"></i>
           <input type="text" id="lname" name="lname" placeholder="Enter Last Name..."/>
        </div>
        <div class="input-container">
          <i class="fa fa-envelope icon"></i>
           <input type="email" id="email" name="email" placeholder="Enter Email..."/>
        </div>
        <div class="input-container">
          <i class="fa fa-book icon"></i>
           <input type="text" id="foi" name="foi" placeholder="Enter Field of Interest..."/>
        </div>
        <div class="input-container">
          <i class="fa fa-university icon"></i>
           <input type="text" id="du" name="du" placeholder="Enter Dream University..."/>
        </div>
        <div class="input-container">
          <i class="fa fa-graduation-cap icon"></i>
           <input type="number" class="cgpa" id="cgpa" name="cgpa" min="0" max="10" step="0.01" placeholder="Enter CGPA..."/>
        </div>
      </fieldset>
      <input type="submit" class="registerbutton" name="submit" value="Sign up">

    </form>
    <p class="message"><a href='hep_home.html'>Home</a><br></p>
    <p class="message"><a href='hep_login.php'>Already Registered? login here!</a></p>
  </div>
</div>
</div>
</body>

     </html>
