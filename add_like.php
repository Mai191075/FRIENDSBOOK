<?php
session_start();

if ( isset($_SESSION['user_name']) && !empty($_GET) )
{
	require 'config.php';

	$post_id = $stripped = str_replace(' ', '',$_GET['id']);
	$user_name = $_SESSION['user_name'];

	$query = "INSERT INTO likes (post_id,user_name) VALUES ($post_id,'$user_name')";

	mysqli_query($conn, $query);
}
?>