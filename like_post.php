<?php
include("./connection.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_id = $_POST['post_id'];
    $sql = "UPDATE posts SET numberoflikes = numberoflikes + 1 WHERE postid = '$post_id';";
    mysqli_query($conn, $sql);
    header("Location: homee.php");
    exit();
}

        mysqli_close($conn);