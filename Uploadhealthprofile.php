<?php
     include "include/database.php";

     $userid = $_SESSION['userid'];

     $query = mysqli_query($db, "SELECT * FROM user WHERE id='$userid'");
     $rowq = mysqli_fetch_assoc($query);

     $heathid = mysqli_query($db, "SELECT * FROM Health WHERE id='".$rowq['healthid']."'");
     $rowhi = mysqli_fetch_assoc($heathid);

        if(isset($_POST["image"]))
        {
            $data = $_POST["image"];
            $image_array_1 = explode(";", $data);
            $image_array_2 = explode(",", $image_array_1[1]);
            $data = base64_decode($image_array_2[1]);
            $imageName = 'Profileimage/'.$rowhi['fname'].'_'.$rowhi['lname'].'.png';
            file_put_contents($imageName, $data);

            $query = mysqli_query($db, "UPDATE Health SET profile_image='$imageName' WHERE id='".$rowq['healthid']."'");
            
        }
        $_SESSION['message'] = array('type'=>'success', 'msg'=>'Upload Profile Image Successful!');
        header('Location: Settings.php');
?>