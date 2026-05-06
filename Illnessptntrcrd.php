<?php
include "functions.php";

$patientid = $_GET['patientid'];
$lmpatientid = $_GET['lmpatientid'];
$illnessname = $_GET['illnessname'];
$illnessid = $_GET['illnessid'];

$patient_l_m=mysqli_query($db,"SELECT * FROM patient WHERE id='$patientid'");
$rowplm=mysqli_fetch_assoc($patient_l_m);

$lmpatient=mysqli_query($db,"SELECT * FROM illness_patients WHERE id='$lmpatientid'");
$rowlmp=mysqli_fetch_assoc($lmpatient);
if(isset($_POST['addmedspatient'])){
    addmedspatient($_POST['patientid'],$_POST['illnessid'],$_POST['lmpatientid'],$_POST['illnessname'],$_POST['medicine'],$_POST['quantity'],$_POST['date']);
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
                <h1 class="h3 mb-0 text-gray-800">Add Medicine to Patient</h1>
                <div class="btn-group">
                    <a href="Illnessmonitor.php?illnessid=<?php echo $illnessid;?>&illnessname=<?php echo $illnessname;?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-backspace"></i> Back Illness Monitoring</a>
                </div>
            </div>
            <div class="row">
                <?php
                if(isset($_SESSION['message'])) {
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
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Add Form</h6>
                        </div>
                        <div class="card-body">
                            <form class="user" action="" method="post" enctype="multipart/form-data">
                                <div class="row">   
                                    <div class="col-sm-4">
                                        <label for="" style="font-size: 12px;">Medicine</label>
                                        <div class="form-group">
                                            <select name="medicine" id="medicine" class="form-control" required>
                                                <option value="" selected disabled>Select Medicine</option>
                                                <?php
                                                $medicine=mysqli_query($db,"SELECT * FROM medicine");
                                                while($rowm=mysqli_fetch_assoc($medicine)){
                                                ?>
                                                <option value="<?php echo $rowm['medicine_name']?>"><?php echo $rowm['medicine_name'];?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div> 
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="" style="font-size: 12px;">Quantity</label>
                                        <div class="form-group">
                                            <input type="number" class="form-control" id="quantity" name="quantity" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="" style="font-size: 12px;">Date</label>
                                        <div class="form-group">
                                            <input type="date" class="form-control" id="date" name="date" required>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-sm btn-primary" id="addmedspatient" name="addmedspatient">Add To Pateint</button>
                                <input type="hidden" id="lmpatientid" name="lmpatientid" value="<?php echo $lmpatientid;?>">
                                <input type="hidden" id="patientid" name="patientid" value="<?php echo $patientid;?>">
                                <input type="hidden" id="illnessname" name="illnessname" value="<?php echo $illnessname;?>">
                                <input type="hidden" id="illnessid" name="illnessid" value="<?php echo $illnessid;?>">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php 
include "include/script.php"; 
?>