<?php
session_start();
include_once('connection.php');
 if($_SERVER['REQUEST_METHOD'] == 'POST')  {
    $email = trim(mysqli_real_escape_string($conn, $_POST['email']));
    $pswd = trim(mysqli_real_escape_string($conn, $_POST['password']));
    if(empty($email) && empty($pswd)) echo('<div class="error">All fields required, please fill out those fields!</div>');
    else if(empty($email)) echo('<div class="error"> Email is required!</div>');
    
    else if(empty($pswd)) echo('<div class="error"> Password is required!</div>');
    else {
      $pswd = md5($pswd);
      $sql = mysqli_query($conn, "SELECT * FROM users where email = '{$email}' and password = '{$pswd}'");
      $row = mysqli_fetch_array($sql);
      if($row) {
          if($row["email"] == $email && $row["password"] == $pswd) {
               $_SESSION["unique_id"] = $row['unique_id'];
               $sql_2 = "UPDATE users SET status = 'online' WHERE unique_id = '{$_SESSION["unique_id"]}'";
               if($conn->query($sql_2)) {
                    echo('<div class="success">You\'re now logged in!</div>'); 
               }
          } else echo('<div class="error">Invalid email or password!</div>');
      } else {
          echo('<div class="error">Invalid email or password!</div>');
      }
      
    }
 }
 ?>