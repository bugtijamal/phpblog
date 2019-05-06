<?php
include "session.php";
require_once "db.php";






  $errors ="";
  $messages="";
if(isset($_POST['post'])){
 
 $post_title = trim($_POST['post_title']);
 $post_content = trim($_POST['post_content']);
 $post_category= $_POST['post_category'];

 $photo_name = $_FILES['photo']['name'];
 $photo_size =$_FILES['photo']['size'];
 $photo_tmp =$_FILES['photo']['tmp_name'];
 $photo_type=$_FILES['photo']['type'];

   $photo_ext=strtolower(end(explode('.',$_FILES['photo']['name'])));
   $extensions= array("jpeg","jpg","png");
  
  if(!in_array($photo_ext,$extensions)){
   $errors="extension not allowed, please choose a JPEG or PNG file.";
}

 if($photo_size > 2097152){
   $errors='File size must be excately 2 MB';
 }

 if(empty($errors)==true){
    move_uploaded_file($photo_tmp,"images/".$photo_name);
    $post_title = addslashes($post_title);
    $post_content = addslashes($post_content);
    $sid = $_SESSION['id'];
    $query ="INSERT INTO `post`(`post_title`, `post_content`, `post_image`, `post_user`,`post_category`)VALUES('$post_title','$post_content','$photo_name','$sid' ,'$post_category')";
    if (mysqli_query($db, $query)) {
     $messages= "<h2 class='text-center bg-success'>New record posted successfully</h2>";
     header("Location: index.php");
 }

 else{
   echo "Error:" ."<br>" . mysqli_error($db);
  }
  }
 }




if($errors){
  print_r ($errors);
}
if($messages){
  print_r($messages);
}

$title ="";
$category ="";
$content ="";

if(isset($_GET['edit'])){
  $edit_id = $_GET['edit'];
  $query ="SELECT * FROM post WHERE post_id = $edit_id";
  $result = mysqli_query($db, $query);
  $post = mysqli_fetch_assoc($result);
  $content = $post['post_content'];
  $category = $post['post_category'];
 $title = $post['post_title'];
  
}






if(isset($_POST['editpost'])){
  $title = trim($_POST['post_title']);
   $content = trim($_POST['post_content']);
   $category = $_POST['post_category'];
   $title = addslashes($title);
  $content = addslashes($content);

  $del_image = $post['post_image'];
  $photo_name = $_FILES['photo']['name'];
  $photo_size =$_FILES['photo']['size'];
  $photo_tmp =$_FILES['photo']['tmp_name'];
  $photo_type=$_FILES['photo']['type'];
 
    $photo_ext=strtolower(end(explode('.',$_FILES['photo']['name'])));
    $extensions= array("jpeg","jpg","png");
   
   if(!in_array($photo_ext,$extensions)){
    $errors="extension not allowed, please choose a JPEG or PNG file.";
 }
 
  if($photo_size > 2097152){
    $errors='File size must be excately 2 MB';
  }

   if( !empty($photo_tmp)===true && empty($errors)===true){
    unlink("images/".$del_image);
    move_uploaded_file($photo_tmp,"images/".$photo_name);
   
    $update_query ="UPDATE `post` SET post_title='$title', post_content='$content',post_image='$photo_name', post_category='$category' WHERE post_id='$edit_id'";
    if(mysqli_query($db, $update_query)){
      header("Location: index.php");
    }

   }
    
   else{
      $update_query ="UPDATE `post` SET post_title='$title', post_content='$content',post_category='$category' WHERE post_id='$edit_id'";
      if(mysqli_query($db, $update_query)){
        header("Location: index.php");
      }
    }
   }
 
?>
 <!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title><? echo (isset($_GET['edit']) ? 'Update Post' : 'Add post'); ?></title>
  </head>
  <body>
    <h1 class="text-center"><? echo (isset($_GET['edit']) ? 'Update Post' : 'Add post'); ?></h1>
    
    <div class="contaner">

   
    <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
    <a href="index.php" class=" btn btn-warning float-right mb-2">Cancel</a>
     <form action="" class="form-group" method="POST" enctype="multipart/form-data">

     <label for="title">title:</label>
      <input type="text" name="post_title" id="title" class="form-control mb-2" placeholder="Enter title" value="<? echo $title; ?>" required>
      <label for="category">Add category</label>
      <select name="post_category" id="category" class="form-control" required>
         <? if (isset($_GET['edit'])):?>
         <option value="<? echo $category;?>"><? echo $category; ?></option>
  <? else:?>
          <option value="">Select category</option>
  <? endif; ?>
          <option value="local">Local</option>
          <option value="world">World</option>
          <option value="support">Support</option>
          <option value="lifestyle">Lifestyle</option>
      </select>
      
      <label for="post_content">Full content</label>
     <textarea name="post_content" id="post_content" class="form-control" rows="30"><? echo $content; ?></textarea>
      <br>
      <? if(isset($_GET['edit'])):?>
      <input type="file" name="photo" class="form-control-file">
      <img src="images/<?php echo $post['post_image'];?>" width="70" height="60" style="position: reletive; margin-left: 25%; margin-top: -50px;">
      <? else:?>
      <input type="file" name="photo" class="form-control-file " required>
      <? endif;?>
      <br>
      <? if (isset($_GET['edit'])):?>
      <input type="submit" name="editpost" class="btn btn-sm btn-outline-info mt-4" value="Edit Post">
      <? else:?>
  <input type="submit" name="post" class="btn btn-sm btn-outline-info mt-2" value="Add post">
  <? endif;?>
      
     </form>
    </div>
    <div class="col-md-2"></div>
    </div>
    </div>


    <script>
        CKEDITOR.replace( 'post_content' );
    </script>
    <!-- Optional JavaScript -->
    
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>