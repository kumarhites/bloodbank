<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css"
        integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">
    <!-- css -->
    <link rel="stylesheet" href="./assets/css/first_css/view_avlb_blood_samples.css">
    <!-- <link rel="stylesheet" href="./assets/css/first_css/style.scss"> -->
    <!-- fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,900;1,400;1,700&family=Montserrat:ital,wght@0,400;0,700;1,400;1,700&family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
        <!-- icon -->
        <link rel="shortcut icon" href="./assets/images/hand-white.svg" type="image/x-icon">
    <title>Available Blood Samples</title>
</head>
<body class="bg-light">
    <span class="position-absolute trigger"><!-- hidden trigger to apply 'stuck' styles --></span>
    <nav class="navbar navbar-expand-sm sticky-top navbar-light py-4">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="./assets/images/hand-red.svg" alt="" width="50px" draggable="false"></a>
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
                        <a class="nav-link" href="#">Contact Us</a>
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
                    <a href="profile.php" class="dropdown-item">My Requests</a>
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