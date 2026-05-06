<?php
include "functions.php";

$apptnmnt = $_GET['apptnmntid'];

if(isset($_POST['deletepselected'])){
    deletepselected($_POST['pselectedid'],$_POST['apptnmntid']);
}
if(isset($_POST['selectappaptients'])){
    selectappaptients($_POST['apptnmntid'],$_POST['patientid']);
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
        <div class="container-fluid pr-5">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Appointment Patients</h1>
                <a href="Appointment.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-backspace"></i> Back Appointment</a>
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
                <div class="col-lg-6 pt-2">
                    <div class="card shadow mb-4">
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-check-square"></i> Select Patients</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <th>Patients Name</th>
                                        <th>Select</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $selectpatients=mysqli_query($db,"SELECT * FROM patient");
                                        while($rowsp=mysqli_fetch_assoc($selectpatients)){
                                        ?>
                                        <tr>
                                            <td><?php echo $rowsp['fname'].' '.$rowsp['mname'].' '.$rowsp['lname']; ?></td>
                                            <td>
                                                <?php
                                                $apptients=mysqli_query($db,"SELECT * FROM appntmnt_patients WHERE patientid='".$rowsp['id']."' AND apptmntid='$apptnmnt'");
                                                $rowapp=mysqli_fetch_array($apptients);

                                                    if(mysqli_num_rows($apptients)  > 0){
                                                ?>
                                                    <button type="submit" id="selectappaptients" name="selectappaptients" class="btn btn-sm btn-primary" disabled><i class="fas fa-angle-double-right"></i></button>
                                                <?php
                                                    }else{
                                                ?>
                                                <form  action="" method="post" enctype="multipart/form-data">
                                                    <button type="submit" id="selectappaptients" name="selectappaptients" class="btn btn-sm btn-primary"><i class="fas fa-angle-double-right"></i></button>
                                                    <input type="hidden" id="apptnmntid" name="apptnmntid" value="<?php echo $apptnmnt;?>">
                                                    <input type="hidden" id="patientid" name="patientid" value="<?php echo $rowsp['id'];?>">
                                                </form>
                                                <?php
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 pt-2">
                    <div class="card shadow mb-4">
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Patient Selected for Appointments</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <th>#</th>
                                        <th>Patient Name</th>
                                        <th>Patient Full Information</th>
                                        <th>Remove</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $num=1;
                                        $apptients=mysqli_query($db,"SELECT * FROM appntmnt_patients WHERE apptmntid='$apptnmnt'");
                                        while($rowapp=mysqli_fetch_assoc($apptients)){

                                            $patientname=mysqli_query($db, "SELECT * FROM patient WHERE id='".$rowapp['patientid']."'");
                                            $rowht=mysqli_fetch_assoc($patientname);
                                        ?>
                                        <tr>
                                            <td><?php echo $num++;?></td>
                                            <td><?php if(mysqli_num_rows($patientname) > 0){ echo $rowht['fname'].' '.$rowht['mname'].' '.$rowht['lname']; }?></td>
                                            <form action="" method="post" enctype="multipart/form-data">
                                                <td>
                                                    <a class="btn btn-sm btn-primary" href="Patientinfo.php?patientid=<?php echo $rowht['id'];?>&status=<?php echo "Appointment.php";?>"><i class="fas fa-address-card"></i></a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-danger" id="deletepselected" name="deletepselected"><i class="fas fa-times-circle"></i></button>
                                                    <input type="hidden" id="pselectedid" name="pselectedid" value="<?php echo $rowapp['id'];?>">
                                                    <input type="hidden" id="apptnmntid" name="apptnmntid" value="<?php echo $apptnmnt;?>">
                                                </td>
                                            </form>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php 
include "include/script.php"; 
?>