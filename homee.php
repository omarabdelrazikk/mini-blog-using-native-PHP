<?php
include("./Posts.php");
require_once("./connection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  
</head>

<body>
      <link rel="stylesheet" href="./styles/homee.css">
    <h1 style="text-align: center;">Posts</h1>
    <div name="homepage">
        <table>
            <tr>
                <th>
                    Author
                </th>
                <th>
                    Content
                </th>
                <th>
                    Likes
                </th>
                <th>
                    Comments
                </th>
                <th>
                    Like
                </th>
            </tr>
            <?php
            require_once("./connection.php");
            $sql = "SELECT posts.*, users.username 
                    FROM posts 
                    JOIN users ON posts.userid = users.userid;";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['content'] . "</td>";
                echo "<td>" . $row['numberoflikes'] . "</td>";
                echo "<td>
                        <form action='comment_post.php' method='POST'>
                            <input type='hidden' name='post_id' value='" . $row['postid'] . "'>
                            <input type='text' name='comment' placeholder='Add a comment'>
                            <button type='submit'>Comment</button>
                        </form>
                      </td>";
                echo "<td>
                        <form action='like_post.php' method='POST'>
                            <input type='hidden' name='post_id' value='" . $row['postid'] . "'>
                            <button type='submit'>Like 👍</button>
                        </form>
                      </td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
    <a href="logout.php" style=" text-decoration: none; text-align: center; color: brown; margin-left: 870px; height: max-content;">
        Logout</a>
    <a href="add_post.php" style=" text-decoration: none; text-align: center; color: blue; margin-left: 20px; height: max-content;">
        Add Post  </a>
</body>

</html>