<?php
  $con = mysqli_connect("localhost","root","","atmLocator");
  if (!$con) {
    exit();
  }else{
    $baseVariable = "http://localhost/atmLocator/";
    session_start();
    if(isset($_SESSION['user'])){
      $user_check=$_SESSION['user'];
      $ses_sql=mysqli_query($con, "select * from users where username='$user_check'");
      $row = mysqli_fetch_assoc($ses_sql);
      $username = $row['username'];
      $name = $row['names'];
      $email = $row['email'];
      $priviledge = $row['priviledge'];
    }
  }
?>