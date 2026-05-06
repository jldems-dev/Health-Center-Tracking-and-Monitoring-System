<?php
include "functions.php";
$illnessid = $_GET['illnessid'];
$illnessname = $_GET['illnessname'];

if(isset($_POST['selectpatients'])){
    selectpatients($_POST['illnessid'], $_POST['patientid'], $_POST['illnessname']);
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
                <h1 class="h3 mb-0 text-gray-800">Select Patients</h1>
                <a href="Illnessmonitor.php?illnessid=<?php echo $illnessid;?>&illnessname=<?php echo $illnessname;?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-backspace"></i> Back Illness</a>
            </div>
            <div class="row">
                <?php
                if(isset($_SESSION['message'])){
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
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-table"></i> Patient List</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <th>#</th>
                                        <th>Full Name</th>
                                        <th>Address</th>
                                        <th>Age</th>
                                        <th>Gender</th>
                                        <th>Status</th>
                                        <th>BLood Pressure</th>
                                        <th>Temprerature</th>
                                        <th>Weight</th>
                                        <th>Height</th>
                                        <th>Select</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $num=1;
                                        $patient = mysqli_query($db,"SELECT * FROM patient");
                                        while($rowp=mysqli_fetch_assoc($patient)){
                                        ?>
                                        <tr>
                                            <td><?php echo $num++;?></td>
                                            <td><?php echo $rowp['fname']." ".$rowp['mname']." ".$rowp['lname'];?></td>
                                            <td><?php echo $rowp['address'];?></td>
                                            <td><?php echo $rowp['age'];?></td>
                                            <td><?php echo $rowp['gender'];?></td>
                                            <td><?php echo $rowp['status'];?></td>
                                            <td><?php if(empty($rowp['bps']) && empty($rowp['bpd'])){ echo "N/A"; }else{echo $rowp['bps']."/".$rowp['bpd'];}?></td>
                                            <td><?php echo $rowp['temp'];?> ℃</td>
                                            <td><?php echo $rowp['wt'];?> kg.</td>
                                            <td><?php echo $rowp['ht'];?> cm</td>
                                            <td>
                                                <?php
                                                $illnessp=mysqli_query($db,"SELECT * FROM illness_patients WHERE patients_id='".$rowp['id']."'");
                                                $rowip=mysqli_fetch_assoc($illnessp);

                                                if(mysqli_num_rows($illnessp) > 0){
                                                ?>
                                                    <button type="submit" class="btn btn-sm btn-danger" id="selectpatients" name="selectpatients" Disabled>Selected</button>
                                                <?php
                                                }else{
                                                ?>
                                                <form action="" method="post" enctype="multipart/form-data">
                                                    <button type="submit" class="btn btn-sm btn-success" id="selectpatients" name="selectpatients">Select</button>
                                                    <input type="hidden" id="illnessid" name="illnessid" value="<?php echo $illnessid;?>">
                                                    <input type="hidden" id="patientid" name="patientid" value="<?php echo $rowp['id'];?>">
                                                    <input type="hidden" id="illnessname" name="illnessname" value="<?php echo $illnessname;?>">
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
            </div>
        </div>
<?php
include "include/script.php"; 
?>