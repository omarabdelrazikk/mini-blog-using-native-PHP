<?php
require_once("./connection.php");
include("./Users.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="./styles/REGstyle.css">

</head>

<body>
    <div class="body">
        <form method="post">
            <table class="table">
                <tr>
                    <th>Field</th>
                    <th>Input</th>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" id="username" name="username" required></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="email" id="email" name="email" required></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" id="password" name="password" required></td>
                </tr>
                <tr>
                    <td>re-Password</td>
                    <td><input type="password" id="repassword" name="repassword" required></td>
                </tr>
            </table>
            <input type="submit" value="Register"
                style="color: white; font-weight: bold; font-size: 16px; font-family: Arial, sans-serif; background-color: green;  border: none;  border-radius: 8px; padding: 5px 20px;">
            <input type="reset" value="Cancel"
                style="margin-left: 10px; color: white; font-weight: bold; font-size: 16px; font-family: Arial, sans-serif; background-color: brown; border: none; border-radius: 8px; padding: 5px 20px;">
        </form>
    </div>
    <script src="./scripts/Reg.js"></script>
</body>

</html>

<?php
if (isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["repassword"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $password2 = $_POST["repassword"];
    $user = new Users($username, $email, $password);
    if ($user->validate($password2)) {
        $user->save();
        header("Location: ./Login.php");
    }
}


?>