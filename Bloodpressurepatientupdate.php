<?php
include "functions.php";
$patientid = $_GET['patientid'];
$patientbp=mysqli_query($db,"SELECT * FROM patient WHERE id='$patientid'");
$rowpbp = mysqli_fetch_assoc($patientbp);

if(isset($_POST['updatebpp'])){

    updatebpp($_POST['patientid'], $_POST['bps'], $_POST['bpd']);
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
                <h1 class="h3 mb-0 text-gray-800">Update Patient Blood Pressure</h1>
                <a href="Bloodpressure.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-backspace"></i> Back Blood Pressure</a>
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
                            <h6 class="m-0 font-weight-bold text-primary">Patient Blood Pressure Update Form</h6>
                        </div>
                        <div class="card-body">
                            <form class="user" action="" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="" ><b>Blood Pressure</b></label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="" Style="font-size: 12px;">Systolic</label>
                                            <input type="text" class="form-control" id="bps" name="bps" value="<?php echo $rowpbp['bps'];?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="" style="font-size: 12px;">Diastolic</label>
                                        <div class="form-group">
                                            <input type="number" class="form-control" id="bpd" name="bpd" value="<?php echo $rowpbp['bpd'];?>">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" id="updatebpp" name="updatebpp" class="btn btn-primary btn-sm"><i class="fas fa-external-link-alt"></i> Update Patient Blood Pressure</button>
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