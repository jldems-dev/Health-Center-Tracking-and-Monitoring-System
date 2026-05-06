<?php
include "functions.php";

$patienttt= mysqli_query($db, "SELECT * FROM patient");
$rowptt=mysqli_num_rows($patienttt);

$illnesstt = mysqli_query($db, "SELECT * FROM illness");
$rowitt=mysqli_num_rows($illnesstt);

$illnessptt=mysqli_query($db,"SELECT * FROM illness_patients");
$rowillptt=mysqli_num_rows($illnessptt);

$immunizett=mysqli_query($db, "SELECT * FROM immunization");
$rowimtt=mysqli_num_rows($immunizett);
$immunizeptt=mysqli_query($db, "SELECT * FROM immunize_patients");
$rowpimtt=mysqli_num_rows($immunizeptt);

$prenataltt=mysqli_query($db,"SELECT * FROM prenatal");
$rowpltt=mysqli_num_rows($prenataltt);

$prenatalptt=mysqli_query($db, "SELECT * FROM prenatal_patients");
$rowptltt=mysqli_num_rows($prenatalptt);

$appointmenttt=mysqli_query($db, "SELECT * FROM appointment");
$rowapptt=mysqli_num_rows($appointmenttt);
$healtwtt=mysqli_query($db, "SELECT * FROM health");
$rowhtt=mysqli_num_rows($healtwtt);

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
                <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-tachometer-alt"></i> Dashboard</h1>
            </div>
            <div class="row">
                <div class="col-lg-8 pt-2">
                    <div class="card shadow mb-4">
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Patient Illness Pie Chart</h6>
                        </div>
                        <div class="card-body">
                            <div>
                                <p class="text-center">Overall Patient Under Treatment & Cured</p>
                            </div>
                            <div class="chart-pie pt-4 pb-2">
                                <canvas id="myPieChart"></canvas>
                                <canvas class="hidden" id="Treatment" value="<?php echo $rowilt;?>"></canvas>
                            </div>
                            <div class="mt-4 text-center small">
                                <span class="mr-2">
                                    <i class="fas fa-circle text-primary"></i> Under Treatment
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-circle text-success"></i> Cured
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow mb-4">
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Latest Appointment</h6>
                            <button  class="btn btn-sm btn-primary" onclick="location.href='Appointment.php'"> View All</button>
                        </div>
                        <div class="card-body">
                           <div class="table-responsive">
                                <table class="table table-sm table-hovered">
                                    <thead>
                                        <tr>
                                            <th>Incharge</th>
                                            <th>Start Date & Time</th>
                                            <th>End Date & Time</th>
                                            <th>Note</th>
                                            <th>Total Patients</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $appointmenttt = mysqli_query($db, "SELECT * FROM appointment ORDER BY id DESC");
                                        while($rowapp=mysqli_fetch_assoc($appointmenttt)){

                                            $heathinfor=mysqli_query($db, "SELECT * FROM health WHERE id='".$rowapp['healthid']."'");
                                            $rowhifo=mysqli_fetch_assoc($heathinfor);

                                            $apppatients=mysqli_query($db, "SELECT * FROM appntmnt_patients WHERE apptmntid='".$rowapp['id']."'");
                                        
                                        ?>
                                        <tr>
                                            <td><?php echo $rowhifo['fname']; ?></td>
                                            <td><?php echo $rowapp['start'];?></td>
                                            <td><?php echo $rowapp['end'];?></td>
                                            <td><?php echo $rowapp['title'];?></td>
                                            <td><?php echo mysqli_num_rows($apppatients); ?></td>
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
                <div class="col-lg-4 pt-2 p-0">
                    <div class="card border-left-primary shadow">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Patient</div>
                                    <p class="badge bg-warning text-dark">Total Patients: <b><?php echo $rowptt;?></b></p>
                                </div>
                                <div class="col-auto">
                                    <i class="fa fa-wheelchair fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border-left-primary shadow mt-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Illness</div>
                                        <p class="badge bg-warning text-dark">Total Illness: <b><?php echo $rowitt;?></b></p>
                                        <p class="badge bg-success text-dark">Overall Patient: <b><?php echo $rowillptt;?></b></p>
                                </div>
                                <div class="col-auto">
                                <i class='fas fa-clinic-medical fa-2x text-gray-300'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border-left-primary shadow mt-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                       Immunization</div>
                                        <p class="badge bg-warning text-dark">Total Immunize: <b><?php echo $rowimtt;?></b></p>
                                        <p class="badge bg-success text-dark">Overall Patient: <b><?php echo $rowpimtt;?></b></p>
                                </div>
                                <div class="col-auto">
                                    <i class='fas fa-crutch fa-2x text-gray-300'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border-left-primary shadow mt-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Prenatal</div>
                                        <p class="badge bg-warning text-dark">Total Prenatal: <b><?php echo $rowpltt;?></b></p>
                                        <p class="badge bg-success text-dark">Overall Patient: <b><?php echo $rowptltt;?></b></p>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-female fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border-left-primary shadow mt-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Appointment</div>
                                        <p class="badge bg-warning text-dark">Total Appointment: <b><?php echo $rowapptt;?></b></p>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border-left-primary shadow mt-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Health Worker</div>
                                        <p class="badge bg-warning text-dark">Total Health Worker: <b><?php echo $rowhtt;?></b></p>
                                </div>
                                <div class="col-auto">
                                    <i class='fas fa-user-md fa-2x text-gray-300'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 pt-2">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div id="calendar"></div>
                        </div>
                    </div>
            </div>
        </div>
<?php 
include "include/script.php"; 
?>