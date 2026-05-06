<?php
include "functions.php";
$prenatalid = $_GET['prenatalid'];

if(isset($_POST['delete_prenatal_patient'])){
    delete_prenatal_patient($_POST['prenatalid'], $_POST['prenatalpatientid'] );
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
                <h1 class="h3 mb-0 text-gray-800">Prenatal Monitoring</h1>
                <div class="btn-group">
                    <a href="Prenatal.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-backspace"></i> Back Prenatal</a>
                    <a href="Prenatalselect.php?prenatalid=<?php echo $prenatalid;?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-check-square"></i> Prenatal Select Patients</a>
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
                                        <th>Quarter</th>
                                        <th>Date Visit</th>
                                        <th>Date Added</th>
                                        <th>Prenatal Patient Record</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $num=1;
                                        $prenatal=mysqli_query($db,"SELECT * FROM prenatal_patients WHERE prenatal_id='$prenatalid'");
                                        while($rowiprt=mysqli_fetch_assoc($prenatal)){
                                            $patientinfo=mysqli_query($db,"SELECT * FROM patient WHERE id='".$rowiprt['patients_id']."'");
                                            $rowpi=mysqli_fetch_assoc($patientinfo);
                                        ?>
                                        <tr>
                                            <td><?php echo $num++;?></td>
                                            <td><?php echo $rowpi['fname']." ".$rowpi['mname']." ".$rowpi['lname'];?></td>
                                            <td><?php echo $rowiprt['status_visit'];?> Visit</td>
                                            <td><?php echo $rowiprt['quarter'];?></td>
                                            <td><?php echo $rowiprt['date_visit'];?></td>
                                            <td><?php echo $rowiprt['date_add'];?></td>
                                            <td><a type="submit" class="btn btn-sm btn-primary" href="Prenatalmonitorpr.php?patientid=<?php echo $rowiprt['patients_id'];?>&prenatalid=<?php echo $prenatalid;?>&prenatalpatientid=<?php echo $rowiprt['id'];?>"><i class="fas fa-address-card"></i></a></td>
                                            <td>
                                                <form action="" method="post" enctype="multipart/form-data">
                                                    <a type="submit" class="btn btn-sm btn-secondary" href="Prenatalmonitorupdate.php?patientid=<?php echo $rowpi['id'];?>&prenatalid=<?php echo $prenatalid; ?>&prenatalpatientid=<?php echo $rowiprt['id'];?>">Update</a>
                                                    <button type="submit" id="delete_prenatal_patient" name="delete_prenatal_patient" class="btn btn-sm btn-danger">Delete</button>
                                                    <input type="hidden" id="prenatalpatientid" name="prenatalpatientid" value="<?php echo  $rowiprt['id'];?>">
                                                    <input type="hidden" id="prenatalid " name="prenatalid" value="<?php echo $prenatalid;?>">
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