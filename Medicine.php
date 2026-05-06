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
                <h1 class="h3 mb-0 text-gray-800">Medicine</h1>
                <a href="Medicineadd.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"> New Medicine</a>
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
                            <h6 class="m-0 font-weight-bold text-primary">Medicine List</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <th>#</th>
                                        <th>Medicine Name</th>
                                        <th>Quantity</th>
                                        <th>Date Added</th>
                                        <th>Date Update</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $num=1;
                                        $medicine=mysqli_query($db,"SELECT * FROM medicine");
                                        while($rowm=mysqli_fetch_assoc($medicine)){
                                        ?>
                                        <tr>
                                            <td><?php echo $num++;?></td>
                                            <td><?php echo $rowm['medicine_name'];?></td>
                                            <td><?php echo $rowm['quantity'];?></td>
                                            <td><?php echo $rowm['date_add'];?></td>
                                            <td><?php echo $rowm['date_up'];?></td>
                                            <td>
                                                <form action="" method="post" enctype="multipart/form-data">
                                                    <a class="btn btn-sm btn-secondary" href="Medicineupdate.php?medicineid=<?php echo $rowm['id'];?>">Update</a>
                                                    <button class="btn btn-sm btn-danger" id="deletemedicine" name="deletemedicine">Delete</button>
                                                    <input type="hidden" id="medicineid" name="medicineid" value="<?php echo $rowim['id'];?>">
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