<?php include "../admin/db.php";
$slider ="SELECT * FROM post ORDER BY post_id DESC limit 3";
$result = mysqli_query($db, $slider);

 ?>
    <section class="site-section pt-5">
      <div class="container">
        <div class="row">
          <div class="col-md-12">

            <div class="owl-carousel owl-theme home-slider">
     <?php  while($row = mysqli_fetch_assoc($result)):
        $date = $row['post_date'];?>
              <div>
                <a href="blog-single.php?post=<? echo $row['post_id'];?>" class="a-block d-flex align-items-center height-lg" style="background-image: url('../admin/images/<?php echo $row["post_image"];?>'); ">
                  <div class="text half-to-full">
                    
                    <h3><? echo $row['post_title'];?></h3>
                    <p> <? echo substr($row['post_content'], 0, 100);?></p>
                    <div class="post-meta">
                      <span class="category"><? echo $row['post_category'];?></span>
                      <span class="mr-2"><?echo date("M d, Y", strtotime($date));?></span> &bullet;
                      <span class="ml-2"><span class="fa fa-comments"></span> <? echo $row['post_comments'];?> </span> <span class="ml-2"><span class="fa fa-eye"></span> <? echo $row['post_views'];?> </span>
                    </div>
                  </div>
                </a>
              </div>
<?php  endwhile;?>  
            </div>
          </div>
        </div>
      </div>
    </section>