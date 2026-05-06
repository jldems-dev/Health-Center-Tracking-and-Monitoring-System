<?php
include "functions.php";

$prenatalid = $_GET['prenatalid'];

$prenatarinfo = mysqli_query($db,"SELECT * FROM prenatal WHERE id='$prenatalid'");
$rowpri=mysqli_fetch_assoc($prenatarinfo);

if(isset($_POST['updateprenatal'])){
    updateprenatal($_POST['prenatalname'],$_POST['sdate'],$_POST['y'], $_POST['prenatalid']);
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
                <h1 class="h3 mb-0 text-gray-800">Update Prenatal Record</h1>
                <a href="Prenatal.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-backspace"></i> Back Prenatal</a>
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
                            <h6 class="m-0 font-weight-bold text-primary">Prenatal Update Form</h6>
                        </div>
                        <div class="card-body">
                            <form class="user" action="" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="" Style="font-size: 12px;">Prenatal Name Record</label>
                                            <input type="text" class="form-control" id="prenatalname" name="prenatalname" value="<?php echo $rowpri['prenatal_name'];?>" placeholder="Prenatal Name Record" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="" Style="font-size: 12px;">Date</label>
                                            <input type="date" class="form-control" id="sdate" name="sdate" value="<?php echo $rowpri['date'];?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="" Style="font-size: 12px;">Year</label>
                                        <div class="form-group">
                                            <select id="y" name="y" class="form-control" required>
                                                <option value="<?php echo $rowpri['year'];?>"><?php echo $rowpri['year'];?></option>
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
                                <button type="submit" id="updateprenatal" name="updateprenatal" class="btn btn-primary btn-sm"><i class="fas fa-external-link-alt"></i> Update Prenatal Record</button>
                                <input type="hidden" id="prenatalid" name="prenatalid" value="<?php echo $prenatalid;?>">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php 
include "include/script.php"; 
?>