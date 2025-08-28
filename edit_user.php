<?php
require_once("./connection.php");
$id = (int) $_GET['id'];
$sql = "SELECT username, email, isadmin , password FROM users WHERE userid = '$id';";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit</title>
    <link rel="stylesheet" href="./styles/REGstyle.css">

</head>

<body>
    <div class="body">
        <form method="post" >
            <table class="table">
                <tr>
                    <th>Field</th>
                    <th>Input</th>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" id="username" name="username"  value="<?php echo $row['username'] ?>"></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="email" id="email" name="email"  value="<?php echo $row['email'] ?>"></td>
                </tr>
                <tr>
                    <td>new Password (Left empty if no needed change)</td>
                    <td><input type="password" id="password" name="password" ></td>
                </tr>
                <tr>
                    <td>old-Password</td>
                    <td><input type="password" id="oldpassword" name="oldpassword" required></td>
                </tr>
            </table>
            <input type="submit" value="Edit"
                style="color: white; font-weight: bold; font-size: 16px; font-family: Arial, sans-serif; background-color: green;  border: none;  border-radius: 8px; padding: 5px 20px;">
            <input type="reset" value="Cancel"
                style="margin-left: 10px; color: white; font-weight: bold; font-size: 16px; font-family: Arial, sans-serif; background-color: brown; border: none; border-radius: 8px; padding: 5px 20px;">
        </form>
    </div>
    <script src="./scripts/Edit.js"></script>
</body>

</html>

<?php
if (isset($_POST['username'])&& !empty($_POST['username'])) {
$username = $_POST['username'];
$sql = "UPDATE users SET username = '$username' WHERE userid = '$id'";
mysqli_query($conn, $sql);
}
if (isset($_POST['email'])&& !empty($_POST['email'])) {
$email = $_POST['email'];
$sql = "UPDATE users SET email = '$email' WHERE userid = '$id'";
mysqli_query($conn, $sql);
}
if (isset($_POST['oldpassword']) && isset($_POST['password'])) {
$oldpassword = $_POST['oldpassword'];
$newpassword = $_POST['password'];
if (password_verify($oldpassword, $row['password'])) {
$npass = password_hash($newpassword, PASSWORD_DEFAULT);
$sql = "UPDATE users SET password = '$npass' WHERE userid = '$id';";
mysqli_query($conn, $sql);
}
}

?>