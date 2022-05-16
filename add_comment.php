<?php
	session_start();
	$user=$_SESSION['user_name'];
	$post_id=$_GET['post_id'];
	echo $post_id.$user;
?>