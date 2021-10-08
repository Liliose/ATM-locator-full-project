<?php
  require_once('connect.php');
  if(isset($username)){
    if($priviledge != 'admin'){
      header('location: profile');
    }
  }else{
    header('location: home');
  }
  if(isset($_POST['submit'])){
    $id = $_POST['id'];
    $lat = $_POST['latitude'];
    $ln = $_POST['longitude'];
    $district = $_POST['district'];
    $sector = $_POST['sector'];
    $cell = $_POST['cell'];
    $village = $_POST['village'];
    $address = $_POST['address'];
    $problem = $_POST['problem'];
    $functioning = $_POST['functioning'];
    if($functioning == 'Yes'){
      mysqli_query($con,"update atms set lat='$lat', lon='$ln', district='$district', sector='$sector', cell='$cell', village='$village',address='$address', functioning='YES', problem='' where id='$id'");
    }else{
      mysqli_query($con,"update atms set lat='$lat', lon='$ln', district='$district', sector='$sector', cell='$cell', village='$village',address='$address', functioning='NO', problem='$problem' where id='$id'");
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
          <!--register new atms-->
          <?php
          if(isset($_POST['register'])){
            $Rbank_name = mysqli_real_escape_string($con,$_POST['bank_name']);
            $Rlatitude = mysqli_real_escape_string($con,$_POST['latitude']);
            $Rlongitude = mysqli_real_escape_string($con,$_POST['longitude']);
            $Rdistrict = mysqli_real_escape_string($con,$_POST['district']);
            $Rsector = mysqli_real_escape_string($con,$_POST['sector']);
            $Rcell = mysqli_real_escape_string($con,$_POST['cell']);
            $Rvillage = mysqli_real_escape_string($con,$_POST['village']);
            $Raddress = mysqli_real_escape_string($con,$_POST['address']);
            $chk = mysqli_query($con,"select * from atms where lat='$Rlatitude' AND lon='$Rlongitude' AND address='$Raddress' AND bank_name='$Rbank_name'");
            $chkn = mysqli_num_rows($chk);
            if($chkn == 0){
              $qr = mysqli_query($con, "insert into atms(bank_name,bank_id,lat,lon,district,sector,cell,village,address,problem) values('$Rbank_name',0,'$Rlatitude','$Rlongitude','$Rdistrict','$Rsector','$Rcell','$Rvillage','$Raddress','')");
              if($qr){
                //update atm number
                $nn = mysqli_query($con,"select * from banks where name='$Rbank_name'");
                while($r = mysqli_fetch_assoc($nn)){
                  $n = $r['atms'];
                  $n += 1;
                  mysqli_query($con,"update banks set atms=$n where name='$Rbank_name'");
                }
                echo"<div class='alert alert-success'><b>1</b> ATM registered successful!</div>";
              }else{
                echo"<div class='alert alert-danger'>Failed to register new ATM, try again later.</div>";
              }
            }else{
              echo"<div class='alert alert-danger'>ATM already exist.</div>";
            }
          }
          if(isset($_POST['register2'])){
            $Rbank_name = mysqli_real_escape_string($con,$_POST['bank_name2']);
            $Rlatitude = mysqli_real_escape_string($con,$_POST['latitude2']);
            $Rlongitude = mysqli_real_escape_string($con,$_POST['longitude2']);
            $Rdistrict = mysqli_real_escape_string($con,$_POST['district2']);
            $Rsector = mysqli_real_escape_string($con,$_POST['sector2']);
            $Rcell = mysqli_real_escape_string($con,$_POST['cell2']);
            $Rvillage = mysqli_real_escape_string($con,$_POST['village2']);
            $Raddress = mysqli_real_escape_string($con,$_POST['address2']);
            $chk = mysqli_query($con,"select * from atms where lat='$Rlatitude' AND lon='$Rlongitude' AND address='$Raddress' AND bank_name='$Rbank_name'");
            $chkn = mysqli_num_rows($chk);
            if($chkn == 0){
              $qr = mysqli_query($con, "insert into atms(bank_name,bank_id,lat,lon,district,sector,cell,village,address,problem) values('$Rbank_name',0,'$Rlatitude','$Rlongitude','$Rdistrict','$Rsector','$Rcell','$Rvillage','$Raddress','')");
              if($qr){
                //update atm number
                $nn = mysqli_query($con,"select * from banks where name='$Rbank_name'");
                while($r = mysqli_fetch_assoc($nn)){
                  $n = $r['atms'];
                  $n += 1;
                  mysqli_query($con,"update banks set atms='$n' where name='$Rbank_name'");
                }
                echo"<div class='alert alert-success'><b>1</b> ATM registered successful!</div>";
              }else{
                echo"<div class='alert alert-danger'>Failed to register new ATM, try again later.</div>";
              }
            }else{
              echo"<div class='alert alert-danger'>ATM already exist.</div>";
            }
          }
          ?>
          <div class="row">
            <div class="col">
              <h2>
                <?php
                  $q = mysqli_query($con,"select * from atms order by id asc");
                  $qn = mysqli_num_rows($q);
                  echo "List of all ATMs ($qn)";
                ?>
              </h2>
            </div>
            <div class="col">
              <div class="float-right">
              Filter by: <select onchange="handleFilter(this)">
              <option value="all">All banks</option>
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
              </div>
            </div>
          </div>
          <div id="atms">
          <table class="table">
            <tr>
              <th>#ID</th>
              <th>Bank Name</th>
              <th>Latitude</th>
              <th>Longitude</th>
              <th>District</th>
              <th>Sector</th>
              <th>Cell</th>
              <th>Village</th>
              <th>Functioning</th>
              <th>Action</th>
            </tr>
            <?php 
            if($qn > 0){
              while($row = mysqli_fetch_assoc($q)){
                $id = $row['id'];
                $name = $row['bank_name'];
                $lat = $row['lat'];
                $ln = $row['lon'];
                $district = $row['district'];
                $sector = $row['sector'];
                $cell = $row['cell'];
                $village = $row['village'];
                $functioning = $row['functioning'];
                echo"
                <tr>
                  <td>$id</td>
                  <td>$name</td>
                  <td>$lat</td>
                  <td>$ln</td>
                  <td>$district</td>
                  <td>$sector</td>
                  <td>$cell</td>
                  <td>$village</td>";
                  if($functioning == 'YES'){
                    echo'<td><div class="text-success text-center"><i class="fa fa-check-circle"></i></div></td>';
                  }else{
                    echo'<td><div class="text-danger text-center"><i class="fa fa-close"></i></div></td>';
                  }
                echo"
                  <td><div class='text-center'><button class='btn btn-primary' onclick='editAtm($id)'>Edit</button> <button class='btn btn-danger' onclick=remove($id,'atm')><i class='fa fa-trash'></i></button></div></td>
                </tr>
                ";
              }
            }
            ?>
          </table>
          </div>
          <div>
           <a href="admin/report/atms">
            <button class="print">Make report</button>
           </a>
           <br><br>
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
