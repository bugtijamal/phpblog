
<?php 
require_once "db.php";

$errors= "";
$messages="";
if(isset($_POST['submit'])){
  $name = $_POST['name'];
  $username1 = trim($_POST['username']);
  $username = str_replace(' ','', $username1);
  $email = $_POST['email'];
  
  $password = $_POST['password'];
  $r_password = $_POST['r_password'];
  

 
 $check_user ="SELECT * FROM `user` WHERE username='$username' and email='$email'";
 $get_user = mysqli_query($db, $check_user);
 if(mysqli_num_rows($get_user) > 0)
  {
  $errors="<h1 class='text-center text-danger'>This email is alraedy exist Please choose other one</h1>";
}

 if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $errors = "<h3 class='text-center text-danger'>Invalid email format</h3>"; 
}
if($password != $r_password){
  $errors ="<h3 class='text-center text-danger'>Password must match</h3>";
}
 if(empty($errors)==true){
  //move_uploaded_file($photo_tmp,"images/".$photo_name);
  $hash_password = password_hash($password, PASSWORD_DEFAULT);
  $sql ="INSERT INTO `user`(`name`, `username`, `email`, `password`, `profile`) VALUES('$name','$username','$email','$hash_password', 'profile.jpg')";
  if (mysqli_query($db, $sql)) {
    $messages= "<h3 class='text-center bg-success'>New record created successfully</h3>";
    header("Location: login.php");
}

else{
  echo "Error: " . $sql . "<br>" . mysqli_error();
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

    <title>Register</title>
  </head>
  <body class="bg-info">
    <h1 class="text-center">User registeration</h1>
  
    <div class="contaner">
   
    <div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4 bg-white p-3 shadow-sm">
    <?php  if($errors){
     print_r ($errors);
   }
   if($messages){
     print_r($messages);
   }
   ?>
     <form action="" method="POST" enctype="multipart/form-data">

     <label for="name">Name:</label>
      <input type="text" name="name" id="name" class="form-control" placeholder="Enter your name" required>
      <label for="username">Username</label>
      <input type="text" name="username" id="username" class="form-control" placeholder="Enter username"  pattern="[^' ']+" required>
      <label for="email">Email</label>
      <input type="email" name="email" id="email" class="form-control" placeholder="Enter email" required>

      <label for="password">Password</label>
      <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" required>
      <label for="r_password">Repeat Password</label>
      <input type="password" name="r_password" id="r_password" class="form-control" placeholder="confirm password" required>
      <br>
      
      <input type="submit" name="submit" class="btn btn-sm btn-outline-info mt-2" value="Sign Up">
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