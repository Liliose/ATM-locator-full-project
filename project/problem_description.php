<?php
  require_once('connect.php');
  if(isset($username)){
    if($priviledge != 'admin'){
      header('location: profile');
    }
  }else{
    header('location: home');
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <base href="<?php echo"$baseVariable";?>">
  <title>HHL ATM Locator</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link href="css/admin.css" rel="stylesheet">
</head>
<body>
  <div class="d-flex" id="wrapper">
    <!-- Sidebar -->
    <?php require_once('sidebar.php');?>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle"><i class="fa fa-bars"></i></button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="admin"><i class="fa fa-home"></i> Admininistration</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="logout"><i class="fa fa-sign-out"></i> Logout</a>
            </li>
          </ul>
        </div>
      </nav>

      <div class="container-fluid p-0">
        <div class="welcome-pannel h-auto">
          <div class="row">
            <div class="col">
              <h2>HHL ATM Locator</h2>
              <p>Administration panel</p>
            </div>
            <div class="col pt-5">
              <p><?php echo date("d");?>-<?php echo date("M");?>-<?php echo date("Y");?> <?php echo date("h");?>:<?php echo date("i");?></p>
            </div>
          </div>
        </div>
        <div class="container mt-3">
          <?php
          if(isset($_GET['atm'])){
            $atm_id = $_GET['atm'];
            echo"<div class='alert alert-success'>ATM ID : $atm_id</div>";
            $q = mysqli_query($con, "select * from atms where id=$atm_id AND functioning != 'YES'");
            $qn = mysqli_num_rows($q);
            if($qn == 1){
              while($row = mysqli_fetch_array($q)){
                $name = $row['bank_name'];
                $lat = $row['lat'];
                $ln = $row['lon'];
                $district = $row['district'];
                $sector = $row['sector'];
                $cell = $row['cell'];
                $village = $row['village'];
                $address = $row['address'];
                $problem = $row['problem'];
                echo"
                <table>
                  <tr><td><b>Bank Name </b></td><td>&nbsp;&nbsp;</td><td>$name</td></tr>
                  <tr><td><b>Latitude </b></td><td>&nbsp;&nbsp;</td><td>$lat</td></tr>
                  <tr><td><b>Longitude </b></td><td>&nbsp;&nbsp;</td><td>$ln</td></tr>
                  <tr><td><b>District </b></td><td>&nbsp;&nbsp;</td><td>$district</td></tr>
                  <tr><td><b>Sector </b></td><td>&nbsp;&nbsp;</td><td>$sector</td></tr>
                  <tr><td><b>Cell </b></td><td>&nbsp;&nbsp;</td><td>$cell</td></tr>
                  <tr><td><b>Village </b></td><td>&nbsp;&nbsp;</td><td>$village</td></tr>
                  <tr><td><b>Address </b></td><td>&nbsp;&nbsp;</td><td>$address</td></tr>
                  <tr><td colspan='3'><div class='alert alert-danger'>$problem</div></td></tr>
                </table>
                <button class='btn btn-primary' onclick=remove($atm_id,'atm')>Delete ATM?</button>
                <button class='btn btn-success' onclick='problemFixed($atm_id)'>Problem Fixed?</button>
                ";
              }
            }else{
              echo"<div class='alert alert-danger mt-3'>Invalid information, try again later.</div>";
            }
          }
          ?>
        </div>

      </div>
    </div>

  </div>

  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/admin.js"></script>
</body>
</html>
