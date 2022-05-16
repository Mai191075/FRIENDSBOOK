<?php

session_start();

if ( isset($_SESSION['user_name']) && !empty($_GET) )
{
	require 'config.php';

	$receiver = $stripped = str_replace(' ', '',$_GET['user_name']);
	$sender = $_SESSION['user_name'];

	$query = "INSERT INTO frindes_ship (sender_name,recriver_name) VALUES ('$sender','$receiver')";

	if(mysqli_query($conn, $query))
	{
		header( "location:home.php" );
	}
	else
	{
		echo "Error: " .  "<br>" . mysqli_error($conn);
		header("location:home.php");
	}
	
}


?>