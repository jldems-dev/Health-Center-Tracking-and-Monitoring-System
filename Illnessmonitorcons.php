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
                <h1 class="h3 mb-0 text-gray-800">View Patient Consultation</h1>
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
                            <h6 class="m-0 font-weight-bold text-primary">View Form</h6>
                            <button type="button" class="btnPrint btn btn-secondary btn-sm"><i class="fas fa-print"></i> Print</button>
                        </div>
                        <div class="card-body" id="dvContents">
                            <div class="row">
                                <div class="label col-sm-12">
                                    <h3>Health Care Tracking and Monitoring</h3>
                                </div>
                                <div class="col-sm-12">
                                    <hr>
                                </div>
                                <div class="col-sm-12">
                                    <table class="table table-bordered" id="tablepi">
                                        <thead >
                                            <tr>
                                                <th colspan="3" id="pi">Patient Information</th>
                                            </tr>
                                            <tr>
                                                <th id="thprint">Name: <?php echo $rowplm['fname']." ".$rowplm['mname']." ".$rowplm['lname'];?></th>
                                                <th colspan="2" id="thprint">Address: <?php echo $rowplm['address'];?></th>
                                            </tr>
                                            <tr>
                                                <th id="thprint">Birth Day: <?php echo $rowplm['b_date'];?></th>
                                                <th colspan="2" id="thprint">Birth Place: <?php echo $rowplm['b_place'];?></th>
                                            </tr>
                                            <tr>
                                                <th id="thprint">Age: <?php echo $rowplm['age'];?></th>
                                                <th colspan="2" id="thprint">Gender: <?php echo $rowplm['gender'];?></th>
                                            </tr>
                                            <tr>
                                                <th id="thprint">Status: <?php echo $rowplm['status'];?></th>
                                                <th id="thprint">Civil Status: <?php echo $rowplm['cvstatus'];?></th>
                                                <th id="thprint">Blood Type: <?php echo $rowplm['bt'];?></th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="col-sm-12">
                                    <hr>
                                </div>
                                <div class="col-sm-12">
                                    <table class="table table-bordered" id="tablepi">
                                        <thead>
                                            <tr>
                                                <th colspan="4" id="pi">Vital Signs</th>
                                            </tr> 
                                            <tr>
                                                <th id="thprint">Body Temperature: <?php echo $rowplm['temp'];?></th>
                                                <th id="thprint">Pulse rate: <?php echo $rowplm['pr'];?></th>
                                                <th id="thprint">Respiration rate: <?php echo $rowplm['rr'];?></th>
                                                <th id="thprint">Blood Pressure: <?php if(empty($rowplm['bps']) && empty($rowplm['bpd'])){ echo "N/A";}else{ echo $rowplm['bps']."/".$rowplm['bpd'];}?></th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="col-sm-12">
                                    <hr>
                                </div>
                                <div class="col-sm-12">
                                    <table class="table table-bordered" id="tablepi">
                                        <thead>
                                            <tr>
                                                <th colspan="2" id="pi">Measurement</th>
                                            </tr>
                                            <tr>
                                                <th id="thprint">Weight: <?php echo $rowplm['wt'];?></th>
                                                <th id="thprint">Heigth: <?php echo $rowplm['ht'];?></th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="col-sm-12">
                                    <hr>
                                </div>
                                <div class="col-sm-12">
                                    <table class="table table-bordered" id="tablepi">
                                        <thead>
                                            <tr>
                                                <th colspan="2" id="pi">Refferral</th>
                                            </tr>
                                            <tr>
                                                <th id="thprint">Refferred From: <?php echo $rowplm['refferred_from'];?></th>
                                                <th id="thprint">Refferred To: <?php echo $rowplm['refferred_from'];?></th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="col-sm-12">
                                    <hr>
                                </div>
                                <div class="col-sm-12">
                                    <table class="table table-bordered" id="tablepi">
                                        <thead>
                                            <tr>
                                                <th colspan="3" id="pi">Illness Record</th>
                                            </tr>
                                            <tr>
                                                <th id="thprint" colspan="2">Medicine: <?php echo $rowlmp['medicine'];?></th>
                                                <th id="thprint" >Quantity: <?php echo $rowlmp['quantity'];?></th>
                                            </tr>
                                            <tr>
                                                <th id="thprint">Consulted Illness: <?php echo $illnessname;?></th>
                                                <th id="thprint">Consulted Date: <?php echo $rowlmp['consulted_date'];?></th>
                                                <th id="thprint">Next Visit Date: <?php echo $rowlmp['next_visit_date'];?></th>
                                            </tr>
                                            <tr>
                                                <th colspan="3" id="thprint">Concern: <?php echo $rowlmp['concern'];?></th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php 
include "include/script.php"; 
?>