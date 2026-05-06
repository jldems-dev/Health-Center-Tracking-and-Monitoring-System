<?php
include "functions.php";
$immunizeid = $_GET['immunizeid'];

if(isset($_POST['delete_immunize_patient'])){
    delete_immunize_patient($_POST['immunizeid'], $_POST['immunizepatientid'] );
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
                <h1 class="h3 mb-0 text-gray-800">Immunize Monitoring</h1>
                <div class="btn-group">
                    <a href="Immunization.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-backspace"></i> Back Immunization</a>
                    <a href="Immunizationselect.php?immunizeid=<?php echo $immunizeid;?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-check-square"></i> Immunize Select Patients</a>
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
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-table"></i> Patient List</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <th>#</th>
                                        <th>Full Name</th>
                                        <th>Status Visit</th>
                                        <th>Date Visit</th>
                                        <th>Date Added</th>
                                        <th>Patient Immunize Record</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $num=1;
                                        $immunize=mysqli_query($db,"SELECT * FROM immunize_patients WHERE immunize_id='$immunizeid'");
                                        while($rowimm=mysqli_fetch_assoc($immunize)){
                                            $patientinfo=mysqli_query($db,"SELECT * FROM patient WHERE id='".$rowimm['patients_id']."'");
                                            $rowpi=mysqli_fetch_assoc($patientinfo);
                                        ?>
                                        <tr>
                                            <td><?php echo $num++;?></td>
                                            <td><?php echo $rowpi['fname']." ".$rowpi['mname']." ".$rowpi['lname'];?></td>
                                            <td class="bg-success text-dark"><?php echo $rowimm['status_visit']; ?> Visit</td>
                                            <td class="bg-info text-dark"><?php echo $rowimm['date_visit']; ?></td>
                                            <td><?php echo $rowimm['date_add']; ?></td>
                                            <td><a type="submit" class="btn btn-sm btn-primary" href="Immunizemonitorpr.php?patientid=<?php echo $rowimm['patients_id'];?>&immunizeid=<?php echo $immunizeid; ?>&immunizepatientid=<?php echo $rowimm['id'];?>"><i class="fas fa-address-card"></i></a></td>
                                            <td>
                                                <form action="" method="post" enctype="multipart/form-data">
                                                    <a type="submit" class="btn btn-sm btn-secondary" href="Immunemonitorupdate.php?patientid=<?php echo $rowpi['id'];?>&immunizeid=<?php echo $immunizeid; ?>&immunizepatientid=<?php echo $rowimm['id'];?>">Update</a>
                                                    <button type="submit" id="delete_immunize_patient" name="delete_immunize_patient" class="btn btn-sm btn-danger">Delete</button>
                                                    <input type="hidden" id="immunizepatientid" name="immunizepatientid" value="<?php echo  $rowimm['id'];?>">
                                                    <input type="hidden" id="immunizeid " name="immunizeid" value="<?php echo $immunizeid;?>">
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