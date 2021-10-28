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




$safe_value = mysqli_real_escape_string($_POST['search']);

$result = mysqli_query("SELECT title FROM book WHERE `title` LIKE %$safe_value%");
 while ($row = mysqli_fetch_assoc($result)) {
echo "<div id='link' onClick='addText(\"".$row['username']."\");'>" . $row['username'] . "</div>";  
 }


  ?>