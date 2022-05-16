<?php
  session_start();
  if ( !isset($_SESSION['user_name'] ) )
  {
    header("Location:profil.php");

  }
  ?>
<!DOCTYPE html>
<html>  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/v4-shims.css">
    <link href="home_reset.css" rel="stylesheet">
    <link href="home_style.css" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <title>FRIENDSBOOK ADD POST</title>
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
            <a href="chat.html">
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
<style>
 input , textarea
{
  display: block;
  width: 300px;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 25px;
  margin-top: 15px;
  margin-bottom: 15px;
  outline: none;
}
textarea
{
  height: 100px;
  width: 100%;
}
input
{
  width: 100%;
}
</style>
</head>
<body>

 <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto" style="margin-top: 3rem;">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h2 style=" padding-bottom: 7px; text-align: center;">Add post</h2>

            <form class="form-signin" action="add_post.php" method="post" enctype="multipart/form-data">

              <div class="form-group">
                <textarea name="text" placeholder="Text"></textarea>
              </div>
              <div class="form-group">
                <input type="file" name="file"></textarea>
              </div>
             
              <button  class="btn btn-lg btn-primary btn-block text-uppercase" style="background-color: black" class= "btn btn-outline-light" type="submit" name="submit">Add post</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>