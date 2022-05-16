<?php
session_start();

if ( isset($_SESSION['user_name']) && !empty($_GET) )
{
	require 'config.php';

	$post_id = $stripped = str_replace(' ', '',$_GET['id']);
	$username = $_SESSION['user_name'];

	$query = "DELETE FROM 'likes' WHERE post_id= $post_id and user_name='$user_name'";
	mysqli_query($conn, $query);

}

?>