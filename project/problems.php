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
              <p><?php echo date("d-M-yy");echo" "; echo date("h:i:s");?></p>
            </div>
          </div>
        </div>
        <div class="container mt-3">
          <h2>
            <?php
              $q = mysqli_query($con,"select * from atms where functioning!='YES'");
              $qn = mysqli_num_rows($q);
              echo "$qn Atm with Problems";
            ?>
          </h2>
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
            </tr>
            <?php 
            $qn = mysqli_num_rows($q);
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
                <td><a href='admin/problems/$id'><button class='btn btn-primary'>More</button></a></td>
                </tr>
                ";
              }
            }
            ?>
          </table>
          <a href="admin/report/problems">
            <button class="print">Make report</button>
           </a>
        </div>

      </div>
    </div>

  </div>

  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/admin.js"></script>
</body>
</html>
