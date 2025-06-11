<?php
    $title = "Ajouter Categorie";
    session_start();
    include_once '../../../App/Model/categorie.php';

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
    <title>Ajouter Categorie</title>
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
            <div class="shadow-lg card p-3  overflow-hidden " style="width: 28rem; height: 34rem; max-height: 500px; background-color: rgb(51, 51, 51);">
                <div class="card-title fw-bold text-light text-center my-3 h3">Ajouter Categorie</div>
                <form action="../../../App/Controller/categorie.php" method="POST" >
                    <div class="form-floating mb-5">
                        <input type="text" class="form-control bg-transparent text-light border-0" id="floatingInput" placeholder="Nom Complet" name="libelle" required>
                        <label for="floatingInput">Libelle</label>
                    </div>
                 
                    <textarea name="description" class="form-control my-3 border-0 bg-light" rows="3" placeholder="Decrivez la categorie ..." style="resize: none; width: 25rem; height: 10rem;"></textarea>

                    <input type="submit" class="border-0 btn btn-primary  text-light my-5 w-100"  name="ajouter" value="Ajouter">
                </form>
            </div>
        </div>

    </main>


   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>