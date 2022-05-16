<?php

session_start();

if ( isset($_SESSION['user_name']) && !empty($_GET) )
{
    require 'config.php';

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
      $fileDes=$fileNameNew;

      move_uploaded_file($fileTmpName, $fileDes);
      }
    }

  $post_id = $_GET['id'];
  $text = htmlspecialchars($_POST['text']);


  $query = "UPDATE post SET text='$text' , img='$fileDes' WHERE id = $post_id";
  $result = mysqli_query($conn, $query);

  if ($result)
  {
    header( "location:profil.php" );
  }
  else{
    echo "Error " . mysqli_error($conn);
  }

}
?>