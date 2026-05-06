<?php
include "functions.php";

$illnessid = $_GET['illnessid'];

$illness=mysqli_query($db,"SELECT * FROM illness WHERE id='$illnessid'");
$rowi=mysqli_fetch_assoc($illness);

if(isset($_POST['updateillness'])){
    updateillness($_POST['illnessid'],$_POST['illness'],$_POST['description'] );
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
                <h1 class="h3 mb-0 text-gray-800">Update Illness</h1>
                <a href="Illness.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-backspace"></i> Back Patient</a>
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
                            <h6 class="m-0 font-weight-bold text-primary">Illness Update Form</h6>
                        </div>
                        <div class="card-body">
                            <form class="user" action="" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-sm-12">
                                       <label for=""><b>Illness Information</b></label>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="" style="font-size: 12px;">Illness Name</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="illness" name="illness" value="<?php echo $rowi['illness_name'];?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="" style="font-size: 12px;">Illness Description</label>
                                        <div class="form-group">
                                            <textarea class="form-control" name="description" id="description" maxlength="99"><?php echo $rowi['description'];?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" id="updateillness" name="updateillness" class="btn btn-primary btn-sm"><i class="fas fa-external-link-alt"></i> Update Illness</button>
                                <input type="hidden" id="illnessid" name="illnessid" value="<?php echo $illnessid;?>">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php 
include "include/script.php"; 
?>