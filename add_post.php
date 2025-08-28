<?php
include("./Posts.php");
require_once("./connection.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = $_POST['content'];
    $userid =  $_SESSION['userid']; 
    $post = new Posts($userid, $content);
    $post->save($userid);

    header("Location: homee.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Post</title>
</head>

<body>
    <h1>Add Post</h1>
    <form action="" method="POST">
        <textarea name="content" rows="5" cols="40" placeholder="What's on your mind?"></textarea><br>
        <button type="submit">Post</button>
    </form>
</body>

</html>