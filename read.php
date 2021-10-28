<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Read</title>
</head>
<H1>Bibliothèque des meilleurs livres</H1>
<form method="GET">
<input id="search" type="text" name="search" placeholder="Titre">
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
?> 
  <label for="list">parût à partir de</label>            

          <select id=date name="date">
            <option value=""></option>  

          <?php $sql = "SELECT `date` FROM book";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) { 
              while($row = $result->fetch_assoc()) {
              ?> <option <?php if(isset($_GET['date']) AND $_GET['date'] === $row ["date"]){echo "selected";} ?> value="<?php echo $row ["date"];?>" > <?php echo $row ["date"] . "<br>"; ?></option>
              <?php }
          } ?> 
          </select>
<input id="submit" type="submit" value="Rechercher">
</form>

<body>
<br>
<?php

$edit = '<svg class= "svg-icon" viewBox="0 0 20 20">
<path d="M18.303,4.742l-1.454-1.455c-0.171-0.171-0.475-0.171-0.646,0l-3.061,3.064H2.019c-0.251,0-0.457,0.205-0.457,0.456v9.578c0,0.251,0.206,0.456,0.457,0.456h13.683c0.252,0,0.457-0.205,0.457-0.456V7.533l2.144-2.146C18.481,5.208,18.483,4.917,18.303,4.742 M15.258,15.929H2.476V7.263h9.754L9.695,9.792c-0.057,0.057-0.101,0.13-0.119,0.212L9.18,11.36h-3.98c-0.251,0-0.457,0.205-0.457,0.456c0,0.253,0.205,0.456,0.457,0.456h4.336c0.023,0,0.899,0.02,1.498-0.127c0.312-0.077,0.55-0.137,0.55-0.137c0.08-0.018,0.155-0.059,0.212-0.118l3.463-3.443V15.929z M11.241,11.156l-1.078,0.267l0.267-1.076l6.097-6.091l0.808,0.808L11.241,11.156z"></path>
</svg>';

$deleted_icon ='<svg class="svg-icon" viewBox="0 0 20 20">
<path d="M17.114,3.923h-4.589V2.427c0-0.252-0.207-0.459-0.46-0.459H7.935c-0.252,0-0.459,0.207-0.459,0.459v1.496h-4.59c-0.252,0-0.459,0.205-0.459,0.459c0,0.252,0.207,0.459,0.459,0.459h1.51v12.732c0,0.252,0.207,0.459,0.459,0.459h10.29c0.254,0,0.459-0.207,0.459-0.459V4.841h1.511c0.252,0,0.459-0.207,0.459-0.459C17.573,4.127,17.366,3.923,17.114,3.923M8.394,2.886h3.214v0.918H8.394V2.886z M14.686,17.114H5.314V4.841h9.372V17.114z M12.525,7.306v7.344c0,0.252-0.207,0.459-0.46,0.459s-0.458-0.207-0.458-0.459V7.306c0-0.254,0.205-0.459,0.458-0.459S12.525,7.051,12.525,7.306M8.394,7.306v7.344c0,0.252-0.207,0.459-0.459,0.459s-0.459-0.207-0.459-0.459V7.306c0-0.254,0.207-0.459,0.459-0.459S8.394,7.051,8.394,7.306"></path>
</svg>';

$url ='http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
if (strpos($url, 'deleted=1')!==false){
    echo "<span id='red'>Livre supprimé !</span><br>"; 
}?> <br> <?php 



$sql = "SELECT book.id, book.title, author.firstname, author.lastname, book.date 
FROM book 
JOIN author on book.author_id = author.id";


if (isset($_GET['search']) OR isset($_GET['date'])) {
  $sql .= " WHERE";
}

if (isset($_GET['search'])) {
  $search=$_GET['search'];
  $parts=explode(" ",$search);

  $conditions = [];
  foreach($parts as $part) {
    $conditions[] = "title LIKE '%" . mysqli_real_escape_string($conn, $part) . "%'";
    
  }

  $sql .= " (" . implode(" OR ", $conditions) . ")";
}

if (isset($_GET['date'])) {
  if (isset($_GET['search']) ) {
    $sql .= " AND ";
  }

  $sql .= "date >= " . $_GET['date'];
}

$result = $conn->query($sql);


if ($result->num_rows > 0) {
  echo "<table id='customers'><tr><th> ID</th><th> Titre</th><th> Auteur</th><th> Date de parution</th><th colspan=2> Modifier / Supprimer</th></tr>";
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row["id"]. "</td><td>" . $row["title"]. "</td><td>" . $row["firstname"] ." ". $row["lastname"]. " </td><td>" . $row["date"]. "</td><td><a href= 'update.php?id=".$row["id"]."'<button id=edit> $edit </button></a></td><td>" . " ". "<a href= 'delete.php?id=".$row["id"]."'<button id=edit> $deleted_icon</button> </a></td></td>";
  }
  echo "</table>";
} else {
  echo "0 results";
}
$conn->close();


?>
<br>
<button><a href="read.php">Retour</a></button>
<button><a href="create.php">Créer un livre</a></button>


</body>
</html>

