<?php
    session_start();
    error_reporting(1);
    include 'db_connect.php';
    // for reciever login
    $user = $_SESSION['userName'];
    $userId = $_SESSION['userId'];
    $reciver_pattern = "/Rec_/i";
    $reciever_logged = preg_match($reciver_pattern, $userId);
    unset($_SESSION['userId']);	
    unset($_SESSION['userName']);
    // for hospital login
    $hospital = $_SESSION['hospitalName'];
    $hospitalId = $_SESSION['hospitalId'];
    $hospital_pattern = "/H_/i";
    $hospital_logged = preg_match($hospital_pattern, $hospitalId);
    // echo $hospital.'<br>'.$hospitalId.'<br>'.$hospital_logged;
    if($user != "" && $userId == 1){
        header('location:logout.php');
    }
    
    elseif($hospital == "" && $hospitalId != 1){
        $_SESSION['redirectURL'] = $_SERVER['REQUEST_URI'];
           header('location:login_hospital.php');
    }
    

    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $blood_grp = $_POST['blood_grp'];
        $quantity = $_POST['quantity'];

        $blood_id = 'B_'.date('Y-m-d').'-'.time();
        $todays_date = date('Y-m-d');

        $hospital_check = mysqli_query($db, "SELECT * FROM hospital WHERE h_name = '$name' AND h_email = '$email'");
        $row_count = mysqli_num_rows($hospital_check);

        if($row_count == 1){
            echo "<script>alert('Hospital cannot be the donor')</script>";
            exit();
        }
        $effectiveDate = date('Y-m-d', strtotime("+3 months", strtotime($todays_date)));
        $sql1 = "INSERT INTO `blood_info` (`blood_id`, `blood_grp`, `quantity_recieved`, `donor_name`, `donor_email`, `h_id`, `date_of_donation`) VALUES ('$blood_id', '$blood_grp', '$quantity', '$name', '$email', '$hospitalId', '$effectiveDate')";

        $insert_query = mysqli_query($db, $sql1);

        if($insert_query == 1){
            $check = mysqli_query($db, "SELECT * FROM `blood_inventory` WHERE `h_id` = '$hospitalId' AND blood_grp = '$blood_grp'");

            $result = mysqli_num_rows($check);
            $row = mysqli_fetch_assoc($check);
            
            
            if($result != 1){
                // echo "<script>alert('".$result."')</script>";
                // echo "<script>alert('".$blood_grp."')</script>";
                // echo "<script>alert('".$quantity."')</script>";
                // echo "<script>alert('".$hospitalId."')</script>";
                
                $insert = mysqli_query($db, "INSERT INTO `blood_inventory` (`blood_grp`, `total_available_quantity`, `h_id`) VALUES ('$blood_grp', '$quantity', '$hospitalId');");

                echo "<script>alert('Blood Information Successfully inserted!')</script>";
                
            }
            else{
                $db_qty = $row['total_available_quantity'];
                $total_available_quantity = $db_qty  + $quantity;
                $update_query = mysqli_query($db, "UPDATE `blood_inventory` SET `total_available_quantity` = '$total_available_quantity' WHERE `blood_inventory`.`blood_grp` = '$blood_grp' AND `blood_inventory`.`h_id` = '$hospitalId';");

                echo "<script>alert('Blood Information updated successfully!')</script>";
            }

        }        
        // }
        
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
    <link rel="stylesheet" href="./assets/css/first_css/add_blood_info.css">
    <!-- fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,900;1,400;1,700&family=Montserrat:ital,wght@0,400;0,700;1,400;1,700&family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
        <!-- icon -->
        <link rel="shortcut icon" href="./assets/images/hand-white.svg" type="image/x-icon">
    <title>Add Blood Info</title>
</head>

<body class="bg-light">
<!-- nav bar -->
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
                    header('location:index.php');
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
<!-- nav bar -->
    <div class="container">
        <main>
            <div class="py-5 text-center">
                <img class="d-block mx-auto mb-4" src="./assets/images/hand-red.svg" alt="" width="72" height="57">
                <h2>Add Blood Info</h2>
                <p class="lead">Be a part of a noble cause.</p>
            </div>
            <div class="col-md-6 col-lg-7 mx-auto">
                <h4 class="mb-3">Donor Information</h4>
                <form action="#" method="POST">
                    <div class="row g-3">
                        <div class="col-sm-12">
                            <label for="name" class="form-label">Name*</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter Full Name" required name="name">
                        </div>
                        <div class="col-sm-8">
                            <label for="email" class="form-label">Email*</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter Donor Email" required name="email">
                        </div>
                        <div class="col-md-4">
                            <label for="country" class="form-label">Blood Group*</label>
                            <select class="form-select" id="blood-group" name="blood_grp" required>
                                <option value="">Select</option>
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
                        

                        <div class="col-sm-12">
                            <label for="qty" class="form-label">Quantity <small>(in ml)</small>*</label>
                            <input type="text" class="form-control" id="qty" placeholder="Enter Quantity in ml" required name="quantity">
                        </div>
                                     
                    </div>

                    <button class="btn btn-danger btn-lg btn-block mt-5" type="submit" name="submit">Submit</button>
                </form>
            </div>
    </div>
    </main>

    <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; 2020 Blood Bank</p>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="#">Privacy</a></li>
            <li class="list-inline-item"><a href="#">Terms</a></li>
            <li class="list-inline-item"><a href="#">Support</a></li>
        </ul>
    </footer>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.bundle.min.js"
        integrity="sha384-BOsAfwzjNJHrJ8cZidOg56tcQWfp6y72vEJ8xQ9w6Quywb24iOsW913URv1IS4GD" crossorigin="anonymous">
    </script>

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