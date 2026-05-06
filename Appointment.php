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
        <div class="container-fluid pr-5">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-calendar-check"></i> Appointment</h1>
                <a href="Appointmentadd.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-external-link-alt"></i> New Appointment</a>
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
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-table"></i> Schedule List</h6>
                            <button class="btn btn-sm btn-primary" onclick="location.href='Appointmentcalendar.php'"><i class="fas fa-calendar"></i> Calendar</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <th>#</th>
                                        <th>Incharge</th>
                                        <th>Start Date & Time </th>
                                        <th>End Date & Time</th>
                                        <th>Total Patient</th>
                                        <th>Patient List</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $num=1;
                                        $appointment=mysqli_query($db,"SELECT * FROM appointment");
                                        while($rowa=mysqli_fetch_assoc($appointment)){
                                            $healhn=mysqli_query($db, "SELECT * FROM health WHERE id='".$rowa['healthid']."'");
                                            $rowht=mysqli_fetch_assoc($healhn);
                                            $appmntp = mysqli_query($db,"SELECT * FROM appntmnt_patients WHERE apptmntid='".$rowa['id']."'");
                                            $rowappmntp=mysqli_num_rows($appmntp);
                                        ?>
                                        <tr>
                                            <td><?php echo $num++;?></td>
                                            <td><?php echo $rowht['fname'].' '.$rowht['mname'].' '.$rowht['lname']?></td>
                                            <td><?php echo $rowa['start'];?></td>
                                            <td><?php echo $rowa['end'];?></td>
                                            <td style="background-color: yellow;"><?php echo $rowappmntp;?></td>
                                            <td><a class="btn btn-sm btn-success" href="Appointmentpatients.php?apptnmntid=<?php echo $rowa['id'];?>"><i class="fas fa-street-view"></i></a></td>
                                            <td>
                                                <form action="" method="post" enctype="multipart/form-data">
                                                    <a class="btn btn-sm btn-secondary" href="Appointmentupdate.php?apptnmntid=<?php echo $rowa['id'];?>">Update</a>
                                                    <button class="btn btn-sm btn-danger" id="deleteapptnmnt" name="deleteapptnmnt">Delete</button>
                                                    <input type="hidden" id="apptnmntid" name="apptnmntid" value="<?php echo $rowa['id'];?>">
                                                </form>
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
            </div>
        </div>
<?php 
include "include/script.php"; 
?>