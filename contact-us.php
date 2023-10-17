<?php

if(isset($_POST['submit'])){
    $to = "ngengeetienne@gmail.com";
    $subject = $_POST['subject'];
    $headers = "From: " . $_POST['email'];
    $message = "Name: " . $_POST['name'] . "\r\nEmail: " . $_POST['email'] . "\r\nMessage: " . $_POST['message'];
    $sent = mail($to, $subject, $message, $headers);  
    if($sent) {
      $message="<div class='alert alert-success'>Your message has been sent successfully</div>";
    } else {
        $message="<div class='alert alert-warning'>Unable to send email. Please try again</div>";
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Contact Us - Brand</title>
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
            
        </div>
    </nav><?php if(isset($message)){echo $message;}?>
    <main class="page contact-us-page">
        <section class="clean-block clean-form dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Contact Us</h2>
                    <p>HOW CAN WE HELP YOU?</p>
                </div>
                <form method="POST" action="">
                    <div class="form-group"><label>Name</label><input class="form-control" type="text" name="name" required></div>
                    <div class="form-group"><label>Subject</label><input class="form-control" type="text" name="subject" required></div>
                    <div class="form-group"><label>Email</label><input class="form-control" type="email" name="email" required></div>
                    <div class="form-group"><label>Message</label><textarea class="form-control" name="message" required></textarea></div>
                    <div class="form-group"><button class="btn btn-primary btn-block" type="submit" name="submit">Send</button></div>
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