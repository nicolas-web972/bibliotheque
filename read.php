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
  echo "<table><tr><th> ID</th><th> Titre</th><th> Auteur</th><th> Date de parution</th><th colspan=2> Requete</th></tr>";
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row["id"]. "</td><td>" . $row["title"]. "</td><td>" . $row["firstname"] ." ". $row["lastname"]. " </td><td>" . $row["date"]. "</td><td><a href= 'update.php?id=".$row["id"]."'>  Editer</a></td><td>" . " ". "<a href= 'delete.php?id=".$row["id"]."'>  Supprimer</a></td></td>";
  }
  echo "</table>";
} else {
  echo "0 results";
}
$conn->close();

echo "<a href= 'create.php'>  Créer un livre </a></td></td>";




?>


