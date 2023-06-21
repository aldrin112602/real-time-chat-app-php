<?php
session_start();
include_once('connection.php');
 if($_SERVER['REQUEST_METHOD'] == 'POST')  {
    $fname = trim(mysqli_real_escape_string($conn, $_POST['fname']));
    $lname = trim(mysqli_real_escape_string($conn, $_POST['lname']));
    $email = trim(mysqli_real_escape_string($conn, $_POST['email']));
    $pswd =  trim(mysqli_real_escape_string($conn, $_POST['password']));
    $confirm = trim(mysqli_real_escape_string($conn, $_POST['confirm']));
    $data = $_POST['file'];
 
    if(empty($fname) && empty($lname) && empty($email) && empty($pswd) && empty($data)) echo('<div class="error">All fields are required, please fill out those fields!</div>');
    
    else if(empty($fname)) echo('<div class="error"> First name is required!</div>');
    
    else if(empty($lname)) echo('<div class="error"> Last name is required!</div>');
    
    else if(empty($email)) echo('<div class="error"> Email is required!</div>');
    
    
    else if(empty($pswd)) echo('<div class="error"> Password is required!</div>');
    
    else if(strtolower($pswd) == '123qwerty') echo('<div class="error">Don\'t use commonly password, please choose a strong password!</div>');
    
    else if($pswd == $email) echo('<div class="error">Your email cannot be your password!</div>');
    
    else if(empty($confirm)) echo('<div class="error">Confirm password is required!</div>');
    
    else if(strlen($pswd) < 6) echo('<div class="error"> Password must at least have 6 characters!</div>');
    
    else if($pswd != $confirm) echo('<div class="error">Confirm password did not match!</div>');
    
    else if(empty($data)) echo('<div class="error">Please select image!</div>');
    
    else {
      $pswd = md5($pswd);
      $sql = mysqli_query($conn, "SELECT email FROM users where email = '{$email}'");
      if(mysqli_num_rows($sql) > 0) {
        echo('<div class="error">'.$email.' - this email already used!');
       } else {
         $unique_id = uniqid();
         $path = 'tmp/image-'.uniqid().'.webp';
         list($type, $data) = explode(';', $data);
         list(, $data) = explode(',', $data);
         $data = base64_decode($data);
         if(file_put_contents($path, $data)) {
           if(mysqli_query($conn, "INSERT INTO users (fname, lname, email, password, profile, unique_id, status) VALUES('$fname', '$lname', '$email', '$pswd', '$path', '$unique_id', 'online')")) {
             $_SESSION["unique_id"] = $unique_id;
             echo('<div class="success">Congratulations, registered successfully!</div>');
              
            }
          }
        }
      }
      
      
      
      
      
    }
    
  
?>