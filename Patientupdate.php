<?php
include "functions.php";

$patientid= $_GET['patientid'];

$patient=mysqli_query($db,"SELECT * FROM patient WHERE id='$patientid'");
$rowp=mysqli_fetch_assoc($patient);

if(isset($_POST['updatepatient'])){
    updatepatient($_POST['patientid'],$_POST['fname'],$_POST['mname'],$_POST['lname'],
    $_POST['address'],$_POST['bday'],$_POST['bplace'],$_POST['age'],
    $_POST['gender'],$_POST['status'],$_POST['cvstatus'],
    $_POST['bps'],  $_POST['bpd'], $_POST['pr'], $_POST['rr'],$_POST['temp'],$_POST['wt'],$_POST['ht'],$_POST['bt'],$_POST['phonenum']);
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
                <h1 class="h3 mb-0 text-gray-800">Update Patient</h1>
                <a href="Patient.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-backspace"></i> Back Patient</a>
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
                            <h6 class="m-0 font-weight-bold text-primary">Patient Update Form</h6>
                        </div>
                        <div class="card-body">
                            <form class="user" action="" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-sm-12">
                                       <label for=""><b>Patient Information</b></label>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="" Style="font-size: 12px;">First Name</label>
                                            <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $rowp['fname'];?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="" Style="font-size: 12px;">Middle Name</label>
                                            <input type="text" class="form-control" id="mname" name="mname" value="<?php echo $rowp['mname'];?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="" Style="font-size: 12px;">Last Name</label>
                                            <input type="text" class="form-control" id="lname" name="lname" value="<?php echo $rowp['lname'];?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="" Style="font-size: 12px;">Address</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="address" name="address" value="<?php echo $rowp['address'];?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="" Style="font-size: 12px;">Contact</label>
                                        <div class="form-group">
                                            <input type="number" class="form-control" id="phonenum" name="phonenum" value="<?php echo $rowp['phonenum'];?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                       <label for=""><b>Birth</b> </label>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="" Style="font-size: 12px;">Birth Date</label>
                                            <input type="date" class="form-control" id="bday" name="bday" value="<?php echo $rowp['b_date'];?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="" Style="font-size: 12px;">Birth Place</label>
                                            <input type="text" class="form-control" id="bplace" name="bplace" value="<?php echo $rowp['b_place'];?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="" Style="font-size: 12px;">Age</label>
                                            <input type="number" class="form-control" id="age" name="age" value="<?php echo $rowp['age'];?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                       <label for=""><b>Status</b></label>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="" Style="font-size: 12px;">Gender</label>
                                            <select name="gender" id="gender" class="form-control" required>
                                                <option value="<?php echo $rowp['gender'];?>"><?php echo $rowp['gender'];?></option>
                                                <option>Male</option>
                                                <option>Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="" Style="font-size: 12px;">Human Growth Status</label>
                                            <select name="status" id="status" class="form-control">
                                                <option value="<?php echo $rowp['status'];?>"><?php echo $rowp['status'];?></option>
                                                <option>Infancy</option>
                                                <option>Child</option>
                                                <option>Adult</option>
                                                <option>Old</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="" Style="font-size: 12px;">Civil Status</label>
                                            <select name="cvstatus" id="cvstatus" class="form-control">
                                                <option value="<?php echo $rowp['cvstatus'];?>"><?php echo $rowp['cvstatus'];?></option>
                                                <option>Married</option>
                                                <option>Single</option>
                                                <option>Divorced</option>
                                                <option>Widowed</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                       <label for=""><b>Vital Sign</b> </label>
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="" style="font-size: 12px;">Pulse rate</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="pr" name="pr" value="<?php echo $rowp['pr'];?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="" style="font-size: 12px;">Respiration rate</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="rr" name="rr"value="<?php echo $rowp['rr'];?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="" Style="font-size: 12px;">Blood Pressure</label>
                                            <input type="text" class="form-control" id="bps" name="bps" value="<?php echo $rowp['bps'];?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-2 pt-1">
                                        <label for="" style="font-size: 12px;"></label>
                                        <div class="form-group">
                                            <input type="number" class="form-control" id="bpd" name="bpd" value="<?php echo $rowp['bpd'];?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="" Style="font-size: 12px;">Temperature</label>
                                            <input type="text" class="form-control" id="temp" name="temp" value="<?php echo $rowp['temp'];?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                       <label for=""><b>Patient Messurement</b> </label>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="" Style="font-size: 12px;">Weight</label>
                                            <input type="text" class="form-control" id="wt" name="wt" value="<?php echo $rowp['wt'];?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="" Style="font-size: 12px;">Height</label>
                                            <input type="text" class="form-control" id="ht" name="ht" value="<?php echo $rowp['ht'];?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="" style="font-size: 12px;">Blood Group</label>
                                        <div class="form-group">
                                            <select name="bt" id="bt" class="form-control">
                                                <option value="<?php echo $rowp['bt'];?>"><?php echo $rowp['bt'];?></option>
                                                <option>A+</option>
                                                <option>O+</option>
                                                <option>B+</option>
                                                <option>AB+</option>
                                                <option>A</option>
                                                <option>O</option>
                                                <option>B</option>
                                                <option>AB</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" id="updatepatient" name="updatepatient" class="btn btn-primary btn-sm"><i class="fas fa-external-link-alt"></i> Update Patient</button>
                                <input type="hidden" id="patientid" name="patientid" value="<?php echo $patientid;?>">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php 
include "include/script.php"; 
?>