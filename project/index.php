<?php
require_once('connect.php');
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
  <section id="header">
    <div class="container-fluid">
      <div class="row">
        <div class="col text-center">
          <h1 class="main-title">HHL ATM Locator</h1>
        </div>
        <div class="col text-center get-started">
          <div>
            <a href="login"><button class="btn btn-primary">Get started</button></a>
          </div>
          <div class="touch"><img src="src/touch.png"></div>
        </div>
      </div>
    </div>
  </section>
  <section>
    <div id="slide" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <div class="slide-contents">
          <img src="src/go to atm.jpg" alt="atm locator">
          <div class="slide-captions">
            <h3>Get info about all ATMs near by you.</h3>
            <p>We don't care about your bank account........</p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <div class="slide-contents">
          <img src="src/all devices.png" alt="atm locator">
          <div class="slide-captions">
            <h3>All devices are supported</h3>
            <p>This platform is able to work accross all devices, and every where in Rwanda.</p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <div class="slide-contents">
          <img src="src/atm questions2.png" alt="atm locator">
          <div class="slide-captions">
            <h3>All your questions are solved here!</h3>
            <p>Get answers for all your questions related to ATM Now!</p>
          </div>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#slide" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#slide" role="button" data-slide="next">
      
      <span class="sr-only">Next</span>
    </a>
  </div>
  </section><!--slider-->
  <section>
    <div class="container mt-3 footer">
        <button class="btn btn-default" onclick="aboutUs()">About us</button>
        <button class="btn btn-default" onclick="contactUs()">Contact us</button>
        <button class="btn btn-default" onclick="helpMe()">Help?</button>
    </div>
  </section>
  
  <div class="home-modal d-none" id="sideBarModal">
    <div class="home-modal-contents" id="sideBar">
      <div class="text-right"><i class="fa fa-close" style="font-size: 25px;cursor: pointer;" onclick="closeSideBar()"></i></div>
      <div id="sideBarContents"></div>
    </div>
  </div>
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/controller.js"></script>
  <script src="js/main.js"></script>
</body>
</html>