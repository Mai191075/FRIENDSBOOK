<?php
  session_start();
  require 'config.php';
  $user=$_SESSION['user_name'];
  $query = "SELECT 'user_name' FROM user WHERE NOT 'user_name'='$user' AND NOT 'user_name' IN (SELECT friend FROM frindes WHERE 'user_name'='$user')";
  $result = mysqli_query($conn, $query);
  while($row = mysqli_fetch_assoc($result))
  { 
?>
<div class="d-flex flex-row border rounded" style="margin-top: 20px" >
  <div class="p-0 w-25">
    <img src="default-profile.jpg" class="img-thumbnail border-0" />  
  </div>
  <div class="pl-3 pt-2 pr-2 pb-2 w-75 border-left">
    <?php
      echo "<h4 class='text-info'>"."<a href='profil.php?user_name=".$row['user_name']."'>".$row['user_name']."</a>"."</h4>";
    ?>
    <a href="add_friend_request.php?user_name= <?php echo$row['user_name'];?>" class="btn btn-dark" ><i class="far fa-user"></i>Add Friend</a>
    <a href="#" class="btn btn-dark" onclick="removeDiv(this)"><i class="far fa-user"></i>Discard</a>
  </div>
</div>
<?php
  }
?>