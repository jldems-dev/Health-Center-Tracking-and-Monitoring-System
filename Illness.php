<?php
include "functions.php";

if(isset($_POST['deleteillness'])){
    deleteillness($_POST['illnessid']);
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
                <h1 class="h3 mb-0 text-gray-800"><i class='fas fa-clinic-medical'></i> Illness</h1>
                <a href="Illnessform.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-external-link-alt"></i> New Illness</a>
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
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-table"></i> Illness List</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <th>#</th>
                                        <th>Illness</th>
                                        <th>Total Patients</th>
                                        <th>Total Under Treatment</th>
                                        <th>Total Cured</th>
                                        <th>Patient List</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $num=1;
                                        $illness = mysqli_query($db,"SELECT * FROM illness");
                                        while($rowi=mysqli_fetch_assoc($illness)){

                                            $totalpt = mysqli_query($db,"SELECT * FROM illness_patients WHERE conditions='Treatment' AND illness_id='".$rowi['id']."'");
                                            $rowtpt=mysqli_num_rows($totalpt);
                                            $totalpc = mysqli_query($db,"SELECT * FROM illness_patients WHERE conditions='Cured' AND illness_id='".$rowi['id']."'");
                                            $rowtpc=mysqli_num_rows($totalpc);
                                        ?>
                                        <tr>
                                            <td><?php echo $num++;?></td>
                                            <td><?php echo $rowi['illness_name'];?></td>
                                            <td class="bg-primary text-dark"><?php echo $totalp = $rowtpt+$rowtpc;?></td>
                                            <td class="bg-warning text-dark"><?php echo $rowtpt;?></td>
                                            <td class="bg-success text-dark"><?php echo $rowtpc;?></td>
                                            <td><a class="btn btn-success btn-sm" href="Illnessmonitor.php?illnessid=<?php echo $rowi['id'];?>&illnessname=<?php echo $rowi['illness_name'];?>"><i class="fas fa-street-view"></i></a></td>
                                            <td>
                                                <form action="" method="post" enctype="multipart/form-data">
                                                    <a class="btn btn-secondary btn-sm" href="Illnessupdate.php?illnessid=<?php echo $rowi['id'];?>">Update</a>
                                                    <button type="submit" class="btn btn-danger btn-sm" id="deleteillness" name="deleteillness">Delete</button>
                                                    <input type="hidden" id="illnessid" name="illnessid" value="<?php echo $rowi['id'];?>">
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