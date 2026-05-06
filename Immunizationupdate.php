<?php
include "functions.php";
$immunizeid = $_GET['immunizeid'];
$immunizeinfo=mysqli_query($db,"SELECT * FROM immunization WHERE id='$immunizeid'");
$rowimmu=mysqli_fetch_assoc($immunizeinfo);

if(isset($_POST['updateimmunize'])){
    updateimmunize($_POST['immunizename'],$_POST['y'],$_POST['sdate'], $_POST['immunizeid']);
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
                <h1 class="h3 mb-0 text-gray-800">Update Immunization: <?php echo $rowimmu['immunize_name']?></h1>
                <a href="Immunization.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-backspace"></i> Back Immunization</a>
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
                            <h6 class="m-0 font-weight-bold text-primary">Immunization Update Form</h6>
                        </div>
                        <div class="card-body">
                            <form class="user" action="" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label for="" style="font-size: 12px;">Immunize Name</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="immunizename" name="immunizename" value="<?php echo $rowimmu['immunize_name']?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="" Style="font-size: 12px;">Start Immunize Date</label>
                                            <input type="date" class="form-control" id="sdate" name="sdate" value="<?php echo $rowimmu['start_date']?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="" style="font-size: 12px;">Year</label>
                                            <select id="y" name="y" class="form-control" required>
                                                <option value="<?php echo $rowimmu['year']?>"><?php echo $rowimmu['year']?></option>
                                                <?php
                                                    for( $y = 2000; $y <= 2100; $y++ ) {
                                                        ?>
                                                            <option value="<?php echo $y-1; ?>-<?php echo $y; ?>"><?php echo $y-1; ?>-<?php echo $y; ?></option>
                                                        <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" id="updateimmunize" name="updateimmunize" class="btn btn-primary btn-sm"><i class="fas fa-external-link-alt"></i> Upadate Immunization Record</button>
                                <input type="hidden" id="immunizeid" name="immunizeid" value="<?php echo $immunizeid;?>">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php 
include "include/script.php"; 
?>