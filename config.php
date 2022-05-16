<?php

$servername = "localhost"; //127.0.0.1
$username = "user_acc";
$password = "user_acc123";
$database = "web-project";
$conn = mysqli_connect($servername, $username, $password, $database);


if (!$conn) {
    die("Connection failed:" .mysqli_connect_error());
}
?>