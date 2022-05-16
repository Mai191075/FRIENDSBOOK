<?php

session_start();

if ( isset($_SESSION['user_name']) && !empty($_GET) )
{
	require 'config.php';

	$friend = $stripped = str_replace(' ', '',$_GET['user_name']);
	$my = $_SESSION['user_name'];

	$query = "DELETE FROM frindes_ship WHERE recriver_name = '$my' AND sender_name='$friend'";

	if(mysqli_query($conn, $query))
	{
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
	else
	{
		echo "Error: " .  "<br>" . mysqli_error($conn);
		header("refresh:.9;url= home.php");
	}
	
}


?>