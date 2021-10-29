<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Read</title>
</head>
<H1>Modifier un livre</H1>
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
?>  

<?php
if(isset($_POST['save']))
{
    $title = $_POST['title'];
    $author_id = $_POST['author_id'];
    $date = $_POST['date'];
    $update = "UPDATE `book` set `title`='". mysqli_real_escape_string($conn, $title) . "', `date`= $date, `author_id`=$author_id WHERE id = ".$_GET['id'];
    var_dump($update);
    $rs = mysqli_query($conn, $update);

    if($rs)
    {
    echo " <span id='red'> Livre modifié</span>";
    }
}

if(isset($_GET['id']))
{
  //On se sert de la variable GET pour récupérer l'entrée dans la table correspondant au membre choisi
  $sql = "SELECT * FROM book WHERE id = ".$_GET['id'];
 
  //Tu éxécute la requête, et fait un affichage classique...
  $result = $conn->query($sql);
  $book= $result->fetch_assoc();
}
else die("Aucun livre correspondant");?>

<form method="post"> 
    <label id="first"> Titre du livre</label>
    <input type="text" name="title" value="<?php echo $book["title"];?>">
    <br><br><br>
    <label for="list"> Nom de l'auteur</label>
        <select name="author_id"> 

        <?php $sql = "SELECT id, firstname, lastname
        FROM author";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) { 
            while($row = $result->fetch_assoc()) {
            ?> <option value="<?php echo $row ["id"];?>" <?php if ($row["id"] == $book["author_id"]) echo "selected";  ?>> <?php echo $row ["firstname"] . " " . $row ["lastname"]."<br>"; ?></option>
            <?php }
        } ?> 
        </select>
        <br><br>
    <label id="first">Date de parution</label>
    <input type="text" name="date" value="<?php echo $book["date"];?>">
    <br> <br>
    <button><a href="read.php">Retour liste</a></button>
    <button type="submit" name="save">Enregistrer la modification</button>
    </form>
    </body>
</html>