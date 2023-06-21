<?php
session_start();
include_once('connection.php');
if($_SERVER['REQUEST_METHOD'] == 'GET')  {
 
  $to_unique_id = $_GET['to_unique_id'];
  $from_unique_id = $_GET['from_unique_id'];
  $msg = '';
  $no_cv = true;
  $sql = "SELECT * FROM messages";
        if($result = mysqli_query($conn, $sql)) {
         if(mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_array($result)) {
              if(($to_unique_id == $row['to_unique_id'] || $to_unique_id == $row['from_unique_id']) && ($from_unique_id == $row['to_unique_id'] || $from_unique_id == $row['from_unique_id'])) {
                $profile_1 = mysqli_query($conn, "SELECT profile FROM users where unique_id = '{$from_unique_id}'");
                if(mysqli_num_rows($profile_1) > 0) {
                  $profile_1 = mysqli_fetch_array($profile_1)['profile'];
                }
                $profile_2 = mysqli_query($conn, "SELECT profile FROM users where unique_id = '{$to_unique_id}'");
                if(mysqli_num_rows($profile_2) > 0) {
                  $profile_2 = mysqli_fetch_array($profile_2)['profile'];
                }
                echo('
                  <div class="msg '.(($row['to_unique_id'] != $from_unique_id) ? "outgoing" : "incoming").'">
                  <img src="'.(($row['to_unique_id'] != $from_unique_id) ? $profile_1 : $profile_2).'">
                  <span>'.$row['message'] .'</span>
                </div>
                ');
                $no_cv = false;
              } else {
                $msg = 'Start Conversation..';
              }
              
            }
            if($no_cv) echo($msg);
            mysqli_free_result($result);
         }
      }
    
    
    
}
?>