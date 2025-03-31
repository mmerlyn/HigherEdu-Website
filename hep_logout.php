<?php
if (isset($_COOKIE['sid'])){
  setcookie('sid','',time()-3600);
  setcookie('username','',time()-3600);
}
$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/hep_home.html';
header('Location: '. $home_url);

 ?>
