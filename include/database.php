<?php
session_start();
$db = new mysqli('localhost', 'root', '', 'hctm');
if($db->connect_error) {
  exit('Error connecting to database');
}