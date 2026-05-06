<?php
include "functions.php";

if(isset($_POST['deleteprenatal'])){
    deleteprenatal($_POST['prenatalid']);
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
                <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-female"></i> Prenatal</h1>
                <a href="Prenataladd.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-external-link-alt"></i> New Record Prenatal</a>
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
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-table"></i> Prenatal List</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <th>#</th>
                                        <th>Prenatal Name</th>
                                        <th>Date</th>
                                        <th>Year</th>
                                        <th>Total Patient</th>
                                        <th>Patient List</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $num=1;
                                        $prenatal=mysqli_query($db,"SELECT * FROM prenatal");
                                        while($rowptal=mysqli_fetch_assoc($prenatal)){
                                            $prenatalpatients=mysqli_query($db,"SELECT * FROM prenatal_patients WHERE prenatal_id='".$rowptal['id']."'");
                                        ?>
                                        <tr>
                                            <td><?php echo $num++;?></td>
                                            <td><?php echo $rowptal['prenatal_name'];?></td>
                                            <td><?php echo $rowptal['date'];?></td>
                                            <td><?php echo $rowptal['year'];?></td>
                                            <td style="background-color: yellow;"><?php echo mysqli_num_rows($prenatalpatients);?></td>
                                            <td><a class="btn btn-sm btn-success" href="Prenatalpatients.php?prenatalid=<?php echo $rowptal['id'];?>"><i class="fas fa-street-view"></i></a></td>
                                            <td>
                                                <form action="" method="post" enctype="multipart/form-data">
                                                    <a class="btn btn-sm btn-secondary" href="Prenatalupdate.php?prenatalid=<?php echo $rowptal['id'];?>">Update</a>
                                                    <button class="btn btn-sm btn-danger" id="deleteprenatal" name="deleteprenatal">Delete</button>
                                                    <input type="hidden" id="prenatalid" name="prenatalid" value="<?php echo $rowptal['id'];?>">
                                                </form>
                                            </td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php 
include "include/script.php"; 
?>