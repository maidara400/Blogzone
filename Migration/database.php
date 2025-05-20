<?php
$serveur = 'localhost';
$username = 'root';
$password = '';
$database = 'blog_zone';
$optons = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
];

try {
    $pdo = new PDO("mysql:host=$serveur;dbname=$database", $username, $password, $optons);
     echo "Connexion établie avec succès!";
} catch (PDOException $e) {
    echo "La Connection a echoue: " . $e->getMessage();
}   

?>