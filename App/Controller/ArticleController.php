<?php
require_once __DIR__ . '/../Model/Article.php';

class ArticleController {
    private $articleModel;

    public function __construct() {
        $this->articleModel = new Article();
    }

    public function index() {
        $articles = $this->articleModel->getTousLesArticles();
        require __DIR__ . '/../View/visiteur/Acceuil.php';
    }

    public function ajouter() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Charger les catégories AVANT le formulaire
        $categorieModel = new Categorie();
        $categories = $categorieModel->getAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $libelle = $_POST['libelle'];
            $description = $_POST['description'];
            $image = '';
            $id_categorie = $_POST['id_categorie'] ?? null;
            $idAuteur = $_SESSION['utilisateurs']['id'];

            // Gestion image
            if (!empty($_FILES['image']['name'])) {
                $imageName = uniqid() . '_' . $_FILES['image']['name'];
                $uploadPath = __DIR__ . '/../uploads/' . $imageName;
                move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath);
                $image = $imageName;
            }

            // Ajouter article avec catégorie
            $this->articleModel->add($libelle, $description, $image, $idAuteur, $id_categorie);

            header('Location: ../../Route/web.php?action=dashblogueur');
            exit;
        }

        // Passer $categories à la vue
        require __DIR__ . '/../../View/admin/article/ajouter.php';
    }



    public function modifier() {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            header('Location: ../Route/web.php?action=dashblogueur');
            exit;
        }

        $id = (int)$_GET['id'];
        $article = $this->articleModel->getById($id);

        if (!$article) {
            echo "Article introuvable.";
            exit;
        }

        // Charger les catégories
        $categorieModel = new Categorie();
        $categories = $categorieModel->getAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $libelle = $_POST['libelle'];
            $description = $_POST['description'];
            $idCategorie = $_POST['id_categorie'] ?? null;
            $image = $article['image']; // conserver l’image actuelle par défaut

            if (!empty($_FILES['image']['name'])) {
                $imageName = uniqid() . '_' . $_FILES['image']['name'];
                $uploadPath = __DIR__ . '/../uploads/' . $imageName;
                move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath);
                $image = $imageName;
            }

            $this->articleModel->update($id, $libelle, $description, $image, $idCategorie);
            header('Location: ../Route/web.php?action=dashblogueur');
            exit;
        }

        require __DIR__ . '/../../View/admin/article/modifier.php';
    }


    public function supprimer() {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            header('Location: ../../Route/web.php?action=dashblogueur');
            exit;
        }

        $id = (int)$_GET['id'];
        $this->articleModel->delete($id);
        header('Location: ../../Route/web.php?action=dashblogueur');
        exit;
    }

    public function afficher() {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            header('Location: ../../Route/web.php?action=index');
            exit;
        }

        $id = (int)$_GET['id'];
        $article = $this->articleModel->getById($id);

        if (!$article) {
            echo "Article introuvable.";
            exit;
        }

        // require __DIR__ . '/../View/visiteur/afficher.php';
        require __DIR__ . '/../../View/admin/article/afficher.php';
    }

    public function dashboardAuteur() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Vérifie si l'utilisateur est connecté et est un auteur
        if (!isset($_SESSION['utilisateurs']) || $_SESSION['utilisateurs']['role'] !== 'auteur') {
            header('Location: ../../Route/web.php?action=connexion');
            exit;
        }

        $idAuteur = $_SESSION['utilisateurs']['id'];

        require_once __DIR__ . '/../Model/Article.php';
        $articleModel = new Article();
        $articles = $articleModel->trouverParAuteur($idAuteur);

        require __DIR__ . '/../../View/admin/dashbord_blogeur.php';
    }
}