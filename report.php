<?php
require_once('connect.php');
?>
<html>
  <head>
    <title>ATM Locator</title>
    <base href="<?php echo"$baseVariable";?>">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <style>
      .table tr:nth-of-type(odd){
        background: #f2f2f2;
      }
    </style>
  </head>
  <body>
    <?php
    if(isset($_GET['type'])){
      $type = $_GET['type'];
      if($type == 'atms'){
        ?>
        <h2>List of all ATMs</h2>
        <table class="table w-100">
            <tr>
              <th>#ID</th>
              <th>Bank Name</th>
              <th>Latitude</th>
              <th>Longitude</th>
              <th>District</th>
              <th>Sector</th>
              <th>Cell</th>
              <th>Village</th>
              <th>Address</th>
              <th>Functioning</th>
            </tr>
            <?php 
            $q = mysqli_query($con,"select * from atms");
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
                $address = $row['address'];
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
                  <td>$village</td>
                  <td>$address</td>
                  <td>$functioning</td>
                </tr>
                ";
              }
            }
            ?>
          </table>
        <?php
      }else if($type == 'problems'){
        ?>
        <h2>List of all ATMs with problems</h2>
        <table class="table w-100">
            <tr>
              <th>#ID</th>
              <th>Bank Name</th>
              <th>Latitude</th>
              <th>Longitude</th>
              <th>District</th>
              <th>Sector</th>
              <th>Cell</th>
              <th>Village</th>
              <th>Address</th>
              <th>Issue</th>
              <th>Functioning</th>
            </tr>
            <?php 
            $q = mysqli_query($con,"select * from atms where functioning!='YES'");
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
                $address = $row['address'];
                $functioning = $row['functioning'];
                $problem = $row['problem'];
                echo"
                <tr>
                  <td>$id</td>
                  <td>$name</td>
                  <td>$lat</td>
                  <td>$ln</td>
                  <td>$district</td>
                  <td>$sector</td>
                  <td>$cell</td>
                  <td>$village</td>
                  <td>$address</td>
                  <td>$problem</td>
                  <td>$functioning</td>
                </tr>
                ";
              }
            }
            ?>
          </table>
        <?php
      }else if($type == 'users'){
        ?>
        <h2>
            <?php
              $q = mysqli_query($con,"select * from users");
              $qn = mysqli_num_rows($q);
              echo "$qn Registered Users";
            ?>
          </h2>
          <table class="table">
            <tr>
              <th>#ID</th>
              <th>Names</th>
              <th>Username</th>
              <th>Email</th>
              <th>Privilege</th>
              <th>Registered on</th>
            </tr>
            <?php 
            $q = mysqli_query($con, "select * from users");
            $qn = mysqli_num_rows($q);
            if($qn > 0){
              while($row = mysqli_fetch_assoc($q)){
                $id = $row['id'];
                $name = $row['names'];
                $email = $row['email'];
                $user = $row['username'];
                $date = $row['date'];
                $priviledge = $row['priviledge'];
                echo"
                <tr>
                  <td>$id</td>
                  <td>$name</td>
                  <td>$user</td>
                  <td>$email</td>
                  <td>$priviledge</td>
                  <td>$date</td>
                </tr>
                ";
              }
            }
            ?>
          </table>
      <?php }
    }
    ?>
    <script>
      window.addEventListener('load',function(){
        window.print();
      });
    </script>
  </body>
</html>