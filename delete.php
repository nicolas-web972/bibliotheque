<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Read</title>
</head>
<H1>Enregistrer un nouveau livre</H1>
<body>
  
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
  header("Location: /read.php?deleted=1");
  die();} else {
  echo "Error deleting: " . $conn->error;
}

$conn->close();
?>
</body>
</html>
