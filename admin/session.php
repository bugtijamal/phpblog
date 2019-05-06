<?php
   include 'db.php';
   session_start();
   
   $user_check = $_SESSION['login_user'];
   $ses_sql = mysqli_query($db,"SELECT * from user where username = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql);
   
   $login_session = $row['username'];
   
   if(!isset($_SESSION['login_user'])){
      $erorr ="You are not allowed please login first";
      header("location:login.php");
      $erorr ="You are not allowed please login first";
     
      die();
   }
?>