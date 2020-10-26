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
    

       $blood_info = mysqli_query($db, "SELECT * FROM blood_inventory
                                        INNER JOIN hospital
                                        ON blood_inventory.h_id = hospital.h_id;");
        $row_count = mysqli_num_rows($blood_info);


        if(isset($_POST['request'])){
            if($user == "" && $reciever_logged == 0){
                echo "<script>alert('To request please login as Reciever.')</script>";
                header('location:login_reciever.php');
           }
           else{
                $hidden_request_id = $_POST['hidden_request_id'];
                $hidden_r_id = $_POST['hidden_r_id'];
                $hidden_h_id = $_POST['hidden_h_id'];
                $hidden_blood_grp = $_POST['hidden_blood_grp'];
                $hidden_units = $_POST['unit_request'];
                // echo "<script>alert('".$hidden_request_id."')</script>";
                // echo "<script>alert('".$hidden_r_id."')</script>";
                // echo "<script>alert('".$hidden_h_id."')</script>";
                // echo "<script>alert('".$hidden_blood_grp."')</script>";
                // echo "<script>alert('".$hidden_units."')</script>";
                if($_POST['unit_request'] == ""){
                    echo "<script>alert('Please select no of units')</script>";
                }
                else{
                    // $check = mysqli($db, "SELECT * FROM requests where r_id")

                    $request_insert = mysqli_query($db, "INSERT INTO requests (`req_id`,`r_id`,`h_id`,`blood_grp`,`units_requested`) VALUES ('$hidden_request_id', '$hidden_r_id', '$hidden_h_id', '$hidden_blood_grp', '$hidden_units')");
                    echo "<script>alert('Request sent!')</script>";
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
<div class="container">
<section class="section1 mt-3" style="height: 30vh;">
    <header class="text-center">
        <h1 class=" header-text">Available Blood Samples</h1>
    </header>
</section>
<section class="container section2">
<?php 
    if($row_count > 0){
        while($row = mysqli_fetch_assoc($blood_info)){
            // echo "<script>alert('from join query inside while".$row['blood_grp']."')</script>";
            $h_id = $row['h_id'];
            // echo "<script>alert('".$h_id."')</script>";
            $b_type = $row['blood_grp'];
            ?>
                <div class="bld-grp mt-3 mb-5">
                    <div class="preview">
                        <h6>Blood Group</h6>
                        <h2><?php echo $row['blood_grp'];?></h2>
                        <small class="text-light">Available : <?php echo $row['total_available_quantity'];?> units</small>
                    </div>
                    <div class="info">
                        <!-- <h6>Donor name : Hitesh Kumar</h6> -->
                        <h2>Hospital Info</h2>
                        <h6><?php echo $row['h_name'];?></h6>
                        <h6 style="text-transform: lowercase;"><?php echo $row['h_email'];?></h6>
                        <h6 style="text-transform: uppercase;"><?php echo $row['h_city'];?></h6>
                        <h6>+91 <?php echo $row['h_phone'];?></h6>

                    <?php
                        $rec_blood_grp = mysqli_query($db, "SELECT * FROM reciever WHERE r_id = '$userId'");
                        $row = mysqli_fetch_assoc($rec_blood_grp);
                        $rec_blood_type = $row['r_blood-grp'];
                        $req_id = 'REQ-'.date('Y-m-d/A').'-'.time();
                        // echo "<script>alert('$req_id')</script>";
                        // if(isset($_POST['request'])){
                        //     if ($user == "" && $userId == 0) {
                        //         header('location:login_reciever.php');
                        //     }
                        // }
                        
                        

                        if($rec_blood_type == $b_type){

                            ?>
                                    <form action="#" method="POST">
                                        <input class="unit_request text-right" type="text" name="unit_request" id="" required placeholder="Enter Blood Required" pattern="[0-3]{2}" maxlength="2" size="2" >
<!-- hidden input boxes for data transfer -->
<input type="hidden" name="hidden_request_id" value="<?php echo $req_id.'3'; ?>" />
<input type="hidden" name="hidden_r_id" value="<?php echo $userId; ?>" />
<input type="hidden" name="hidden_h_id" value="<?php echo $h_id; ?>" />
<input type="hidden" name="hidden_blood_grp" value="<?php echo $row['r_blood-grp']; ?>" />
<!-- <input type="hidden" name="hidden_units" value="<?php echo $_POST['unit_request']; ?>" /> -->



<!-- hidden input boxes for data transfer -->
                                        
                                            <button class="btn btn-request" name="request" required >Request</button>
                                    </form>   
                            <?php
                        }
                        
                        else{
                            ?>   <form action="./login_reciever.php" method="POST">
                                    <input class="unit_request text-right" type="text" name="unit_request" id="" required placeholder="Enter Blood Required" pattern="[0-3]{2}" maxlength="2" size="2" hidden>
                                    <button type="submit" class="btn btn-request" name="request" required disabled>Request</button>
                                </form>
                            <?php
                        }
                    ?>
                                                               
                    </div>
                </div>
                    
<?php
        }
    }

?>
</section>
</div>

    <!-- JavaScript Bundle with Popper.js -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.bundle.min.js" integrity="sha384-BOsAfwzjNJHrJ8cZidOg56tcQWfp6y72vEJ8xQ9w6Quywb24iOsW913URv1IS4GD" crossorigin="anonymous"></script>
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