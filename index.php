<?php
    session_start();
    error_reporting(1);
    include 'db_connect.php';
    // for reciever login
    $user = $_SESSION['userName'];
    $userId = $_SESSION['userId'];
    $reciver_pattern = "/Rec_/i";
    $reciever_logged = preg_match($reciver_pattern, $userId);
    // for hospital login
    $hospital = $_SESSION['hospitalName'];
    $hospitalId = $_SESSION['hospitalId'];
    $hospital_pattern = "/H_/i";
    $hospital_logged = preg_match($hospital_pattern, $hospitalId);
    // echo $hospital.'<br>'.$hospitalId.'<br>'.$hospital_logged;

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css"integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,900;1,400;1,700&family=Montserrat:ital,wght@0,400;0,700;1,400;1,700&family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- css -->
    <link rel="stylesheet" href="./assets/css/first_css/style.css">
    <link rel="stylesheet" href="./assets/css/first_css/styleservices.css">
    <!-- icon -->
    <link rel="shortcut icon" href="./assets/images/hand-white.svg" type="image/x-icon">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    
    <title>Blood Bank</title>
</head>
<body class="bg-light">
    <!-- main-page -->
    <!-- nav -->
    <span class="position-absolute trigger"><!-- hidden trigger to apply 'stuck' styles --></span>
    <nav class="navbar navbar-expand-sm sticky-top navbar-light py-4">
        <div class="container">
            <a class="navbar-brand" href="index.php" style="font-family: 'Montserrat'; font-size: 24px; font-weight: 700; color: #fff;">
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
                    <a href="hospital_dashboard.php" class="dropdown-item">View Requests</a>
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
<!-- nav end -->
<!-- container -->
<div class="container section1">
    <div class="col ">
        <img src="./assets/images/Group 36@2x.png" alt="" width="100%" class="hero-img">
        <h1 class="hero-txt mt-5 pt-5" style="color: 	#0e1111">Give the, <br>Gift of Life.</h1>
        <p class="intro-txt" style="color: 	#0e1111">One pint of blood can save upto 3 lives.</p>
        <a href="view_available_blood_samples.php" class="btn link-sample">Request Blood</a>
    </div>
</div>

<!-- reasons to donate blood -->
<section id="services" class="section-bg">
      <div class="container" data-aos="fade-up">
        <header class="section-header">
          <h3 style="color: black;">Why should we donate? </h3>
          <p style="color: #333; font-size: 16px; font-weight: bold;">
          Blood is the most precious gift that anyone can give to another person.
          </p>
        </header>

        <div class="row justify-content-center">
          <div class="col-md-6 col-lg-5" data-aos="zoom-in" data-aos-delay="100">
            <div class="box">
              <div class="icon">
                <!-- <i class="ion-ios-analytics-outline" style="color: #ff689b"></i> -->
              </div>
              <h4 class="title"><a href="javascript:void(0);">The need is great</a></h4>
              <p class="description">
              Cancer patients are among the most common recipients of blood transfusions. But donations are also used daily for surgery patients, accident victims, organ transplant recipients and burn patients — young and old.
              </p>
            </div>
          </div>
          <div class="col-md-6 col-lg-5" data-aos="zoom-in" data-aos-delay="200">
            <div class="box">
              <div class="icon">
                <!-- <i class="ion-ios-bookmarks-outline" style="color: #e9bf06"></i> -->
              </div>
              <h4 class="title"><a href="javascript:void(0);">You may need blood at some time.</a></h4>
              <p class="description">
              Statistics show that 25 percent or more of us will need blood at least once in our lifetime. And those 50-plus begin needing it the most. So why not give back before you need it — or give because someone has given for you?
              </p>
            </div>
          </div>

          <div class="col-md-6 col-lg-5" data-aos="zoom-in" data-aos-delay="100">
            <div class="box">
              <div class="icon">
                <!-- <i class="ion-ios-paper-outline" style="color: #3fcdc7"></i> -->
              </div>
              <h4 class="title"><a href="javascript:void(0);">You get a free mini-physical.</a></h4>
              <p class="description">
              Before donating, your vitals — temperature, pulse and blood pressure — are checked as well as your hemoglobin level. “Many people find out they have elevated blood pressure from us,” Eder says. 
              </p>
            </div>
          </div>
          <div class="col-md-6 col-lg-5" data-aos="zoom-in" data-aos-delay="200">
            <div class="box">
              <div class="icon">
                <!-- <i class="ion-ios-speedometer-outline" style="color: #41cf2e"></i> -->
              </div>
              <h4 class="title"><a href="javascript:void(0);">It’s an act of kindness.</a></h4>
              <p class="description">
              One donation can help save the lives of up to three people. “It’s a truly selfless act,” Eder says. “There’s personal satisfaction that you may have saved someone’s life.”
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

<!-- Footer -->
<footer class="page-footer font-small bg-danger pt-4 text-center" id="contact">
  <div class="container-fluid text-center text-md-left container">
    <div class="row">
      <div class="col-md-12 mt-md-0 mt-3">
        <h5 class="font-weight-bold text-light" style="font-size: 24px;">SourceRed </h5>
        <span> 
          <a href="" class="text-uppercase text-light mr-3"><i class="lab la-google-plus-g la-2x"></i></a> 
          <a href="" class="text-uppercase text-light mr-3"><i class="lab la-facebook la-2x"></i></i></a> 
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


    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js" integrity="sha512-IQLehpLoVS4fNzl7IfH8Iowfm5+RiMGtHykgZJl9AWMgqx0AmJ6cRWcB+GaGVtIsnC4voMfm8f2vwtY+6oPjpQ==" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

<script>
    (new IntersectionObserver(function(e,o){
    if (e[0].intersectionRatio > 0){
        document.documentElement.removeAttribute('class');
    } else {
        document.documentElement.setAttribute('class','stuck');
    };
})).observe(document.querySelector('.trigger'));
</script>
</body>
</html>