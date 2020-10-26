<?php
  require 'db_connect.php';
  error_reporting(1);
  if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cnf_password = $_POST['cnf_password'];
  if ($password !== $cnf_password) {
      echo "<script>alert('Password and Confirm Password don't match!')</script>";
      exit();
    }
    else{
      $check = mysqli_query($db, "SELECT * from hospital where h_name = '$name' and h_address = '$address' and h_city = '$city' and h_email = '$email'");
        if(mysqli_num_rows($check))
        {
          echo "<script>alert('Hospital Already exists')</script>";	
        }		
        else{
          $id = 'H_'.date('Y-m-d').'-'.time();
          $hash_password = password_hash($password, PASSWORD_DEFAULT);
          $sql = mysqli_query($db, "INSERT INTO `hospital` (`h_id`, `h_name`, `h_phone`, `h_address`, `h_city`, `h_email`, `h_password`) VALUES ('$id', '$name', '$phone', '$address', '$city', '$email', '$hash_password')");
          header('location: login_hospital.php');
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
    <link rel="stylesheet" href="./assets/css/first_css/style.scss">
    <!-- favicon -->
    <link rel="shortcut icon" href="./assets/images/hand-white.svg" type="image/x-icon">
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Hospital | Registration</title>
</head>
<body>
    <a href="./index.html"><svg class="back_arrow" width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-left-short" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
      <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
    </svg></a>
    <section class="card container-fluid px-3 py-3 mb-5">
        <form action="#" method="POST">
            <div class="card-title mb-3 mt-3">
                <h3>Hospital Registration</h3>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="name">Hospital Name</label>
                  <input type="text" class="form-control" id="name" placeholder="Hospital Name" name="name">
                </div>
                <div class="form-group col-md-6">
                  <label for="phone">Hospital Phone</label>
                  <input type="tel" class="form-control" id="phone" placeholder="Phone No."
                  maxlength="10" size="10" pattern="[1-9]{1}[0-9]{9}" required name="phone">
                </div>
                <div class="form-group col-md-6">
                  <label for="address">Address</label>
                  <input type="address" class="form-control" id="address" placeholder="Address" name="address">
                </div>
                <div class="form-group col-md-6">
                  <label for="city">City</label>
                  <input type="text" class="form-control" id="city" placeholder="City" maxlength="20" size="20" required name="city">
                </div>
                <div class="form-group col-md-12">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" placeholder="Email" name="email">
                </div>
                <div class="form-group col-md-6">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                </div>
                <div class="form-group col-md-6">
                  <label for="cnf_password">Confirm Password</label>
                  <input type="password" class="form-control" id="cnf_password" placeholder="Confirm Password" name="cnf_password">
                </div>
            </div>
            <a href="login_hospital.php" class="btn ml-n2 text-muted">Member Hospital? <u>Login</u></a>
            <button type="submit" class="btn btn-primary mt-3 float-right" name="submit">Submit</button>
          </form>
    </section>


<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js" integrity="sha512-IQLehpLoVS4fNzl7IfH8Iowfm5+RiMGtHykgZJl9AWMgqx0AmJ6cRWcB+GaGVtIsnC4voMfm8f2vwtY+6oPjpQ==" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>