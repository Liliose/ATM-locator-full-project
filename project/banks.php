<?php
  require_once('connect.php');
  if(isset($username)){
    if($priviledge != 'admin'){
      header('location: profile');
    }
  }else{
    $url = 'home';
    header('location: $baseVariable$url');
  }
  if(isset($_POST['submit'])){
    $id = $_POST['id'];
    $bank = mysqli_real_escape_string($con,$_POST['bank_name']);
    $old = mysqli_real_escape_string($con,$_POST['old']);
    $q = mysqli_query($con, "select * from banks where name='$bank'");
    $qn = mysqli_num_rows($q);
    if($qn == 0){
      mysqli_query($con,"update banks set name='$bank' where id='$id'");
      mysqli_query($con,"update atms set bank_name='$bank' where bank_name='$old'");
    }
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
              <p><?php echo date("d-M-yy");echo" "; echo date("h:i:s");?></p>
            </div>
          </div>
        </div>
        <div class="container mt-3">
          <h2>
            <?php
              $q = mysqli_query($con,"select * from banks");
              $qn = mysqli_num_rows($q);
              echo "$qn Registered banks";
            ?>
          </h2>
          <div class="row mt-3">
            <?php
            if($qn > 0){
              while($row = mysqli_fetch_assoc($q)){
                $id = $row['id'];
                $bName = $row['name'];
                $atms = $row['atms'];
                echo"<div class='col-md-3 separate'>
                  <div class='alert alert-success'>
                    <div class='mb-2'>$bName</div>
                    <div class='text-right'>
                      <button class='btn'>$atms ATMs</button>
                      <button class='btn btn-danger' onclick=remove($id,'bank')><i class='fa fa-trash'></i></button>
                      <button class='btn btn-primary' onclick='editBank($id)'>Edit</button>
                    </div>
                  </div>
                </div>";
              }
            }
            ?>
          </div>
          <div class="alert bg-light"><h3>Register new ATM</h3></div>
          <div class="mt-2 mb-5">
            <table>
              <tr>
                <td colspan="2">Bank Name:</td>
              </tr>
              <tr>
                <td><input type="text" id="bankName" class="form-control w-auto" onkeyup="handleBankName(this)"></td>
                <td>&nbsp;&nbsp;<button class="btn btn-primary" onclick="saveBank(this)">Save</button></td>
              </tr>
              <tr>
                <td colspan="2"><div id="msg"></div></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>

  <div class="atm-pop-up d-none" id="popUp">
    <div class="pop-up-container">
      <div class="text-right mb-2"><span class='close' onclick='closePopUp()'><i class='fa fa-close'></i></span></div>
      <div class="pop-up-contents" id="popUpContents"></div>
    </div>
  </div>

  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/admin.js"></script>
</body>
</html>
