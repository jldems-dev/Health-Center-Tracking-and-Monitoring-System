<?php
include "functions.php";

if(isset($_POST['submit'])){
    $month = $_POST['month'];
    $year = $_POST['year'];
    $stat = $_POST['stat'];

    if($month && $year && $stat){
        $patient = mysqli_query($db,"SELECT * FROM patient WHERE month(date)='$month' AND year(date)='$year' AND status='$stat'");
    }else if($month && $year && empty($stat)){
        $patient = mysqli_query($db,"SELECT * FROM patient WHERE month(date)='$month' AND year(date)='$year'");
    }else if(empty($month) && empty($year) && $stat){
        $patient = mysqli_query($db,"SELECT * FROM patient WHERE status='$stat'");
    }else if(empty($month) && $year && $stat){
        $patient = mysqli_query($db,"SELECT * FROM patient WHERE year(date)='$year' AND status='$stat'");
    }else if(empty($month) && $year && empty($stat)){
        $patient = mysqli_query($db,"SELECT * FROM patient WHERE year(date)='$year'");
    }else{
        $patient = mysqli_query($db,"SELECT * FROM patient");
    }
     
}else{
    $patient = mysqli_query($db,"SELECT * FROM patient");
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
                <h1 class="h3 mb-0 text-gray-800">Patient Report</h1>
                <a href="Print.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-backspace"></i> Back Print Report</a>
            </div>
            <div class="row">
                <div class="col-lg-12 pt-2">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-table"></i> All Patient List</h6>
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
                                        <label>Status: </label>
                                    </div>
                                    <div class="col-sm-2">
                                        <select name="stat" id="stat" class="form-control form-control-sm">
                                            <option value="">Select Status</option>
                                            <option>Infancy</option>
                                            <option>Child</option>
                                            <option>Adult</option>
                                            <option>Senior Citizen</option>
                                        </select>
                                    </div>
                                    <div class="col-2">
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
                                                        <th colspan="15" class="text-center">Patient Monitoring Record</th>
                                                    </tr>
                                                    <tr>
                                                        <th colspan="4">Patient Information</th>
                                                        <th colspan="4">Vital Sign</th>
                                                        <th>Blood Type</th>
                                                        <th colspan="3">Measurement</th>
                                                        <th colspan="2">Patient Added Date</th>
                                                    </tr>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Full Name</th>
                                                        <th>Age</th>
                                                        <th>Gender</th>
                                                        <th>Blood Pressure</th>
                                                        <th>Pulse Rate</th>
                                                        <th>Respiration rate</th>
                                                        <th>Body Temperature</th>
                                                        <th>Blood Type</th>
                                                        <th>weight</th>
                                                        <th>Height</th>
                                                        <th>Status</th>
                                                        <th>Month</th>
                                                        <th>Year</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $num=1;
                                                    while($rowp=mysqli_fetch_assoc($patient)){
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $num++;?></td>
                                                        <td><?php echo $rowp['fname']." ".$rowp['mname']." ".$rowp['lname'];?></td>
                                                        <td><?php echo $rowp['age'];?></td>
                                                        <td><?php echo $rowp['gender'];?></td>
                                                        <td><?php if(empty($rowp['bp'])){echo "N/A";}else{echo $rowp['bp'];}?></td>
                                                        <td><?php if(empty($rowp['pr'])){echo "N/A";}else{echo $rowp['pr'];}?></td>
                                                        <td><?php if(empty($rowp['rr'])){echo "N/A";}else{echo $rowp['rr'];}?></td>
                                                        <td><?php if(empty($rowp['temp'])){echo "N/A";}else{echo $rowp['temp'];}?></td>
                                                        <td><?php echo $rowp['bt'];?></td>
                                                        <td><?php echo $rowp['wt'];?></td>
                                                        <td><?php echo $rowp['ht'];?></td>
                                                        <td><?php echo $rowp['status'];?></td>
                                                        <td><?php echo date('F',strtotime($rowp['date']));?></td>
                                                        <td><?php echo date('Y',strtotime($rowp['date']));?></td>
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