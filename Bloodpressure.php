<?php
include "functions.php";
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
                <h1 class="h3 mb-0 text-gray-800"><img src="img/bp.png" alt="" width="24px"> Blood Pressure Monitoring</h1>
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
                <div class="col-lg-4 pt-2">
                <div class="card shadow mb-4">
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-chart-area"></i> Blood Pressure Chart</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered">
                                    <thead>
                                        <tr class="bg-secondary text-dark">
                                            <th>Blood Pressure</th>
                                            <th>Systolic</th>
                                            <th>Diastolic</th>
                                        </tr>
                                        <tr class="bg-secondary text-dark">
                                            <th>Category</th>
                                            <th>Upper Number</th>
                                            <th>Lower Number</th>
                                        </tr>
                                        <tr class="bg-primary text-dark">
                                            <th>Normal</th>
                                            <th>Less Than 120</th>
                                            <th>Less Than 80</th>
                                        </tr>
                                        <tr class="bg-success text-dark">
                                            <th>Elevated</th>
                                            <th>120-129</th>
                                            <th>Less Than 80</th>
                                        </tr>
                                        <tr class="bg-info text-dark">
                                            <th>High Blood Pressure (lvl 1)</th>
                                            <th>130-139</th>
                                            <th>80-89</th>
                                        </tr>
                                        <tr class="bg-warning text-dark">
                                            <th>High Blood Pressure (lvl 2)</th>
                                            <th>140 or Higher</th>
                                            <th>90 or Higher</th>
                                        </tr>
                                        <tr class="bg-danger text-dark">
                                            <th>Hypertensive Crisis</th>
                                            <th>Higher Than 180</th>
                                            <th>Higher Than 120</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 pt-2 p-0">
                    <div class="card shadow mb-4">
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-table"></i> Patient List</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <th>#</th>
                                        <th>Patient Name</th>
                                        <th>Status</th>
                                        <th>Blood Pressure</th>
                                        <th>Blood Pressure Status</th>
                                        <th>Patient Blood Pressure Record</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $num=1;
                                        $patientlist=mysqli_query($db,"SELECT * FROM patient WHERE status='Adult' OR status='Senior Citizen'");
                                        while($rowplist=mysqli_fetch_assoc($patientlist)){
                                        ?>
                                        <tr>
                                            <td><?php echo $num++;?></td>
                                            <td><?php echo $rowplist['fname']." ".$rowplist['mname']." ".$rowplist['lname'];?></td>
                                            <td><?php echo $rowplist['status'];?></td>
                                            <td><?php echo $rowplist['bps']."/".$rowplist['bpd']; ?></td>
                                            <td>
                                                <?php
                                                if($rowplist['bps'] < 120 && $rowplist['bpd'] < 80){
                                                    echo "<p class='bg-primary text-dark badge'>Normal</p>";
                                                }else if($rowplist['bps'] >= 119 && $rowplist['bpd'] < 81){
                                                    echo "<p class='bg-success text-dark badge'>Elevated</p>";
                                                }else if($rowplist['bps'] >= 129 && $rowplist['bps'] < 139 && $rowplist['bpd'] > 80 && $rowplist['bpd'] < 89){
                                                    echo "<p class='bg-info text-dark badge'>High Blood Pressure LVL 1</p>";
                                                }else if($rowplist['bps'] > 140 && $rowplist['bps'] < 179 && $rowplist['bpd'] > 90 && $rowplist['bpd'] < 119){
                                                    echo "<p class='bg-warning text-dark badge'>High Blood Pressure LVL 2</p>";
                                                }else if($rowplist['bps'] > 180 && $rowplist['bpd'] > 120){
                                                    echo "<p class='bg-danger text-dark badge'>Hypertensive Crisis</p>";
                                                }
                                                ?>
                                            </td>
                                            <td> <a class="btn btn-sm btn-primary" href="Bloodpressurepatientrecord.php?patientid=<?php echo $rowplist['id'];?>"><i class="fas fa-address-card"></i></a></td>
                                            <td><a class="btn btn-sm btn-secondary" href="Bloodpressurepatientupdate.php?patientid=<?php echo $rowplist['id'];?>">Update</a></td>
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