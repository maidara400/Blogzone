<?php
include_once '../../App/Model/categories.php';
include_once '../../Migration/database.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['libelle'])) {
        $pdo = Database::getInstance();
        $nom = $_POST['libelle'];
        $message =  Categorie::supprimer($pdo, $nom);
    } else {
        $message = "Le nom est obligatoire.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Supprimer une catégorie</title>
</head>
<body>
    <h1>Supprimer une catégorie</h1>
    <p style="color: green"><?= $message ?></p>
    <form action="" method="POST">
        <label for="">Nom de la catégorie à supprimer :</label><br>
        <input type="text" name="libelle" required><br><br>
        <button type="submit">Supprimer</button>
    </form>
</body>
</html>
