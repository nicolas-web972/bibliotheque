<?php
define('DSN', 'mysql:host=localhost;dbname=pdo_quest');
define('USER', 'root');
define('PASS', '');

$query = "SELECT * FROM friend";
$statement = $pdo->query($query);
$friends = $statement->fetchAll();

$query = "INSERT INTO friend (firstname, lastname) VALUES ('Chandler', 'Bing')";
$statement = $pdo->exec($query);