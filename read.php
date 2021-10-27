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
echo "Connected successfully";?> <br>
<?php
$sql = "SELECT book.id, book.title, author.firstname, author.lastname, book.date 
FROM book 
JOIN author on book.author_id = author.id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["id"]. " - Titre: " . $row["title"]. " | Auteur " . $row["firstname"] ." ". $row["lastname"]. " " . $row["date"]. "<a href= 'update.php?id=".$row["id"]."'>  Editer</a>" . " ". "<a href= 'delete.php?id=".$row["id"]."'>  Supprimer</a><br>";
  }
} else {
  echo "0 results";
}
$conn->close();



?>


