<?php
    session_start();
    $title = "Modifier Article";
    $id = $_GET['modifier'];
    include_once '../../../App/Model/article.php';
    include_once '../../../App/Model/categorie.php';
    $categorie = new Categorie();
    $article = new Article();
    $article = $article->afficherArticleParId($id);
   // $categories = $categorie->afficherCategories();
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
    <title>Modifier Article</title>
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
    <main class="min-vh-100 d-flex justify-content-center align-items-center " >
         <div class="container mt-5 pt-3 d-flex justify-content-center align-items-center ">
            <div class="shadow-lg card p-3  overflow-hidden " style="width: 28rem; height: 35rem; max-height: 600px; background-color: rgb(51, 51, 51);">
                <div class="card-title fw-bold text-light text-center my-3 h3">Modifier Article</div>
                <form action="../../../App/Controller/article.php" method="POST" enctype="multipart/form-data">
                    <div class="form-floating mb-5">
                        <input type="text" class="form-control bg-transparent text-light border-0" id="floatingInput" placeholder="Titre de l article" name="titre" value="<?= htmlspecialchars($article->titre); ?>" required>
                        <label for="floatingInput">Titre</label>
                    </div>

                    <textarea name="description" class="form-control my-3 border-0 bg-light mb-3" rows="3" placeholder="Decrivez l article ..." style="resize: none; width: 25rem; height: 10rem;"><?= htmlspecialchars($article->description); ?></textarea>

                    <div class="input-group mb-3">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($article->id); ?>">
                        <input type="file" class="form-control" id="inputGroupFile02" name="image" value="<?= htmlspecialchars($article->image); ?>" required>
                        <label class="input-group-text" for="inputGroupFile02"></label>
                    </div>

                     <select class="form-select form-select-sm bg-transparent border-0 mb-3" aria-label=".form-select-sm example" name="categorie_id" required>
                        <option selected value="0"  disabled>Catégorie</option>
                        <?php foreach($categories as $categorie): ?>
                            <option value="<?= $categorie['id']; ?>" <?= $categorie['id'] == $article->categorie_id ? 'selected' : ''; ?>><?= $categorie['libelle']; ?></option>
                        <?php endforeach; ?>
                    </select>

                    <input type="submit" class="border-0 btn btn-primary  text-light  w-100"  name="modifier" value="Modifier">
                </form>
            </div>
        </div>

    </main>


   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>