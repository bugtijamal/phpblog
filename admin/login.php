<?php
require_once "db.php";
   session_start();
  
   if(isset($_SESSION['login_user'])){
    header("location:index.php");
   
 }

   $error="";
   if(isset($_POST['login'])) {
      // username and password sent from form 
      $username = $_POST['username'];
      $password = $_POST['password']; 
      
      $sql ="SELECT * FROM user WHERE username = '$username'";
      $result = mysqli_query($db, $sql);
      $row = mysqli_fetch_array($result);
      $count = mysqli_num_rows($result);
      $data_pass = $row['password'];
      // If result matched $myusername and $mypassword, table row must be 1 row
      if($count > 0) {
        if (password_verify($password, $data_pass)) {
          $_SESSION['login_user'] = $username;
          $_SESSION['id'] = $row['id'];
          header("location: index.php");
         }
         else{
         
         $error='Invalid password.';
          }
           
      }
      else {
        $error= "There is no such user";
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

    <title>Login</title>
  </head>
  <body>
    <h1 class="text-center">Login</h1>
   
  
    <div class="contaner">
    <div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
    <?php if($error):?>
    <div class="aler alert-danger pl-3 p-2">
     <? echo $error; ?>
     </div>
   <?php endif; ?>
    
     <form action="" method="POST" enctype="multipart/form-data">

      <label for="username">Username: </label>
      <input type="text" name="username" id="username" class="form-control" required>

      <label for="password">Password: </label>
      <input type="password" name="password" id="password" class="form-control" required>
    
      <br>
      
      <input type="submit" name="login" class="btn btn-sm btn-outline-info mt-2" value="Login">
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