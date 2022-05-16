<?php
session_start();
require 'config.php';
  ?>

<!DOCTYPE HTML>
<html lang="en" >
<html>
<head>
  <title>FRIENDSBOOK</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="login_style.css">
  

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body class="body">
<div class="login-page">
  <div class="form">
    <img src="tttttt.png"  width="260" height="310">

    <form method="POST" action="checklogin.php">
      <input type="text" name="user_name" placeholder="&#xf007; username" required />
      <input type="password" id="password" name="password" placeholder="&#xf023; password" required />
      <i class="fas fa-eye" onclick="show()"></i> 
      <br>
      <br>
      
      <button type="submit">LOGIN</button>  

      <p class="message"></p>   
    </form>

    <form class="login-form">
        <button type="button" onclick="window.location.href='signup.html'">SIGN UP</button>
    </form>
  <div>

        <?php 
        if(isset($_GET['error'])){
         ?> 
          <div class="alert alert-danger" role="alert"> 
          Invalid Usernamer or Password!
         </div>
        <?php
          }
        ?> 

       </div>
      </div>
</div>

  <script>
    function show(){
      var password = document.getElementById("password");
      var icon = document.querySelector(".fas")

      if(password.type === "password"){
        password.type = "text";
      }
      else {
        password.type = "password";
      }
    };
  </script>
</body>
</html>