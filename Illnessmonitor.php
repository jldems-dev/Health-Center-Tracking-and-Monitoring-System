<?php
include "functions.php";
$illnessid = $_GET['illnessid'];
$illnessname = $_GET['illnessname'];

if(isset($_POST['delete_p_monitor'])){
    delete_p_monitor($_POST['patientid'],$_POST['illnessid'],$_POST['illnessname']);
}
if(isset($_POST['condition'])){
   echo $_GET['condition'];
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
                <h1 class="h3 mb-0 text-gray-800"><?php echo $illnessname;?> Monitoring</h1>
                <div class="btn-group">
                    <a href="Illness.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-backspace"></i> Back Illness</a>
                    <a href="Illnessselect.php?illnessid=<?php echo $illnessid;?>&illnessname=<?php echo $illnessname;?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-check-square"></i> Illness Select Patients</a>
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
                                        <th>Consulted Date</th>
                                        <th>Next Visit Date</th>
                                        <th>Status</th>
                                        <th>Patient Record</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $num=1;
                                        $illness_p=mysqli_query($db,"SELECT * FROM illness_patients WHERE illness_id='$illnessid'");
                                        while($rowip=mysqli_fetch_assoc($illness_p)){
                                            $patientinfo=mysqli_query($db,"SELECT * FROM patient WHERE id='".$rowip['patients_id']."'");
                                            $rowpi=mysqli_fetch_assoc($patientinfo);
                                        ?>
                                       <tr>
                                           <td><?php echo $num++;?></td>
                                           <td><?php echo $rowpi['fname']." ".$rowpi['mname']." ".$rowpi['lname'];?></td>
                                           <td><?php echo $rowip['consulted_date'];?></td>
                                           <td><?php echo $rowip['next_visit_date'];?></td>
                                           <td class="text-dark <?php if($rowip['conditions'] == 'Treatment'){ echo "bg-warning"; }else{ echo "bg-success"; }?>"><?php echo $rowip['conditions'];?></td>
                                           <td><a type="submit" class="btn btn-sm btn-primary" href="Illnessmonitorcons.php?patientid=<?php echo $rowip['patients_id'];?>&lmpatientid=<?php echo $rowip['id'];?>&illnessname=<?php echo $illnessname;?>&illnessid=<?php echo $illnessid;?>"><i class="fas fa-address-card"></i></a></td>
                                           <td>
                                                <form action="" method="post" enctype="multipart/form-data">
                                                    <a type="submit" class="btn btn-sm btn-secondary" href="Illnessmonitorupdate.php?patientid=<?php echo $rowip['patients_id'];?>&lmpatientid=<?php echo $rowip['id'];?>&illnessname=<?php echo $illnessname;?>&illnessid=<?php echo $illnessid;?>">Update</a>
                                                    <button type="submit" id="delete_p_monitor" name="delete_p_monitor" class="btn btn-sm btn-danger">Delete</button>
                                                    <input type="hidden" id="patientid" name="patientid" value="<?php echo $rowip['id'];?>">
                                                    <input type="hidden" id="illnessid" name="illnessid" value="<?php echo $illnessid;?>">
                                                    <input type="hidden" id="illnessname" name="illnessname" value="<?php echo $illnessname;?>">
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