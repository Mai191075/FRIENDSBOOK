<?php
  require 'config.php';
  session_start();
  if ( !isset( $_SESSION['user_name'] ) )
  {
    header("Location:logout.php");
  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>FRIENDSBOOK PROFILE</title>   
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/v4-shims.css">
    <link href="profil_reset.css" rel="stylesheet">
    <link href="profil_style.css" rel="stylesheet">
  </head>
  <body>
  <header  style="background: #2C2C2C">
      <div class="logo-area">
        <a href="home.php">FRIENDSBOOK</a>
      </div>
      <div class="menu">
        <ul>
          <li>
            <button type="button" class="btn btn-outline-light" onclick="window.location.href='home.php'">Home</button>
          </li>
          <li>
            <button type="button" class="btn btn-outline-light" onclick="window.location.href='profil.php'">Profile</button>
          </li>
        </ul>
      </div>
      <div class="icon-links">
        <ul class="quick-options">
          <li>
            <a href="chat.php">
              <i class="fa fa-comments" aria-hidden="true"></i>
            </a>
          </li>  
          <a href="#">
            <li class="nav-item dropdown">
              <a class="fa fa-bell"  href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              </a>
              <div class="dropdown-menu dropdown-menu-right" style="width:400px " aria-labelledby="navbarDropdown">
                <p style="margin-left: 10px">Friend requests: </p>
                <div id="freq">
                  <?php
                    require 'config.php';
                    $user=$_SESSION['user_name'];
                    $query = "SELECT first_name, last_name, 'user_name' FROM user WHERE 'user_name' IN (SELECT sender_name FROM frindes_ship WHERE recriver_name='$user')";

                    $result = mysqli_query($conn, $query);
                    if(mysqli_num_rows($result)==0)
                      { 
                        echo "<p style='margin-left:10px''>You have no friend requests</p>";
                      }
                    while($row = mysqli_fetch_assoc($result))
                    { 
                  ?>
                  <div class="d-flex flex-row border rounded" style="margin-top: 20px" >
                    <div class="p-0 w-25">
                      <img src="user.png" class="img-thumbnail border-0" />  
                    </div>
                    <div class="pl-3 pt-2 pr-2 pb-2 w-75 border-left">
                      <?php
                        echo "<h4 class='card-title'>"."<a href='profil.php?user_name=".$row['user_name']."'>".$row['first_name']." ".$row['last_name']."</a>"."</h4>"; 
                      ?>
                      <a href="add_friend.php?user_name= <?php echo$row['user_name'];?>" class="btn btn-outline-dark" >Confirm</a>
                      <a href="delete_friend_request.php?user_name= <?php echo$row['user_name'];?>" class="btn btn-outline-dark">Delete</a>
                    </div>
                  </div>
                  <?php
                  }
                  ?>
                </div>
              </div>
            </li>
          </a>
        </ul>
      </div>
      <div class="logout">
        <ul class="quick-options">
          <li>
            <a href="logout.php">
              <i class="fa fa-sign-out" aria-hidden="true"></i>
            </a>
          </li>
        </ul>
      </div>
    </header>
    <section id="top-area">
      <div class="profile-info">
        <div class="pro-pic">
        
         <img src="user1.png" style= "height: 40px width: 40px border-radius: 50%"/>
        </div>      
        <div class="user-desc">
          <h3>
            <?php
              echo $_SESSION['user_name'] 
            ?>
          </h3>
        </div>
      </div>
    </section>
    <section id="content-area">
      <div class="side-feed">
        <div class="widget-box bio">
        </div>
        <div class="widget-box teams">
          <div class="head">
            <div class="widget-icon-container">
              <div class="widget-icon">
                <i class="fa fa-users" aria-hidden="true"></i>
              </div>
             <b> My Friends: </b>
        <div id="myfrinds">
        <?php
          require 'config.php';
          $user=$_SESSION['user_name'];
          $query = "SELECT 'user_name' FROM user WHERE 'user_name' IN (SELECT friend FROM frindes WHERE 'user_name'='$user')";

          $result = mysqli_query($conn, $query);
          if(mysqli_num_rows($result)==0)
            { 
              echo "<br> You have no friends ";
            }
          while($row = mysqli_fetch_assoc($result))
          { ?>

        <div class="d-flex flex-row border rounded" style="margin-top: 20px" >
          <div class="p-0 w-25">
            <img src="user.png" class="img-thumbnail border-0" />  
          </div>

          <div class="pl-3 pt-2 pr-2 pb-2 w-75 border-left">
            <?php
              echo "<h4 class='card-title'>"."<a href='profil.php?user_name=".$row['user_name']."'>"."</a>"."</h4>"; 
            ?>
          </div>
        </div>

        <?php
          }
        ?>
      </div>
      </div>
      </div>
      </div>
      </div>


      <div class="main-feed">
        <div class="card">
          <div class="card-header">
            <div class="input-group">
              <div class="input-group-append">
                <a href="post_form.php" class="btn btn-outline-dark">Add post</a>        
              </div>
            </div>
          </div>
        </div>
        <div class="widget-box post">
          <?php
            require 'config.php';
            $user=$_SESSION['user_name'];
            $query = "SELECT p.id, p.user_name, p.date_posted, p.text, p.img, u.first_name, u.last_name FROM post p INNER JOIN user u ON p.user_name=u.user_name WHERE p.user_name='$user' order by date_posted DESC";
            $result = mysqli_query($conn, $query);
            if(mysqli_num_rows($result)==0)
            { 
              echo "<p style='margin-left:10px''>GO write your First POST!</p>";
            }
            while($row = mysqli_fetch_assoc($result))
            {
          ?>
          <div class="head">
            <div class="user-img"><br><br><br>
              <img src="user1.png" alt="" style="
              display: inline-block; background: no-repeat center center; background-size: cover;
              height: 40px; width: 40px; border-radius: 50%; float: left; margin-right: 15px;"/>
            </div>
            <div class="post-info">
              <span class="user-info" style="display: block; font-size: 14px; margin-top: 4px;">
                <?php
                  echo "<h4>"."<a href='profil.php?user_name=".$row['user_name']."'>".$row['first_name']." ".$row['last_name']."</a>"."</h4>"; 
                ?>  
              </span>
              <?php
                echo "<p class='text-secondary text-left' style='margin-top: 10px; margin-bottom: 5px'>".$row['date_posted']."</p>";
                echo "<br>";
                echo "<p class='main-text'>".$row['text']."</p>";
              ?>
            </div>
            <div class="body post-body">
              <div class="post-img">
                <?php
                  if(!empty($row['img']))
                  {
                    echo "<img src='".$row['img']."' class='w-100'>";
                    

                  }
                ?>
              </div>

              <div>  
                    <p id="newlikes">
                      <?php 
                        $post_id=$row['id']; 

                        $query1 = "SELECT count(*) AS likes FROM likes l where l.post_id = $post_id";
                        $result1 = mysqli_query($conn, $query1);         
                        $row1 = mysqli_fetch_assoc($result1);
                                              
                       
                        $query2 = "SELECT l.user_name as liked FROM likes l WHERE l.user_name = '$user' AND l.post_id= $post_id";
                        $result2 = mysqli_query($conn, $query2);         
                        $row2 = mysqli_fetch_assoc($result2);

                        if (!isset($row2['liked'])) 
                        {
                          ?>
                            <a id='like' value="<?php echo $post_id;?>" class="btn btn-outline-dark" onclick="like(this)"><?php echo $row1['likes'];?> Likes</a>
                            <a href="edit_post_form.php?id= <?php echo$row['id'];?>" class="btn btn-outline-dark">Edit Post</a>
                            <a href="delete_post.php?id= <?php echo$row['id'];?>" class="btn btn-outline-dark">Delete Post</a>
                          <?php
                        }
                        else
                        {
                        ?>
                        <a id='like' value="<?php echo $post_id;?>" class="btn btn-outline-dark" onclick="like(this)"><?php echo $row1['likes'];?> Likes</a>

                        <a href="edit_post_form.php?id= <?php echo$row['id'];?>" class="btn btn-outline-dark">Edit Post</a>
                        <a href="delete_post.php?id= <?php echo$row['id'];?>" class="btn btn-outline-dark">Delete Post</a>

                        <?php
                          }
                        ?>

                    </p>
                  </div>  
                  <br>
                  <!-- ......................<br>
                   
                  ...................... -->
              <div class="post-comments">
                <div class="user-img">
                  <img src="user.png" alt="Daniel Bedjanov" />
                </div>
                <div class="user-comment">
                  <div class="user-info">
                    <a href="#">mohanad fatafta</a>
                    <span class="time"> 5:25 PM </span>
                  </div>
                  <p>
                    Wow, your fantasy team is so much better than mine!
                  </p>
                </div>
              </div>
              <!-- ......................... -->
            </div>

          </div>
          <?php
            }              
          ?>
        </div>
      </div>
    </section>
  </body>
</html>


<script>
setInterval(function() {
  $(document).ready(function(){
        $("#posts").load("load_profile_comments.php");
  });
}, 8000);
</script>

<script>
setInterval(function() {
  $(document).ready(function(){
        $("#freq").load("load_requests.php");
  });
}, 30000);
</script>

<script>
setInterval(function() {
  $(document).ready(function(){
        $("#myfrinds").load("load_my_frinds.php");
  });
}, 30000);
</script>

<script>
  $('form.ajax').on('submit',function(){
    var that = $(this),
        url = that.attr('action'), 
        type = that.attr('method'),
        data = {};

    that.find('[name]').each(function(index, value){
      var that = $(this),
          name = that.attr('name'),
          value = that.val();

      data[name] = value;
    });
    $.ajax({
        url: url,
        type: type,
        data: data,
        success: function(response){
          console.log(response);
           $(document).ready(function(){
      $("#posts").load("load_profile_comments.php");
    });
        }
    });
   
    return false;
  });
</script>

<script>
function like(el) {
  if ($(el).hasClass('btn-primary'))
  {
    like.staticVar=$(el).attr('value');
    $.ajax(
    {
       url: "add_like.php?id="+like.staticVar,
       success: function(data){
        $("#posts").load("load_profile_comments.php");
        console.log("success");
       }
    });
  }
  else
  {
    like.staticVar=$(el).attr('value');
    $.ajax(
    {
       url: "delete_like.php?id="+like.staticVar,
       success: function(data){
        $("#posts").load("load_profile_comments.php");
        console.log("success");
       }
   });
  }
};
</script>