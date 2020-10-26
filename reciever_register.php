<?php
  require 'db_connect.php';
  error_reporting(1);
  if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $blood_grp = $_POST['blood_grp'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cnf_password = $_POST['cnf_password'];
    if ($blood_grp === "select") {
      echo "<script>alert('Please Select a Blood Group')</script>";
      exit();
    }
    elseif ($password !== $cnf_password) {
      echo "<script>alert('Password and Confirm Password don't match!')</script>";
      exit();
    }
    else{
      $check = mysqli_query($db, "SELECT * from reciever where r_name = '$name' and r_email = '$email'");
      if(mysqli_num_rows($check))
      {
        echo "<script>alert('User Already exists')</script>";	
      }		
      else{
        $id = 'Rec_'.date('Y-m-d').'-'.time();
        $hash_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = mysqli_query($db, "INSERT INTO `reciever` (`r_id`, `r_name`, `r_phone`, `r_address`, `r_city`, `r_blood-grp`, `r_email`, `r_password`) VALUES ('$id', '$name', '$phone', '$address', '$city', '$blood_grp', '$email', '$hash_password')");
        header("location:login_reciever.php");
      }
    }
  }
    
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- css -->
    <link rel="stylesheet" href="./assets/css/first_css/reciever_register.css">
    <!-- favicon -->
    <link rel="shortcut icon" href="./assets/images/hand-white.svg" type="image/x-icon">
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Login</title>
</head>
<body>
    <a href="./index.php"><svg class="back_arrow" width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-left-short" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
      <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
    </svg></a>
    <section class="card container-fluid px-3 py-3 mb-5">
        <form action="#" method="POST">
            <div class="card-title mb-3 mt-3">
                <h3>Reciever Registration</h3>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="name">Full Name</label>
                  <input type="name" class="form-control" id="name" placeholder="Full Name" required name="name">
                </div>
                <div class="form-group col-md-6">
                  <label for="phone">Phone</label>
                  <input type="tel" class="form-control" id="phone" placeholder="Phone No." maxlength="10" size="10" pattern="[1-9]{1}[0-9]{9}" required name="phone">
                </div>
              <div class="form-group col-md-12">
                  <label for="address" class="">Address</label>
                  <input type="text" class="form-control" name="address" id="address" placeholder="Enter address" required>
              </div>
              <div class="form-group col-md-6">
                  <label for="city" class="">City</label>
                  <input type="text" class="form-control" id="city" name="city" placeholder="Enter city" maxlength="20" size="20" required>
              </div>
              <div class="form-group col-md-6">
                <label for="blood-group">Blood Group</label>
                <select class="form-control" id="blood-group" name="blood_grp">
                    <option value="select">Select</option>
                    <option value="A+">A+ve</option>
                    <option value="A-">A-ve</option>
                    <option value="B+">B+ve</option>
                    <option value="B-">B-ve</option>
                    <option value="AB+">AB+ve</option>
                    <option value="AB-">AB-ve</option>
                    <option value="O+">O+ve</option>
                    <option value="O-">O-ve</option>
                  </select>
            </div>
            <div class="form-group">
                <div class="form-row">
                    <div class="form-group col-md-12">
                      <label for="email">Email</label>
                      <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="passowrd">Password</label>
                      <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="cnf_password">Confirm Password</label>
                      <input type="password" class="form-control" id="cnf_password" name="cnf_password" placeholder="Confirm Password" required>
                    </div>                    
            </div>
            <a href="login_reciever.html" class="btn ml-n2 text-muted">Already a Member? <u>Login</u></a>
            <button type="submit" class="btn btn-primary mt-3 float-right" name="submit">Submit</button>
          </form>
    </section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js" integrity="sha512-IQLehpLoVS4fNzl7IfH8Iowfm5+RiMGtHykgZJl9AWMgqx0AmJ6cRWcB+GaGVtIsnC4voMfm8f2vwtY+6oPjpQ==" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>