<?php
include "functions.php";

$patientid = $_GET['patientid'];

if(isset($_POST['addmedrecord'])){
    addmedrecord($_POST['recordname'],$_POST['patientid'], $_POST['date']);
}
if(isset($_POST['deletepatientrecord'])){
    deletepatientrecord($_POST['patientmedrecid'],$_POST['patientid']);
}
if(isset($_POST['searchname'])){
    $searchname = $_POST['searchname'];
    $mdrecord = mysqli_query($db,"SELECT * FROM medical_record WHERE rname LIKE '%$searchname%'");
}else{
    $mdrecord = mysqli_query($db,"SELECT * FROM medical_record");
    $searchname = "";
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

        <div class="container-fluid pr-5">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Patients Medical Record</h1>
                <a href="Medical.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-backspace"></i> Back Medical Records</a>
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
                <div class="col-lg-3 pt-2">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-folder-plus"></i> New Record</h6>
                        </div>
                        <div class="card-body">
                            <form class="user" action="" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-sm-12">
                                       <label for=""><b>Name</b></label>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="recordname" name="recordname" placeholder="Record Name" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <input type="date" class="form-control" id="date" name="date" placeholder="Year" required>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" id="addmedrecord" name="addmedrecord" class="btn btn-primary btn-sm"><i class="fas fa-external-link-alt"></i> Add New Medical Record</button>
                                <input type="hidden" id="patientid" name="patientid" value="<?php echo $patientid;?>">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 pt-2">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-folder"></i> Patient Medical Record Folder</h6>
                            <div class="bg-light">
                                <form class="form-inline" action="" method="post" enctype="multipart/form-data">
                                    <input class="form-control mr-sm-1 form-control-sm" type="search" id="searchname" name="searchname" placeholder="Search" value="<?php echo $searchname;?>" aria-label="Search">
                                    <button class="btn btn-outline-primary my-2 my-sm-0 btn-sm" type="submit" id="searchfoldername" name="searchfoldername">Search</button>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <?php
                                        $num=1;
                                        
                                        while($rowmd=mysqli_fetch_assoc($mdrecord)){

                                        $patientfiletotal = mysqli_query($db,"SELECT * FROM medical_record_patient WHERE patientid='$patientid' AND medrecordid='".$rowmd['id']."'");
                                    ?>
                                    <div class="col-md-3">
                                        <div class="card shadow h-100 py-2">
                                            <a href="Medicalfiles.php?patientid=<?php echo $patientid;?>&medicalrecordid=<?php echo $rowmd['id'];?>">
                                                <div class="card-body">
                                                    <div class="row align-items-center">
                                                        <div class="col-12 nav-item">
                                                            <i class="fas fa-folder-open fa-6x text-gray-300"></i><span class="badge badge-warning navbar-badge"><?php echo mysqli_num_rows($patientfiletotal);?></span>
                                                        </div>
                                                        <div class="col-12 ">
                                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                            <?php echo $rowmd['rname'];?></div>
                                                            <div class="h6 mb-0 font-weight-bold text-gray-800"><?php echo $rowmd['date'];?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                <form action="" method="post" enctype="multipart/form-data">
                                                    <a class="btn btn-sm btn-primary ml-3" href="Medicalupdate.php?patientmedrecid=<?php echo $rowmd['id'];?>&patientid=<?php echo $patientid;?>" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">Update</span>
                                                    </a>
                                                    <button type="submit" class="btn btn-sm btn-danger px-2" id="deletepatientrecord" name="deletepatientrecord" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">Delete</span>
                                                    </button>
                                                    <input type="hidden" id="patientmedrecid" name="patientmedrecid" value="<?php echo $rowmd['id'];?>">
                                                    <input type="hidden" id="patientid" name="patientid" value="<?php echo $patientid;?>">
                                                </form>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <?php
                                        }
                                    ?>
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