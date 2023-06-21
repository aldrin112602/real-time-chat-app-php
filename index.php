<?php
session_start();
if(isset($_SESSION['unique_id'])) {
  header('location: login.php');
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sign Up</title>
  <style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');
  @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css');
    * {
      padding: 0;
      margin: 0;
      box-sizing: border-box;
      outline: none;
      font-family: "Poppins", sans-serif;
      color: #fff;
    }
    canvas {
      position: fixed;
      top: 0;
      left: 0;
      height: 100vh;
      width: 100vw;
      z-index: -5;
    }
    *::-webkit-progress-bar {
      width: 0;
    }
    
    button, a, img, input, i {
      cursor: pointer;
    }
    
    img {
      object-fit: cover;
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
      background: rgba(255, 255, 255, 0.1);
      padding: 20px;
      border: 1px solid rgba(255,255,255,0.1);
      width: 350px;
      border-radius: 10px;
      backdrop-filter: blur(5px);
      
    }
   
   form header {
     border-bottom: 1px solid rgba(255, 255, 255, 0.1);
     padding:20px 0;
   } 
   .full-name {
     width: 100%;
     display: flex;
     align-items: center;
     justify-content: space-between;
   }
   .full-name div {
     width: 120px;
   }
   .full-name div input {
     width: 100%;
     height: 30px;
     border: 1px solid rgba(255,255,255,0.1);
     font-size: 13px;
     padding-left: 15px;
     background: rgba(255, 255, 255, 0.1);
     
   }
   .success {
     padding:5px 10px;
     margin: 10px 0;
     border-radius: 3px;
     font-size: 13px;
     background: rgba(19, 148, 72, 0.1);
     color: green;
     text-align: center;
   }
   .error {
     padding:5px 10px;
     margin: 10px 0;
     border-radius: 3px;
     font-size: 13px;
     background: rgba(255, 209, 181, 0.6);
     color: rgba(139, 14, 14, 1);
     text-align: center;
   }
   label {
     font-size: 14px;
     margin-bottom: 5px;
   }
   .fields input {
     border: 1px solid rgba(255,255,255,0.1);
     padding-left: 15px;
     font-size: 13px;
     height: 30px;
     width: 100%;
     background: rgba(255, 255, 255, 0.1);
   }
   .fields {
     margin: 5px 0;
     position: relative;
   }
   input[type="file"] {
     padding-left: 3px;
     padding-top: 3px;
   }
   input[type="submit"] {
     background: rgba(255, 255, 255, 0.1);
     color: #fff;
     margin-top: 10px;
   }
   ::placeholder {
     color: #fff;
   }
   footer {
     text-align: center;
     font-size: 13px;
     margin-top: 20px;
     padding: 10px;
   
   }
   i {
     font-size: 11px;
     position: absolute;
     right: 10px;
     top: 70%;
     transform: translateY(-45%);
     
   }
  </style>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
  <div class="wrapper">
    <form action="#" method="post">
      <header>Realtime Chat App</header>
      <div class="err-msg"></div>
      <div class="full-name">
        <div>
          <label for="fname">First Name</label><br>
          <input placeholder="First name" type="text" name="fname">
        </div>
        <div>
          <label for="lname">Last Name</label><br>
          <input placeholder="Last name" type="text" name="lname"> 
        </div>
      </div>
      <div class="fields">
        <label for="">Email Address</label>
        <input placeholder="Enter your email" type="email" name="email">
      </div>
      
      <div class="fields">
        <label for="">Password</label>
        <input id="pswd" placeholder="Enter new password" type="password" name="password">
        <i class="fas fa-eye-slash"></i>
      </div>
      
      <div class="fields">
        <label for="">Confirm password</label>
        <input placeholder="Confirm password" type="password" name="confirm">
      </div>
      
      <div class="fields">
        <label for="">Select image</label>
        <input accept="image/*" type="file" id="file">
        <input id="file_data" type="hidden" name="file">
      </div>
      
      <div class="fields">
        <input id="submit" value="Continue to Chat" type="submit">
        <small style="text-align: center; display: block; margin-top: 5px">Already signed up?
          <a href="login.php"> Log In now</a>
        </small>
      </div>
    </form>
    <footer>
      Copyright © 2022 all rights reserved<br> ~ Aldrin Caballero
    </footer>
  </div>
  <script src="handle-signup.js" defer></script>
  <script src="show-hide-password.js" defer></script>
  <script src="particles.js" defer></script>
</body>
</html>
