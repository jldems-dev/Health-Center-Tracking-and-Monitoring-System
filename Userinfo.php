<?php
include "functions.php";

$userid = $_GET['userid'];

$healthinfo=mysqli_query($db,"SELECT * FROM health WHERE id='$userid'");
$rowui=mysqli_fetch_assoc($healthinfo);
$userinfo=mysqli_query($db,"SELECT * FROM user WHERE healthid='".$rowui['id']."'");
$rowhi=mysqli_fetch_assoc($userinfo);
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
                <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-address-card"></i> Full Information</h1>
                <a href="User.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-backspace"></i> Back Health Worker</a>
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
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="text-center">
                                        <img src="<?php echo $rowui['profile_image']; ?>" alt="" width="150"><br>
                                        <label for=""><b>Profile Image Review</b></label>
                                    </div>
                                    <hr class="sidebar-divider">
                                </div>
                                <div class="col-sm-12 pt-4">
                                    <label for=""><b>Full Name: </b><?php echo $rowui['fname']." ".$rowui['mname']." ".$rowui['lname']?></label><br>
                                    <label for=""><b>Address: </b><?php echo $rowui['address']; ?></label><br>
                                    <label for=""><b>Phone number: </b><?php echo $rowui['phone_number']; ?></label><br>
                                    <label for=""><b>Birth Date: </b><?php echo $rowui['b_day']; ?></label><br>
                                    <label for=""><b>Age: </b><?php echo $rowui['age']; ?></label><br>
                                    <label for=""><b>Gender: </b><?php echo $rowui['gender']; ?></label><br>
                                    <label for=""><b>Civil Status: </b><?php echo $rowui['cvstatus']; ?></label><br>
                                    <label for=""><b>Position: </b><?php echo $rowui['status']; ?></label><br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php 
include "include/script.php"; 
?>