<?php
include('conn.php');
if(isset($_POST['submit'])){
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    // echo $name;
    // Sanitize and validate the password input
    $pass = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $pass = filter_var($pass, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z0-9]+$/")));
    // echo $pass;
    // Sanitize and validate the email input
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    echo $email;
    // Sanitize the hospital input
    $hospital = filter_var($_POST['hospital'], FILTER_SANITIZE_STRING);
    // echo $hospital;
    // Sanitize and validate the gender input
    $gender = filter_var($_POST['gender'], FILTER_SANITIZE_STRING);
    $gender = filter_var($gender, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^(male|female)$/i")));
//    echo $gender;
    $specialty = filter_var($_POST['specialty'], FILTER_SANITIZE_STRING);
    $specialty = filter_var($specialty, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^(doctor|nurse)$/i")));
//    echo $specialty;
    $m=mysqli_query($conn,"INSERT INTO `user`(`Name`,`email`, `password`, `gender`, `specialty`, `hospital`) VALUES ('$name','$email','$pass','$gender','$specialty','$hospital')");
    if($m){
    header('location: login.php');
}
    else{
        // echo $m;
        $error="<div class='alert alert-danger'>An error occured, Please input correctly</div>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Register - Brand</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css">
    <link rel="stylesheet" href="assets/css/smoothproducts.css">
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar sticky-top">
        <div class="container"><a class="navbar-brand logo" href="#">Health system</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse"
                id="navcol-1">
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item" role="presentation"><a class="nav-link" href="contact-us.php">Contact Us</a></li>
                </ul>
            </div>
        </div>
    </nav><?php if(isset($error)){echo $error;} ?>
    <main class="page registration-page">
        <section class="clean-block clean-form dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Registration</h2>
                </div>
                <form method="POST" action="">
                    <div class="form-group"><label for="name">Full Name</label><input class="form-control item" type="text" id="name" name="name" required></div>
                    <div class="form-group"><label for="email">Email</label><input class="form-control item" type="email" id="email" name="email" required></div>

                    <div class="form-group"><label for="password">Password</label><input class="form-control item" type="password" id="password" name="password" required></div>
                    <div class="form-group"><label for="hospital">Hospital</label><input class="form-control item" type="text" id="hopital" name="hospital" required></div>
                    <div class="form-group"><label for="specialty">Specialty</label><select class="form-control" name="specialty" required><optgroup label=""><option value="Doctor" selected="">Doctor</option><option value="Nurse">Nurse</option></optgroup></select></div>

                    <div class="form-group"><label for="gender">Gender</label><select class="form-control" name="gender" required><optgroup label=""><option value="Male" selected="">Male</option><option value="female">Female</option></optgroup></select></div>
                    <div>Already have an account? <a href="login.php">Login</a></div>
                    <button class="btn btn-primary btn-block" type="submit" name="submit">Sign Up</button>
                </form>
            </div>
        </section>
    </main>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
    <script src="assets/js/smoothproducts.min.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>