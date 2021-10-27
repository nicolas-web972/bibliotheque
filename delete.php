<?php

$servername = "localhost:3306";
$username = "root";
$password = "";
$database = "bibliotheque";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully"; ?>  <br> <br> <?php

// sql to delete a record
$sql = "DELETE FROM book WHERE id = ".$_GET['id'];

if ($conn->query($sql) === TRUE) {
  echo " deleted successfully";
} else {
  echo "Error deleting: " . $conn->error;
}

$conn->close();
?>