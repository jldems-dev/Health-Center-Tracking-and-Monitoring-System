<?php
include "functions.php";
$patientid = $_GET['patientid'];
$prenatalid = $_GET['prenatalid'];
$prenatalpatientid = $_GET['prenatalpatientid'];

$ipinfo = mysqli_query($db, "SELECT * FROM prenatal_patients WHERE id='$prenatalpatientid'");
$rowipinfo = mysqli_fetch_assoc($ipinfo);

if(isset($_POST['updatepsprenatal'])){
    updatepsprenatal($_POST['patientid'],$_POST['prenatalid'],$_POST['prenatalpatientid'],$_POST['statusv'],$_POST['quarter'],$_POST['concern'], $_POST['datev']);
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
                <h1 class="h3 mb-0 text-gray-800">Update Patient Immunize Status</h1>
                <div class="btn-group">
                    <a href="Prenatalpatients.php?prenatalid=<?php echo $prenatalid;?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-backspace"></i> Back Prenatal Monitoring</a>
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
                                    <div class="col-sm-3">
                                        <label for="" style="font-size: 12px;">Status Visit</label>
                                        <div class="form-group">
                                            <select name="statusv" id="statusv" class="form-control">
                                                <option value="<?php echo $rowipinfo['status_visit']; ?>"><?php echo $rowipinfo['status_visit'];?></option>
                                                <option>1st</option>
                                                <option>2nd</option>
                                                <option>3rd</option>
                                                <option>4th</option>
                                                <option>5th</option>
                                                <option>Done</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="" style="font-size: 12px;">Quarter</label>
                                        <div class="form-group">
                                            <select name="quarter" id="quarter" class="form-control">
                                                <option value="<?php echo $rowipinfo['quarter'];?>"><?php echo $rowipinfo['quarter'];?></option>
                                                <option>1st</option>
                                                <option>2nd</option>
                                                <option>3rd</option>
                                                <option>4th</option>
                                                <option>5th</option>
                                                <option>Done</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="" style="font-size: 12px;">Date Visit</label>
                                        <div class="form-group">
                                           <input type="date" id="datev" name="datev" class="form-control" value="<?php echo $rowipinfo['date_visit'];?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="" style="font-size: 12px;">Concern</label>
                                        <div class="form-group">
                                           <textarea class="form-control" name="concern" id="concern" maxlength="499"><?php echo $rowipinfo['concern'];?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" id="updatepsprenatal" name="updatepsprenatal" class="btn btn-primary btn-sm"><i class="fas fa-external-link-alt"></i> Update Patient Status</button>
                                <input type="hidden" id="prenatalid" name="prenatalid" value="<?php echo $prenatalid;?>">
                                <input type="hidden" id="patientid" name="patientid" value="<?php echo $patientid;?>">
                                <input type="hidden" id="prenatalpatientid" name="prenatalpatientid" value="<?php echo $prenatalpatientid;?>">
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php 
include "include/script.php"; 
?>