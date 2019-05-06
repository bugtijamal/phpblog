<?php include "../admin/db.php";?>
<?php include "includes/header.php"; ?>
<?php include "includes/navbar.php"; ?>
    <!-- END header -->
<?php

if(isset($_GET['post'])){
$post_id = $_GET['post'];

 $sql ="SELECT * FROM post WHERE post_id=$post_id";
 $result = mysqli_query($db, $sql);
 $post = mysqli_fetch_assoc($result);

 $views = $post['post_views']  = $post['post_views'] + 1 ;
 $updateviews ="UPDATE post SET post_views= $views WHERE post_id=$post_id";
 mysqli_query($db, $updateviews);

}
 ?>
    <section class="site-section py-lg">
      <div class="container">
        
        <div class="row blog-entries">
          <div class="col-md-12 col-lg-8 main-content">
          <div class="col-md-12 mb-4 element-animate">
                <img src="../admin/images/<? echo $post['post_image'];?>" alt="Image placeholder" class="img-fluid">
          </div>
            <h1 class="mb-4"><? echo $post['post_title'];?></h1>
            <div class="post-meta">
                        <span class="category">Food</span>
                        <span class="mr-2"><?echo date('M d, Y', strtotime($post['post_date']));?> </span> &bullet;
                        <span class="ml-2"><span class="fa fa-comments"></span> 3</span>
                        <span class="ml-2"><span class="fa fa-eye"></span> <? echo $post['post_views'];?> </span>
                      </div>
            <div class="post-content-body">
              <p> <? echo $post['post_content'];?> </p>
            </div>

            
            <?php 
             $post_id = $_GET['post'];
            $comment ="SELECT * FROM comment WHERE post_id= $post_id";
            $r_comment = mysqli_query($db, $comment);
            ?>

            <div class="pt-5">
              <h3 class="mb-5">9 Comments</h3>
              <ul class="comment-list">
              <?php  while($comment_row = mysqli_fetch_assoc($r_comment)):?>
                <li class="comment">
                  <div class="vcard">
                    <img src="images/person_1.jpg" alt="Image placeholder">
                  </div>
                  <div class="comment-body">
                    <h3><? echo $comment_row['name'];?></h3>
                    <div class="meta"><?echo date('M d, Y', strtotime($comment_row['date']));?> at <?echo date('h:i a', strtotime($post['post_date']));?> </div>
                    <p><? echo $comment_row['message'];?></p>
                    <p><a href="#" class="reply">Reply</a></p>
                  </div>
                </li>
             <? endwhile;?>
                  </ul>
                
              <!-- END comment-list -->
              <?php 
                if(isset($_POST['addcomment'])){
                  $post_id = $_GET['post'];
                  $name = $_POST['name'];
                  $email = $_POST['email'];
                  $message = $_POST['message'];

                  $sql ="INSERT INTO comment (name,email,message,post_id)VALUES('$name','$email','$message','$post_id')";
                  $result= mysqli_query($db, $sql);

                  $comment = $post['post_comments'] = $post['post_comments'] +1 ;
                  $com ="UPDATE post SET post_comments= $comment WHERE post_id=$post_id";
                  mysqli_query($db, $com);

                  header("Location: blog-single.php?post=$post_id");
                }
               ?>
              <div class="comment-form-wrap pt-5">
                <h3 class="mb-5">Leave a comment</h3>
                <form action="" class="p-5 bg-light" method="POST">
                  <div class="form-group">
                    <label for="name">Name *</label>
                    <input type="text" class="form-control" id="name" name="name">
                  </div>
                  <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" class="form-control" id="email" name="email">
                  </div>
                
                  <div class="form-group">
                    <label for="message">Message*</label>
                    <textarea name="message" id="message" cols="30" rows="10" class="form-control"></textarea>
                  </div>
                  <div class="form-group">
                    <input type="submit" value="Post Comment" class="btn btn-primary" name="addcomment">
                  </div>

                </form>
              </div>
            </div>
          </div>

          <!-- END main-content -->
          <?php include "includes/sidebar.php"; ?>
            <!-- END sidebar-box -->
        
          </div>
          <!-- END sidebar -->

        </div>
      </div>
    </section>

    <!-- END section -->
    <?php include "includes/footer.php"; ?>