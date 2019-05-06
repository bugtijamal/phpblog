
<?php 
include "session.php";
require_once "db.php";

$errors= "";
$messages="";

if(isset($_GET['profile'])){

 $user_id = $_GET['profile'];
 $query ="SELECT * FROM user WHERE id='$user_id'";
 $user_result = mysqli_query($db, $query);
 $user = mysqli_fetch_assoc($user_result);
 
}

if (isset($_POST['submit'])){
$name = trim($_POST['name']);
  $username = trim($_POST['username']);
  $username = str_replace(' ','', $username);
  $email = $_POST['email'];

  $del_image =$user['profile'];
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

   if( !empty($photo_tmp)=== true && empty($errors)===true){
     if("profiles/".$del_image && "profiles/".$del_image != "profile.jpg"){
      unlink("profiles/".$del_image);
  
     }
      move_uploaded_file($photo_tmp,"profiles/".$photo_name);
    
    $update_query ="UPDATE `user` SET name='$name', username='$username',email='$email', profile='$photo_name' WHERE id='$user_id'";
    if(mysqli_query($db, $update_query)){
      header("Location: index.php");
    }

   }

   else{
    $update_query ="UPDATE `user` SET name='$name', username='$username',email='$email' WHERE id='$user_id'";
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

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">

    <title>Profile</title>
  </head>
  <body>
    <div class="text-center">
    <h1>Profile</h1>
   
  
     <img src="profiles/<? echo $user['profile'];?>" alt="profile-pic" width="80" height="80" class="img rounded-circle" style="margin-bottom:-25px;"><br>

     
    </div>
    
    <div class="contaner">
    <div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4  p-5 shadow-lg">
    <?php  if($errors){
     print_r ($errors);
   }
   if($messages){
     print_r($messages);
   }
   ?>
     <form action="" method="POST" enctype="multipart/form-data">
     <h6 class="text-center">
     <label for="photo" class="text-center" style="font-size:35px; cursor:pointer;"><span class="fas fa-image"></span></label>
     <br>
     <small>Edit profile </small>
     </h6>
     
      <input type="file" class="invisible" id="photo" name="photo">
     <label for="name">Name:</label>
      <input type="text" name="name" id="name" class="form-control-plaintext" value="<?php echo $user['name']; ?>" placeholder="Enter your name" required>
      <label for="username">Username</label>
      <input type="text" name="username" id="username" class="form-control-plaintext" placeholder="Enter username"  pattern="[^' ']+" value="<?php echo $user['username'];?>" required>
      <label for="email">Email</label>
      <input type="email" name="email" id="email" class="form-control-plaintext" placeholder="Enter email" value="<?php echo $user['email'];?>" required>
      
      <br>
      
      <input type="submit" name="submit" class="btn btn-sm btn-primary p-2" value="Update profile">
      <a href="index.php" class="float-right btn btn-info mb-5"> Go to dashboard </a>
     </form>
 
    </div>
    <div class="col-md-4"></div>
    </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>