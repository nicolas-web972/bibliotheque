<?php

$servername = "localhost:3306";
$username = "root";
$password = "";
$database = "bibliotheque";

session_start();

if (isset($_SESSION['name'])) {

    echo 'Bonjour ' . $_SESSION['name'] . '! Vous êtes connecté sur le panier de la bibliothèque ! <br>';
    echo '<a href="logout.php">Se déconnecter</a>';
} else {
    header('location: login.php');
    die();
}

// Create connection
$conn = new mysqli($servername, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Panier</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <h1>Mon panier</h1> <br> 
    <?php
    if (!empty($_POST)) {
        $verifier = true;
        $id = $_POST['id'];

        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $item) {
                if ($id == $item['id']) {
                    echo "<br> Ce livre est déjà dans le panier : " . $item['title'] . "<br>";
                    $verifier = false;
                    break;
                }
            }
        }

        if ($verifier == true) {
            $sql = "SELECT Books.id, title, firstname, lastname, book.date FROM Books JOIN Author ON Books.author_id=Author.id WHERE Books.id=" . $id;
            $result = $conn->query($sql);
            $_SESSION['cart'][] = $result->fetch_assoc();
        }
    }
    ?>

    <?php
        if (isset($_SESSION['cart'])) {?>
            <table>
            <tr>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Date de publication</th>
            </tr>
            <?php
            for ($i = 0; $i < count($_SESSION['cart']); $i++) { ?>
                <tr>
                    <td><?php echo $_SESSION['cart'][$i]["title"]; ?></td>
                    <td><?php echo $_SESSION['cart'][$i]["firstname"] . " " . $_SESSION['cart'][$i]["lastname"]; ?></td>
                    <td><?php echo $_SESSION['cart'][$i]["date"]; ?></td>
                </tr>
        <?php }
        }else{echo "<br>Votre panier est vide !";} ?>
    </table>
</body>

</html>