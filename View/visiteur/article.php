<?php 
 session_start(); 
 include_once '../../App/Model/article.php';
 include_once '../../App/Model/commentaire.php';
 $article = new Article();
 $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
 $article_p = $article->afficherArticleParId($id);
 $article_meme = $article->afficherArticlesDeLaMemeCategorie($article_p->categorie_id, $article_p->id,3);
 $articles_aleatoires = $article->afficherArticlesAleatoires(6);
 //var_dump($article_meme);die();

?>
<?php ob_start(); $title = $article_p->titre; ?>
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
    <nav aria-label="breadcrumb" style="margin-top: 5rem;--bs-breadcrumb-divider: '';"  aria-label="breadcrumb">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item "><a href="index.php" class="text-light text-decoration-none ">Accueil /</a></li>
            <li class="breadcrumb-item"><a href="#" class="text-light text-decoration-none"><?php echo $article_p->categorie_id; ?> /</a></li>
            <li class="breadcrumb-item active text-light text-decoration-none" aria-current="page"><?php echo $article_p->titre; ?></li>
        </ol>
        
    </nav>
    <?php 
        if(isset($_SESSION['message'])) {
            include_once 'include/composant.php';
            alert($_SESSION['message'],'success');
            unset($_SESSION['message']);
        }
    ?>
    <div class="row">
         <div class="shadow-lg card col-lg-6 col-md-6 col-sm-12  col-12  overflow-hidden " style="width: 35rem; height: 27rem; max-height: 500px; background-color: rgb(51, 51, 51);">
            <span class="position-relative  overflow-hidden" style="width: 550px; height: 100%; max-height: 465px; max-width: 550px;">
                <img src="../../Public/image/<?= $article_p->image; ?>" class="card-img-top img-fluid " alt="<?php echo $article_p->titre; ?>" style="width: 100%; height: 100%; object-fit: cover;">
            </span>
             <div class="card-body text-light">
                     <span class="row">
                        <div class="col-6"><i class="bi bi-hand-thumbs-up text-secondary"></i> <span class="text-secondary me-3" style="font-size:12px;"><?= $article->jaime; ?></span>  <i class="bi bi-hand-thumbs-up text-secondary"></i></div>
                        <div class="col-6"></div>
                     </span>
                </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12  col-12 text-light d-flex flex-column  align-items-center" >
            <h4 class="text-light mb-3 text-center"><?= $article_p->titre; ?></h4>
            <h6 class="mb-5" style="color: #ccc;">Laissez un commentaire</h6>
            <form action="../../App/Controller/article.php" method="POST">
                <div class="form-floating mb-3">
                    <input type="hidden" name="id_article" id="" value="<?= $article_p->id; ?>">
                    <input type="email" class="form-control bg-transparent text-light border-0" id="floatingInput" placeholder="name@example.com" name="mail" value="<?php echo isset($_COOKIE['utilisateur']) ? $_COOKIE['utilisateur'] : ''; ?>" required>
                    <label for="floatingInput">Adresse Mail</label>
                </div>
                <textarea name="description" class="form-control my-3 border-0 bg-light" rows="3" placeholder="Laissez un commentaire..." style="resize: none; width: 25rem; height: 10rem;"></textarea>
                <button type="submit" class="btn btn-primary w-100" name="commenter">Commenter</button>
            </form>
        </div>
    </div>
           
        <p class="text-light text-center fs-5 my-5">
            <?= $article_p->description; ?>
        </p>


    <div class="row justify-content-center align-items-center my-5 gy-5 container-article ">
            <h2 class="text-center text-light">Articles de la même catégorie</h2>
        <?php foreach ($article_meme as $article): ?>
            <div class="col-lg-3 col-md-4 col-sm-6 col-12 ">
                <div class="shadow-lg card   overflow-hidden " style="width: 18rem; height: 30rem; max-height: 700px; background-color: rgb(51, 51, 51);">
                    <span class="position-relative  overflow-hidden" style="width: 300px; height: 500px; max-height: 500px; max-width: 300px;">
                        <img src="../../Public/image/<?= $article->image; ?>" class="card-img-top img-fluid " alt="<?php echo $article->titre; ?>" >
                    </span>
                    <div class="card-body text-light" style=" height: 25rem; max-height: 500px;">
                        <h5 class="card-title text-light " style="font-size: 0.8rem;"><?= $article->titre; ?></h5>
                        <p class="card-text fw-bold"><?= $article->description; ?></p>
                        <!-- <a href="#" class="btn btn-primary btn-sm">Lire la suite</a> -->
                        <span class="row">
                            <div class="col-6"><i class="bi bi-hand-thumbs-up text-secondary"></i> <span class="text-secondary me-3" style="font-size:12px;"><?= $article->jaime; ?></span>  <i class="bi bi-hand-thumbs-up text-secondary"></i></div>
                            <div class="col-6"><a href="article.php?id=<?= $article->id; ?>" class="btn btn-primary btn-sm">Lire la suite</a></div>
                        </span>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
         <!-- <div class="col-lg-3 col-md-4 col-sm-6 col-12 ">
            <div class="shadow-lg card  overflow-hidden " style="width: 18rem; height: 23rem; max-height: 500px; background-color: rgb(51, 51, 51);">
                <span class="position-relative  overflow-hidden" style="width: 300px; height: 250px; max-height: 250px; max-width: 300px;">
                    <img src="../../Public/image/monster red.avif" class="card-img-top img-fluid " alt="..." style="width: -150%; height: -150%; ">
                </span>
                <div class="card-body text-light ">
                    <h5 class="card-title text-light">Card title</h5>
                    <p class="card-text ">Some quick example text to build on the card title and make up the bulk of the card’s content.</p>
                    <a href="#" class="btn btn-primary btn-sm">Lire la suite</a>
                </div>
            </div>
        </div> -->
             
    </div>
     <!-- <div class="col-lg-6 col-md-6 col-sm-12 col-12 ">
            <div class="shadow-lg card   overflow-hidden " style="width: 35rem; height: 23rem; max-height: 500px; background-color: rgb(51, 51, 51);">
                <span class="position-relative  overflow-hidden" style="width: 550px; height: 250px; max-height: 250px; max-width: 550px;">
                    <img src="../../Public/image/monster noir blanc.avif" class="card-img-top img-fluid " alt="...">
                </span>
                <div class="card-body text-light">
                    <h5 class="card-title text-light " style="font-size: 0.8rem;">Aliexpress</h5>
                    <p class="card-text fw-bold">Some quick example text to build on the card title and make up the bulk of the card’s content.</p>
                   <span class="row align-items-center mx-1">
                        <a href="#" class="btn btn-primary btn-sm col-6">Lire la suite</a>
                        <a href="#" class="nav-link link-secondary disabled col-6 text-end mt-2" style="font-size: 12px;">Pub</a>
                    </span>
                </div>
            </div>
        </div> -->
    <h2 class="text-center text-light">Articles Populaires</h2>
    <div class="row justify-content-center align-items-center my-5 gy-5 container-article ">
        <?php foreach ($articles_aleatoires as $article): ?>
            <div class="col-lg-3 col-md-4 col-sm-6 col-12 ">
                <div class="shadow-lg card   overflow-hidden " style="width: 18rem; height: 30rem; max-height: 700px; background-color: rgb(51, 51, 51);">
                    <span class="position-relative  overflow-hidden" style="width: 300px; height: 500px; max-height: 500px; max-width: 300px;">
                        <img src="../../Public/image/<?= $article->image; ?>" class="card-img-top img-fluid " alt="<?php echo $article->titre; ?>" >
                    </span>
                    <div class="card-body text-light" style=" height: 25rem; max-height: 500px;">
                        <h5 class="card-title text-light " style="font-size: 0.8rem;"><?= $article->titre; ?></h5>
                        <p class="card-text fw-bold"><?= $article->description; ?></p>
                        <!-- <a href="#" class="btn btn-primary btn-sm">Lire la suite</a> -->
                        <span class="row">
                            <div class="col-6"><i class="bi bi-hand-thumbs-up text-secondary"></i> <span class="text-secondary me-3" style="font-size:12px;"><?= $article->jaime; ?></span>  <i class="bi bi-hand-thumbs-up text-secondary"></i></div>
                            <div class="col-6"><a href="#" class="btn btn-primary btn-sm">Lire la suite</a></div>
                        </span>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php
    $titre = "Article" ; 
    $content = ob_get_clean() ;
    require_once 'include/template.php';
 ?>