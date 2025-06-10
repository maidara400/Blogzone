<?php
include_once '../../Migration/database.php';
include_once '../../App/Model/categories.php';

$pdo = Database::getInstance();
$categories = Categorie::getAll($pdo);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des catégories</title>
</head>
<body>
    <h1>Liste des catégories</h1>

    <?php if (!empty($categories)): ?>
        <ul>
            <?php foreach ($categories as $categorie): ?>
                <li>
                    <strong><?= htmlspecialchars($categorie['libelle']) ?></strong><br>
                    <?= nl2br(htmlspecialchars($categorie['description'])) ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Aucune catégorie trouvée.</p>
    <?php endif; ?>
</body>
</html>