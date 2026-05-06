<?php
include "functions.php";

if(isset($_POST['submit'])){
    $month = $_POST['month'];
    $year = $_POST['year'];
    $prenatal = $_POST['prenatal'];

    if($month && $year && $prenatal){
        $prenatalpatient = mysqli_query($db,"SELECT * FROM prenatal_patients WHERE month(date_add)='$month' AND year(date_add)='$year' AND prenatal_id='$prenatal'");
    
    }else if($month && $year && empty($prenatal)){
        $prenatalpatient = mysqli_query($db,"SELECT * FROM prenatal_patients WHERE month(date_add)='$month' AND year(date_add)='$year'");
    }else if(empty($month) && empty($year) && $prenatal){
        $prenatalpatient = mysqli_query($db,"SELECT * FROM prenatal_patients WHERE prenatal_id='$prenatal'");
    }else if(empty($month) && $year && $prenatal){
        $prenatalpatient = mysqli_query($db,"SELECT * FROM prenatal_patients WHERE  year(date_add)='$year' AND prenatal_id='$prenatal'");
    }else if(empty($month) && $year && empty($prenatal)){
        $prenatalpatient = mysqli_query($db,"SELECT * FROM prenatal_patients WHERE  year(date_add)='$year'");
    }else{
        $prenatalpatient = mysqli_query($db,"SELECT * FROM prenatal_patients");
    }
     
}else{
    $prenatalpatient = mysqli_query($db,"SELECT * FROM prenatal_patients");
    
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
                                        <label>Status: </label>
                                    </div>
                                    <div class="col-sm-2">
                                        <select name="prenatal" id="prenatal" class="form-control form-control-sm">
                                            <option value="">Select Prenatal Record Name</option>
                                           <?php
                                            $prenatallist=mysqli_query($db,"SELECT * FROM prenatal");
                                            while($rowpl=mysqli_fetch_assoc($prenatallist)){
                                           ?>
                                           <option value="<?php echo $rowpl['id'];?>"><?php echo $rowpl['prenatal_name'];?></option>
                                           <?php
                                            }
                                           ?>
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
                                                        <th colspan="11" class="text-center">Prenatal Monitoring Record</th>
                                                    </tr>
                                                    <tr>
                                                        <th colspan="5">Patient Information</th>
                                                        <th>Patient Visit Done</th>
                                                        <th>Prenatal Record Name</th>
                                                        <th colspan="2">Month & Year Patient Add</th>
                                                    </tr>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Full Name</th>
                                                        <th>Age</th>
                                                        <th>Gender</th>
                                                        <th>Status</th>
                                                        <th>Done Visit</th>
                                                        <th>Prenatal Name</th>
                                                        <th>Month</th>
                                                        <th>Year</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $num=1;
                                                    
                                                    while($rowprenatalpatient=mysqli_fetch_assoc($prenatalpatient)){
                                                        $prenatal=mysqli_query($db, "SELECT * FROM prenatal WHERE id='".$rowprenatalpatient['prenatal_id']."'");
                                                        $rowprenatal=mysqli_fetch_assoc($prenatal);
                                                        $patient=mysqli_query($db, "SELECT * FROM patient WHERE id='".$rowprenatalpatient['patients_id']."'");
                                                   
                                                    while($rowp=mysqli_fetch_assoc($patient)){
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $num++;?></td>
                                                        <td><?php echo $rowp['fname']." ".$rowp['mname']." ".$rowp['lname'];?></td>
                                                        <td><?php echo $rowp['age'];?></td>
                                                        <td><?php echo $rowp['gender'];?></td>
                                                        <td><?php echo $rowp['status'];?></td>
                                                        <td><?php echo $rowprenatalpatient['status_visit'];?></td>
                                                        <td><?php echo $rowprenatal['prenatal_name'];?></td>
                                                        <td><?php echo date('F',strtotime($rowprenatalpatient['date_add']));?></td>
                                                        <td><?php echo date('Y',strtotime($rowprenatalpatient['date_add']));?></td>
                                                    </tr>
                                                    <?php
                                                        }
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