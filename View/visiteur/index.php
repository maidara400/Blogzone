<?php 
    session_start();
    include_once '../../App/Model/article.php';
    $article = new Article();
    $data = $article->afficherArticles();
    $articles = $data['articles']; 
    // article le plus aimé
    $article_le_plus_aime = $article->afficherArticleLePlusAime();
    $articles_aleatoires = $article->afficherArticlesAleatoires(4);
    // Vérification de la session pour les messages
    if(isset($_SESSION['message'])) {
        include_once '../../visiteur/include/composant.php';
        alert($_SESSION['message'], 'success');
        unset($_SESSION['message']);
    }
    
  //  var_dump($articles);die();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Blogzone</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #1a1a1a;
            color: #e0e0e0;
            font-family: 'Segoe UI', Arial, sans-serif;
            line-height: 1.6;
        }
        .navbar {
            background-color: #2c2c2c;
            padding: 1rem 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }
        .navbar-brand, .nav-link {
            color: #e0e0e0 !important;
            font-weight: 500;
        }
        .nav-link:hover {
            color: #007bff !important;
        }
        .card {
            background-color: #2c2c2c;
            border: none;
            border-radius: 8px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease, opacity 0.5s ease;
            opacity: 0;
        }
        .card.fade-in {
            opacity: 1;
            transform: translateY(0);
        }
        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.4);
        }
        .card-img-top {
            object-fit: cover;
            width: 100%;
            height: 100%;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }
        .card-title {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        .card-text {
            font-size: 0.9rem;
            color: #b0b0b0;
        }
        .featured-card {
            background-color: #333;
        }
        .featured-card .card-title {
            font-size: 1.5rem;
            font-weight: 700;
        }
        .featured-card .card-img-top {
            height: 300px;
        }
        .breadcrumb {
            background-color: transparent;
            --bs-breadcrumb-divider: '';
            margin-top: 1rem;
        }
        .breadcrumb-item a {
            color: #007bff;
            text-decoration: none;
        }
        .breadcrumb-item a:hover {
            color: #0056b3;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 4px;
            font-weight: 500;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .container-articles {
            margin-top: 2rem;
            margin-bottom: 3rem;
        }
        .header-section {
            text-align: center;
            margin: 2rem 0;
        }
        .header-section h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #fff;
        }
        .header-section p {
            color: #b0b0b0;
            font-size: 1.1rem;
        }
        @media (max-width: 768px) {
            .card-title {
                font-size: 0.9rem;
            }
            .featured-card .card-title {
                font-size: 1.2rem;
            }
            .header-section h1 {
                font-size: 1.8rem;
            }
            .featured-card .card-img-top {
                height: 200px;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">Mon Blog</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Catégories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">À Propos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Breadcrumb -->
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page"><a href="#">Accueil</a></li>
            </ol>
        </nav>

        <!-- Header Section -->
        <div class="header-section">
            <p>Découvrez les dernières actualités, articles et histoires captivantes</p>
        </div>

        <!-- Featured Article -->
        <div class="row container-articles mb-5">
            <div class="col-12">
                <div class="shadow-lg card featured-card">
                    <div class="row g-0">
                        <div class="col-md-6">
                            <img src="../../Public/image/<?= $article_le_plus_aime->image; ?>" class="card-img-top img-fluid" alt="Featured Article">
                        </div>
                        <div class="col-md-6 d-flex align-items-center text-center">
                            <div class="card-body text-light">
                                <h5 class="card-title"><?= $article_le_plus_aime->titre; ?></h5>
                                <p class="card-text"><?= $article_le_plus_aime->description; ?></p>
                                <span class="row align-items-center mt-5">
                                    <a href="article.php?id=1" class="btn btn-primary btn-sm col-6 ">Lire la suite</a>
                                    <span class="col-6 text-end text-secondary" style="font-size: 12px;">
                                        <i class="bi bi-hand-thumbs-up"></i> <?= $article_le_plus_aime->jaime; ?>
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Article Grid -->
        <div class="row container-articles gy-4 justify-content-center">
            <?php foreach ($articles_aleatoires as $article): ?>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                    <div class="shadow-lg card">
                        <span class="position-relative overflow-hidden" style="width: 100%; height: 200px;">
                            <img src="../../Public/image/<?= $article->image; ?>" class="card-img-top img-fluid" alt="<?= $article->titre; ?>">
                        </span>
                        <div class="card-body text-light">
                            <h5 class="card-title"><?= $article->titre; ?></h5>
                            <p class="card-text"><?= $article->description; ?></p>
                            <span class="row align-items-center">
                                <a href="article.php?id=2" class="btn btn-primary btn-sm col-6">Lire la suite</a>
                                <span class="col-6 text-end text-secondary" style="font-size: 12px;">
                                    <i class="bi bi-hand-thumbs-up"></i> <?= $article->jaime; ?>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            
        </div>
    </div>

    <!-- Bootstrap JS and Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const cards = document.querySelectorAll('.card');
            cards.forEach((card, index) => {
                setTimeout(() => {
                    card.classList.add('fade-in');
                }, index * 150);
            });
        });
    </script>
</body>
</html>