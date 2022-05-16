<?php
          session_start();
          require 'config.php';
          $user=$_SESSION['user_name'];
          $query = "SELECT user_name FROM user WHERE user_name IN (SELECT sender_name FROM frindes_ship WHERE receiver_name='$user')";

          $result = mysqli_query($conn, $query);
          if(mysqli_num_rows($result)==0)
            { 
              echo "<p style='margin-left:10px''>You have no friend requests</p>";
            }
          while($row = mysqli_fetch_assoc($result))
          { ?>

        <div class="d-flex flex-row border rounded" style="margin-top: 20px" >
          <div class="p-0 w-25">
            <img src="user.png" class="img-thumbnail border-0" />  
          </div>

          <div class="pl-3 pt-2 pr-2 pb-2 w-75 border-left">
            <?php
              echo "<h4 class='card-title'>"."<a href='profil.php?username=".$row['username']."'>".$row['fname']." ".$row['lname']."</a>"."</h4>"; 
            ?>
            <a href="add_friend.php?username= <?php echo$row['username'];?>" class="btn btn-dark" ><i class="far fa-user"></i>Confirm</a>
            <a href="delete_friend_request.php?username= <?php echo$row['username'];?>" class="btn btn-dark"><i class="far fa-user"></i>Delete</a>
          </div>
        </div>

        <?php
          }
        ?>