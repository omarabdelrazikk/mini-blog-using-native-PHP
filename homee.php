<?php
include("./Posts.php");
require_once("./connection.php");
session_start();
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
                $_SESSION['postt'] = $row['postid'] + 1;
                ?>
                <tr>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['content']; ?> <br>
                        <?php
                        $files = glob("upload/*.*");
                        for ($i = 0; $i < count($files); $i++) {
                            $image = $files[$i];
                            $name = explode(".", explode("/", $image)[1])[0];
                           if (((int) $name) == $row['postid'] ) {
                            echo '<img src="' . $image . '" alt="Random image" width="50" />' . "<br /><br />";
                           }
                        }
                        ?>
                    </td>

                    <td><?php echo $row['numberoflikes']; ?></td>
                    <td>
                        <form action='comment_post.php' method='POST'>
                            <input type='hidden' name='post_id' value='<?php echo $row['postid']; ?>'>
                            <input type='text' name='comment' placeholder='Add a comment'>
                            <button type='submit'>Comment</button>
                        </form>

                    </td>
                    <td>
                        <form class="like-form" action="like_post.php" method="POST">
                            <input type="hidden" name="post_id" value="<?php echo $row['postid']; ?>">
                            <button type="submit" class="like">Like 👍</button>
                        </form>

                    </td>
                <tr>
                    <?php
                    $postid = $row['postid'];
                    $sql2 = "SELECT comments.*, users.username 
                                 FROM comments 
                                 JOIN users ON comments.userid = users.userid 
                                 WHERE comments.postid = $postid;";
                    $result2 = mysqli_query($conn, $sql2);
                    while ($comment = mysqli_fetch_assoc($result2)) {
                        echo "<tr><td colspan='4' style='padding-left: 20px; font-size: 14px; color: gray;'>" . htmlspecialchars($comment['username']) . ": " . htmlspecialchars($comment['content']) . "</td></tr>";
                    }
                    ?>
                </tr>
            <?php }
            ?>
        </table>
    </div>
    <a href="logout.php"
        style=" text-decoration: none; text-align: center; color: brown; margin-left: 670px; height: max-content; border: 3px solid brown; border-radius: 4px;">
        Logout</a>
    <a href="add_post.php"
        style=" text-decoration: none; text-align: center; color: blue; margin-left: 20px; height: max-content; border:3px solid blue; border-radius: 4px;">
        Add Post </a>
    <script>
        // Get current user ID from PHP session
        const currentUserId = <?php echo json_encode($_SESSION['userid']); ?>;

        const like = document.querySelectorAll(".like");

        // Check for already liked posts on page load
        like.forEach(button => {
            const postId = button.form.querySelector('input[name="post_id"]').value;
            const storageKey = "likedPost_" + postId + "_user_" + currentUserId;

            // If this post was already liked by current user, disable the button
            if (localStorage.getItem(storageKey)) {
                button.disabled = true;
                button.textContent = "Liked 👍";
                return; // Skip adding the event listener
            }

            button.addEventListener("click", function handler(e) {
                e.preventDefault();
                e.stopPropagation();

                // Store in localStorage that this post was liked by current user
                localStorage.setItem(storageKey, "true");

                // Disable button immediately to prevent double clicks
                button.disabled = true;
                button.textContent = "Liked 👍";

                // Submit the form
                button.form.submit();

                // Remove event listener to ensure it can't be triggered again
                button.removeEventListener("click", handler);
            });
        });
    </script>
</body>

</html>