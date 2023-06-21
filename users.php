<?php
session_start();
include_once('connection.php');
if($_SERVER['REQUEST_METHOD'] == 'GET')  {
  $sql = "SELECT * FROM users";
  if($result = mysqli_query($conn, $sql)) {
   if(mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_array($result)) {
       if($row['unique_id'] != $_SESSION['unique_id']) {
         $last_msg = '';
         $to_unique_id = $row['unique_id'];
         $from_unique_id = $_SESSION['unique_id'];
         //Get message
         $msg = "SELECT * FROM messages";
        if($res = mysqli_query($conn, $msg)) {
         if(mysqli_num_rows($res) > 0) {
            while($row_msg = mysqli_fetch_array($res)) {
              if(($to_unique_id == $row_msg['to_unique_id'] || $to_unique_id == $row_msg['from_unique_id']) && ($from_unique_id == $row_msg['to_unique_id'] || $from_unique_id == $row_msg['from_unique_id'])) {
                
                $last_msg = ($row_msg['to_unique_id'] != $from_unique_id) ? "You: " . $row_msg['message'] : '<b>'.$row_msg['message'].'</b>';
              }
              
            }
            if($last_msg == '') {
              $last_msg = "Start conversation..";
            }
           
         }
          
        }
        echo '
         <a href="message-index.php?unique_id='.$row['unique_id'].'" target="_self" style="display: block; text-decoration: none;">
          <div class="user">
          <img src="'.$row['profile'].'" alt="">
          <div class="profile">
            <span>'.$row['fname'].' '.$row['lname'].'</span>
            <small>
            '.$last_msg.' 
            </small>
          </div>
          <button class="status">
            <i class="fas fa-circle '.trim(((strtolower($row['status'])) == 'online') ? 'online' : 'offline').'"></i>
          </button>
        </div>
        </a>
        
        ';
       }
      }
      mysqli_free_result($result);
    }
  }
}
?>