<?php
    include "include/database.php";
    $json = array();
    $appointment = mysqli_query($db,"SELECT * FROM appointment");

    $eventArray = array();
    while($rowapp=mysqli_fetch_assoc($appointment)){
        array_push($eventArray, $rowapp);
    }

    echo json_encode($eventArray);
?>