<?php
    $title = "Toutes les Categories";
    session_start();
    include_once '../../../App/Model/categorie.php';
    $categorie = new Categorie();
   $data = $categorie->afficherCategories();
   $categories = $data['categories'];
   if(isset($_SESSION['message'])) {
       include_once '../../visiteur/include/composant.php';
       alert($_SESSION['message'],'danger');
        unset($_SESSION['message']);
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
     <link rel="stylesheet" href="../../../Public/css/visiteur.css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <title>Ajouter Utilisateur</title>
</head>
<style>
    .form-control {
        background-color: transparent;
        color: white;
    }
    .form-control::placeholder {
        color: #ccc;
    }
    .form-floating label , .form-select {
        color: #ccc;
    }
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }
</style>
<body class="body m-0 p-0">
     <div class="row text-center py-5">
            <h3 class=" text-light fw-bold">Table des catégories</h3>
     </div>
     <div class="row text-center py-2">
        <div class="col-6">
            <a href="ajouter.php" class="btn btn-primary mb-3 ms-5">Ajouter une categorie</a>
        </div>
        <div class="col-6">
            <p class="text-light">(<?= count($categories); ?>) catégories enregistrées</p>
        </div>
     </div>
    <main class="min-vh-50 d-flex justify-content-center align-items-center " >
         <div class="container  d-flex justify-content-center align-items-center ">
            <table class="table table-dark table-striped text-center mt-5">
                <thead>
                    <tr>
                        <th scope="col">Libelle</th>
                        <th scope="col">Description</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $categorie): ?>
                        <tr>
                            <td><?= htmlspecialchars($categorie['libelle']); ?></td>
                            <td><?= htmlspecialchars($categorie['description']); ?></td>
                            <td>
                                <a href="modifier.php?modifier=<?= $categorie['id']; ?>" class="btn btn-primary btn-sm">Modifier</a>
                                <form action="../../../App/Controller/categorie.php" method="POST" class="d-inline">
                                    <input type="hidden" name="id" value="<?= $categorie['id']; ?>">
                                    <button type="submit" class="btn btn-danger btn-sm" name="supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?');">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                  
                </tbody>
            </table>
        </div>

    </main>


   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>