<?php
include "functions.php";
$medicineid = $_GET['medicineid'];

$medicine = mysqli_query($db, "SELECT * FROM medicine WHERE id='$medicineid'");
$rowm = mysqli_fetch_assoc($medicine);

if(isset($_POST['updatemedicine'])){
    updatemedicine($_POST['medicine'], $_POST['quantity'], $_POST['medicineid']);
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
                <h1 class="h3 mb-0 text-gray-800">Update Medicine</h1>
                <a href="Medicine.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-backspace"></i> Back Medicine</a>
            </div>
            <div class="row">
                <?php
                if(isset($_SESSION['message'])){
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
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Medicine Update Form</h6>
                        </div>
                        <div class="card-body">
                            <form class="user" action="" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-sm-12">
                                       <label for=""><b>Medicine Information</b></label>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="medicine" name="medicine" value="<?php echo $rowm['medicine_name'];?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input type="number" class="form-control" id="quantity" name="quantity" value="<?php echo $rowm['quantity'];?>" required>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" id="updatemedicine" name="updatemedicine" class="btn btn-primary btn-sm"><i class="fas fa-external-link-alt"></i> Update Medicine</button>
                                <input type="hidden" id="medicineid" name="medicineid" value="<?php echo $medicineid; ?>">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php 
include "include/script.php"; 
?>