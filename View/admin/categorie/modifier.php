<?php
include_once '../../App/Model/categories.php';
include_once '../../Migration/database.php';

$message = "";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['ancien_nom']) && !empty($_POST['nouveau_libelle'])) {
        $ancienNom = $_POST['ancien_nom'];
        $nouveauLibelle = $_POST['nouveau_libelle'];
        $description = $_POST['description'] ?? "";
        $pdo = Database::getInstance();
        if (Categorie::existe($pdo, $ancienNom)) {
            if (!Categorie::existe($pdo, $nouveauLibelle) || $ancienNom === $nouveauLibelle) {
                $categorie = new Categorie($nouveauLibelle, $description);
                $categorie->modifier($pdo, $ancienNom);
                $message = "Catégorie modifiée avec succès.";
            } else {
                $message = "Une autre catégorie avec ce nom existe déjà.";
            }
        } else {
            $message = "La catégorie à modifier n'existe pas.";
        }
    } else {
        $message = "Veuillez remplir tous les champs obligatoires.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modifier une catégorie</title>
</head>
<body>
    <h1>Modifier une catégorie</h1>
    <p style="color:green"><?= $message ?></p>

    <form method="POST">
        <label>Ancien libellé (catégorie à modifier)* :</label><br>
        <input type="text" name="ancien_nom" required><br>

        <label>Nouveau libellé* :</label><br>
        <input type="text" name="nouveau_libelle" required><br>

        <label>Nouvelle description :</label><br>
        <textarea name="description" rows="4" cols="40"></textarea><br>

        <button type="submit">Modifier</button>
    </form>
</body>
</html>
