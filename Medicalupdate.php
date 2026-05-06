<?php
include "functions.php";

$patientmedrecid = $_GET['patientmedrecid'];
$patientid = $_GET['patientid'];

$medrecordpatient = mysqli_query($db, "SELECT * FROM medical_record WHERE id='$patientmedrecid'");
$rowmrp=mysqli_fetch_assoc($medrecordpatient);

if(isset($_POST['updaterecordpatient'])){
    updaterecordpatient($_POST['recordname'], $_POST['date'], $_POST['patientmedrecid'], $_POST['patientid']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Health Center Tracking And Monitoring System</title>

   <?php include "include/link.php";?>

</head>
<body id="page-top">
    <div id="wrapper">
        <?php include "include/navbar.php"; ?>
        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Update Patients Medical Record</h1>
                <a href="Medicaladd.php?patientid=<?php echo $patientid;?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-backspace"></i> Back Medical Records</a>
            </div>
            <div class="row">
                <?php
                if(isset($_SESSION['message'])){
                ?>
                <div class="col-lg-12">
                    <div class="card bg-<?php echo $_SESSION['message']['type'];?> text-white shadow">
                        <div class="card-body">
                            <?php 
                            echo $_SESSION['message']['msg'];
                            unset($_SESSION['message']);
                            ?>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
                <div class="col-lg-12 pt-2">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Update Form</h6>
                        </div>
                        <div class="card-body">
                            <form class="user" action="" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-sm-12">
                                       <label for=""><b>Name</b></label>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="recordname" name="recordname" value="<?php echo $rowmrp['rname'];?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="date" class="form-control" id="date" name="date" value="<?php echo $rowmrp['date'];?>" required>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" id="updaterecordpatient" name="updaterecordpatient" class="btn btn-primary btn-sm">Update Medical Record</button>
                                <input type="hidden" id="patientid" name="patientid" value="<?php echo $patientid;?>">
                                <input type="hidden" id="patientmedrecid" name="patientmedrecid" value="<?php echo $patientmedrecid;?>">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php 
include "include/script.php"; 
?>