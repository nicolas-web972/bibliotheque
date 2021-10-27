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
echo "Connected successfully";


if(isset($_POST['save'])){
       
        $title = $_POST['title'];
        $author_id = $_POST['author_id'];
        $date = $_POST['date'];
        $sql = "INSERT INTO `book` (`title`, `date`, `author_id`) VALUES ('$title', '$date', '$author_id')";

        $rs = mysqli_query($conn, $sql);
      

        if($rs)
        {
            echo "  Livre enregistré";
        }
}
    ?>
<br>
    <form method="post"> 
    <label id="first"> Titre du livre</label><br/>
    <input type="text" name="title"><br/>

    <label for="list">Nom de l'auteur</label>
        <select name="author_id"> 

        <?php $sql = "SELECT id, firstname, lastname
        FROM author";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) { 
            while($row = $result->fetch_assoc()) {
            ?> <option value="<?php echo $row ["id"];?>" > <?php echo $row ["firstname"] . " " . $row ["lastname"]."<br>"; ?></option>
            <?php }
        } ?> 
        </select>
        <br>
    <label id="first">Date de parution</label><br/>
    <input type="text" name="date"><br/>
    
    <button type="submit" name="save">Enregistrer</button>
    </form>

        