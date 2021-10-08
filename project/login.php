<?php
  require_once('connect.php');
  if(isset($username)){
    if($priviledge == 'visitor'){
      header('location: profile');
    }else{
      header('location: admin');
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
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-4 p-0">
        <div class="login-container">
          <a href="home"><button class="btn btn-primary"><i class="fa fa-home"></i> Home</button></a>
          <a href="signup"><button class="btn btn-primary"><i class="fa fa-user-plus"></i> Sign Up</button></a>
          <form id="loginForm">
          <div class="login-form">
            <h1 class="text-center">HHL ATM Locator</h1>
            <p class="text-center">Login form</p>
            <div class="text-box-container">
              <input type="text" id="loginUsername" placeholder="Username..." autocomplete="off" required>
              <div><i class="fa fa-user"></i></div>
            </div>
            <div class="text-box-container">
              <input type="password" id="loginPassword" placeholder="Password..." autocomplete="off" required>
              <div><i class="fa fa-lock"></i></div>
            </div>
            <div class="text-center">
              <input type="checkbox" id="agree" required> <small>I agree to terms of use.</small>
              <div id="loginError" class="mt-2 text-danger d-none"></div>
              <button id="loginBtn" class="mt-3 mb-3">Login</button>
              <p>Don't have an account? <a href="signup">Signup</a></p>
              <p><a href="#">Forgot password?</a></p>
            </div>
          </div>
        </div>
      </form>
      </div>
      <div class="col-md-8 login-bg p-0">
        <div class="login-benefits">
          <div class="benefit-contents">
            <h1>Log into your account</h1>
            <p>Once you login, you will be able to:</p>
            <ul>
              <li><i class="fa fa-check"></i> Know ATM conditions Know ATM conditions</li>
              <li><i class="fa fa-check"></i> Know ATMs Near by you Know ATMs Near by you</li>
              <li><i class="fa fa-check"></i> Know address and location of your..........</li>
              <li><i class="fa fa-check"></i> Know ATM conditions</li>
              <li><i class="fa fa-check"></i> Know ATM conditions</li>
            </ul>
          </div>
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