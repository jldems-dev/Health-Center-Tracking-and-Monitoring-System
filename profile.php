<?php
include "functions.php";
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
                <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Profile</h1>
            </div>
            <div class="row">
                <div class="col-lg-12 pt-2">
                    <div class="card shadow mb-4">
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-address-card"></i> Profile Informations</h6>
                        </div>
                        <div class="card-body text-center">
                          <img src="<?php echo $rowh['profile_image']; ?>" alt="" width="25%">
                          <p class="pt-3"><b><?php echo $rowh['fname'].' '.$rowh['mname'].' '.$rowh['lname'];?></b></p>
                          <p class="badge bg-success text-dark"><?php echo $rowh['status'];?></p>
                          <hr>
                          <div class="text-left">
                            <p><b>Address: </b><?php echo $rowh['address'];?></p>
                            <p><b>Birth Day: </b><?php echo $rowh['b_day'];?></p>
                            <p><b>Age: </b><?php echo $rowh['age'];?></p>
                            <p><b>Gender: </b><?php echo $rowh['gender'];?></p>
                            <p><b>Civil Status: </b><?php echo $rowh['cvstatus'];?></p>
                            <p><b>Contact Number: </b><?php echo $rowh['phone_number'];?></p>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php 
include "include/script.php"; 
?>