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

session_start();
session_destroy();

header("Location: read.php");

// Create connection
$conn = new mysqli($servername, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['save']) AND !empty($_POST['title'])) {
       
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $author_id = $_POST['author_id'];
        $date = $_POST['date'];
        $sql = "INSERT INTO `book` (`title`, `date`, `author_id`) VALUES ('$title', '$date', '$author_id')";
        $rs = mysqli_query($conn, $sql);

        if($rs)
        {
            echo "  <span id='red'>Livre enregistré</span><br>";
        }
        } else {
        echo "<span id='red'>Remplir les champs vides<br></span>";
}
    ?>
<br>
    <form method="post"> 
    <label id="first"> Titre du livre</label><br/>
    <input type="text" name="title"><br/>
    <br>
    <label for="list">Nom de l'auteur</label><br>

        <select id=liste name="author_id">  
        <?php $sql = "SELECT id, firstname, lastname
        FROM author";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) { 
            while($row = $result->fetch_assoc()) {
            ?> <option value="<?php echo $row ["id"];?>" > <?php echo $row ["firstname"] . " " . $row ["lastname"]."<br>"; ?></option>
            <?php }
        } ?> 
        </select>
        <br> <br>
    <label id="first">Date de parution</label><br/>
    <input type="text" name="date"><br/>
    <br>
    <button><a href="read.php">Liste des livres</a></button>
    <button type="submit" name="save">Créer</button>
    </form>
    <br>
</body>
</html>

        