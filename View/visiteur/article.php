<?php 
 session_start(); 
include_once '../../App/Model/commentaire.php';


?>
<?php ob_start()  ?>
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
            <li class="breadcrumb-item "><a href="#" class="text-light text-decoration-none ">Accueil /</a></li>
            <li class="breadcrumb-item"><a href="#" class="text-light text-decoration-none">Categorie /</a></li>
            <li class="breadcrumb-item active text-light text-decoration-none" aria-current="page">Article</li>
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
                <img src="../../Public/image/monster noir blanc.avif" class="card-img-top img-fluid " alt="...">
            </span>
             <div class="card-body text-light">
                     <span class="row">
                        <div class="col-6"><i class="bi bi-hand-thumbs-up text-secondary"></i> <span class="text-secondary me-3" style="font-size:12px;">2 </span>  <i class="bi bi-hand-thumbs-up text-secondary"></i></div>
                        <div class="col-6"></div>
                     </span>
                </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12  col-12 text-light d-flex flex-column  align-items-center" >
            <h1 class="text-light mb-3">Titre de l'article</h1>
            <h6 class="mb-5" style="color: #ccc;">Laissez un commentaire</h6>
            <form action="../../App/Controller/article.php" method="POST">
                <div class="form-floating mb-3">
                    <input type="hidden" name="id_article" id="" value="1">
                    <input type="email" class="form-control bg-transparent text-light border-0" id="floatingInput" placeholder="name@example.com" name="mail" value="<?php echo isset($_COOKIE['utilisateur']) ? $_COOKIE['utilisateur'] : ''; ?>" required>
                    <label for="floatingInput">Adresse Mail</label>
                </div>
                <textarea name="description" class="form-control my-3 border-0 bg-light" rows="3" placeholder="Laissez un commentaire..." style="resize: none; width: 25rem; height: 10rem;"></textarea>
                <button type="submit" class="btn btn-primary w-100" name="commenter">Commenter</button>
            </form>
        </div>
    </div>
           
        <p class="text-light text-center fs-5 my-5">
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Assumenda ipsa eligendi libero enim repellendus officia tempora ut itaque doloremque? Fugiat repellendus eligendi cupiditate numquam vitae facilis ducimus dolores esse aperiam suscipit libero blanditiis possimus tenetur quos fuga, doloremque a vel, eveniet cum deleniti hic! Dolorum delectus quibusdam debitis ex impedit error ut veniam tempora. Sed, nesciunt? Earum quisquam provident nihil voluptatibus praesentium, consequatur consequuntur veritatis vitae recusandae sit animi excepturi quod soluta et nobis fuga quibusdam ullam asperiores eveniet, reprehenderit reiciendis facere! Reiciendis in accusantium veritatis animi! Sunt ad deserunt ea saepe eum repellat corrupti assumenda vitae, accusamus autem explicabo.
        </p>


    <div class="row justify-content-center align-items-center my-5 gy-5 container-article ">
         <div class="col-lg-3 col-md-4 col-sm-6 col-12 ">
            <div class="shadow-lg card   overflow-hidden " style="width: 18rem; height: 23rem; max-height: 500px; background-color: rgb(51, 51, 51);">
                <span class="position-relative  overflow-hidden" style="width: 300px; height: 250px; max-height: 250px; max-width: 300px;">
                    <img src="../../Public/image/monster noir blanc.avif" class="card-img-top img-fluid " alt="..." >
                </span>
                <div class="card-body text-light">
                     <h5 class="card-title text-light " style="font-size: 0.8rem;">RTS 2</h5>
                    <p class="card-text fw-bold">Some quick example text to build on the card title and make up the bulk of the card’s content.</p>
                    <!-- <a href="#" class="btn btn-primary btn-sm">Lire la suite</a> -->
                     <span class="row">
                        <div class="col-6"><i class="bi bi-hand-thumbs-up text-secondary"></i> <span class="text-secondary me-3" style="font-size:12px;">2 </span>  <i class="bi bi-hand-thumbs-up text-secondary"></i></div>
                        <div class="col-6"></div>
                     </span>
                </div>
            </div>
        </div>
         <div class="col-lg-3 col-md-4 col-sm-6 col-12 ">
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
        </div>
         <div class="col-lg-3 col-md-4 col-sm-6 col-12 ">
            <div class=" shadow-lg card  overflow-hidden " style="width: 18rem; height: 23rem; max-height: 500px; background-color: rgb(51, 51, 51);">
                <span class="position-relative  overflow-hidden" style="width: 300px; height: 250px; max-height: 250px; max-width: 300px;">
                    <img src="../../Public/image/monster noir blanc.avif" class="card-img-top img-fluid " alt="...">
                </span>
                <div class="card-body text-light">
                    <h5 class="card-title text-light " style="font-size: 0.8rem;">Alibaba</h5>
                    <p class="card-text fw-bold">Some quick example text to build on the card title and make up the bulk of the card’s content.</p>
                    <span class="row align-items-center mx-2">
                        <a href="#" class="btn btn-primary btn-sm col-6">Lire la suite</a>
                        <a href="#" class="nav-link link-secondary disabled col-6 text-end mt-2" style="font-size: 12px;">Annonce</a>
                    </span>
                </div>
            </div>
        </div>
         <div class="col-lg-3 col-md-4 col-sm-6 col-12 ">
            <div class="shadow-lg card   overflow-hidden " style="width: 18rem; height: 23rem; max-height: 500px; background-color: rgb(51, 51, 51);">
                <span class="position-relative  overflow-hidden" style="width: 300px; height: 250px; max-height: 250px; max-width: 300px;">
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
        </div>

         <div class="col-lg-6 col-md-6 col-sm-12 col-12 ">
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
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-12 ">
            <div class="shadow-lg card   overflow-hidden " style="width: 18rem; height: 23rem; max-height: 500px; background-color: rgb(51, 51, 51);">
                <span class="position-relative  overflow-hidden" style="width: 300px; height: 250px; max-height: 250px; max-width: 300px;">
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
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-12 ">
            <div class="shadow-lg card   overflow-hidden " style="width: 18rem; height: 23rem; max-height: 500px; background-color: rgb(51, 51, 51);">
                <span class="position-relative  overflow-hidden" style="width: 300px; height: 250px; max-height: 250px; max-width: 300px;">
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
        </div>
        
        
        
    </div>
<?php
    $titre = "Article" ; 
    $content = ob_get_clean() ;
    require_once 'include/template.php';
 ?>