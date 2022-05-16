<br>
<?php
  session_start();
  require 'config.php';
  $user=$_SESSION['user_name'];
  $query = "SELECT p.id, p.user_name, p.text, p.img, p.date_posted, u.first_name, u.last_name  from post p INNER JOIN user u ON p.user_name=u.user_name WHERE p.user_name = '$user' or p.user_name IN(SELECT 'user_name' FROM user WHERE 'user_name' IN (SELECT friend FROM frindes WHERE 'user_name'='$user')) order by date_posted DESC";
  $result = mysqli_query($conn, $query);
  if(mysqli_num_rows($result)==0)
    { 
      echo "<p style='margin-left:10px''>There are No posts</p>";
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
            <div class="card-block px-3">
              <?php
                echo "<h4 class='card-title'>"."<a href='profil.php?user_name=".$row['user_name']."'>".$row['first_name']." ".$row['last_name']."</a>"."</h4>";  
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
          <input class="form-control" style="width: 700px" type="text" name="text" id="newcomment" placeholder="Comment"  aria-describedby="basic-addon2" required>
          <input type="hidden" name="post_id" value="<?php echo($post_id)?>">
        </div>
        <input type="submit" value="Comment" class="btn btn-primary mb-2 btn-outline-secondary comment_btn">
      </form>
    </div>
    <div>  
      <p id="newlikes">
        <?php 
          $query2 = "SELECT count(*) AS likes FROM likes where post_id = $post_id";
          $result2 = mysqli_query($conn, $query2);         
          $row2 = mysqli_fetch_assoc($result2);
          $query3 = "SELECT 'user_name' as liked FROM likes WHERE 'user_name' = '$user' AND post_id= $post_id";
          $result3 = mysqli_query($conn, $query3);         
          $row3 = mysqli_fetch_assoc($result3);
          if (!isset($row3['liked'])) 
          {
        ?>
        <a id='like' value="<?php echo $post_id;?>" class="float-left btn text-white btn-primary" onclick="like(this)"><?php echo $row2['likes'];?> Like</a>
        <?php
          }
          else
          {
        ?>
        <a id='like' value="<?php echo $post_id;?>" class="float-left btn text-white btn-danger" onclick="like(this)"><?php echo $row2['like'];?> Like</a>
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
        }
    });
    return false;
  });
</script>
