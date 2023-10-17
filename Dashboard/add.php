<?php
session_start();
include'../conn.php';

if(!isset($_SESSION['userid'])){
      header('location: ../login.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form inputs
    $userid=$_SESSION['userid'];

    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $gender = filter_var($_POST['gender'], FILTER_SANITIZE_STRING);
    $dob = filter_var($_POST['dob'], FILTER_SANITIZE_STRING);
    $contact = filter_var($_POST['contact'], FILTER_SANITIZE_STRING);
    $address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
    $temp = filter_var($_POST['temp'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $pulse = filter_var($_POST['pulse'], FILTER_SANITIZE_NUMBER_INT);
    $resp = filter_var($_POST['resp'], FILTER_SANITIZE_NUMBER_INT);
    $blood = filter_var($_POST['blood'], FILTER_SANITIZE_STRING);
    $oxygen = filter_var($_POST['oxygen'], FILTER_SANITIZE_NUMBER_INT);
    $illness = filter_var($_POST['illness'], FILTER_SANITIZE_STRING);
    $surgery = filter_var($_POST['surgery'], FILTER_SANITIZE_STRING);
    $medication = filter_var($_POST['medication'], FILTER_SANITIZE_STRING);
    $allergies = filter_var($_POST['allergies'], FILTER_SANITIZE_STRING);
    $hospital = filter_var($_POST['hospital'], FILTER_SANITIZE_STRING);
    $fil=$_FILES['labs'];


$image = $_FILES['labs']['name'];
$target = "images/".basename($image);

function uploadPicture($file,$image) {
    if (move_uploaded_file($file['tmp_name'], $image)) {
        
    }else{
       
          }}
uploadPicture($fil,$target);
    
    function calculateAge($dob) {
        $dob = new DateTime($dob);
        $now = new DateTime();
        $interval = $now->diff($dob);
        return $interval->y;
      }
      $age = calculateAge($dob);
      
// // Echo the variables
// echo "User ID: " . $userid . "<br>";
// echo "Name: " . $name . "<br>";
// echo "Gender: " . $gender . "<br>";
// echo "Date of Birth: " . $dob . "<br>";
// echo "Contact: " . $contact . "<br>";
// echo "Address: " . $address . "<br>";
// echo "Temperature: " . $temp . "<br>";
// echo "Pulse rate: " . $pulse . "<br>";
// echo "Respiratory rate: " . $resp . "<br>";
// echo "Blood pressure: " . $blood . "<br>";
// echo "Oxygen saturation: " . $oxygen . "<br>";
// echo "Illness: " . $illness . "<br>";
// echo "Surgery: " . $surgery . "<br>";
// echo "Medication: " . $medication . "<br>";
// echo "Allergies: " . $allergies . "<br>";
// echo "Hospital: " . $hospital . "<br>";

// echo "age:".$age."<br/>";

    $sql = "INSERT INTO patients (name, gender, date_of_birth,phone_number, address,medical_personnel,age) VALUES ('$name', '$gender', '$dob', '$contact', '$address','$userid','$age')";

if ($conn->query($sql) === TRUE) {
$message='<div class="alert alert-success">New record created successfully</div>';
} else {
    $message='<div class="alert alert-success">Error adding Patient</div>';

}
// Select the patient id from the patients table
$sql = "SELECT id FROM patients WHERE name = '$name' AND age = '$age'";
$result = mysqli_query($conn, $sql);

// Fetch the patient id from the result set
if ($row = mysqli_fetch_assoc($result)) {
    $id = $row['id'];
    echo $id;
    
    // Insert the remaining data into meta_data table
    $sql = "INSERT INTO meta_data (patients_id, illness, surgery, medication, hospital, temperature, pulse_rate, respiratory_rate, blood_pressure, oxygen_saturation, allergy, lab_results) VALUES ('$id', '$illness', '$surgery', '$medication', '$hospital', '$temp', '$pulse', '$resp', '$blood', '$oxygen', '$allergies','$target')";
    
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error inserting data into meta_data table: " . $conn->error;
    }
} else {
    echo "No patient found with the given name and age";
}

$conn->close();
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
    </nav><?php if(isset($message)){ echo $message;}?>
    <section style="margin: 10px;margin-right: 10px;margin-left: 10px;margin-top: 10px;margin-bottom: 10px;">
        <p style="margin-right: 100px;"><span>Enter Patients Information</span><span class="text-primary d-flex justify-content-center"><a href="view.php" class="btn btn-primary btn-lg" type="button">View Patient</a><a class="btn btn-outline-primary btn-lg" role="button" data-aos="fade-right" href="index.php">Dashboard</a></span></p>
        <div>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
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
          <tbody>
            <tr>
              <td>Name:&nbsp;<input type="text" name="name" required></td>
              <td>Gender:&nbsp;<select name="gender" required><option value="male">Male</option><option value="female">Female</option></select></td>
            </tr>
            <tr>
              <td>Date of Birth:&nbsp;<input type="date" name="dob" required></td>
            </tr>
            <tr>
              <td>Contact:&nbsp;<input type="tel" name="contact" required></td>
              <td>Address:&nbsp;<input type="text" name="address" required></td>
            </tr>
            <caption class="text-primary d-flex"><a class="nav-link btn btn-primary" role="tab" data-toggle="tab" href="#tab-2" style="width: 88px;">Next</a></caption>

          </tbody>
        </table>
      </div>
    </div>
    <div class="tab-pane" role="tabpanel" id="tab-2">
      <section>
        <p>Medical Diagnosis</p>
        <div class="table-responsive table-bordered">
          <table class="table table-striped table-bordered">
            <tbody>
              <tr>
                <td>Temperature:&nbsp;<input type="number" name="temp" required></td>
                <td>Pulse rate:&nbsp;<input type="number" name="pulse" required></td>
              </tr>
              <tr>
                <td>Respiratory rate:&nbsp;<input type="number" name="resp" required></td>
                <td>Blood pressure:&nbsp;<input type="number" name="blood" required></td>
              </tr>
              <tr>
                <td>Oxygen saturation:&nbsp;<input type="number"name="oxygen" required></td>
                <td>Illness:&nbsp;<textarea name="illness" required></textarea></td>
              </tr>
              <tr>
                <td>Surgery:&nbsp;<input type="text" name="surgery" required></td>
                <td>Medication:&nbsp;<textarea name="medication" required></textarea></td>
              </tr>
              <tr>
                <td>Hospital:&nbsp;<input type="text" name="hospital" required></td>
                <td>Allergies:&nbsp;<input type="text" name="allergies" required></td>
              </tr>
              <tr>
                <td>Lab results:&nbsp;<input type="file" name="labs" required></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="d-flex justify-content-center"><a class="nav-link btn btn-primary" role="tab" data-toggle="tab" href="#tab-1" style="width: 88px; margin-right:30px;">Previous</a><span class="d-flex justify-content-center"><button class="btn btn-success pull-right" type="submit" style="width: 88px;">Save</button></span></div>
      </section>
    </div>
  </div>
</form>
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