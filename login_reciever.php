<?php
  session_start();
  require 'db_connect.php';
	if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM `reciever` WHERE r_email = ?;";
    $stmt = mysqli_stmt_init($db);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      echo "<script>alert('No such User Exits')</script>";
      exit();
    }
    else{
      mysqli_stmt_bind_param($stmt, "s", $email);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if($row = mysqli_fetch_assoc($result)){
        $password_check = password_verify($password, $row['r_password']);
        if($password_check == false){
          echo "<script>alert('Invalid Username or Password Combination!')</script>";
          exit();
        }
        else{
          $_SESSION['userId'] = $row['r_id'];
          $_SESSION['userName'] = $row['r_name'];
          header('location:index.php');
        }
      }
      else{
        echo "<script>alert('Invalid Username or Password Combination!')</script>";
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
    <link rel="stylesheet" href="./assets/css/first_css/login_reciever.css">
    <!-- favicon -->
    <link rel="shortcut icon" href="./assets/images/hand-white.svg" type="image/x-icon">
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Login | Reciever</title>
</head>
<body>
  <a href="./index.html"><svg class="back_arrow" width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-left-short" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
    <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
  </svg></a>
  <section class="card container-fluid px-3 py-3">
    <form action="#" method="POST">
        <div class="card-title mb-3  text-center"> 
          <svg id="download" xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 104.714 113.639">
            <path id="Path_1" data-name="Path 1" d="M45.962,60.962,27.772,48.626V41.034a7.625,7.625,0,0,0-4.425-6.88v-9.49A10.21,10.21,0,0,0,13.024,14.7,10.21,10.21,0,0,0,2.7,24.664V55.98a9.866,9.866,0,0,0,4.67,8.3L30.23,78.993V90.855a2.283,2.283,0,0,0,2.458,2.372,2.283,2.283,0,0,0,2.458-2.372V77.569a2.893,2.893,0,0,0-.983-1.9L9.828,60.488a5.26,5.26,0,0,1-2.458-4.27V24.664a5.411,5.411,0,0,1,10.816,0v8.778A7.767,7.767,0,0,0,11.3,41.034V52.659a2.283,2.283,0,0,0,2.458,2.372,2.283,2.283,0,0,0,2.458-2.372V41.034a3.2,3.2,0,0,1,6.391,0v8.778s0,1.661.983,1.9,0,0,.246.237L43.258,65a5.26,5.26,0,0,1,2.458,4.27V91.329a2.46,2.46,0,0,0,4.916,0V69.266A9.3,9.3,0,0,0,45.962,60.962Z" transform="translate(-2.7 19.937)" fill="#ff5f5f"/>
            <path id="Path_2" data-name="Path 2" d="M63.554,14.7A10.21,10.21,0,0,0,53.23,24.664v9.49a7.785,7.785,0,0,0-4.425,6.88v7.592L30.37,60.962a9.866,9.866,0,0,0-4.67,8.3V91.329A2.283,2.283,0,0,0,28.158,93.7a2.283,2.283,0,0,0,2.458-2.372V69.266A5.26,5.26,0,0,1,33.074,65L52.493,51.947a2.543,2.543,0,0,0,.983-1.9V41.271a3.2,3.2,0,0,1,6.391,0V52.9a2.46,2.46,0,0,0,4.916,0V41.271A7.767,7.767,0,0,0,57.9,33.679V24.9a5.411,5.411,0,0,1,10.816,0V56.217a5.26,5.26,0,0,1-2.458,4.27L42.415,75.909a2.133,2.133,0,0,0-.983,1.9V91.092a2.46,2.46,0,0,0,4.916,0V79.23l22.86-14.709a9.866,9.866,0,0,0,4.67-8.3V24.664A10.21,10.21,0,0,0,63.554,14.7Z" transform="translate(30.836 19.937)" fill="#ff5f5f"/>
            <path id="Path_3" data-name="Path 3" d="M61.2,43.99C61.2,32.365,42.03,4.37,39.818,1.049A2.264,2.264,0,0,0,37.852.1a3.075,3.075,0,0,0-1.966.949C33.673,4.133,14.5,32.365,14.5,43.99c0,12.337,10.57,22.538,23.352,22.538S61.2,56.564,61.2,43.99ZM37.852,61.783c-10.078,0-18.436-8.066-18.436-17.793,0-7.592,11.8-27.283,18.436-37.247C44.488,16.707,56.287,36.4,56.287,43.99,56.287,53.954,47.93,61.783,37.852,61.783Z" transform="translate(14.505 -0.1)" fill="#ff2424"/>
            <path id="Path_4" data-name="Path 4" d="M32.019,28.276a8.562,8.562,0,0,1-8.6-8.3A2.283,2.283,0,0,0,20.958,17.6,2.283,2.283,0,0,0,18.5,19.972c0,7.117,6.145,13.048,13.519,13.048a2.283,2.283,0,0,0,2.458-2.372A2.42,2.42,0,0,0,32.019,28.276Z" transform="translate(20.337 23.917)" fill="#ff2424"/>
          </svg>
          <h3 class="text-center">Reciever Login</h3>
        </div>
    <div class="form-group">
      <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email" required>
      <small id="email" class="form-text text-muted">We'll never share your details with anyone else.</small>
    </div>
    <div class="form-group">
      <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
    </div>
    <a href="reciever_register.php" class="btn ml-n2 text-muted">New User? <u>SignUp</u></a>
    <button type="submit" class="btn btn-primary mt-3 float-right" name="submit">Submit</button>
  </form>
    </section>




<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js" integrity="sha512-IQLehpLoVS4fNzl7IfH8Iowfm5+RiMGtHykgZJl9AWMgqx0AmJ6cRWcB+GaGVtIsnC4voMfm8f2vwtY+6oPjpQ==" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>
</html>