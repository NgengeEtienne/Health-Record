<?php
include('../conn.php');
session_start();
if(!isset($_SESSION['userid'])){
    header('location: ../login.php');
}
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

<body style="margin-left:30px; margin-left:30px">
    <nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar sticky-top">
        <div class="container"><a class="navbar-brand logo" href="../">Health system</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse"
                id="navcol-1">
                <ul class="nav navbar-nav ml-auto">
                <li class="nav-item" role="presentation"><a class="nav-link" href="../contact-us.php">Contact Us</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" href="../logout.php">logout</a></li>                </ul>
            </div>
        </div>
    </nav>
    <section style="margin: 10px;margin-right: 10px;margin-left: 10px;margin-top: 10px;margin-bottom: 10px;">
        <p style="margin-right: 100px;"  class="d-flex justify-content-center"><span class="pull-right"><a href="add.php" class="btn btn-primary btn-lg" type="button" style="background-color: rgb(45,193,77);">Add Patient</a><a class="btn btn-outline-primary btn-lg" role="button" data-aos="fade-right" href="index.php">Dashboard</a></span></p>
        <div>
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active" role="tab" data-toggle="tab" href="#tab-1">Personal Infomation</a></li>
                <li class="nav-item"><a class="nav-link" role="tab" data-toggle="tab" href="#tab-2">Medical Diagnosis</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" role="tabpanel" id="tab-1">
                    <div class="table-responsive table-bordered">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center" colspan="2">Id Details</th>
                                </tr>
                            </thead>
                            <tbody><?php
                            
                            $id=$_SESSION["userid"];
                            $sql="SELECT * FROM patients WHERE medical_personnel='$id'";
                    $result=mysqli_query($conn,$sql);
                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        function calculateAge($dob) {
                            $dob = new DateTime($dob);
                            $now = new DateTime();
                            $interval = $now->diff($dob);
                            return $interval->y;
                          }
                          $age = calculateAge($row["date_of_birth"]);

                            echo'
                                <tr>
                                    <td>Name:&nbsp;<span>'. $row["name"].'</span></td>
                                    <td>Gender:&nbsp;<span>'. $row["gender"].'</span></td>
                                </tr>
                                <tr>
                                    <td>Date of Birth:&nbsp;<span>'. $row["date_of_birth"].'</span></td>
                                    <td>Age:&nbsp;<span>'. $age.'</span></td>
                                </tr>
                                <tr>
                                    <td>Contact:&nbsp;<span>'. $row["phone_number"].'</span></td>
                                    <td>Address:&nbsp;<span>'. $row["address"].'</span></td>
                                </tr>';?>
                                <tr></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" role="tabpanel" id="tab-2">
                    <section>
                        <p>Medical Diagnosis</p>
                        <div class="table-responsive table-bordered">
                            <table class="table table-striped table-bordered">
                                <tbody><?php
                                $pid=$row["id"];
                               // echo $pid;
                                $sql2="SELECT * FROM meta_data WHERE patients_id='$pid'";
                                $result2=mysqli_query($conn,$sql2);
                                if (mysqli_num_rows($result) > 0) {
                                    $row = mysqli_fetch_assoc($result2);
                                    
                                        echo'
                                    <tr>
                                        <td>Temperature:&nbsp;<span style="color: rgb(31,128,224);">'. $row["temperature"].'</span></td>
                                        <td>pulse rate:&nbsp;<span style="color: rgb(31,128,224);">'. $row["pulse_rate"].'</span></td>
                                    </tr>
                                    <tr>
                                        <td>respiratory rate:&nbsp;<span style="color: rgb(31,128,224);">'. $row["respiratory_rate"].'</span></td>
                                        <td>blood pressure:&nbsp;<span style="color: rgb(31,128,224);">'. $row["blood_pressure"].'</span></td>
                                    </tr>
                                    <tr>
                                        <td>oxygen saturation:&nbsp;<span style="color: rgb(31,128,224);">'. $row["oxygen_saturation"].'</span></td>
                                        <td>illness:&nbsp;<span style="color: rgb(31,128,224);">'. $row["illness"].'</span></td>
                                    </tr>
                                    <tr>
                                        <td>surgery:&nbsp;<span style="color: rgb(31,128,224);">'. $row["surgery"].'</span></td>
                                        <td>medication:&nbsp;<span style="color: rgb(31,128,224);">'. $row["medication"].'</span></td>
                                    </tr>
                                    <tr>
                                        <td>hospital:&nbsp;<span style="color: rgb(31,128,224);">'. $row["hospital"].'</span></td>
                                        <td>Allergies:&nbsp;<span style="color: rgb(31,128,224);">'. $row["allergy"].'</span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">lab results:&nbsp;<span style="color: rgb(31,128,224);"><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">View</button></span></td>
                                    </tr>
                                </tbody>
                            </table>
                            
                            <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title">Lab Results</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <p><img src="'.$row["lab_results"].'" class="img" alt="Lab result"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- end Modal-->'; }} ?>

                        </div>
                    </section>
                </div>
            </div>
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

</html>