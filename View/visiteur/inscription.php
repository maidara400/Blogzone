<?php
    $title = "Inscription";
    session_start();
    include_once '../../App/Model/utilisateur.php';
    
    if(isset($_SESSION['message'])) {
        include_once 'include/composant.php';
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
     <link rel="stylesheet" href="../../Public/css/visiteur.css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <title>Inscription</title>
</head>
<style>
    .form-control {
        background-color: transparent;
        color: white;
    }
    .form-control::placeholder {
        color: #ccc;
    }
    .form-floating label {
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
            <div class="shadow-lg card p-3  overflow-hidden " style="width: 28rem; height: 30rem; max-height: 500px; background-color: rgb(51, 51, 51);">
                <div class="card-title fw-bold text-light text-center my-3 h3">Inscription</div>
                <form action="../../App/Controller/authentification.php" method="POST" >
                    <div class="row mb-3">
                        <div class="form-floating  col-6">
                            <input type="text" class="form-control bg-transparent text-light border-0" id="floatingInput" placeholder="Entrer votre nom" name="nom" required>
                            <label for="floatingInput">Nom</label>
                        </div>
                        <div class="form-floating  col-6">
                            <input type="text" class="form-control bg-transparent text-light border-0" id="floatingInput" placeholder="Entrer votre prenom" name="prenom" required>
                            <label for="floatingInput">Prenom</label>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control bg-transparent text-light border-0" id="floatingInput" placeholder="name@example.com" name="mail" required>
                        <label for="floatingInput">Email address</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control bg-transparent text-light border-0" id="floatingPassword" placeholder="Password" name="password" required>
                        <label for="floatingPassword">Password</label>
                    </div>
                    <div class="row text-center mb-5">
                        <div class="col-6 text-secondary">
                            Deja un compte ? 
                        </div>
                        <div class="col-6 mt-1 ">
                            <a href="connexion.php" class="text-decoration-none text-light">Connexion</a>
                        </div>
                    </div>
                    <input type="submit" class="border-0 btn btn-primary  text-light mt-3 w-100"  name="inscription" value="S'inscrire">
                </form>
            </div>
        </div>

    </main>


   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>