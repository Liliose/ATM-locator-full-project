<?php
  require_once('connect.php');
  if(isset($username)){
    header('location: profile');
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
  <div class="container-fluid sign-up">
    <div class="float-right p-3">
    <a href="home"><button class="btn btn-primary"><i class="fa fa-home"></i> Home</button></a>
          <a href="login"><button class="btn btn-primary"><i class="fa fa-users"></i> Login</button></a>
    </div>
    <div class="sign-up-container">
      <h1 class="text-center">HHL ATM Locator</h1>
      <p class="text-center">Login form</p>
      <div class="sign-up-form">
        <div class="text-box-container">
          <input type="text" id="name" placeholder="Your Name..." autocomplete="off">
          <div><i class="fa fa-user"></i></div>
          <div class="right" id="nameCheckMark"></div>
          <span class="error-message" id="nameError"></span>
        </div>
        <div class="text-box-container">
          <input type="email" id="email" placeholder="Your Email Address..." autocomplete="off">
          <div><i class="fa fa-envelope"></i></div>
          <div class="right" id="emailCheckMark"></div>
          <span class="error-message" id="emailError"></span>
        </div>
        <div class="text-box-container">
          <input type="text" id="username" placeholder="Username..." autocomplete="off">
          <div><i class="fa fa-user"></i></div>
          <div class="right" id="usernameCheckMark"></div>
          <span class="error-message" id="usernameError"></span>
        </div>
        <div class="text-box-container">
          <input type="password" id="password" placeholder="Password..." autocomplete="off">
          <div><i class="fa fa-lock"></i></div>
          <div class="right" id="passwordCheckMark"></div>
          <span class="error-message" id="passwordError"></span>
        </div>
        <div class="text-box-container">
          <input type="password" id="password2" placeholder="Comfirm Password..." autocomplete="off">
          <div><i class="fa fa-lock"></i></div>
          <div class="right" id="password2CheckMark"></div>
          <span class="error-message" id="password2Error"></span>
        </div>
        <div class="text-center">
          <button class="mt-3 mb-3" type="button" id="signupBtn">Signup</button>
          <p>Already have an account? <a href="login">Login</a></p>
        </div>
      </div>
    </div>
  </div>
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/controller.js"></script>
  <script src="js/main.js"></script>
</body>
</html>
