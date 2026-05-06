<?php
include "functions.php";

$userids = $_GET['userid'];

$userinfo=mysqli_query($db,"SELECT * FROM health WHERE id='$userids'");
$rowui=mysqli_fetch_assoc($userinfo);

$userpos = mysqli_query($db, "SELECT * FROM user WHERE healthid='$userids'");
$rowup = mysqli_fetch_assoc($userpos);

if(isset($_POST['updateuser'])){
    updateuser($_POST['username'],$_POST['fname'],$_POST['mname'],$_POST['lname'],
               $_POST['address'],$_POST['pnumber'],$_POST['bday'],$_POST['age'],
               $_POST['gender'],$_POST['status'],$_POST['cvstatus'],$_POST['userid']);
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
                <h1 class="h3 mb-0 text-gray-800">Update Health Worker</h1>
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
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">User Update Form</h6>
                        </div>
                        <div class="card-body">
                        <form class="user" action="" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-sm-12">
                                       <div class="text-center">
                                           <img src="<?php echo $rowui['profile_image']; ?>" alt="" width="150"><br>
                                           <label for=""><b>Profile Image Review</b></label>
                                       </div>
                                    </div>
                                    <hr>
                                    <div class="col-sm-12 pt-2">
                                       <label for=""><b>User Name</b></label>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="" Style="font-size: 12px;">First Name</label>
                                            <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $rowui['fname']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="" Style="font-size: 12px;">Middle Name</label>
                                            <input type="text" class="form-control" id="mname" name="mname" value="<?php echo $rowui['mname']; ?>"  required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="" Style="font-size: 12px;">Last Name</label>
                                            <input type="text" class="form-control" id="lname" name="lname"value="<?php echo $rowui['lname']; ?>"  required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                       <label for=""><b>Contact Information</b> </label>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="" Style="font-size: 12px;">Address</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="address" name="address" value="<?php echo $rowui['address']; ?>"  required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="" Style="font-size: 12px;">Phone number</label>
                                        <div class="form-group">
                                            <input type="number" class="form-control" id="pnumber" name="pnumber" value="<?php echo $rowui['phone_number']; ?>"  required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                       <label for=""><b>Birth</b> </label>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="" Style="font-size: 12px;">Birth Date</label>
                                        <div class="form-group">
                                            <input type="date" class="form-control" id="bday" name="bday" value="<?php echo $rowui['b_day']; ?>"  required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="" Style="font-size: 12px;">Age</label>
                                            <input type="number" class="form-control" id="age" name="age" value="<?php echo $rowui['age']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                       <label for=""><b>Status</b></label>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="" Style="font-size: 12px;">Gender</label>
                                            <select name="gender" id="gender" class="form-control" required>
                                                <option value="<?php echo $rowui['gender']; ?>"><?php echo $rowui['gender']; ?></option>
                                                <option>Male</option>
                                                <option>Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="" Style="font-size: 12px;">Position</label>
                                            <select name="status" id="status" class="form-control">
                                                <option value="<?php echo $rowui['status']; ?>"><?php echo $rowui['status']; ?></option>
                                                <option>Administrator</option>
                                                <option>Midwife</option>
                                                <option>BHW</option>
                                                <option>Nurse</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="" Style="font-size: 12px;">Civil Status</label>
                                            <select name="cvstatus" id="cvstatus" class="form-control">
                                                <option value="<?php echo $rowui['cvstatus']; ?>"><?php echo $rowui['cvstatus']; ?></option>
                                                <option>Married</option>
                                                <option>Single</option>
                                                <option>Divorced</option>
                                                <option>Widowed</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" id="updateuser" name="updateuser" class="btn btn-primary btn-sm"><i class="fas fa-external-link-alt"></i> Update</button>
                                <input type="hidden" name="userid" id="userid" value="<?php echo $userids;?>">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php 
include "include/script.php"; 
?>