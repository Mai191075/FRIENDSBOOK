<?php
require 'config.php';
session_start();
if ( !isset( $_SESSION['user_name'] ) ){
    header("Location:logout.php");
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>FRIENDSBOOK HOME</title>   
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/v4-shims.css">
    <link href="home_reset.css" rel="stylesheet">
    <link href="home_style.css" rel="stylesheet">
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
                      <img src="user1.png" class="img-thumbnail border-0" />  
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
    <section id="content-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12  col-lg-8" id="posts">
                <br>
                <?php
                    require 'config.php';
                    $user=$_SESSION['user_name'];
                    $query = "SELECT p.id, p.user_name, p.text, p.img, p.date_posted, u.first_name, u.last_name  from post p INNER JOIN user u ON p.user_name=u.user_name WHERE p.user_name = '$user' or p.user_name IN(SELECT 'user_name' FROM user WHERE 'user_name' IN (SELECT friend  FROM frindes WHERE 'user_name'='$user')) order by date_posted DESC";
                    $result = mysqli_query($conn, $query);
                    if(mysqli_num_rows($result)==0)
                    { 
                        echo "<p style='margin-left:10px''>There are no posts</p>";
                    }
                    while($row = mysqli_fetch_assoc($result))
                    {
                ?>
                <div class="card">
                    <div class="card-body">
                        <div class="container py-3">
                            <div class="card">
                                <div class="row ">                                
                                    <?php                                    
                                        echo "<div class='col-md-4'>";
                                            if(!empty($row['img']))
                                            {
                                                echo "<img src='".$row['img']."' class='w-100'>";
                                            }
                                            echo "<p class='text-secondary text-center' style='margin-top: 10px; margin-bottom: 5px'>".$row['date_posted']."</p>";
                                        echo "</div>";                                                                
                                    ?>
                                    <div class="col-md-8 px-3">
                                        <div class="card-block px-3" >
                                            <?php
                                                echo "<h4 class='card-title' style='color:red;'>"."<a href='profil.php?user_name=".$row['user_name']."'>".$row['first_name']." ".$row['last_name']."</a>"."</h4>"; 
                                                echo "<p class='card-text'>".$row['text']."</p>";
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="comments">
                            <?php
                                $post_id=$row['id'];
                                $query1 = "SELECT c.user_name_comm, c.text ,u.first_name,u.last_name from comment c INNER JOIN user u on  c.user_name_comm= u.user_name WHERE post_id=$post_id";
                                $result1 = mysqli_query($conn, $query1);         
                                while($row1 = mysqli_fetch_assoc($result1))
                                {      
                            ?>
                            <div class="card card-inner comment">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <?php 
                                                echo "<p><strong>"."<a href='profil.php?user_name=".$row1['user_name_comm']."'>".$row1['first_name']." ".$row1['last_name']."</a>"."</strong></p>";
                                                echo"<p>".$row1['text']."</p>";                                                
                                            ?>                                    
                                        </div>
                                    </div>
                                </div>
                            </div>
                                    <?php
                                }
                            ?> 
                        </div>
                        <div class="input-group mb-3 mt-3">
                            <form action="comment_form.php" method="post" class="ajax form-inline ml-auto" >
                                <div class="form-group mx-sm-3 mb-2 ">
                                    <input class="form-control" style="width: 700px" type="text" name="text" id="newcomment" placeholder="Write a comment"  aria-describedby="basic-addon2" required>
                                    <input type="hidden" name="post_id" value="<?php echo($post_id)?>">
                                </div>
                                <input type="submit" value="Comment" class="btn btn-outline-dark">
                            </form>
                        </div>
                        <div>  
                            <p id="newlikes">
                                <?php 
                                    $query2 = "SELECT count(*) AS likes FROM likes where post_id = $post_id";
                                    $result2 = mysqli_query($conn, $query2);         
                                    $row2 = mysqli_fetch_assoc($result2);                                                                                       
                                    $query3 = "SELECT 'user_name' AS liked FROM likes WHERE 'user_name' = '$user' AND post_id= $post_id";
                                    $result3 = mysqli_query($conn, $query3);         
                                    $row3 = mysqli_fetch_assoc($result3);
                                    if (!isset($row3['liked'])) 
                                        {   
                                ?>
                                    <a id='like' value="<?php echo $post_id;?>" class="btn btn-outline-dark" onclick="like(this)"><?php echo $row2['likes'];?> Like </a>
                                <?php
                                    }
                                    else
                                        {
                                ?>
                                <a id='like' value="<?php echo $post_id;?>" class="btn btn-outline-dark" onclick="like(this)"><?php echo $row2['like'];?> Like</a>
                                <?php
                                    }
                                ?>
                            </p>
                        </div>                       
                    </div>   
                </div>
                <hr>
                <?php
                    }              
                ?>
            </div>
            <div class=" col-xs-6 col-lg-4">                
                <br>
                <h1 class=""><small>Friend Suggestions</small></h1>
                <div id="newpeople">
                    <?php
                       require 'config.php';
                        $user=$_SESSION['user_name'];
                        $query = "SELECT u.first_name, u.last_name, u.user_name FROM user u WHERE NOT u.user_name='$user' AND NOT u.user_name IN (SELECT friend FROM frindes f WHERE f.user_name='$user')";
                        $result = mysqli_query($conn, $query);
                        while($row = mysqli_fetch_assoc($result))
                            {
                    ?>
                    <div class="d-flex flex-row border rounded" style="margin-top: 20px" >
                        <div class="p-0 w-25">
                            <img src="user1.png" class="img-thumbnail border-0" />  
                        </div>
                        <div class="pl-3 pt-2 pr-2 pb-2 w-75 border-left">
                            <?php
                                echo "<h4 class='text-info'>"."<a href='profil.php?user_name=".$row['user_name']."'>".$row['first_name']." ".$row['last_name']."</a>"."</h4>";
                            ?>
                            <a href="add_friend_request.php?user_name= <?php echo$row['user_name'];?>" class="btn btn-outline-dark" ><i class="far fa-user"></i>Add Friend</a>
                            <a href="#" class="btn btn-outline-dark" onclick="removeDiv(this)"><i class="far fa-user"></i>Discard</a>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>   
  </section>
</body>
</html>
    
<script type="text/javascript">
        function removeDiv(e){
            e.parentNode.parentNode.parentNode.removeChild(e.parentNode.parentNode);
        }
</script>


<script>
// load-comments & posts
setInterval(function() {
  $(document).ready(function(){
        $("#posts").load("load_comments.php");

  });
}, 8000);
</script>

<script>
//load friends requests 
setInterval(function() {
  $(document).ready(function(){
        $("#freq").load("load_requests.php");
  });
}, 30000);
</script>

<script>
//load new people 
setInterval(function() {
  $(document).ready(function(){
        $("#people").load("load_new_people.php");
  });
}, 30000);
</script>


<script>
  //submit comment
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
      $("#posts").load("load_comments.php");
    });
        }
    });
   
    return false;
  });
</script>


<script>
  //add/delete likes
function like(el) {
  if ($(el).hasClass('btn-primary'))
  {
    like.staticVar=$(el).attr('value');
    $.ajax(
    {
       url: "add_like.php?id="+like.staticVar,
       success: function(data){
        $("#posts").load("load_comments.php");
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
        $("#posts").load("load_comments.php");
        console.log("success");
       }
   });
  }
};
</script>

