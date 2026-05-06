<?php
include "functions.php";

$apptnmnt = $_GET['apptnmntid'];

$appointupdate=mysqli_query($db,"SELECT * FROM appointment WHERE id='$apptnmnt'");
$rowapup=mysqli_fetch_assoc($appointupdate);

$healthn=mysqli_query($db, "SELECT * FROM health WHERE id='".$rowapup['healthid']."'");
$rowhi=mysqli_fetch_assoc($healthn);

if(isset($_POST['updateappointment'])){
    updateappointment($_POST['inchargename'],$_POST['startt'],$_POST['endt'],$_POST['note'],$_POST['apptnmntid']);
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
                <h1 class="h3 mb-0 text-gray-800">Update Appointment</h1>
                <a href="Appointment.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-backspace"></i> Back Appointment</a>
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
                            <h6 class="m-0 font-weight-bold text-primary">Appointment Update Form</h6>
                        </div>
                        <div class="card-body">
                            <form class="user" action="" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-sm-12">
                                       <label for=""><b>Incharge</b></label>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="" style="font-size: 12px;">Incharge Name</label>
                                        <div class="form-group">
                                            <select name="inchargename" id="inchargename" class="form-control">
                                                <option value="<?php echo $rowhi['id']; ?>"><?php echo $rowhi['fname'].' '.$rowhi['mname'].' '.$rowhi['lname'];?></option>
                                                <?php
                                                    $hworker=mysqli_query($db,"SELECT * FROM health");
                                                    while($rowhw=mysqli_fetch_assoc($hworker)){
                                                ?>
                                                <option value="<?php echo $rowhw['id']; ?>"><?php echo $rowhw['fname'].' '.$rowhw['mname'].' '.$rowhw['lname'];?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="" style="font-size: 12px;">Start Date & Time</label>
                                        <div class="form-group">
                                            <input type="datetime-local" name="startt" id="startt" class="form-control" value="<?php echo $rowapup['start']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="" style="font-size: 12px;">End Date & Time</label>
                                        <div class="form-group">
                                            <input type="datetime-local" name="endt" id="endt" class="form-control" value="<?php echo $rowapup['end']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="" style="font-size: 12px;">Note</label>
                                        <div class="form-group">
                                            <textarea name="note" id="note" class="form-control"><?php echo $rowapup['title']; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" id="updateappointment" name="updateappointment" class="btn btn-primary btn-sm"><i class="fas fa-external-link-alt"></i> Update Appointment</button>
                                <input type="hidden" id="apptnmntid" name="apptnmntid" value="<?php echo $apptnmnt;?>">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
function selectTimesOfDay() {
    $open_time = strtotime("7:00");
    $close_time = strtotime("23:59");
    $now = time();
    $output = "";
    for( $i=$open_time; $i<$close_time; $i+=300) {
        $output .= "<option>".date("h:i",$i)."</option>";
    }
    return $output;
}
include "include/script.php"; 
?>