<?php
include "functions.php";

if(isset($_POST['submit'])){
    $month = $_POST['month'];
    $year = $_POST['year'];

    if($month && $year){
        $bppatient = mysqli_query($db,"SELECT * FROM patient_bloodpressure WHERE month(date)='$month' AND year(date)='$year'");
    }else if($month && empty($year)){
        $bppatient = mysqli_query($db,"SELECT * FROM patient_bloodpressure WHERE month(date)='$month'");
    }else if(empty($month) && $year){
        $bppatient = mysqli_query($db,"SELECT * FROM patient_bloodpressure WHERE year(date)='$year'");
    }else{
        $bppatient = mysqli_query($db,"SELECT * FROM patient_bloodpressure");
    }
     
}else{
    $bppatient=mysqli_query($db, "SELECT * FROM patient_bloodpressure");
    
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
                <h1 class="h3 mb-0 text-gray-800">Prenatal Patient Report</h1>
                <a href="Print.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-backspace"></i> Back Print Report</a>
            </div>
            <div class="row">
                <div class="col-lg-12 pt-2">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-table"></i> All Prenatal Patient List</h6>
                        </div>
                        <div class="card-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-0 pl-2">
                                        <label>Month: </label>
                                    </div>
                                    <div class="col-sm-3">
                                        <select name="month" id="month" class="form-control form-control-sm">
                                        <option value="">Select Month</option>
                                        <?php
    
                                            for ($i = 1; $i <= 12; $i++)
                                            {
                                                $month = date('F', mktime(0, 0, 0, $i, 1, 2011));
                                                ?>
                                                <option value="<?php echo $i; ?>"><?php echo $month; ?></option>
                                                <?php
                                            }

                                        ?>
                                        </select>
                                    </div>
                                    <div class="col-0">
                                        <label>Year: </label>
                                    </div>
                                    <div class="col-sm-3">
                                        <select name="year" id="year" class="form-control form-control-sm">
                                            <option value="">Select Year</option>
                                        <?php
                                            for($n=2000;$n<=2050;$n++){
                                                ?>
                                                <option value="<?php echo $n; ?>"><?php echo $n; ?></option>
                                                <?php
                                            }
                                        ?>
                                        </select>
                                    </div>
                                    <div class="col-0">
                                        <button type="sybmit" class="btn btn-sm btn-primary" name="submit">Get Data</button>
                                    </div>
                                    <div class="col-sm-12">
                                        <hr>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-sm" id="idtable">
                                                <thead>
                                                    <tr>
                                                        <th colspan="11" class="text-center">Prenatal Monitoring Record</th>
                                                    </tr>
                                                    <tr>
                                                        <th colspan="5">Patient Information</th>
                                                        <th colspan="2">Patient Blood Pressure</th>
                                                        <th colspan="2">Latest Update Month & Year</th>
                                                    </tr>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Full Name</th>
                                                        <th>Age</th>
                                                        <th>Gender</th>
                                                        <th>Status</th>
                                                        <th>Blood Pressure</th>
                                                        <th>Blood Pressure Status</th>
                                                        <th>Month</th>
                                                        <th>Year</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $num=1;
                                                    
                                                        while($rowbp=mysqli_fetch_assoc($bppatient)){

                                                        $patient = mysqli_query($db,"SELECT * FROM patient WHERE id='".$rowbp['patients_id']."'");
                                                        $rowpatient=mysqli_fetch_assoc($patient);
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $num++;?></td>
                                                        <td><?php echo $rowpatient['fname']." ".$rowpatient['mname']." ".$rowpatient['lname'];?></td>
                                                        <td><?php echo $rowpatient['age'];?></td>
                                                        <td><?php echo $rowpatient['gender'];?></td>
                                                        <td><?php echo $rowpatient['status'];?></td>
                                                        <td><?php if(empty($rowbp['bps']) && empty($rowbp['bpd'])){echo "N/A";}else{ echo $rowbp['bps']."/".$rowbp['bpd'];}?></td>
                                                        <td><?php
                                                            if($rowbp['bps'] < 120 && $rowbp['bpd'] < 80){
                                                                echo "<p class='bg-primary text-dark badge'>Normal</p>";
                                                            }else if($rowbp['bps'] >= 119 && $rowbp['bpd'] < 81){
                                                                echo "<p class='bg-success text-dark badge'>Elevated</p>";
                                                            }else if($rowbp['bps'] >= 129 && $rowbp['bps'] < 139 && $rowbp['bpd'] > 80 && $rowbp['bpd'] < 89){
                                                                echo "<p class='bg-info text-dark badge'>High Blood Pressure LVL 1</p>";
                                                            }else if($rowbp['bps'] > 140 && $rowbp['bps'] < 179 && $rowbp['bpd'] > 90 && $rowbp['bpd'] < 119){
                                                                echo "<p class='bg-warning text-dark badge'>High Blood Pressure LVL 2</p>";
                                                            }else if($rowbp['bps'] > 180 && $rowbp['bpd'] > 120){
                                                                echo "<p class='bg-danger text-dark badge'>Hypertensive Crisis</p>";
                                                            }
                                                            ?>
                                                        </td>
                                                        <td><?php echo date('F',strtotime($rowbp['date'])); ?></td>
                                                        <td><?php echo date('Y',strtotime($rowbp['date'])); ?></td>
                                                    </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
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