<?php
session_start();
include("./connection.php");

;
class Comment_post
{
    private $postid;
    private $userid;
    private $content;
    public function __construct($postid, $userid, $content)
    {
        $this->postid = $postid;
        $this->userid = $userid;
        $this->content = $content;
    }

    function save()
    {

        global $conn;
        $cont = $this->content;
        $userid = $this->userid;
        $postid = $this->postid;
        $sql = "INSERT INTO comments (content, userid,postid) VALUES ('$cont', '$userid','$postid')";

        if (mysqli_query($conn, $sql)) {
            echo "New comment created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
        header("Location: homee.php");
        exit();
    }

}
$comment = new Comment_post($_POST['post_id'],$_SESSION['userid'],$_POST['comment']);
$comment->save();
?>