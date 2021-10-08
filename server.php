<?php
require_once('connect.php');
if(isset($_POST['signup'])){
  $name = mysqli_real_escape_string($con, $_POST['name']);
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $username = mysqli_real_escape_string($con, $_POST['username']);
  $password = mysqli_real_escape_string($con, $_POST['password']);
  $password2 = mysqli_real_escape_string($con, $_POST['password2']);
  
  //username exists
  $usernameExist = mysqli_query($con,"select * from users where username='$username'");
  $usernameExistn = mysqli_num_rows($usernameExist);

  //server side validation
  if($name == ''){
    echo"name";
  }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    echo"email";
  }else if($usernameExistn > 0 || $username == ''){
    echo"username";
  }else if(strlen($password) < 4 || $password != $password2){
    echo"password";
  }else{
    //save user details
    $date = date("d-m-Y H:i");
    $password = md5($password);
    $q = mysqli_query($con, "insert into users(names,email,username,password,date) values('$name','$email','$username','$password','$date')");
    if($q){
      $_SESSION['user'] = $username;
      echo"success";
    }else{
      echo"Failed!";
    }
  }
}
if(isset($_POST['login'])){
  $username = mysqli_real_escape_string($con, $_POST['username']);
  $pwd = mysqli_real_escape_string($con, $_POST['pwd']);
  $pwd = md5($pwd);
  $q1 = mysqli_query($con, "select * from users where username='$username'");
  $q2 = mysqli_query($con, "select * from users where username='$username' AND password='$pwd'");
  $q1n = mysqli_num_rows($q1);
  $q2n = mysqli_num_rows($q2);
  if($q1n > 0){
    if($q2n === 1){
      $_SESSION['user'] = $username;
      while($row = mysqli_fetch_assoc($q2)){
        $priviledge = $row['priviledge'];
        if($priviledge == 'visitor'){
          echo"success";
        }else{
          echo"success2";
        }
      }
    }else{
      echo"Wrong password";
    }
  }else{
    echo"Invalid username";
  }
}
if(isset($_POST['bankList'])){
  $q = mysqli_query($con, "select * from banks");
  $qn = mysqli_num_rows($q);
  if($qn > 0){
    $arr = array();
    while($row = mysqli_fetch_assoc($q)){
      $obj = array('name' => $row['name']);
      array_push($arr,$obj);
    }
    $banks = json_encode($arr);
    echo $banks;
  }
}


if(isset($_POST['getAtms'])){
  $bankName = mysqli_real_escape_string($con, $_POST['bankName']);
  $q = mysqli_query($con, "select * from atms where bank_name='$bankName'");
  $qn = mysqli_num_rows($q);
  $arr = array();
  if($qn > 0){
    while($row = mysqli_fetch_assoc($q)){
      $obj = array(
        'bankName' => $row['bank_name'],
        'lat' => $row['lat'],
        'lon' => $row['lon'],
        'district' => $row['district'],
        'sector' => $row['sector'],
        'cell' => $row['cell'],
        'village' => $row['village'],
        'address' => $row['address'],
        'functioning' => $row['functioning']
      );
      array_push($arr,$obj);
    }
  }else{
    $obj = array('data' => 0);
    array_push($arr,$obj);
  }
  $atms = json_encode($arr);
  echo $atms;
}

if(isset($_POST['removeUser'])){
  $id = $_POST['id'];
  if(isset($username)){
    if($priviledge != 'visitor'){
      mysqli_query($con, "delete from users where id='$id' AND priviledge='visitor'");
    }
  }
}
if(isset($_POST['removeBank'])){
  $id = $_POST['id'];
  if(isset($username)){
    if($priviledge != 'visitor'){
      $q = mysqli_query($con,"select * from banks where id='$id'");
      while($row = mysqli_fetch_assoc($q)){
        $nme = $row['name'];
        mysqli_query($con, "delete from atms where bank_name='$nme'");
      }
      mysqli_query($con, "delete from banks where id='$id'");
    }
  }
}
if(isset($_POST['removeAtm'])){
  $id = $_POST['id'];
  if(isset($username)){
    if($priviledge != 'visitor'){
      $q = mysqli_query($con,"select * from atms where id='$id'");
      while($row = mysqli_fetch_assoc($q)){
        $bank_name = $row['bank_name'];
        //update atm number
        $nn = mysqli_query($con,"select * from banks where name='$bank_name'");
        while($r = mysqli_fetch_assoc($nn)){
          $n = $r['atms'];
          $n -= 1;
          if($n > 0){
            mysqli_query($con,"update banks set atms=$n where name='$bank_name'");
          }else{
            mysqli_query($con,"update banks set atms='0' where name='$bank_name'");
          }
        }
      }
      mysqli_query($con, "delete from atms where id='$id'");
    }
  }
}
if(isset($_POST['problemFixed'])){
  $atm = $_POST['atm'];
  if(isset($username)){
    if($priviledge != 'visitor'){
      mysqli_query($con, "update atms set functioning='YES' where id=$atm");
    }
  }
}
if(isset($_POST['editBank'])){
  $id = $_POST['id'];
  if(isset($username)){
    if($priviledge != 'visitor'){
      $q = mysqli_query($con,"select * from banks where id=$id");
      $qn = mysqli_num_rows($q);
      if($qn > 0){
        while($row = mysqli_fetch_assoc($q)){
          $nme = $row['name'];
          echo"
          <h3>Edit bank name</h3>
          <form method='POST' action='admin/banks' class='mb-2'>
            <table class='w-100'>
              <tr>
                <td colspan='2'>Bank Name:</td>
              </tr>
              <tr>
                <td><input type='hidden' name='id' value='$id'><input type='hidden' name='old' value='$nme'><input type='text' value='$nme' name='bank_name' class='form-control' onkeyup='handleBankName2(this)'></td>
                <td>&nbsp;&nbsp;<button type='submit' name='submit' class='btn btn-primary' id='update'>Update</button></td>
              </tr>
              <tr>
                <td colspan='2'><div id='msg2'></div></td>
              </tr>
            </table>
          </form>
          ";
        }
      }
    }
  }
}

