<?php
  require_once('connect.php');
  if(!isset($username)){
    header("location: home");
  }
  if (isset($_POST['submit'])) {
    $newPwd = $_POST['new_pwd'];
    $newPwd2 = $_POST['new_pwd2'];
    if ($newPwd2 == $newPwd) {
      $newPwd = md5($newPwd);
      $q = mysqli_query($con,"update users set password='$newPwd' where username='$username'");
      if ($q) {
        if(session_destroy()){
          header('location: login');
        }
      }
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HHL ATM Locator</title>
  <base href="<?php echo"$baseVariable";?>">
  <link rel="shortcut icon" href="src/atm1.png" type="image/png">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body class='home-page'>
  <div class="container-fluid profile bg_marker1">
    <div style="position: relative;">
      <div class="float-right p-3">
        <a href="home"><button class="btn btn-primary"><i class="fa fa-home"></i> Home</button></a>
        <button class="btn btn-primary" onclick="chooseBank()"><i class="fa fa-bank"></i> Bank name</button>
        <button class="btn btn-primary" onclick="showUserMenu()"><i class="fa fa-user"></i> <?php echo"$username";?></button>
      </div>
      <div class="user-menu d-none" id="userMenu">
        <div class="text-center">
          <i class="fa fa-user-circle" style="font-size: 3em"></i>
          <p class="m-0"><?php echo"$name";?></p>
        </div>
        <hr class="mt-1">
        <p onclick="changePwd()"><i class="fa fa-key"></i> Change Password</p>
        <p class="m-0"><a href="logout"><i class="fa fa-sign-out"></i> Logout</a></p>
        <hr class="m-2">
        <p onclick="closeUserMenu()" style="color: #007bff;text-decoration: none;background-color: transparent;"><i class="fa fa-close"></i> Close</p>
      </div>
    </div>
    <div class="container" style="padding-top:100px">
      <div id="atmResultsHeader" class="atm-main-header"></div>
      <div class="row" id="atmResults"></div>
    </div>
  </div><!--profile-->


  <div class="location-modal" id="prompts">
    <div class="location-modal-content" id="locationPrompt"></div>
    <div class="location-modal-content-attempt" id="locationAttempt"></div>
  </div>
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/controller.js"></script>
  <script src="js/main.js"></script>
</body>
</html>