<?php
    include "include/database.php";
    session_destroy();
    header('location:login.php');
?>