if(isset($_POST['editAtm'])){
  $id = $_POST['id'];
  if(isset($username)){
    if($priviledge != 'visitor'){
      $q = mysqli_query($con, "select * from atms where id=$id");
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
          $fucntioning = $row['functioning'];
          echo"<div><h3>Edit ATM with ID of $id</h3></div>";
          ?>
          <form action="admin/atms" method="post">
            <div class="edit-wrapper">
                <input type="hidden" name="id" value="<?php echo"$id";?>">
                <p class="mb-2"><b>Bank name: <?php echo"$name";?></b></p>
                <p class="mb-2">Latitude:</p>
                <input type="text" name="latitude" value="<?php echo"$lat";?>" class='form-control mb-2' required>
                <p class="mb-2">Longitude:</p>
                <input type="text" name="longitude" value="<?php echo"$ln";?>" class='form-control mb-2' required>
                <p class="mb-2">District:</p>
                <input type="text" name="district" value="<?php echo"$district";?>" class='form-control mb-2' required>
                <p class="mb-2">Sector:</p>
                <input type="text" name="sector" value="<?php echo"$sector";?>" class='form-control mb-2' required>
                <p class="mb-2">Cell:</p>
                <input type="text" name="cell" value="<?php echo"$cell";?>" class='form-control mb-2' required>
                <p class="mb-2">Village:</p>
                <input type="text" name="village" value="<?php echo"$village";?>" class='form-control mb-2' required>
                <p class="mb-2">Addres:</p>
                <input type="text" name="address" value="<?php echo"$address";?>" class='form-control mb-2' required>
                <p class="mb-2">Is this ATM functioning?</p>
                <?php
                if($fucntioning == 'YES'){
                  ?>
                  <input type="radio" name="functioning" value='Yes' class="form-radio" checked onclick="handleProblem(this)"> Yes &nbsp;&nbsp;
                  <input type="radio" name="functioning" value='No' class="form-radio" onclick="handleProblem(this)"> No
                  <div id="problemContainer" class="d-none">
                    <p class="mb-2">Problem Description:</p>
                    <textarea name="problem" class='form-control mb-2' id="problem"><?php echo"$problem";?></textarea>
                  </div>
                  <?php
                }else{
                  ?>
                  <input type="radio" name="functioning" value='Yes' class="form-radio" onclick="handleProblem(this)"> Yes &nbsp;&nbsp;
                  <input type="radio" name="functioning" value='No' class="form-radio" checked onclick="handleProblem(this)"> No
                  <div id="problemContainer">
                    <p class="mb-2">Problem Description:</p>
                    <textarea name="problem" class='form-control mb-2' id="problem"><?php echo"$problem";?></textarea>
                  </div>
                  <?php
                }
                ?>
            </div>
            <div class="mt-2 p-3">
              <button type="button" class="btn btn-danger" onclick="remove(<?php echo $id;?>,'atm')">Delete ATM</button>
              <button type="submit" name="submit" class="btn btn-success">Update Atm info</button>
            </div>
          </form>
          <?php
        }
      }
    }
  }
}

if(isset($_POST['input'])){
  $bank = mysqli_real_escape_string($con,$_POST['name']);
  if(isset($username)){
    if($priviledge != 'visitor'){
      $q = mysqli_query($con, "select * from banks where name='$bank'");
      $qn = mysqli_num_rows($q);
      if($qn > 0){
        echo"<div class='alert alert-danger mt-2'>Bank name already exist.</div>";
      }else{
        echo"";
      }
    }
  }
}

if(isset($_POST['saveBank'])){
  $bank = mysqli_real_escape_string($con,$_POST['bankName']);
  if(isset($username)){
    if($priviledge != 'visitor'){
      $q = mysqli_query($con, "select * from banks where name='$bank'");
      $qn = mysqli_num_rows($q);
      if($qn > 0 || $bank == ''){
        echo"<div class='alert alert-danger mt-2'>Bank name already exist.</div>";
      }else{
        mysqli_query($con, "insert into banks(name,atms) values('$bank','0')");
        echo"success";
      }
    }
  }
}

if(isset($_POST['filter'])){
  $option = mysqli_real_escape_string($con,$_POST['option']);
  if(isset($username)){
    if($priviledge != 'visitor'){
      if($option != 'all'){
        $q = mysqli_query($con,"select * from atms where bank_name='$option'");
        $qn = mysqli_num_rows($q);
        if($qn > 0){
          ?>
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
          <?php
        }
      }else{
        $q = mysqli_query($con,"select * from atms");
        $qn = mysqli_num_rows($q);
        if($qn > 0){
          ?>
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
            }
            ?>
          </table>
          <?php
      }
    }
  }
}

if(isset($_POST['old'])){
  $pwd = $_POST['pwd'];
  $pwd = md5($pwd);
  $q = mysqli_query($con, "select * from users where username='$username' AND password='$pwd'");
  $qn = mysqli_num_rows($q);
  if($qn == 1){echo "success";}else{echo "nope";}
}
?>
