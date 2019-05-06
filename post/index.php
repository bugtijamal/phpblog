<?php include "../admin/db.php";?>
<?php include "includes/header.php"; ?>
<?php include "includes/navbar.php"; ?>
    <!-- END header -->
<?php include "includes/slider.php"; ?>
    <!-- SLIDE SECTION -->
    <!-- END section -->
    <section class="site-section py-sm">
      <div class="container">
        <div class="row blog-entries">
          <div class="col-md-12 col-lg-8 main-content">
            <div class="row">
            <?php 
            $sql ="SELECT * FROM post ORDER BY post_id DESC limit 4";
            $result = mysqli_query($db, $sql);
             while($post = mysqli_fetch_assoc($result)):
             ?>

              <div class="col-md-6">
                <a href="blog-single.php?post=<? echo $post['post_id'];?>" class="blog-entry element-animate" data-animate-effect="fadeIn">
                  <img src="../admin/images/<? echo $post['post_image'];?>" alt="Image placeholder">
                  <div class="blog-content-body">
                    <div class="post-meta">
                      <span class="category"><? echo $post['post_category'];?></span>
                      <span class="mr-2">March 15, 2018 </span> &bullet;
                      <span class="ml-2"><span class="fa fa-comments"> </span> <? echo $post['post_comments'];?> </span>
                      <span class="ml-2"><span class="fa fa-eye"></span> <? echo $post['post_views'];?> </span>
                    </div>
                    <h2><? echo $post['post_title'];?></h2>
                  </div>
                </a>
              </div>
             <?php endwhile;?>
      
            </div>

        
            <div class="row mb-5 mt-5">

              <div class="col-md-12">
                <h2 class="mb-4">More Blog Posts</h2>
              </div>
            
              <div class="col-md-12">
              <?php 
            $sql ="SELECT * FROM post ORDER BY post_id DESC limit 4,4";
            $result = mysqli_query($db, $sql);
             while($post = mysqli_fetch_assoc($result)):
             ?>
                <div class="post-entry-horzontal">
                  <a href="blog-single.php?post=<? echo $post['post_id'];?>">
                    <div class="image element-animate"  data-animate-effect="fadeIn" style="background-image: url(../admin/images/<? echo $post['post_image'];?>);"></div>
                    <span class="text">
                      <div class="post-meta">
                        <span class="category">Travel</span>
                        <span class="mr-2">March 15, 2018 </span> 
                        <span class="ml-2"><span class="fa fa-comments"></span> 3</span>
                        <span class="fa fa-eye"></span> <? echo $post['post_views'];?> </span>
                    
                      </div>
                      <h2><? echo $post['post_title'];?></h2>
                    </span>
                  </a>
                </div>
                <?php endwhile;?>

                <!-- END post -->
              </div>
            </div>
          </div>
          <!-- END main-content -->
          <?php include "includes/sidebar.php"; ?>
          <!-- END sidebar -->
        </div>
      </div>
    </section>
    <?php include "includes/footer.php"; ?>