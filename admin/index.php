
<?php
 include "session.php";
 require_once "db.php";
 ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>User dashboard</title>
  </head>
  <body>
 <div class="container">
  <nav class="navbar navbar-expand-lg navbar-light bg-info">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="addpost.php">Add Post</a>
      </li>
    </ul>
    <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="logout.php"> <strong> Logout </strong></a>
    </li>
     <li class="nav-item ">
      <a class="nav-link" href="profile.php?profile=<? echo $row['id']; ?>">
      <strong><? echo $row['name'];?></strong>
      <img src="profiles/<?php echo $row['profile'];?>" class="img rounded-circle" style="height:25px; width:25px;" alt="profile-pic">
      </a>
      </li>
      
  </ul>
  </div>
</nav>
</div>

<div class="container">
<table class="table table-striped table-sm table-bordered">
<thead>
<th>Sr</th>
<th>Title</th>
<th>Author</th>
<th>Date</th>
<th>Views</th>
<th>Image</th>
<th>Edit</th>
<th>Delete</th>
</thead>
<tbody>
</tbody>
<?php
  
$sql = "SELECT * FROM post";
$query = mysqli_query($db, $sql);
$row = mysqli_fetch_row($query);
$rows = $row[0];
$page_rows = 10;

$last = ceil($rows/$page_rows);
if($last < 1){
	$last = 1;
}
$pagenum = 1;

if(isset($_GET['page'])){
	$pagenum = preg_replace('#[^0-9]#', '', $_GET['page']);
}
// This makes sure the page number isn't below 1, or more than our $last page
if ($pagenum < 1) { 
  $pagenum = 1; 
} else if ($pagenum > $last) { 
  $pagenum = $last; 
}
// This sets the range of rows to query for the chosen $pagenum
$limit = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;

$query ="SELECT * FROM post ORDER BY post_id DESC $limit";
  
  $result = mysqli_query($db, $query);

$textline2 = "Page <b>$pagenum</b> of <b>$last</b>";
// Establish the $paginationCtrls variable
$paginationCtrls = '';


if($last != 1){
	if ($pagenum > 1) {
        $previous = $pagenum - 1;
		    $paginationCtrls .= '<li class="page-item"> <a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$previous.'">Prev</a> </li> ';
		for($i = $pagenum-4; $i < $pagenum; $i++){
			if($i > 0){
		        $paginationCtrls .= '<li class="page-item"> <a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$i.'">'.$i.'</a> </li>';
			}
	    }
    }

$paginationCtrls .= '<li class="page-item active"><a class="page-link">'.$pagenum.'</a></li>';

for($i = $pagenum + 1; $i <= $last; $i++){
  $paginationCtrls .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$i.'">'.$i.'</a> </li>';
  if($i >= $pagenum + 4){
    break;
  }
}

  if ($pagenum != $last) {
    $next = $pagenum + 1;
    $paginationCtrls .= '<li class="page-item"> <a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$next.'">Next</a> </li> ';
}
}

$list = '';
   $sr = 0;
  while($row = mysqli_fetch_assoc($result)):
    $author = $row['post_user'];
    $sr = $sr + 1;
    $get_user ="SELECT * FROM user WHERE id ='$author' ";
    $u_result = mysqli_query($db, $get_user);

    $date = $row['post_date'];
    while($u_row =mysqli_fetch_assoc($u_result)):

 ?>
<tr>
 <td><? echo $sr; ?></td>
 <td><? echo $row['post_title'];?></td>
 <td><? echo $u_row['username']; ?></td>
 <td><?echo date("M d, Y", strtotime($date));?></td>
 <td><i class="fas fa-eye"> <? echo $row['post_views'];?></i></td>
 <td><img src="images/<?php echo $row['post_image'];?>" width="50" height="40" /></td>

 <td>
 <a href="addpost.php?edit=<?php echo $row['post_id'];?>" class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>
 </td>
 <td>
 <a href="warning.php?del=<?php echo $row['post_id'];?>" class="btn btn-sm btn-warning"><i class="fas fa-trash"></i></a>
 </td>

</tr>

  <?php endwhile;
   endwhile;
   ?>
</table>
<p><?php echo $textline2; ?></p>
<nav class="page  navigation example">
<ul class="pagination">
  
  <?php echo $paginationCtrls; ?>
</ul>
</nav>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>

