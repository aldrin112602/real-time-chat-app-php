<?php
session_start();
include_once('connection.php');
$sql = "UPDATE users SET status = 'offline' WHERE unique_id = '{$_SESSION['unique_id']}'";
  if($conn->query($sql)) {
    session_unset();
    header('location: login.php');
  }
?>