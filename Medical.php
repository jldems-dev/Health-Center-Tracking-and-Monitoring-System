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
                <h1 class="h3 mb-0 text-gray-800"><i class='fas fa-notes-medical'></i> Medical Records</h1>
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
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-table"></i> Patient List</h6>
                        </div>
                        <div class="card-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="table-responsive">
                                    <table class="table table-sm table-hover" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <th>#</th>
                                            <th>Full Name</th>
                                            <th>Total Medical Records</th>
                                            <th>Medical Records</th>
                                            <th>Patient Full Information</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $num=1;
                                            $patient = mysqli_query($db,"SELECT * FROM patient");
                                            while($rowp=mysqli_fetch_assoc($patient)){
                                                $totalmedicalrecordpatients=mysqli_query($db, "SELECT * FROM medical_record WHERE patientid='".$rowp['id']."'");

                                            ?>
                                            <tr>
                                                <td><?php echo $num++;?></td>
                                                <td><?php echo $rowp['fname']." ".$rowp['mname']." ".$rowp['lname'];?></td>
                                                <td style="background-color: yellow;"><?php echo mysqli_num_rows($totalmedicalrecordpatients); ?></td>
                                                <td>
                                                    <a class="btn btn-primary btn-sm" href="Medicaladd.php?patientid=<?php echo $rowp['id'];?>"><i class="fas fa-laptop-medical"></i></a>
                                                </td>
                                                <td>
                                                    <a class="btn btn-primary btn-sm" href="Patientinfo.php?patientid=<?php echo $rowp['id'];?>&status=<?php echo "Medical.php";?>"><i class="fas fa-address-card"></i></a>
                                                </td>
                                            </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php 
include "include/script.php"; 
?>