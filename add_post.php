<?php
include("./Posts.php");
require_once("./connection.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = $_POST['content'];
    $userid = $_SESSION['userid'];
    $post = new Posts($userid, $content);
    $post->save($userid);
    $nam = $_SESSION['postt'];
    if (isset($_FILES['immg'])) {
        $imaagetyp = explode("/", $_FILES['immg']['type']);
        $ext = strtolower(end($imaagetyp));
        $allowed = array('jpeg', 'jpg', 'png');
        if (in_array($ext, $allowed)) {
            move_uploaded_file($_FILES['immg']['tmp_name'], __DIR__ . "\\upload\\$nam." . $ext);
        }
    }
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
    <link rel="stylesheet" href="./styles/post.css">
    <h1>Add Post</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <textarea name="content" rows="5" cols="40" placeholder="What's on your mind?"></textarea><br>
        <input type="file" name="immg">
        <button type="submit">Post</button>
    </form>
</body>

</html>
