<?php
include('../conn.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form inputs
    //$userid=$_SESSION['userid'];

    $id = $_POST['id'];
      // Delete the row with the given id

      $sql0 = mysqli_query($conn,"DELETE FROM patients WHERE id='$id'");
    $sql = mysqli_query($conn,"DELETE FROM meta_data WHERE patients_id='$id'");
      if ($conn->query($sql) === TRUE) {
        //$message=
       // echo"<div class='alert alert-success'>Record deleted successfully</div>";
      } else {
       // $message=
      // echo"<div class='alert alert-warning'>Error deleting record: " . $conn->error."</div>";
      }
    
    header("location: index.php");
}

?>