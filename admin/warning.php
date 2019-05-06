
<?php
include "session.php";
require_once "db.php";

if(isset($_GET['del'])){
    $del_id = $_GET['del'];
    $query ="SELECT * FROM post WHERE post_id = $del_id";
    $result = mysqli_query($db, $query);
    $post = mysqli_fetch_assoc($result);

    $title = $post['post_title'];
    $content = $post['post_content'];
    $category = $post['post_category'];
 }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Warning</title>
  </head>
  <body>

    <div class="container">
    <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
    <h1 class="text-center">Warning</h1>
    <div>
     <h4 class="alert alert-danger"> Are you sure That you want delete This post</h4>
     <hr>
     <div>
     <p>
     <? echo $title = $post['post_title']; ?>
     </p>
     </div>
     <div>
     <img src="images/<?php echo $post['post_image'];?>" width="200" height="200" class="mt-5 mb-5" />
     </div>
     <a href="index.php" class="btn btn-primary">Cancel</a>
     <a href="delete.php?delete=<?echo $post['post_id'];?>" class="btn btn-danger ml-5">Delete</a>
    </div>
    </div>
    <div class="col-md-3"></div>
    </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>