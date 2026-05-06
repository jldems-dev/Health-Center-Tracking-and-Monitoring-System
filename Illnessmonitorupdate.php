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

if(isset($_POST['updatecondition'])){
    updatecondition($_POST['lmpatientids'], $_POST['condition'],$_POST['patientids'],$_POST['cdate'],$_POST['nvdate'],$_POST['illnessname'],$_POST['illnessid'],$_POST['concern'],$_POST['medicine'],$_POST['quantity']);
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
                <h1 class="h3 mb-0 text-gray-800">Update Condition Of Patient</h1>
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
                            <h6 class="m-0 font-weight-bold text-primary">Update Form</h6>
                        </div>
                        <div class="card-body">
                            <form class="user" action="" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label for=""><b>Patient Condition Information</b></label>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="" Style="font-size: 12px;">Consulted Date</label>
                                            <input type="date" id="cdate" name="cdate" class="form-control" value="<?php echo $rowlmp['consulted_date'];?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="" Style="font-size: 12px;">Next Visit Date</label>
                                            <input type="date" class="form-control" id="nvdate" name="nvdate" value="<?php echo $rowlmp['next_visit_date'];?>" required> 
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="" Style="font-size: 12px;">Status Treatment</label>
                                            <select name="condition" id="condition" class="form-control">
                                                <option value="<?php echo $rowlmp['conditions'];?>"><?php echo $rowlmp['conditions'];?></option>
                                                <option>Treatment</option>
                                                <option>Cured</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="" Style="font-size: 12px;">Medicine</label>
                                            <input type="text" class="form-control" id="medicine" name="medicine" value="<?php echo $rowlmp['medicine'];?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="" Style="font-size: 12px;">Quantity</label>
                                           <input type="text" class="form-control" id="quantity" name="quantity" value="<?php echo $rowlmp['quantity'];?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="" Style="font-size: 12px;">Concern</label>
                                            <textarea class="form-control" name="concern" id="concern"><?php echo $rowlmp['concern'];?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" id="updatecondition" name="updatecondition" class="btn btn-primary btn-sm"><i class="fas fa-external-link-alt"></i> Update Condition</button>
                                <input type="hidden" id="lmpatientids" name="lmpatientids" value="<?php echo $lmpatientid;?>">
                                <input type="hidden" id="patientids" name="patientids" value="<?php echo $patientid;?>">
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