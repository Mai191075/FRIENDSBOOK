<?php
   
   session_start();
   if(isset($_POST['text'],$_POST['post_id'],$_SESSION['user_name']))
   {
   require 'config.php';

   $user = $_SESSION['user_name'];
   $text = htmlspecialchars($_POST['text']);
   $post_id = $_POST['post_id'];

   $query = "INSERT INTO comment (post_id,user_name_comm, username,text) VALUES ($post_id,'$user','$text')";
   mysqli_query($conn, $query);
  
   }


?>