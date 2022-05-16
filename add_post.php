<?php
 session_start();
  if ( !isset($_SESSION['user_name']) && empty($_POST) )
  {
    header("Location:post_form.php");
  }
  else
{
  	require 'config.php';
  	$username = $_SESSION['user_name'];
    
  	$text =htmlspecialchars($_POST['text']);

  	$file =$_FILES['file'];

  	$fileName =$_FILES['file']['name'];
  	$fileTmpName =$_FILES['file']['tmp_name'];
  	$fileSize =$_FILES['file']['size'];
  	$fileError =$_FILES['file']['error'];
  	$fileType =$_FILES['file']['type'];

  	$fileExt = explode('.', $fileName);
  	$fileActExt = strtolower(end($fileExt));

  	$allowed = array('jpg','jpeg','png');

  	if(in_array($fileActExt, $allowed))
  	{
	  	if ($fileError === 0) 
		{
			$fileNameNew=uniqid('',true).".".$fileActExt;
			$fileDes= $fileNameNew;

			move_uploaded_file($fileTmpName, $fileDes);
	  	}
  	}
  	$date =date('Y-m-d');
	$query = "INSERT INTO post (user_name, text, img, date_posted) values ('$username', '$text','$fileDes',CAST('". $date ."' AS DATE))";

	$result = mysqli_query($conn, $query);

	if ($result){
		echo "user saved successfully";
		header( "location:profil.php" );
	}
	else{
		echo "Error " . mysqli_error($conn);
	}
}

?>