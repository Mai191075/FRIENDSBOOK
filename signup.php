<?php
require 'config.php';

echo $_POST['user_name'];
echo $_POST['first_name'];
echo $_POST['last_name'];
echo $_POST['gender'];
echo $_POST['email'];
echo $_POST['address'];
echo $_POST['phone_no'];
echo $_POST['password'];
echo $_POST['img'];

$user_name = $_POST['user_name'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$address = $_POST['address'];
$phone_no = $_POST['phone_no'];
$password = $_POST['password'];
$img = $_POST['img'];



$query = "INSERT INTO user ( user_name, first_name, last_name, gender, email, address, phone_no, password, img)
VALUES ('$user_name', '$first_name', '$last_name', '$gender','$email', '$address', '$phone_no', '$password', '$img')";

$result = mysqli_query($conn, $query);

if(!$result){
    echo mysqli_error($conn);
}
else {
    header ("Location: login.php");

}

?>