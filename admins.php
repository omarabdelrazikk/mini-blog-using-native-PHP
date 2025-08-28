<?php
session_start();
require_once("./connection.php");
if (!isset($_SESSION['userid']) || $_SESSION['isadmin'] !== true) {
    header("Location: ./login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admins</title>
    <link rel="stylesheet" href="./styles/admins.css">
</head>

<body>
    <div id="container">
        <h1 style="font-family: 'Courier New', Courier, monospace; text-align: center;">Welcome to the Admins Page</h1>
        <p>Manage your admin settings here.</p>
        <table>
            <th>
                <tr>
                    <td>
                        User name
                    </td>
                    <td>
                        Email
                    </td>
                    <td>
                        is Admin
                    </td>
                    <td>
                        actions
                    </td>
                </tr>
            </th>
            <?php
            $stmt = "SELECT userid, username,email,isadmin FROM users ; ";
            $result = mysqli_query($conn, $stmt);
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['isadmin'] ? 'Yes' : 'No'; ?></td>
                    <td>
                        <a href="edit_user.php?id=<?php echo $row['userid']; ?>">Edit</a>
                        <a href="delete_user.php?id=<?php echo $row['userid']; ?>">Delete</a>
                    </td>
                </tr>
            <?php }
            ?>

        </table>

    </div>
    <a href="logout.php" style=" text-decoration: none; text-align: center; color: brown; margin-left: 870px; height: max-content;">
        Logout
    </a>
</body>

</html>