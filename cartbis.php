<?php
@include "login.php";


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




if (!empty($_POST)) {
    $verifier=true;
    $id = $_GET['id'];
    if (!isset($_SESSION['cartItem'])) {
        $sql = "SELECT book.id, title, author.firstname, author.lastname book.date  
        FROM book JOIN author ON book.author_id=author.id Where book.id=".$_GET['id'];
        $result = $conn->query($sql);
        $_SESSION['cartItem'][] = $result->fetch_assoc();
    } 
    else {
        foreach ($_SESSION['cartItem'] as $k => $v) {
            if ($id == $_SESSION['cartItem'][$k]['id']) {
                echo "<br> Book already in cart <br>";
                $verifier = false;
                break;
            }
        }
        if ($verifier) {
            $sql = "SELECT book.id, title, author.firstname, author.lastname, book.date FROM book JOIN author ON book.author_id=author.id Where book.id=" . $_GET['id'];
            $result = $conn->query($sql);
            $_SESSION['cartItem'][] = $result->fetch_assoc();
        }
    }
} "SELECT book.id, book.title, author.firstname, author.lastname, book.date 
FROM book 
JOIN author on book.author_id = author.id";

header("Location: read.php");