<?php
include "session.php";
require_once "db.php";

if(isset($_GET['delete'])){
    $del_id = $_GET['delete'];
    $query ="SELECT * FROM post WHERE post_id =$del_id";
     $result = mysqli_query($db, $query);
     $post = mysqli_fetch_assoc($result);
    if (unlink("images/".$post['post_image'])){

    $sql = "DELETE FROM post WHERE post_id=$del_id";
if ($db->query($sql) === TRUE) {
    echo "Record deleted successfully";
    header("Location: index.php");
} else {
    echo "Error deleting record: " . $conn->error;
}
    }
 }
?>