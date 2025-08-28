<?php
include("./connection.php");
$id = $_GET['id'];
$stmt = "DELETE FROM users WHERE userid = '$id';";
if (mysqli_query($conn, $stmt)) {
  echo "Record deleted successfully";
  header("Location:./admins.php");
} else {
  echo "Error deleting record: " . mysqli_error($conn);
}

mysqli_close($conn);