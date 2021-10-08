<?php
  require_once('connect.php');
  if(isset($username)){
    if($priviledge != 'admin'){
      $url = 'profile';
      header("location: $baseVariable$url");
    }
  }else{
    $url = 'home';
    header("location: $baseVariable$url");
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
        <div class="welcome-pannel h-auto py-2">
          <div class="row">
            <div class="col">
              <h2>HHL ATM Locator</h2>
              <p>Administration panel</p>
            </div>
            <div class="col pt-5">
              <p><?php echo date("d-M-yy");echo" "; echo date("h:i:s");?></p>
            </div>
          </div>
        </div>
        <div class="container mt-0">
          <div class="row">
            <div class="col tab tab-active" id="automaticTab">
              <h4 class="m-0">Automatic</h4>
            </div>
            <div class="col tab" id="manualTab">
              <h4 class="m-0">Manual</h4>
            </div>
          </div>
          <div class="automatic-registration" id="automaticRegistration">
            <form action="admin/atms" method="post" onsubmit="automaticReg()">
            <div class="alert alert-warning mt-2 mb-2"><i class="fa fa-exclamation-triangle"></i> Use this tab(automatic tab) when this device is at the same place as the ATM you are going to register.</div>
              <div class="edit-wrapper">
                <p class="mb-2">Bank name:</p>
                <select name="bank_name" class='form-control mb-2' required>
                  <option value=""></option>
                  <?php
                    $qq = mysqli_query($con, "select * from banks");
                    $qqn = mysqli_num_rows($qq);
                    if($qqn > 0){
                      while($row = mysqli_fetch_assoc($qq)){
                        $bank_name = $row['name'];
                        ?>
                        <option value="<?php echo"$bank_name";?>"><?php echo"$bank_name";?></option>
                        <?php
                      }
                    }
                  ?>
                </select>
                <p class="mb-2">Latitude:</p>
                <input type="text" name="latitude" id="lt" class='disabled mb-2' disabled="true" required>
                <p class="mb-2">Longitude:</p>
                <input type="text" name="longitude" id="ln" class='disabled mb-2' disabled="true" required>
                <p class="mb-2">District:</p>
                <input type="text" name="district" class='form-control mb-2' required>
                <p class="mb-2">Sector:</p>
                <input type="text" name="sector" class='form-control mb-2' required>
                <p class="mb-2">Cell:</p>
                <input type="text" name="cell" class='form-control mb-2' required>
                <p class="mb-2">Village:</p>
                <input type="text" name="village" class='form-control mb-2' required>
                <p class="mb-2">Addres:</p>
                <input type="text" name="address" class='form-control mb-2' required>
              </div>
              <div class="mt-1 p-3">
                <div id="messages">
                  <button type="submit" name="register" class="btn btn-success">Register ATM</button>
                </div>
              </div>
            </form>
          </div>
          <div id="manualRegistration">
            <form action="admin/atms" method="post">
            <div class="alert alert-warning mt-2 mb-2"><i class="fa fa-exclamation-triangle"></i> Use this tab(manual tab) if you know the coordinates of ATM you are going to register.</div>
              <div class="edit-wrapper">
                <p class="mb-2">Bank name:</p>
                <select name="bank_name2" class='form-control mb-2' required>
                  <option value=""></option>
                  <?php
                    $qq = mysqli_query($con, "select * from banks");
                    $qqn = mysqli_num_rows($qq);
                    if($qqn > 0){
                      while($row = mysqli_fetch_assoc($qq)){
                        $bank_name = $row['name'];
                        ?>
                        <option value="<?php echo"$bank_name";?>"><?php echo"$bank_name";?></option>
                        <?php
                      }
                    }
                  ?>
                </select>
                <p class="mb-2">Latitude:</p>
                <input type="text" name="latitude2" class='form-control mb-2' required>
                <p class="mb-2">Longitude:</p>
                <input type="text" name="longitude2" class='form-control mb-2' required>
                <p class="mb-2">District:</p>
                <input type="text" name="district2" class='form-control mb-2' required>
                <p class="mb-2">Sector:</p>
                <input type="text" name="sector2" class='form-control mb-2' required>
                <p class="mb-2">Cell:</p>
                <input type="text" name="cell2" class='form-control mb-2' required>
                <p class="mb-2">Village:</p>
                <input type="text" name="village2" class='form-control mb-2' required>
                <p class="mb-2">Addres:</p>
                <input type="text" name="address2" class='form-control mb-2' required>
              </div>
              <div class="mt-1 p-3">
                <button type="submit" name="register2" class="btn btn-success">Register ATM</button>
              </div>
            </form>
          </div>


        </div><!--/container-->

      </div>
    </div>

  </div>

  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/admin.js"></script>
</body>
</html>
