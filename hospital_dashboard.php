<?php
    session_start();
    error_reporting(1);
    include './db_connect.php';
    // for reciever login
    $user = $_SESSION['userName'];
    $userId = $_SESSION['userId'];
    // echo "<script>alert('".$userId."')</script>";
    $reciver_pattern = "/Rec_/i";
    $reciever_logged = preg_match($reciver_pattern, $userId);
    // for hospital login
    $hospital = $_SESSION['hospitalName'];
    $hospitalId = $_SESSION['hospitalId'];
    // echo "<script>alert('".$hospitalId."')</script>";
    $hospital_pattern = "/H_/i";
    $hospital_logged = preg_match($hospital_pattern, $hospitalId);
    // echo $hospital.'<br>'.$hospitalId.'<br>'.$hospital_logged;
    if($user != "" && $reciever_logged == 1){
        unset($_SESSION['userId']);	
        unset($_SESSION['userName']);	
        header('location:login_hospital.php');
    }
    elseif($hospital == "" && $hospital_logged == 0){
        header('location:login_hospital.php');
    }
    else{
        $req_info = mysqli_query($db, "SELECT * FROM requests INNER JOIN reciever ON requests.r_id = reciever.r_id WHERE requests.h_id = '$hospitalId'");
        $result = mysqli_num_rows($req_info);

    }


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css"
        integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">
    <!-- fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,900;1,400;1,700&family=Montserrat:ital,wght@0,400;0,700;1,400;1,700&family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <!-- css -->
    <link rel="stylesheet" href="./assets/css/first_css/view_avlb_blood_samples.css">
    <!-- icon -->
    <link rel="shortcut icon" href="./assets/images/hand-white.svg" type="image/x-icon">
    
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

    <title>Blood Bank</title>
</head>

<body class="bg-light">
    <!-- main-page -->
    <!-- nav -->
    <span class="position-absolute trigger">
        <!-- hidden trigger to apply 'stuck' styles --></span>
        <nav class="navbar navbar-expand-sm sticky-top navbar-light py-4">
        <div class="container">
        <a class="navbar-brand" href="index.php" style="font-family: 'Montserrat'; font-size: 24px; font-weight: 700; color: #222;">
                <img src="./assets/images/hand-red.svg" alt="" width="50px" draggable="false">&emsp;SourceRed</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar1">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar1">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_available_blood_samples.php">Blood Samples</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact Us</a>
                    </li>
                    <!-- <li class="nav-item active">
                        <a class="nav-link" href="#">Dashboard</a>
                    </li> -->
            <?php
                if($user != "" && $reciever_logged == 1){
                    
                
            ?>
                <ul class="navbar-nav navbar-nav-hover align-items-lg-center">
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button">
                    <!-- <i class="ni ni-collection d-lg-none"></i> -->
                    <span class="nav-link-inner--text" style="font-weight: bold;"><?php echo $user;?></span>
                    </a>
                    <div class="dropdown-menu">
                    <!-- <a href="orders.php" class="dropdown-item">Appointments</a> -->
                    <a href="reciever_requests.php" class="dropdown-item">My Requests</a>
                    <a href="logout.php" class="dropdown-item">Logout</a>
                    <!-- <a href="../examples/register.html" class="dropdown-item">Register</a> -->
                    </div>
                </li>
                </ul>
            <?php
            }
            elseif ($hospital != "" && $hospital_logged == 1) {
            ?>
                 <ul class="navbar-nav navbar-nav-hover align-items-lg-center">
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button">
                    <!-- <i class="ni ni-collection d-lg-none"></i> -->
                    <span class="nav-link-inner--text" style="font-weight: bold;"><?php echo $hospital;?></span>
                    </a>
                    <div class="dropdown-menu">
                    <!-- <a href="orders.php" class="dropdown-item">Appointments</a> -->
                    <a href="#" class="dropdown-item">View Requests</a>
                    <a href="add_blood_info.php" class="dropdown-item">Add Blood Info.</a>
                    <a href="logout.php" class="dropdown-item">Logout</a>
                    <!-- <a href="../examples/register.html" class="dropdown-item">Register</a> -->
                    </div>
                </li>
                </ul>

            <?php
            }
            else{
                ?>
                    <div class="dropdown show">
                    <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-weight: bold;">
                        Login
                    </a>
                    
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item " href="login_reciever.php">Login as Reciever</a>
                        <a class="dropdown-item" href="login_hospital.php">Login as Hospital</a>
                        <!-- <a class="dropdown-item" href="#">Something else here</a> -->
                    </div>
                </div>
            <?php
            }
            ?>
                
            </ul>
        </div>
    </div>
