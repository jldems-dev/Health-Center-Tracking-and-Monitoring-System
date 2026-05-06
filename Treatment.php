<?php
$illnesstreatment = mysqli_query($db, "SELECT * FROM illness_patients WHERE condition='Treatment'");
$rowilt=mysqli_num_rows($illnesstt);

echo $rowilt;
?>