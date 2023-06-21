<?php 
 session_start();
 include_once('connection.php');
 if(!isset($_SESSION['unique_id'])) {
   header('location: login.php');
 } else {
   if($_SERVER['REQUEST_METHOD'] == 'GET')  {
     if(!isset($_GET['unique_id'])) {
          header('location: start conversation.php');
      }
   } else {
     header('location: start conversation.php');
   }
 }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Start conversation</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
    
    
    * {
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
      border: 1px solid rgba(0,0,0,0.1);
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
      background: #fff;
      box-shadow: 2px 2px 10px rgba(0,0,0,0.1);
      padding: 20px;
      border: 1px solid rgba(0,0,0,0.1);
      width: 350px;
      border-radius: 10px;
    }
   
   footer {
     text-align: center;
     font-size: 13px;
     margin-top: 20px;
     padding: 10px;
     color: #666;
   }
   
   ::-webkit-scrollbar {
      width: 0;
    }
    
   .online {
     font-size: 9px;
     color: #67B067; 
   }
   .offline {
     font-size: 9px;
     color: #DDDDDD;
   }
   .user {
     padding: 15px 0;
     display: flex;
     align-items: center ;
     justify-content: flex-start;
     border-bottom: 1px solid rgba(0,0,0,0.1);
   }
   .user div {
     margin-left: 20px;
     display: flex;
     align-items: flex-start;
     justify-content: center;
     flex-direction: column; 
   }
   .user div i {
     font-size: 9px;
     margin-left: 10px;
   }
   .user img {
     margin-left: 20px;
   }
   div span {
   font-size: 13px;
  font-weight: bold;
   }
   div.user small {
     color: grey;
     font-size: 12px;
   }
   .user .fa-arrow-left {
     margin-right: 10px; 
   }
   form {
     display: flex;
     align-items: center;
     justify-content: space-between;
     width: 100%;
     padding:20px 0;
     border-top: 1px solid rgba(0,0,0,0.1);
   }
   form textarea {
     width: 90%;
     padding:5px 10px;
     border: 1px solid rgba(0,0,0,0.1);
     border-top: none;
     border-right: none;
     border-left: none;
     height: 30px;
     font-size: 12px;
   }
   form button {
     background: transparent;
     color: #222;
     font-size: 20px;
   }
   .msg {
     display: flex;
     width: 100%;
     margin: 10px 0;
   }
   .incoming {
     align-items: flex-start;
   }
   .incoming span {
     background: rgba(0,0,10,0.1);
     border-radius: 0 5px 5px 5px;
     padding: 5px 10px;
     max-width: 70%;
     margin-top: 20px;
     margin-left: 10px;
     color: #222;
   }
   #msg-container span {
     word-wrap: break-word;
   }
   .outgoing {
     align-self: flex-end;
     flex-direction: row-reverse;
   }
   canvas {
      position: fixed;
      top: 0;
      left: 0;
      height: 100vh;
      width: 100vw;
      z-index: -5;
    }
   .outgoing span {
     background: #5C6AFF;
     border-radius: 5px 0 5px 5px;
     padding: 5px 10px;
     max-width: 70%;
     margin-top: 20px;
     margin-right: 10px;
     color: #fff;
   }
   #msg-container img {
     box-shadow: 1px 1px 5px #eee;
     height: 40px;
     width: 40px;
   }
   #msg-container {
     padding: 20px 3px;
     max-height: 370px;
     overflow-y: auto;
     background: #fefefe;
     width: 100%;
     /*box-shadow: inset 1px 1px 10px #eee;*/
   }
   #msg-container::-webkit-scrollbar {
      width: 0;
    }
  </style>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
  <div class="wrapper">
      <div class="user">
        <a href="start conversation.php">
          <i class="fas fa-arrow-left"></i>
        </a>
   <?php 
     $sql = mysqli_query($conn, "SELECT * FROM users where unique_id = '{$_GET["unique_id"]}'");
      $row = mysqli_fetch_array($sql);
      if($row['unique_id'] == $_GET['unique_id']) {
        echo '
          <img src="'.$row['profile'].'" alt="">
          <div>
             <span>'.$row['fname'].' '.$row['lname'].'</span>
             <small>'.ucfirst($row['status']).'<i class="fas fa-circle '.trim(((strtolower($row['status'])) == 'online') ? 'online' : 'offline').'"></i></small>
           </div>
        ';
      }
  ?>
      </div>
      <div id="msg-container">
        Start Conversation..
      </div>
      <form action="#" method="post" class="input-container">
        <textarea name="message" placeholder="Write message"></textarea>
        <input type="hidden" name="to_unique_id" value="<?php echo($_GET['unique_id']); ?>">
        <input type="hidden" name="from_unique_id" value="<?php echo($_SESSION['unique_id']); ?>">
        <button type="submit" class="material-icons">send</button>
      </form>
    <footer>
      Copyright © 2022 all rights reserved<br> ~ Aldrin Caballero
    </footer>
  </div>
  <script src="message.js"></script>
    <script src="particles.js" defer></script>
</body>
</html>
