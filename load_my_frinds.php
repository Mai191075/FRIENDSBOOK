<?php
   session_start();
  require 'config.php';
  $user=$_SESSION['user_name'];
  $query = "SELECT user_name FROM user WHERE user_name IN (SELECT friend FROM frindes WHERE user_name='$user')";

  $result = mysqli_query($conn, $query);
  if(mysqli_num_rows($result)==0)
    { 
      echo "You have no friends";
    }
  while($row = mysqli_fetch_assoc($result))
  { ?>

<div class="d-flex flex-row border rounded" style="margin-top: 20px" >
  <div class="p-0 w-25">
    <img src="user.png" class="img-thumbnail border-0" />  
  </div>

  <div class="pl-3 pt-2 pr-2 pb-2 w-75 border-left">
    <?php
      echo "<h4 class='card-title'>"."<a href='profil.php?username=".$row['user_name']."'>".$row['user_name']."</a>"."</h4>"; 
    ?>
  </div>
</div>

<?php
  }
?>