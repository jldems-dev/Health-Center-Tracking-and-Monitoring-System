<?php
include "functions.php";

if(isset($_POST['updateprofileinfo'])){
    updateprofileinfo($_POST['fname'],$_POST['mname'],$_POST['lname'],
    $_POST['address'],$_POST['pnumber'],$_POST['bday'],$_POST['age'],
    $_POST['gender'],$_POST['status'],$_POST['cvstatus'],$_POST['healthid'],$_POST['userid']);

}
if(isset($_POST['updateprofileaccount'])){
    updateprofileaccount($_POST['username'],$_POST['oldpass'],$_POST['newpass'],$_POST['userid']);
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
                <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i> Settings</h1>
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
                <div class="col-lg-4 pt-2">
                    <div class="card shadow mb-4">
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-user-circle"></i> Update Profile Account</h6>
                        </div>
                        <div class="card-body text-center">
                            <img src="<?php echo $rowh['profile_image']; ?>" alt="" width="50%">
                            <input type="file" class="pt-5" name="before_crop_image" id="before_crop_image" accept="image/*" />
                        </div>
                        <hr>
                        <form class="user" action="" method="post" enctype="multipart/form-data">
                            <div class="col-sm-12">
                                <p>
                                    <b>Username: </b><input type="text" class="form-control" value="<?php echo $rowu['username'];?>" disabled>
                                </p>
                                <p>
                                <b>Password: </b><input type="password" class="form-control" value="<?php echo $rowu['password'];?>" disabled>
                                </p>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="" Style="font-size: 12px;">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" required>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="" Style="font-size: 12px;">Old Password</label>
                                    <input type="password" class="form-control" id="oldpass" name="oldpass" required>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="" Style="font-size: 12px;">New Password</label>
                                    <input type="password" class="form-control" id="newpass" name="newpass" required>
                                </div>
                            </div>
                            <div class="col-sm-12 pb-3">
                                <button type="submit" id="updateprofileaccount" name="updateprofileaccount" class="btn btn-primary btn-sm"><i class="fas fa-external-link-alt"></i> Update Profile Account </button>
                                <input type="hidden" id="userid" name="userid" value="<?php  echo $userid;?>">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-8 pt-2">
                    <div class="card shadow mb-4">
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-address-card"></i> Update Profile Information</h6>
                        </div>
                        <div class="card-body">
                            <form class="user" action="" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-sm-12">
                                       <label for=""><b>Full Name</b></label>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="" Style="font-size: 12px;">First Name</label>
                                            <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $rowh['fname']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="" Style="font-size: 12px;">Middle Name</label>
                                            <input type="text" class="form-control" id="mname" name="mname" value="<?php echo $rowh['mname']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="" Style="font-size: 12px;">Last Name</label>
                                            <input type="text" class="form-control" id="lname" name="lname" value="<?php echo $rowh['lname']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                       <label for=""><b>Contact Information</b> </label>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="" Style="font-size: 12px;">Address</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="address" name="address" value="<?php echo $rowh['address'];?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="" Style="font-size: 12px;">Phone number</label>
                                        <div class="form-group">
                                            <input type="number" class="form-control" id="pnumber" name="pnumber" value="<?php echo $rowh['phone_number'];?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                       <label for=""><b>Birth</b> </label>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="" Style="font-size: 12px;">Birth Date</label>
                                        <div class="form-group">
                                            <input type="date" class="form-control" id="bday" name="bday" value="<?php echo $rowh['b_day'];?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="" Style="font-size: 12px;">Age</label>
                                            <input type="number" class="form-control" id="age" name="age" value="<?php echo $rowh['age'];?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                       <label for=""><b>Status</b></label>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="" Style="font-size: 12px;">Gender</label>
                                            <select name="gender" id="gender" class="form-control" required>
                                                <option value="<?php echo $rowh['gender']; ?>"><?php echo $rowh['gender']; ?></option>
                                                <option>Male</option>
                                                <option>Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="" Style="font-size: 12px;">Position</label>
                                            <select name="status" id="status" class="form-control">
                                                <option value="<?php echo $rowh['status'];?>"><?php echo $rowh['status'];?></option>
                                                <option>Administrator</option>
                                                <option>Midwife</option>
                                                <option>BHW</option>
                                                <option>Nurse</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="" Style="font-size: 12px;">Civil Status</label>
                                            <select name="cvstatus" id="cvstatus" class="form-control">
                                                <option value="<?php echo $rowh['cvstatus']; ?>"><?php echo $rowh['cvstatus'];?></option>
                                                <option>Married</option>
                                                <option>Single</option>
                                                <option>Divorced</option>
                                                <option>Widowed</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" id="updateprofileinfo" name="updateprofileinfo" class="btn btn-primary btn-sm"><i class="fas fa-external-link-alt"></i> Update Profile</button>
                                <input type="hidden" id="healthid" name="healthid" value="<?php echo $rowh['id']; ?>">
                                <input type="hidden" id="userid" name="userid" value="<?php  echo $userid;?>">
                            </form>
                        </div>
                    </div>
            </div>
        </div>
        <div id="imageModel" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Crop & Resize Upload Profile Image</h4>
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-8 text-center">
                                <div id="image_demo" style="width:350px; margin-top:30px"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary crop_image btn-sm"><i class="fa-solid fa-crop-simple"></i> Crop & Upload</button>
                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
<?php 
include "include/script.php"; 
?>