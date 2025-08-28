<?php
require_once("./connection.php");
session_start();

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
                    <td>Username or Email</td>
                    <td><input type="text" id="usernamemail" name="usernamemail" required></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" id="password" name="password" required></td>
                </tr>

            </table>
            <input type="submit" value="Login"
                style="color: white; font-weight: bold; font-size: 16px; font-family: Arial, sans-serif; background-color: blue;  border: none;  border-radius: 8px; padding: 5px 20px;">
            <input type="reset" value="Cancel"
                style="margin-left: 10px; color: white; font-weight: bold; font-size: 16px; font-family: Arial, sans-serif; background-color: brown; border: none; border-radius: 8px; padding: 5px 20px;">
        </form>
    </div>
    <script src="./scripts/Reg.js"></script>
</body>

</html>

<?php

if (isset($_POST['usernamemail']) && isset($_POST['password'])) {
    $usernamemail = $_POST["usernamemail"];
    $password = $_POST["password"];
    $stmt = $conn->prepare("SELECT userid, username, password FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $usernamemail, $usernamemail);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result && mysqli_num_rows($result) > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            
            $_SESSION['userid'] = $row['userid'];
            $_SESSION['username'] = $row['username'];

            header("Location: ./homee.php");
            exit();
        } else {
            echo "Incorrect password.";
        }
        exit();
    } else {
        echo "There is no user with such username/email or password wrong";
    }
}

?>