</nav>
    <div class="container">
        <section class="section1 mt-3" style="height: 35vh;">
            <header class="text-center">
                <h1 class=" header-text">Requests</h1>
            </header>
        </section>
        <section class="container section2">
        <?php 
    if($result > 0){
        while($row = mysqli_fetch_assoc($req_info)){
            // echo "<script>alert('from join query inside while".$row['blood_grp']."')</script>";
            $h_id = $row['h_id'];
            // echo "<script>alert('".$h_id."')</script>";
            $b_type = $row['blood_grp'];
            ?>
                <div class="bld-grp mt-3 mb-5">
                    <div class="preview text-center">
                        <h6>Blood Group</h6>
                        <h2><?php echo $row['blood_grp'];?></h2>
                        <small class="text-light">Requested : <?php echo $row['units_requested'];?> units</small>
                    </div>
                    <div class="info">
                        <h6>ID : <?php echo $row['req_id'];?></h6>
                        <h2>Request Info</h2>
                        <h6><i class="lar la-user-circle"></i> <?php echo $row['r_name'];?></h6>
                        <h6 style="text-transform: lowercase;"><i class="las la-at"></i> <?php echo $row['r_email'];?></h6>
                        <h6 style="text-transform: uppercase;"><i class="las la-map-pin"></i> <?php echo $row['r_address'];?></h6>
                        <h6><i class="las la-phone"></i> +91 <?php echo $row['r_phone'];?></h6>
                    </div>
                </div>
                <?php
        }
    }
                ?>
</section>
    </div>
    <!-- Footer -->
<footer class="page-footer font-small bg-danger pt-4 text-center" id="contact">
  <div class="container-fluid text-center text-md-left container">
    <div class="row">
      <div class="col-md-12 mt-md-0 mt-3">
        <h5 class="font-weight-bold text-light" style="font-size: 24px;">SourceRed</h5>
        <span> 
          <a href="" class="text-uppercase text-light mr-3"><i class="lab la-google-plus-g la-2x"></i></a> 
          <a href="" class="text-uppercase text-light mr-3"><i class="lab la-facebook la-2x"></i></a> 
          <a href="" class="text-uppercase text-light mr-3"><i class="lab la-instagram la-2x"></i></i></a> 
          <a href="" class="text-uppercase text-light mr-3"><i class="lab la-linkedin-in la-2x"></i></a> 
          <a href="" class="text-uppercase text-light mr-3"><i class="lab la-twitter la-2x"></i></a> <br>
          <a href="" class="text-uppercase  text-light mr-3" style="font-size: 24px; text-decoration: none;"><i class="las la-phone "></i>+91 7004312549</a>
        </span>
        <p class="text-light">SourceRed Blood Bank is aimed at promoting the awareness of blood donation among the public. It is committed to stay ahead of all linguistic-rational-religious-political differences and shall be fully focusing its objectives in health care activities.</p>
      </div>
      <hr class="clearfix w-100 d-md-none pb-3">
    </div>
  </div>
  <div class="footer-copyright text-center py-3 text-light" style="color: white; font-size: 20px; text-decoration: none;"> Every Drop Matters. 
    <a href="https://sourcered.epizy.com/" style="color: white; font-size: 20px;"><i class="las la-tint"></i> SourceRed</a>
  </div>
</footer>
<!-- Footer -->

    <!-- JavaScript Bundle with Popper.js -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.bundle.min.js"
        integrity="sha384-BOsAfwzjNJHrJ8cZidOg56tcQWfp6y72vEJ8xQ9w6Quywb24iOsW913URv1IS4GD" crossorigin="anonymous">
    </script>
    <script>
        (new IntersectionObserver(function (e, o) {
            if (e[0].intersectionRatio > 0) {
                document.documentElement.removeAttribute('class');
            } else {
                document.documentElement.setAttribute('class', 'stuck');
            };
        })).observe(document.querySelector('.trigger'));
    </script>


</body>

</html>