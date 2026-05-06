<?php
include "functions.php";

if(isset($_POST['deletepatient'])){
    deletepatient($_POST['patientid']);
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
                <h1 class="h3 mb-0 text-gray-800"><i class="fa fa-wheelchair"></i> Patient</h1>
                <a href="Patientform.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-external-link-alt"></i> New Patient</a>
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
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <div class="btn-group">
                                <button class="btn btn-primary" onclick="location.href='Patient.php'"><i class="fas fa-baby"></i> Infancy</button>
                                <button class="btn btn-primary" onclick="location.href='Child.php'"><i class="fas fa-child"></i> Child</button>
                                <button class="btn btn-primary" onclick="location.href='Adult.php'"><i class="fas fa-male"></i> Adult</button>
                                <button class="btn btn-primary" onclick="location.href='Old.php'"><img src="img/old.png" alt=""> Senior Citizen</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <th>#</th>
                                        <th>Full Name</th>
                                        <th>Address</th>
                                        <th>Contact</th>
                                        <th>Age</th>
                                        <th>Gender</th>
                                        <th>Status</th>
                                        <th>Date Added</th>
                                        <th>Full Info.</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $num=1;
                                        $patient = mysqli_query($db,"SELECT * FROM patient WHERE status='Child'");
                                        while($rowp=mysqli_fetch_assoc($patient)){
                                        ?>
                                        <tr>
                                            <td><?php echo $num++;?></td>
                                            <td><?php echo $rowp['fname']." ".$rowp['mname']." ".$rowp['lname'];?></td>
                                            <td><?php echo $rowp['address'];?></td>
                                            <td><?php echo $rowp['phonenum'];?></td>
                                            <td><?php echo $rowp['age'];?></td>
                                            <td><?php echo $rowp['gender'];?></td>
                                            <td><?php echo $rowp['status'];?></td>
                                            <td><?php echo $rowp['date'];?></td>
                                            <td><a class="btn btn-primary btn-sm" href="Patientinfo.php?patientid=<?php echo $rowp['id'];?>&status=<?php echo "Patient.php";?>"><i class="fas fa-address-card"></i></a></td>
                                            <td width="15%">
                                                <div class="btn-group">
                                                    <form action="" method="post" enctype="multipart/form-data">
                                                        <a class="btn btn-secondary btn-sm" href="Patientupdate.php?patientid=<?php echo $rowp['id'];?>">Update</a>
                                                        <button type="submit" class="btn btn-danger btn-sm" id="deletepatient" name="deletepatient">Delete</button>
                                                        <input type="hidden" id="patientid" name="patientid" value="<?php echo $rowp['id'];?>">
                                                    </form>
                                                </div>
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