<?php
require_once("./connection.php");
class Posts
{
    public $userid;
    public $numberoflikes;
    public $content;

    public function __construct(int $userid, $content)
    {
        $this->userid = $userid;
        $this->content = $content;
        $this->numberoflikes = 0;
    }
    function Save($userid)
    {
        global $conn;
        $cont = $this->content;
        $sql = "INSERT INTO posts (content, userid) VALUES ('$cont', '$userid')";

        if (mysqli_query($conn, $sql)) {
            echo "New Post created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
}
