<?php
include('../conn.php');
session_start();
if(!isset($_SESSION['userid'])){
    header('location: ../login.php');
} 
else{
    
    

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Health system</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css">
    <link rel="stylesheet" href="../assets/css/smoothproducts.css">
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar sticky-top">
        <div class="container"><a class="navbar-brand logo" href="../">Health system</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse"
                id="navcol-1">
                <ul class="nav navbar-nav ml-auto">
                <li class="nav-item" role="presentation"><a class="nav-link" href="../contact-us.php">Contact Us</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" href="../logout.php">logout</a></li>
                </ul>
            </div>
        </div>
    </nav><?php if(isset($message)){echo $message;} ?>
    <section style="margin: 10px;margin-right: 10px;margin-left: 10px;margin-top: 10px;margin-bottom: 10px;">
        <p style="margin-right: 100px;"><span>Patients you have added</span><a href="add.php" class="btn btn-primary pull-right" type="button" style="background-color: rgb(45,193,77);">Add Patient</a></p>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Name</th>
                        <th>Date of Birth</th>
                        <th>Gender</th>
                        <th>Contact</th>
                        <th>View</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $id=$_SESSION["userid"];
                    $sql="SELECT * FROM patients WHERE medical_personnel='$id'";
                    $result=mysqli_query($conn,$sql);
                    if (mysqli_num_rows($result) > 0) {
                        $i=1;
                        while($row = mysqli_fetch_assoc($result)) {
                            
                            echo'
                    <tr>
                        <td>'.$i.'</td>
                        <td>'. $row["name"].'</td>
                        <td>'. $row["date_of_birth"].'</td>
                        <td>'. $row["gender"].'</td>
                        <td>'. $row["phone_number"].'</td>
                        <td><a href="view.php" class="btn btn-primary" type="button" style="width: 72.25px;">View</a></td>
                        <td>
                        <form method="POST" action="del.php">
                        <input type="hidden" name="id" value="'.$row['id'].'">
                        <button class="btn btn-primary" type="submit" style="background-color: rgb(222,63,53);">Delete</button>
                        </form>
                        </td>
                    </tr>';
                $i=$i+1;
            }}
                    ?>
                </tbody>
            </table>
        </div>
    </section>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
    <script src="../assets/js/smoothproducts.min.js"></script>
    <script src="../assets/js/theme.js"></script>
</body>
        <?php } ?>
</html>