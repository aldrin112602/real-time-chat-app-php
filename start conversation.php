<?php
session_start();
include_once('connection.php');
if(!isset($_SESSION['unique_id'])) {
  header('location: login.php');
} else {
  $expireAfter = 30;
  if(isset($_SESSION['last_action'])) {
    $secondsInactive = time() - $_SESSION['last_action'];
    $expireAfterSeconds = $expireAfter * 60;
   if($secondsInactive >= $expireAfterSeconds) {
        $sql = "UPDATE users SET status = 'offline' WHERE unique_id = '{$_SESSION["unique_id"]}'";
         if($conn->query($sql)) {
           session_unset();
           header('location: login.php');
       }
    }
  }
  $_SESSION['last_action'] = time();
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Start Conversation</title>
  <style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');
  @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css');
    * {
      padding: 0;
      margin: 0;
      box-sizing: border-box;
      outline: none;
      font-family: "Poppins", sans-serif;
      color: #333;
      transition: all 0.3s;
      text-decoration: none;
    }
    
    
    html {
      scroll-behavior: smooth;
    }
    button, a, img, input, i {
      cursor: pointer;
    }
    
    img {
      object-fit: cover;
      width: 50px;
      height: 50px;
      border-radius: 50%;
    }
    
    button, input {
      border: none;
      border-radius: 3px;
    }
    body {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      width: 100vw;
      background: linear-gradient(-45deg, purple, dodgerblue);
    }
    
    .wrapper {
      background:#fff;
      box-shadow: 2px 2px 10px rgba(0,0,0,0.1);
      padding: 20px;
      border: 1px solid rgba(0,0,0,0.1);
      width: 350px;
      border-radius: 10px;
    }
   
   header {
     border-bottom: 1px solid rgba(0,0,0,0.1);
     padding:20px 0;
   } 
   
   footer {
     text-align: center;
     font-size: 13px;
     margin-top: 20px;
     padding: 10px;
     color: #666;
   }
   div.info {
    padding:10px 0;
     display: flex;
     align-items: center;
     justify-content: space-between;
   }
   .info .profile {
     display: flex;
     align-items: center;
     justify-content: center;
   }
   .info button {
     width: 60px;
     height: 30px;
     background: #F0F0F0;
     display: inline-block;
     font-size: 12px;
     font-weight: bold;
   }
   .info a {
     display: inline-block;
   }
   .profile div {
     display: flex;
     align-items: flex-start;
     justify-content: center;
     flex-direction: column;
     margin-left: 10px;
   }
   .profile div span {
     font-size: 14px;
     font-weight: bold;
   } 
   .profile div small {
     color: #142714;
   }
  .profile i.fa-circle {
     font-size: 9px;
     color: #67B067;
     margin-left: 3px;
   }
   div.search {
     /*padding: 5px;*/
     position: relative;
   }
   .search input {
     width: 100%;
     border-radius: 3px;
     border: 1px solid rgba(0,0,0,0.1);
     padding-left: 15px;
     height: 35px;
   }
   .search button {
     position: absolute;
     right: 20px;
     top: 50%;
     transform: translateY(-50%);
     background-color: transparent;
   }
   canvas {
      position: fixed;
      top: 0;
      left: 0;
      height: 100vh;
      width: 100vw;
      z-index: -5;
    }
   .search i {
     color: #B1B2BA;
   }
   .users {
     width: 100%;
     max-height: 370px;
     overflow-y: auto;
     padding: 10px;
     display: block;
   }
   .users::-webkit-scrollbar {
      width: 0;
    }
   .users .user {
     display: flex;
     align-items: flex-start;
     justify-content: flex-start;
     position: relative;
     width: 100%;
     border-bottom: 1px solid rgba(0,0,0,0.1);
     padding: 10px 0;
   }
   .user img {
     height: 40px;
     width: 40px;
   }
   .user span {
     color: #393A46;
     font-weight: bold;
     font-size: 12px;
   }
   .user small {
     color: #75767A;
     font-size: 12px;
     white-space: nowrap;
     overflow: hidden;
     text-overflow: ellipsis;
     max-width: 200px;
   }
   .user div {
     display: flex;
     align-items: flex-start;
     justify-content: space-around;
     flex-direction: column;
     height: 100%;
     margin-left: 10px;
   }
   .user .status {
     position: absolute;
     right: 10px;
     top: 50%;
     transform: translateY(-50%);
     background-color: transparent;
   }
  .user i {
     font-size: 9px;
   }
   .online {
     color: #67B067; 
   }
   .offline {
     color: #DDDDDD;
   }
  </style>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://www.w3schools.com/lib/w3.js"></script>
</head>
<body>
  <?php 
     $sql = mysqli_query($conn, "SELECT * FROM users where unique_id = '{$_SESSION["unique_id"]}'");
      $row = mysqli_fetch_array($sql);
      if($row['unique_id'] == $_SESSION['unique_id']) {
        $_SESSION['fullname'] = $row['fname'].' '.$row['lname'];
        $_SESSION['status'] = $row['status'];
        $_SESSION['profile'] = $row['profile'];
      }
  ?>
  <div class="wrapper">
      <header>Welcome to Realtime Chat App!</header>
      <div class="info">
        <div class="profile">
          <img src="<?php echo($_SESSION['profile']); ?>" alt="">
          <div>
            <span><?php echo($_SESSION['fullname']); ?></span>
            <small><?php echo(ucfirst($_SESSION['status'])); ?><i class="fas fa-circle"></i></small>
          </div>
        </div>
        <div>
          <div>
            <a href="log-out.php">
            <button>Log Out</button>
          </a>
          </div>
        </div>
      </div>
      <div class="search">
        <input id="search" placeholder="Search.." type="text" oninput="w3.filterHTML('.users', '.user', this.value)">
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="users"></div>
    <footer>
      Copyright © 2022 all rights reserved<br> ~ Aldrin Caballero
    </footer>
  </div>
  <script src="fetch-users.js"></script>
    <script src="particles.js" defer></script>
</body>
</html>
