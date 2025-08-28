<?php 
require_once("./connection.php");
echo "Welcome to the home page!";

$sql = "SELECT * FROM users;";
$result = mysqli_query($conn, $sql);
echo print_r( mysqli_fetch_assoc($result));
echo "<br>";
?>