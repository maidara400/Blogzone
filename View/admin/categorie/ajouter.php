<?php

    include_once '../../App/Model/categories.php';
    include_once '../../Migration/database.php';

    $message = "";
    $pdo = Database::getInstance();
    if ($_SERVER['REQUEST_METHOD']=='POST'){
        if (!empty($_POST['libelle'])) {
            $libelle = $_POST['libelle'];
            $description = $_POST['description'] ?? "";
            $categorie = new Categorie($libelle, $description);
            $categorie->ajouter($pdo);
            $message = $categorie->ajouter($pdo);
        }else {
            $message = "le libelle est obligatoire";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Ajouter une nouvelle categorie</h1>
    <p style = "color: green"><?=$message?></p>
    <form action="" method="POST">
        <label for="">Libellé :</label><br>
        <input type="text" name = "libelle" required><br>

        <label for="">description :</label><br>
        <textarea name="description" rows="4" cols="40" id=""></textarea><br>
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>