<?php ob_start();
   require_once realpath(__DIR__ . '/../../config.php');
    require_once __DIR__ . '/../../View/visiteur/include/composant..php'
?>
<?php
      $idCategorie = isset($_GET['id']) ? intval($_GET['id']) : 0;
      $articles = [];
   if ($idCategorie > 0) {
          $stmt = $pdo->prepare("SELECT * FROM articles WHERE categorie_id = ?");
          $stmt->execute([$idCategorie]);
          $articles = $stmt->fetchAll();
   }

      $categories = $pdo->query("SELECT * FROM categories")->fetchAll();

      $recents = $pdo->query("SELECT * FROM articles ORDER BY date_creation DESC LIMIT 6")->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Page Catégorie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <style>
        body {
            background-color: #121212;
            color: white;
        }

        .nav-link {
            color: white;
        }

        .nav-link:hover {
            color: #0dcaf0;
        }

        .navbar-nav .nav-link.active {
            color: #0d6efd;
        }

        .list-group-item {
            border: none;
            background-color: transparent;
            color: white;
        }

        .card-img-top {
            max-height: 100px;
            object-fit: cover;
            width: 100%;
            border-radius: 5%;
        }

        .side-section {
            background-color: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(5px);
            border-radius: 1rem;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .interaction-icons i {
            color: white;
            cursor: pointer;
            margin-right: 10px;
        }

        .interaction-icons i:hover {
            color: #0dcaf0;
        }

        @media (max-width: 991px) {
            .d2 {
                position: static !important;
                width: 100% !important;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid mt-4">
        <div class="row">

            <!-- Première section -->
            <div class="col-lg-2 col-md-4 col-sm-12">
                <div class="side-section">
                    <span class="badge bg-primary text-uppercase fw-bold mb-3">Actualité</span>
                    <h5>Découvrir</h5>
                    <p>Voici une section</p>
                </div>

                <div class="side-section">
                    <h5 class="mb-3">Favoris</h5>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <input class="form-check-input me-2" type="checkbox" id="fav1">
                            <label class="form-check-label" for="fav1">Informatique</label>
                        </li>
                        <li class="list-group-item">
                            <input class="form-check-input me-2" type="checkbox" id="fav2">
                            <label class="form-check-label" for="fav2">Médecine</label>
                        </li>
                        <li class="list-group-item">
                            <input class="form-check-input me-2" type="checkbox" id="fav3">
                            <label class="form-check-label" for="fav3">Finance</label>
                        </li>
                        <li class="list-group-item">
                            <input class="form-check-input me-2" type="checkbox" id="fav4">
                            <label class="form-check-label" for="fav4">People</label>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- section du milieeu -->
            <div class="col-lg-7 col-md-8 col-sm-12">
                <div class="row">
                    <?php if (!empty($articles)) {
                        foreach ($articles as $article) { ?>
                            <div class="col-md-6 mb-4">
                                <div class="card bg-dark text-white border-0 rounded-4 shadow h-100">
                                    <img src="<?= htmlspecialchars($article['image']) ?>" class="card-img-top rounded-top-4" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= htmlspecialchars($article['titre']) ?></h5>
                                        <p class="card-text"><?= htmlspecialchars($article['description']) ?></p>
                                        <div class="d-flex justify-content-between align-items-center interaction-icons">
                                            <small>
                                                <i class="fa-regular fa-thumbs-up me-1"></i>
                                                <i class="fa-regular fa-thumbs-down ms-3"></i>
                                            </small>
                                            <small><i class="fa-regular fa-comment"></i> 3</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    } else { ?>
                        <p>Aucun article trouvé pour cette catégorie.</p>
                    <?php } ?>
                </div>
            </div>

            <!--sections a gauches:article rescent -->
            <div class="col-lg-3 col-md-12 d2">
                <h5 class="mb-4">Articles récents</h5>
                <?php if (!empty($recents)) {
                    foreach ($recents as $recent) { ?>
                        <div class="card bg-dark text-white mb-4 shadow">
                            <img src="<?= htmlspecialchars($recent['image']) ?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <p class="card-text"><?= htmlspecialchars($recent['titre']) ?></p>
                                <small class="text-muted"><?= date('d M Y', strtotime($recent['date_creation'])) ?></small>
                            </div>
                        </div>
                    <?php }
                } else { ?>
                    <p>Aucun article récent disponible.</p>
                <?php } ?>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>


<?php
$titre = "Catégorie";
?>