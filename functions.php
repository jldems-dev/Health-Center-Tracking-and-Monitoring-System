<?php
    include "include/database.php";
    if(!isset($_SESSION['userid']))
    {
        header('location:login.php');
        exit;
    }

    $userid = $_SESSION['userid'];

    $userinfo = mysqli_query($db, "SELECT * FROM user WHERE id='$userid'");
    $rowu = mysqli_fetch_assoc($userinfo);

    $healthinfo = mysqli_query($db,"SELECT * FROM health WHERE id='".$rowu['healthid']."'");
    $rowh=mysqli_fetch_assoc($healthinfo);
   
    date_default_timezone_set("Asia/Manila");
    $date = date("Y-m-d h:i:s A");
    /* add functions */
  function addpatient($fname = NULL, $mname = NULL, $lname = NULL, $address = NULL, $bday=NULL,$bplace=NULL, $age = NULL, $gender = NULL, $status = NULL, $cvstatus= NULL, $bps= NULL, $bpd= NULL,$pr= NULL, $rr= NULL,$temp= NULL, $wt= NULL, $ht=NULL, $bt=NULL, $phonenum=NULL, $refferredfrom=NULL, $refferredto=NULL) {
   global $db;
   $date = date("Y-m-d h:i:s A");

    $stmt = $db->prepare('INSERT INTO patient (fname,mname,lname,address,b_date,b_place,age,gender,status,cvstatus,bps,bpd,pr,rr,temp,wt,ht,bt,phonenum,date, refferred_from, refferred_to) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->bind_param('sssssssssssssssssissss',$fname, $mname, $lname, $address, $bday, $bplace, $age, $gender, $status, $cvstatus, $bps, $bpd, $pr, $rr, $temp, $wt,$ht,$bt,$phonenum,$date, $refferredfrom, $refferredto);
    $stmt->execute();
    $stmt->close();

    $_SESSION['message'] = array('type'=>'success', 'msg'=>'Successfully added a new Patient');
    header('Location: Patientform.php');
    exit();
  }
  function addillness($illness = NULL, $description = NULL) {

   global $db;
    $stmt = $db->prepare('INSERT INTO illness (illness_name,description) VALUES (?, ?)');
    $stmt->bind_param('ss',$illness, $description);
    $stmt->execute();
    $stmt->close();
    $_SESSION['message'] = array('type'=>'success', 'msg'=>'Successfully added a new Illness');
    header('Location: Illnessform.php');
    exit(); 
  }

  function addimmunize($immunizename = NULL, $y = NULL, $sdate=NULL) {

    global $db;
     $stmt = $db->prepare('INSERT INTO immunization (immunize_name,year,start_date) VALUES (?, ?, ?)');
     $stmt->bind_param('sss',$immunizename, $y, $sdate);
     $stmt->execute();
     $stmt->close();
     $_SESSION['message'] = array('type'=>'success', 'msg'=>'Successfully added a new Immunize Name');
     header('Location: Immunizationadd.php');
     exit(); 
   }

   function adduser($fname = NULL, $mname = NULL, $lname = NULL, $address = NULL, $pnumber = NULL, $bday=NULL, $age = NULL, $gender = NULL, $status = NULL, $cvstatus= NULL) {
    global $db;

    $string="12345";
    $pimage="Profileimage/user.png";

     $stmt = $db->prepare('INSERT INTO health (fname,mname,lname,address,phone_number,b_day,age,gender,cvstatus,status,profile_image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
     $stmt->bind_param('sssssssssss',$fname, $mname, $lname, $address,$pnumber, $bday, $age, $gender, $cvstatus, $status, $pimage);
     $stmt->execute();
     $stmt->close();
     $_SESSION['message'] = array('type'=>'success', 'msg'=>'Successfully added a new User');
     header('Location: User.php');
     exit();
   }
   function addmedspatient($patientid,$illnessid,$lmpatientid,$illnessname,$medicine=NULL, $quantity=NULL,$date=NULL){
    global $db;

    echo $patientid;
    echo $illnessid;

    $stmt = $db->prepare('INSERT INTO illness_patients_record (patient_id,illness_id,medicine,quantity,date) VALUE (?, ?, ?, ?, ?)');
    $stmt->bind_param('iisss',$patientid,$illnessid,$medicine,$quantity,$date);
    $stmt->execute();
    $stmt->close();
 
    $medicinelist="SELECT * FROM medicine";
    $stmt = $db->prepare($medicinelist);
    $stmt->execute();
    $result = $stmt->get_result();
    while($medicine1 = $result->fetch_assoc()){

    if($medicine1['medicine_name'] == $medicine){

      $newtotal = $medicine1['quantity'] - $quantity;
      $medicineid = $medicine1['id'];

      $stmt = $db->prepare('UPDATE medicine SET quantity=? WHERE id=?');
      $stmt->bind_param('ii',$newtotal,$medicineid);
      $stmt->execute();
      $stmt->close();
    }
  }

    $_SESSION['message'] = array('type'=>'success', 'msg'=>'Successfully added a Medicine to Patient');
    header("Location: Illnessptntrcrd.php?patientid=".urlencode($patientid)."&lmpatientid=".urlencode($lmpatientid)."&illnessname=".urlencode($illnessname)."&illnessid=".urlencode($illnessid));
    exit();
  }
  function addappointment($inchargename = NULL, $startt = NULL, $endt = NULL, $note=NULL) {
    global $db;

     $stmt = $db->prepare('INSERT INTO appointment (healthid,start,end,title) VALUES (?, ?, ?, ?)');
     $stmt->bind_param('isss',$inchargename, $startt, $endt, $note);
     $stmt->execute();
     $stmt->close();
     $_SESSION['message'] = array('type'=>'success', 'msg'=>'Successfully added a new Appointment');
     header('Location: Appointmentadd.php');
     exit();
   }

   function selectappaptients($apptnmtid, $patientid){
    global $db;
      $status = 1;
     $stmt = $db->prepare('INSERT INTO appntmnt_patients (apptmntid,patientid,status) VALUES (?, ?, ?)');
     $stmt->bind_param('iii',$apptnmtid, $patientid, $status);
     $stmt->execute();
     $stmt->close();
     $_SESSION['message'] = array('type'=>'success', 'msg'=>'Successfully Select a Patient');
     header('Location: Appointmentpatients.php?apptnmntid='.urlencode($apptnmtid));
     exit(); 
   }

   function addmedrecord($recordname, $patientid, $date){
    global $db;

     $stmt = $db->prepare('INSERT INTO medical_record (patientid,rname,date) VALUES (?, ?, ?)');
     $stmt->bind_param('iss',$patientid, $recordname, $date);
     $stmt->execute();
     $stmt->close();
     $_SESSION['message'] = array('type'=>'success', 'msg'=>'Successfully add New Medical Record');
     header('Location: Medicaladd.php?patientid='.urlencode($patientid));
     exit(); 
   }

   function addprenatal($prenatalname = NULL, $sdate=NULL, $y = NULL){
    global $db;

     $stmt = $db->prepare('INSERT INTO prenatal (prenatal_name,year,date) VALUES (?, ?, ?)');
     $stmt->bind_param('sss',$prenatalname, $y, $sdate);
     $stmt->execute();
     $stmt->close();
     $_SESSION['message'] = array('type'=>'success', 'msg'=>'Successfully add New Prenatal Record');
     header('Location: Prenataladd.php');
     exit(); 
   }

   function createaccount($userid, $userpass){
    global $db;

      $useracc="SELECT * FROM user WHERE healthid='$userid'";
      $stmt = $db->prepare($useracc);
      $stmt->execute();
      $result = $stmt->get_result();
      $rowuseracc = $result->fetch_assoc();

      if($rowuseracc['healthid'] != $userid){

      $pass = md5($userpass);
      $stmt = $db->prepare('INSERT INTO user (healthid,username,password) VALUES (?, ?, ?)');
      $stmt->bind_param('iss',$userid, $userpass, $pass);
      $stmt->execute();
      $stmt->close();
      $_SESSION['message'] = array('type'=>'success', 'msg'=>'Successfully Add New Prenatal Record');

      }else{
        $_SESSION['message'] = array('type'=>'warning', 'msg'=>'Health Account is Already Added!');
      }
      header('Location: User.php');
      exit(); 
   }
  /* add functions */

  /* delete functions */
  function deletepatient($patientid){
    global $db;
    $stmt = $db->prepare('DELETE FROM patient WHERE id=?');
    $stmt->bind_param('i', $patientid);
    $stmt->execute();
    $stmt->close();

    $_SESSION['message'] = array('type'=>'success', 'msg'=>'Successfully delete');
    header("Location: Patient.php");
    exit();
  }

  function deleteillness($illnessid){
    global $db;
    $stmt = $db->prepare('DELETE FROM illness WHERE id=?');
    $stmt->bind_param('i', $illnessid);
    $stmt->execute();
    $stmt->close();

    $stmt = $db->prepare('DELETE FROM illness_patients WHERE illness_id=?');
    $stmt->bind_param('i', $illnessid);
    $stmt->execute();
    $stmt->close();

    $_SESSION['message'] = array('type'=>'success', 'msg'=>'Successfully delete');
    header("Location: Illness.php");
    exit();
  }
  function delete_p_monitor($patientid, $illnessid,$illnessname){
    global $db;
    $stmt = $db->prepare('DELETE FROM illness_patients WHERE id=?');
    $stmt->bind_param('i', $patientid);
    $stmt->execute();
    $stmt->close();

    $_SESSION['message'] = array('type'=>'success', 'msg'=>'Successfully delete');
    header("Location: Illnessmonitor.php?illnessid=".urlencode($illnessid)."&illnessname=".urlencode($illnessname));
    exit();
  }
  /* Immunization Delete Funtion*/
  function deleteimunize($immunizeid){
    global $db;

    $ip="SELECT * FROM immunize_patients WHERE immunize_id='$immunizeid'";
    $stmt = $db->prepare($ip);
    $stmt->execute();
    $result = $stmt->get_result();
    while($rowip = $result->fetch_assoc()){
    
      $ipid = $rowip['id'];
    $stmt = $db->prepare('DELETE FROM immunize_patients_record WHERE immunize_patient_id=?');
    $stmt->bind_param('i', $ipid);
    $stmt->execute();
    $stmt->close();
    }

    $stmt = $db->prepare('DELETE FROM immunization WHERE id=?');
    $stmt->bind_param('i', $immunizeid);
    $stmt->execute();
    $stmt->close();

    $stmt = $db->prepare('DELETE FROM immunize_patients WHERE immunize_id=?');
    $stmt->bind_param('i', $immunizeid);
    $stmt->execute();
    $stmt->close();

    $_SESSION['message'] = array('type'=>'success', 'msg'=>'Successfully delete');
    header("Location: Immunization.php");
    exit();
  }

  function delete_immunize_patient($immunizeid, $immunizepatientid){
    global $db;

    $stmt = $db->prepare('DELETE FROM immunize_patients WHERE id=?');
    $stmt->bind_param('i', $immunizepatientid);
    $stmt->execute();
    $stmt->close();

    $stmt = $db->prepare('DELETE FROM immunize_patients_record WHERE immunize_patient_id=?');
    $stmt->bind_param('i', $immunizepatientid);
    $stmt->execute();
    $stmt->close();

    $_SESSION['message'] = array('type'=>'success', 'msg'=>'Successfully delete');
    header("Location: Immunizationmonitor.php?immunizeid=".urlencode($immunizeid));
    exit();
  }
  /* Immunization Delete Funtion*/
  function deleteuser($userid){
    global $db;
    $stmt = $db->prepare('DELETE FROM user WHERE id=?');
    $stmt->bind_param('i', $userid);
    $stmt->execute();
    $stmt->close();

    $_SESSION['message'] = array('type'=>'success', 'msg'=>'Successfully delete');
    header("Location: User.php");
    exit();
  }
  function removeinputmed($patientids,$lmpatientids,$illnessname,$illnessid,$num_meds){
    global $db;
    $num_meds1 = $num_meds - 1;

    $stmt = $db->prepare('UPDATE illness_patients SET num_medicine=? WHERE id=?');
    $stmt->bind_param('ii',$num_meds1,$lmpatientids);
    $stmt->execute();
    $stmt->close();
    header("Location: Illnessptntrcrd.php?patientid=".urlencode($patientids)."&lmpatientid=".urlencode($lmpatientids)."&illnessname=".urlencode($illnessname)."&illnessid=".urlencode($illnessid));
    exit();
  }

  function deleteapptnmnt($apptnmntid){
    global $db;
    $stmt = $db->prepare('DELETE FROM appointment WHERE id=?');
    $stmt->bind_param('i', $apptnmntid);
    $stmt->execute();
    $stmt->close();

    $_SESSION['message'] = array('type'=>'success', 'msg'=>'Successfully Delete');
    header("Location: Appointment.php");
    exit();
  }

  function deletepselected($pselectedid, $apptnmntid){
    global $db;
    $stmt = $db->prepare('DELETE FROM appntmnt_patients WHERE id=?');
    $stmt->bind_param('i', $pselectedid);
    $stmt->execute();
    $stmt->close();

    $_SESSION['message'] = array('type'=>'success', 'msg'=>'Successfully delete');
    header("Location: Appointmentpatients.php?apptnmntid=".urlencode($apptnmntid));
    exit();
  }

  function deleteprenatal($prenatalid){
    global $db;
    $stmt = $db->prepare('DELETE FROM prenatal WHERE id=?');
    $stmt->bind_param('i', $prenatalid);
    $stmt->execute();
    $stmt->close();

    $_SESSION['message'] = array('type'=>'success', 'msg'=>'Successfully delete');
    header("Location: Prenatal.php");
    exit();
  }

  function delete_prenatal_patient($prenatalid, $prenatalpatientid){
    global $db;
    $stmt = $db->prepare('DELETE FROM prenatal_patients WHERE id=?');
    $stmt->bind_param('i', $prenatalpatientid);
    $stmt->execute();
    $stmt->close();

    $_SESSION['message'] = array('type'=>'success', 'msg'=>'Successfully delete');
    header("Location: Prenatalpatients.php?prenatalid=".urlencode($prenatalid));
    exit();
  }

  function deletepatientrecord($patientmedrecid, $patientid){
    global $db;
    $stmt = $db->prepare('DELETE FROM medical_record WHERE id=?');
    $stmt->bind_param('i', $patientmedrecid);
    $stmt->execute();
    $stmt->close();

    $_SESSION['message'] = array('type'=>'success', 'msg'=>'Successfully delete');
    header("Location: Medicaladd.php?patientid=".urlencode($patientid));
    exit();
  }

  function deletepfiles($pfilesid,$pfilepath, $patientid, $medicalrecordid){
    global $db;
    $stmt = $db->prepare('DELETE FROM medical_record_patient WHERE id=?');
    $stmt->bind_param('i', $pfilesid);
    $stmt->execute();
    $stmt->close();

    unlink($pfilepath);
    $_SESSION['message'] = array('type'=>'success', 'msg'=>'Successfully delete');
    header("Location: Medicalfiles.php?patientid=".urlencode($patientid)."&medicalrecordid=".urlencode($medicalrecordid));
    exit();
  }
   /* delete functions */

   /* Update Funtions */
   function updatepatient($patientid, $fname = NULL, $mname = NULL, $lname = NULL, $address = NULL, $bday=NULL, $bplace=NULL, $age = NULL, $gender = NULL, $status = NULL, $cvstatus= NULL, $bps= NULL, $bpd= NULL, $pr= NULL, $rr= NULL, $temp= NULL, $wt= NULL,$ht=NULL,$bt=NULL,$phonenum = NULL) {
    global $db;
     $stmt = $db->prepare('UPDATE patient SET fname=?,mname=?,lname=?,address=?,b_date=?,b_place=?,age=?,gender=?,status=?,cvstatus=?,bps=?, bpd=?, pr=?,rr=?,temp=?,wt=?,ht=?,bt=?,phonenum=? WHERE id=?');
     $stmt->bind_param('sssssssssssssssssssi',$fname, $mname, $lname, $address, $bday,$bplace, $age, $gender, $status, $cvstatus, $bps, $bpd, $pr, $rr, $temp, $wt, $ht, $bt, $phonenum, $patientid);
     $stmt->execute();
     $stmt->close();
     $_SESSION['message'] = array('type'=>'success', 'msg'=>'Successfully update a Patient');
     header('Location: Patientupdate.php?patientid='.urlencode($patientid));
     exit();
   }

  function updateillness($illnessid, $illness = NULL, $description = NULL) {
      global $db;

     $stmt = $db->prepare('UPDATE illness SET illness_name=?, description=? WHERE id=?');
     $stmt->bind_param('ssi', $illness, $description, $illnessid);
     $stmt->execute();
     $stmt->close(); 

      $_SESSION['message'] = array('type'=>'success', 'msg'=>'Successfully Update a Illness');
     header('Location: Illnessupdate.php?illnessid='.urlencode($illnessid));
     exit(); 
   }
  function updatecondition($lmpatientids,  $condition=NULL, $patientids, $cdate=NULL, $nvdate=NULL, $illnessname, $illnessid,$concern=NULL, $medicine=NULL, $quantity=NULL) {
    global $db;
 
    $stmt = $db->prepare('UPDATE illness_patients SET conditions=?,consulted_date=?,next_visit_date=?,medicine=?, quantity=?,concern=? WHERE id=?');
    $stmt->bind_param('ssssssi', $condition, $cdate, $nvdate, $medicine, $quantity, $concern, $lmpatientids);
    $stmt->execute();
    $stmt->close();

    $_SESSION['message'] = array('type'=>'success', 'msg'=>'Successfully Update Patients Condition');
   header('Location: Illnessmonitorupdate.php?patientid='.urlencode($patientids).'&lmpatientid='.urlencode($lmpatientids).'&illnessname='.urlencode($illnessname).'&illnessid='.urlencode($illnessid));
   exit();
 }
  function updateimmunize($immunizename = NULL, $y = NULL, $sdate=NULL, $immunizeid) {
    global $db;

  $stmt = $db->prepare('UPDATE immunization SET immunize_name=?, year=?, start_date=? WHERE id=?');
  $stmt->bind_param('sssi', $immunizename, $y, $sdate, $immunizeid);
  $stmt->execute();
  $stmt->close(); 

    $_SESSION['message'] = array('type'=>'success', 'msg'=>'Successfully Update a Immunize Record');
  header('Location: Immunizationupdate.php?immunizeid='.urlencode($immunizeid));
  exit(); 
  }
  function updateuser($username=NULL, $fname = NULL, $mname = NULL, $lname = NULL, $address = NULL, $pnumber = NULL, $bday=NULL, $age = NULL, $gender = NULL, $status = NULL, $cvstatus= NULL, $userid) {
    global $db;

     $stmt = $db->prepare('UPDATE user SET username=?, fname=?, mname=?, lname=?, address=?, phone_number=?, b_day=?, age=?, gender=?, cvstatus=?, position=? WHERE id=?');
     $stmt->bind_param('sssssssssssi',$username, $fname, $mname, $lname, $address, $pnumber, $bday, $age, $gender, $cvstatus, $status, $userid);
     $stmt->execute();
     $stmt->close();
     $_SESSION['message'] = array('type'=>'success', 'msg'=>'Successfully Update User');
     header('Location: Userupdate.php?userid='.urlencode($userid));
     exit();
   }
   function resetpassword($userid){
    global $db;

    $password = md5("12345");

   $stmt = $db->prepare('UPDATE user SET password=? WHERE id=?');
   $stmt->bind_param('si', $password, $userid);
   $stmt->execute();
   $stmt->close();

    $_SESSION['message'] = array('type'=>'success', 'msg'=>'Successfully Reset Password of User');
   header('Location: Userupdate.php?userid='.urlencode($userid));
   exit(); 
 }
 function updateappointment($inchargename = NULL, $startt = NULL, $endt = NULL, $note=NULL, $apptnmntid) {
  global $db;

  $stmt = $db->prepare('UPDATE appointment SET healthid=?, start=?, end=?, title=? WHERE id=?');
  $stmt->bind_param('isssi', $inchargename, $startt, $endt, $note, $apptnmntid);
  $stmt->execute();
  $stmt->close();

   $_SESSION['message'] = array('type'=>'success', 'msg'=>'Successfully update Appointment');
   header('Location: Appointmentupdate.php?apptnmntid='.urlencode($apptnmntid));
   exit();
 }

 function updatepsimmunize($patientid, $immunizeid, $immunizepatientid, $statusv = NULL, $datev=NULL) {
  global $db;

  $stmt = $db->prepare('UPDATE immunize_patients SET status_visit=?, date_visit=? WHERE id=?');
  $stmt->bind_param('ssi', $statusv,$datev, $immunizepatientid);
  $stmt->execute();
  $stmt->close();

  $stmt = $db->prepare('INSERT INTO immunize_patients_record (immunize_patient_id, status_visit, date_visit) VALUES (?, ?, ?)');
  $stmt->bind_param('iss',$immunizepatientid, $statusv, $datev);
  $stmt->execute();
  $stmt->close();

   $_SESSION['message'] = array('type'=>'success', 'msg'=>'Successfully update Appointment');
   header('Location: Immunemonitorupdate.php?patientid='.urlencode($patientid).'&immunizeid='.urlencode($immunizeid).'&immunizepatientid='.urlencode($immunizepatientid));
   exit();
 }

 function updateprofileaccount($username=NULL, $oldpass=NULL, $newpass=NULL, $userid) {
    global $db;
    
   
    $oldpass = md5($oldpass);

    $useracc="SELECT * FROM user WHERE id='$userid'";
    $stmt = $db->prepare($useracc);
    $stmt->execute();
    $result = $stmt->get_result();
    $rowuseracc = $result->fetch_assoc();

    if($rowuseracc['password'] == $oldpass){
      $newpass = md5($newpass);

      $stmt = $db->prepare('UPDATE user SET username=?, password=? WHERE id=?');
      $stmt->bind_param('ssi',$username, $newpass, $userid);
      $stmt->execute();
      $stmt->close();

      $_SESSION['message'] = array('type'=>'success', 'msg'=>'Successfully update Profile Account');
      header('Location: Settings.php');
      exit();
    }else{
      $_SESSION['message'] = array('type'=>'danger', 'msg'=>'Old Password Invalid!!');
      header('Location: Settings.php');
      exit();
    }
 }
 function updateprofileinfo($fname = NULL, $mname = NULL, $lname = NULL, $address = NULL, $pnumber = NULL, $bday=NULL, $age = NULL, $gender = NULL, $status = NULL, $cvstatus= NULL, $healthid, $userid) {
  global $db;

   $stmt = $db->prepare('UPDATE health SET fname=?, mname=?, lname=?, address=?, phone_number=?, b_day=?, age=?, gender=?, cvstatus=? WHERE id=?');
   $stmt->bind_param('sssssssssi',$fname, $mname, $lname, $address, $pnumber, $bday, $age, $gender, $cvstatus, $healthid);
   $stmt->execute();
   $stmt->close();

   $stmt = $db->prepare('UPDATE user SET position=? WHERE id=?');
   $stmt->bind_param('si',$status, $userid);
   $stmt->execute();
   $stmt->close();

   $_SESSION['message'] = array('type'=>'success', 'msg'=>'Successfully Update Profile Informations');
   header('Location: Settings.php');
   exit();
 }

 function updateprenatal($prenatalname = NULL, $sdate = NULL, $y = NULL, $prenatalid) {
  global $db;

  $stmt = $db->prepare('UPDATE prenatal SET prenatal_name=?, year=?, date=? WHERE id=?');
  $stmt->bind_param('sssi', $prenatalname, $y,$sdate, $prenatalid);
  $stmt->execute();
  $stmt->close();

   $_SESSION['message'] = array('type'=>'success', 'msg'=>'Successfully update Prenatal Record');
   header('Location: Prenatalupdate.php?prenatalid='.urlencode($prenatalid));
   exit();
 }

 function updatepsprenatal($patientid, $prenatalid, $prenatalpatientid, $statusv = NULL, $quarter=NULL, $concern=NULL, $datev=NULL) {
  global $db;

  $stmt = $db->prepare('UPDATE prenatal_patients SET status_visit=?,quarter=?,concern=?, date_visit=? WHERE id=?');
  $stmt->bind_param('ssssi', $statusv, $quarter, $concern,$datev, $prenatalpatientid);
  $stmt->execute();
  $stmt->close();

  $stmt = $db->prepare('INSERT INTO prenatal_patients_record (prenatal_patient_id, status_visit,quarter, concern, date_visit) VALUES (?, ?, ?, ?, ?)');
  $stmt->bind_param('issss',$prenatalpatientid, $statusv,$quarter, $concern, $datev);
  $stmt->execute();
  $stmt->close();

   $_SESSION['message'] = array('type'=>'success', 'msg'=>'Successfully update Appointment');
   header('Location: Prenatalmonitorupdate.php?patientid='.urlencode($patientid).'&prenatalid='.urlencode($prenatalid).'&prenatalpatientid='.urlencode($prenatalpatientid));
   exit();
 }

 function updaterecordpatient($recordname=NULL, $date=NULL, $patientmedrecid, $patientid){
  global $db;

  $stmt = $db->prepare('UPDATE medical_record SET rname=?, date=? WHERE id=?');
  $stmt->bind_param('ssi', $recordname, $date, $patientmedrecid);
  $stmt->execute();
  $stmt->close();

  $_SESSION['message'] = array('type'=>'success', 'msg'=>'Successfully update Patient Medical Record');
  header("Location: Medicalupdate.php?patientid=".urlencode($patientid)."&patientmedrecid=".urlencode($patientmedrecid));
  exit();
}

function updatebpp($patientid, $bps=NULL, $bpd=NULL){
  global $db;
  $date = date("Y-m-d h:i:s A");

  $stmt = $db->prepare('UPDATE patient SET bps=?, bpd=? WHERE id=?');
  $stmt->bind_param('iii', $bps, $bpd, $patientid);
  $stmt->execute();
  $stmt->close();

  $stmt = $db->prepare('INSERT INTO patient_bloodpressure (patients_id, bps, bpd, date) VALUES (?, ?, ?, ?)');
  $stmt->bind_param('iiis',$patientid, $bps, $bpd, $date);
  $stmt->execute();
  $stmt->close();

  $_SESSION['message'] = array('type'=>'success', 'msg'=>'Successfully update Patient Medical Record');
  header("Location: Bloodpressurepatientupdate.php?patientid=".urlencode($patientid));
  exit();
}

   /* Update Funtions */

   /* Select Functions */
   function selectpatients($illnessid, $patientid , $illnessname){
    global $db;
    $selected = "Selected";
    $condition = "Treatment";
    $stmt = $db->prepare('INSERT INTO illness_patients (illness_id, patients_id, conditions, status) VALUES (?, ?, ?, ?)');
    $stmt->bind_param('iiss',$illnessid, $patientid, $condition, $selected);
    $stmt->execute();
    $stmt->close();
    $_SESSION['message'] = array('type'=>'success', 'msg'=>'Successfully select a Patient');
    header('Location: Illnessselect.php?illnessid='.urlencode($illnessid).'&illnessname='.urlencode($illnessname));
    exit();

   }

   function selectpatientsimmunize($immunizeid, $patientid){
    global $db;
    $date = date("Y-m-d h:i:s A");
    $selected = "Selected";
    $selected1 = "1st";

    $stmt = $db->prepare('INSERT INTO immunize_patients (immunize_id, patients_id, status_visit, status, date_add) VALUES (?, ?, ?, ?, ?)');
    $stmt->bind_param('iisss',$immunizeid, $patientid,$selected1, $selected, $date);
    $stmt->execute();
    $stmt->close();

    $_SESSION['message'] = array('type'=>'success', 'msg'=>'Successfully select a Patient');
    header('Location: Immunizationselect.php?immunizeid='.urlencode($immunizeid));
    exit();

   }

   function selectpatientsprenatal($prenatalid, $patientid){
    global $db;
    $date = date("Y-m-d h:i:s A");
    $selected = "Selected";

    $stmt = $db->prepare('INSERT INTO prenatal_patients (prenatal_id, patients_id, status, date_add) VALUES (?, ?, ?, ?)');
    $stmt->bind_param('iiss',$prenatalid, $patientid, $selected, $date);
    $stmt->execute();
    $stmt->close();
    $_SESSION['message'] = array('type'=>'success', 'msg'=>'Successfully select a Patient');
    header('Location: Prenatalselect.php?prenatalid='.urlencode($prenatalid));
    exit();

   }
   /* Select Functions */
 ?>