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
                <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-print"></i> Print Report</h1>
            </div>
            <div class="row">
                <div class="col-lg-12 pt-2">
                    <div class="card shadow mb-4">
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-th-list"></i> Report List</h6>
                        </div>
                        <div class="card-body">
                           <div class="row">
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <a href="Printpatients.php">
                                        <div class="card shadow h-100">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col-6 mr-5">
                                                        <div class="text-xs font-weight-bold text-primary text-uppercase">Patient Report</div>
                                                    </div>
                                                    <div class="col-3">
                                                        <img src="img/report.png" alt="" width="32px">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <a href="Printillness.php">
                                        <div class="card shadow h-100">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col-6 mr-5">
                                                        <div class="text-xs font-weight-bold text-primary text-uppercase">Illness Patient Report</div>
                                                    </div>
                                                    <div class="col-3">
                                                        <img src="img/report.png" alt="" width="32px">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <a href="Printimmunize.php">
                                        <div class="card shadow h-100">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col-6 mr-5">
                                                        <div class="text-xs font-weight-bold text-primary text-uppercase">Immunize Patient Report</div>
                                                    </div>
                                                    <div class="col-3">
                                                        <img src="img/report.png" alt="" width="32px">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <a href="Printprenatal.php">
                                        <div class="card shadow h-100">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col-6 mr-5">
                                                        <div class="text-xs font-weight-bold text-primary text-uppercase">Prenatal Patient Report</div>
                                                    </div>
                                                    <div class="col-3">
                                                        <img src="img/report.png" alt="" width="32px">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <a href="printbloodpressure.php">
                                        <div class="card shadow h-100">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col-6 mr-5">
                                                        <div class=" text-xs font-weight-bold text-primary text-uppercase">Blood Pressure Report</div>
                                                    </div>
                                                    <div class="col-3">
                                                        <img src="img/report.png" alt="" width="32px">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
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