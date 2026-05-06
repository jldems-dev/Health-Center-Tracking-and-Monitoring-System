<?php
include "functions.php";

if(isset($_POST['deleteuser'])){
    deleteuser($_POST['userid']);
}
if(isset($_POST['createaccount'])){
    createaccount($_POST['userid'], $_POST['userpass']);
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
                <h1 class="h3 mb-0 text-gray-800"><i class='fas fa-user-md'></i> Health Worker</h1>
                <a href="Useradd.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-external-link-alt"></i> New Health Worker</a>
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
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-table"></i> Health Worker List</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <th>#</th>
                                        <th>Profile Image</th>
                                        <th>Full Name</th>
                                        <th>Position</th>
                                        <th>Full Information</th>
                                        <th>Create Account</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $num=1;
                                        $health=mysqli_query($db,"SELECT * FROM health");
                                        while($rowu=mysqli_fetch_assoc($health)){
                                        ?>
                                        <tr>
                                            <td><?php echo $num++;?></td>
                                            <td><img src="<?php echo $rowu['profile_image'];?>" alt="" width="30"></td>
                                            <td><?php echo $rowu['fname']." ".$rowu['mname']." ".$rowu['lname'];?></td>
                                            <td><?php echo $rowu['status'];?></td>
                                            <td><a class="btn btn-sm btn-primary" href="Userinfo.php?userid=<?php echo $rowu['id'];?>"><i class="fas fa-eye"></i></a></td>
                                            <td>
                                            <form action="" method="post" enctype="multipart/form-data">
                                                <button class="btn btn-sm btn-primary" id="createaccount" name="createaccount"><i class="fas fa-plus-circle"></i></button></td>
                                                <input type="hidden" id="userid" name="userid" value="<?php echo $rowu['id'];?>">
                                                <input type="hidden" id="userpass" name="userpass"  value="<?php echo $rowu['lname'];?>">
                                            </form>
                                            <td>
                                            <form action="" method="post" enctype="multipart/form-data">
                                                <a class="btn btn-sm btn-secondary" href="Userupdate.php?userid=<?php echo $rowu['id'];?>">Update</a>
                                                <button class="btn btn-sm btn-danger" id="deleteuser" name="deleteuser">Delete</button>
                                                <input type="hidden" id="userid" name="userid" value="<?php echo $rowu['id'];?>">
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