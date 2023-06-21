<?php
session_start();
include_once('connection.php');
 if($_SERVER['REQUEST_METHOD'] == 'POST')  {
    $message = trim(mysqli_real_escape_string($conn, $_POST['message']));
    $to_unique_id = trim(mysqli_real_escape_string($conn, $_POST['to_unique_id']));
    $from_unique_id = trim(mysqli_real_escape_string($conn, $_POST['from_unique_id']));
    
    //Save message
    if(!empty($message)) {
      mysqli_query($conn, "INSERT INTO messages (to_unique_id, from_unique_id, message) VALUES('$to_unique_id', '$from_unique_id', '$message')");
    }
  } else {
   header('location: start conversation.php');
 }
?>