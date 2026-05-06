<?php
include "functions.php";

$patientid= $_GET['patientid'];
$status= $_GET['status'];

$str = substr($status, 0, strpos($status, '.'));

$patient=mysqli_query($db,"SELECT * FROM patient WHERE id='$patientid'");
$rowp=mysqli_fetch_assoc($patient);
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
            <div class="d-sm-flex align-items-center justify-content-between mb-3" >
                <h1 class="h3 mb-0 text-gray-800 hide"><i class="fas fa-address-card"></i> Patient Information</h1>
                <div id="hide">
                    <a href="<?php echo $status;?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-backspace"></i> Back <?php echo $str;?></a>
                </div>
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
                        <div class="card-header py-3 hide">
                            <div class="d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary"> View Form</h6>
                                <button type="button" class="btnPrint btn btn-secondary btn-sm" value="Print"><i class="fas fa-print"></i> Print</button>
                            </div>
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
                                        <thead>
                                            <tr>
                                                <th colspan="3" id="pi">Patient Information</th>
                                            </tr>
                                            <tr>
                                                <th id="thprint">Name: <?php echo $rowp['fname']." ".$rowp['mname']." ".$rowp['lname'];?></th>
                                                <th colspan="2" id="thprint">Address: <?php echo $rowp['address'];?></th>
                                            </tr>
                                            <tr>
                                                <th id="thprint">Phone Number: <?php echo $rowp['phonenum'];?></th>
                                                <th id="thprint">Birth Day: <?php echo $rowp['b_date'];?></th>
                                                <th colspan="2" id="thprint">Birth Place: <?php echo $rowp['b_place'];?></th>
                                            </tr>
                                            <tr>
                                                <th id="thprint">Age: <?php echo $rowp['age'];?></th>
                                                <th colspan="2" id="thprint">Gender: <?php echo $rowp['gender'];?></th>
                                            </tr>
                                            <tr>
                                                <th id="thprint">Status: <?php echo $rowp['status'];?></th>
                                                <th id="thprint">Civil Status: <?php echo $rowp['cvstatus'];?></th>
                                                <th id="thprint">Blood Type: <?php echo $rowp['bt'];?></th>
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
                                                <th id="thprint">Body Temperature: 
                                                    <?php 
                                                    if(empty($rowp['bp'])){ 
                                                        echo "N/A"; 
                                                    }else{ 
                                                        echo $rowp['bp'];
                                                        }
                                                    ?>
                                                </th>
                                                <th id="thprint">Pulse rate: <?php if(empty($rowp['pr'])){ echo "N/A"; }else{echo $rowp['pr'];}?></th>
                                                <th id="thprint">Respiration rate: <?php if(empty($rowp['rr'])){ echo "N/A"; }else{echo $rowp['rr'];}?></th>
                                                <th id="thprint">Blood Pressure: <?php if(empty($rowp['bps']) && empty($rowp['bpd'])){ echo "N/A"; }else{echo $rowp['bps']."/".$rowp['bpd'];}?></th>
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
                                                <th id="thprint">Weight: <?php echo $rowp['wt'];?></th>
                                                <th id="thprint">Heigth: <?php echo $rowp['ht'];?></th>
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
                                                <th id="thprint">Refferred From: <?php if(empty($rowp['refferred_from'])){ echo "N/A"; }else{echo $rowp['refferred_from'];}?></th>
                                                <th id="thprint">Refferred To: <?php  if(empty($rowp['refferred_to'])){ echo "N/A"; }else{echo $rowp['refferred_to'];}?></th>
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