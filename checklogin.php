<?php
session_start();

require 'config.php';

if (isset($_POST['user_name']) && isset($_POST['password'])){

    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    $query = "SELECT * FROM user WHERE user_name = '$user_name' AND password = '$password'";
    $result = mysqli_query($conn,$query);

    if(mysqli_num_rows($result) > 0){
        echo "Welcome  " . $user_name;
    
        $_SESSION['user_name'] = $user_name;
        header("location:home.php");

    } else {
        header("location:login.php?error=1");
    }
}

?>
