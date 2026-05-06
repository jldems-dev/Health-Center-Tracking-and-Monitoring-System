<?php
include "functions.php";
 date_default_timezone_set("Asia/Manila");
 $date = date("Y-m-d h:i:s A");

if(isset($_POST['uploadfile'])){

    if($_FILES["fileToUpload"]["name"] != ''){

 $data = explode(".", $_FILES["fileToUpload"]["name"]);
 $extension = $data[1];
 $allowed_extension = array("pdf", "doc", "docx", "jpg", "JPG", "PNG", "png");

 if(in_array($extension, $allowed_extension)){

    $new_file_name =  $_POST['filename']. '.' . $extension;

    echo $new_file_name;
    $path =   'Patients_medical_record/' . $new_file_name;

    mysqli_query($db,"INSERT INTO medical_record_patient (patientid,medrecordid,file_name,file_path,date) VALUES ('".$_POST['patientid']."','".$_POST['medicalrecordid']."','$new_file_name','$path','$date')");

    if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $path)){

    $_SESSION['message'] = array('type'=>'success', 'msg'=>'Successfully File Uploaded!');
    header('Location: Medicalfiles.php?patientid='.urlencode($_POST['patientid']).'&medicalrecordid='.urlencode($_POST['medicalrecordid']));

    }else{
    $_SESSION['message'] = array('type'=>'danger', 'msg'=>'There is some error while File Uploaded!');
    header('Location: Medicalfiles.php?patientid='.urlencode($_POST['patientid']).'&medicalrecordid='.urlencode($_POST['medicalrecordid']));
    }
 }else{
  $_SESSION['message'] = array('type'=>'danger', 'msg'=>'Invalid File!');
    header('Location: Medicalfiles.php?patientid='.urlencode($_POST['patientid']).'&medicalrecordid='.urlencode($_POST['medicalrecordid']));
 }
 
}else{
 $_SESSION['message'] = array('type'=>'warning', 'msg'=>'Please Select File!');
    header('Location: Medicalfiles.php?patientid='.urlencode($_POST['patientid']).'&medicalrecordid='.urlencode($_POST['medicalrecordid']));
}

}
?>