<?php
include "functions.php";

$patientid = $_GET['patientid'];
$medicalrecordid = $_GET['medicalrecordid'];

$medr = mysqli_query($db, "SELECT * FROM medical_record WHERE id='$medicalrecordid'");
$rowmdr=mysqli_fetch_assoc($medr);

if(isset($_POST['deletepfiles'])){
    deletepfiles($_POST['pfilesid'],$_POST['pfilepath'],$_POST['patientid'],$_POST['medicalrecordid']);
}
if(isset($_POST['searchname'])){
    $searchname = $_POST['searchname'];
    $mrp = mysqli_query($db,"SELECT * FROM medical_record_patient WHERE file_name LIKE '%$searchname%'");
}else{
    $mrp = mysqli_query($db, "SELECT * FROM medical_record_patient WHERE patientid='$patientid' AND medrecordid='$medicalrecordid'");
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

        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Patient Medical Files</h1>
                <a href="Medicaladd.php?patientid=<?php echo $patientid;?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-backspace"></i> Back Medical Records</a>
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
                <div class="col-lg-4 pt-2">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-file-upload"></i> Upload Medical Files</h6>
                        </div>
                        <div class="card-body">
                            <form class="user" action="upload.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label for=""><b>File Name</b></label>
                                    </div>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="filename" name="filename" placeholder="Name" required>
                                    </div>
                                    <div class="col-sm-12 pt-2">
                                       <label for=""><b>Select Choose File to Upload</b></label>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <input type="file" name="fileToUpload" id="fileToUpload" required>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" id="uploadfile" name="uploadfile" class="btn btn-primary btn-sm"><i class="fas fa-file-upload"></i> Upload file</button>
                                <input type="hidden" id="patientid" name="patientid" value="<?php echo $patientid;?>">
                                <input type="hidden" id="medicalrecordid" name="medicalrecordid" value="<?php echo $medicalrecordid;?>">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 pt-2">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary"> <i class="fas fa-file"></i> <?php echo $rowmdr['rname'];?></h6>
                            <div class="bg-light">
                                <form class="form-inline" action="" method="post" enctype="multipart/form-data">
                                    <input class="form-control mr-sm-1 form-control-sm" type="search" id="searchname" name="searchname" placeholder="Search" value="<?php echo $searchname;?>" aria-label="Search">
                                    <button class="btn btn-outline-primary my-2 my-sm-0 btn-sm" type="submit">Search</button>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <?php
                                    $check = true;
                                    while($rowmdrp=mysqli_fetch_assoc($mrp)){
                                        $check = false;
                                    ?>
                                    <div class="col-md-3 pt-2">
                                        <div class="card shadow h-100">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-12 text-right">
                                                        <button type="submit" class="btn btn-sm" id="deletepfiles" name="deletepfiles"><span>&times;</span></button>
                                                        <input type="hidden" id="pfilesid" name="pfilesid" value=<?php echo $rowmdrp['id']?>>
                                                        <input type="hidden" id="pfilepath" name="pfilepath" value=<?php echo $rowmdrp['file_path']?>>
                                                        <input type="hidden" id="patientid" name="patientid" value="<?php echo $patientid;?>">
                                                        <input type="hidden" id="medicalrecordid" name="medicalrecordid" value="<?php echo $medicalrecordid;?>">
                                                    </div>
                                                    <div class="col-12">
                                                        <?php
                                                        $ext = pathinfo($rowmdrp['file_name'], PATHINFO_EXTENSION);
                                                        if($ext == "jpg" || $ext == "png"){
                                                        ?>
                                                            <a href="<?php echo $rowmdrp['file_path']; ?>">
                                                                <i class="fas fa-image  fa-7x text-gray-300"></i>
                                                            </a>
                                                        <?php
                                                        }else{
                                                        ?>
                                                        <a href="<?php echo $rowmdrp['file_path']; ?>">
                                                            <i class="fas fa-file-alt fa-7x text-gray-300" ></i>
                                                        </a>
                                                        <?php
                                                        }
                                                        ?>
                                                        <hr>
                                                    </div>
                                                    <div class="col-12 pt-2">
                                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                        <?php $x = substr($rowmdrp['file_name'], 0, strrpos($rowmdrp['file_name'], '.')); echo $x;?></div>
                                                        <div class="h6 mb-0 font-weight-bold text-gray-800"><?php echo $rowmdrp['date'];?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                    
                                </div>
                            </form>
                            <?php
                            if($check){
                                echo "<div class='text-center'>No Files Found</div>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
include "include/script.php"; 
?>