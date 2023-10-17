<?php
include('conn.php');
session_start();
if(isset($_POST['submit'])){
    $pass = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $pass = filter_var($pass, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z0-9]+$/")));
    
   
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);

$sql="SELECT * FROM user WHERE email='$email' AND password='$pass'";
$result=mysqli_query($conn,$sql);
if (mysqli_num_rows($result) > 0) {
    
    while($row = mysqli_fetch_assoc($result)) {
$_SESSION['userid']=$row['id'];
$userid=$_SESSION['userid'];
header('location: Dashboard/');
}
}
else {
    $error="<div class='alert alert-warning'>Wrong Login Credentials! Please try again</div>";
}

}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login - Health system</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css">
    <link rel="stylesheet" href="assets/css/smoothproducts.css">
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar sticky-top">
        <div class="container"><a class="navbar-brand logo" href="index.php">Health system</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse"
                id="navcol-1">
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item" role="presentation"><a class="nav-link" href="contact-us.php">Contact Us</a></li>
                </ul>
            </div>
        </div>
    </nav><?php if(isset($error)){echo $error; }?>
    <main class="page login-page">
        <section class="clean-block clean-form dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Log In</h2>
                </div>
                <form method="POST" action="">
                    <div class="form-group"><label for="email">Email</label>
                    <input class="form-control item" type="email" id="email" required="" name="email"></div>
                    <div class="form-group"><label for="password">Password</label>
                    <input class="form-control" type="password" id="password" name="password" required=""></div>
                    <div class="form-group">
                    <div class="form-check">Don't have an account?  <a href="registration.php" class="text-primary" for="checkbox">Register</a></div>
                    </div><button class="btn btn-primary btn-block" type="submit" name="submit">Log In</button>
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