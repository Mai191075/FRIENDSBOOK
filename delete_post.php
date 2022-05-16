<?php

session_start();

if ( isset($_SESSION['user_name']) && !empty($_GET) )
{
	require 'config.php';
	$post_id = $_GET['id'];

	$query = "DELETE FROM post WHERE id = '$post_id'";
	mysqli_query($conn, $query);

	if(mysqli_query($conn, $query))
	{
		header( "location:profil.php" );
	}
}
?>