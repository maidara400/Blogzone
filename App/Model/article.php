<?php
 // chemin vers le fichier database.php
    require_once __DIR__ . '../../../config.php'; 
    require_once BASE_PATH . '/Migration/database.php';
    require_once BASE_PATH . '/View/visiteur/include/composant.php'; 
    
class Article {
    public $id;
    public $titre;
    public $description;
    public $categorie_id;
    public $image ;
    public $jaime;

    public function __construct($titre = "", $description = "", $categorie_id = "", $image = "", $jaime = 0) {
        $this->titre = htmlspecialchars(trim($titre));
        $this->description = htmlspecialchars(trim($description));
        $this->categorie_id = htmlspecialchars(trim($categorie_id));
        $this->image = htmlspecialchars(trim($image));
        $this->jaime = (int)$jaime;
    }

    // fonction pour ajouter un article
  public function ajouter() {

    if(isset($_POST['ajouter']) ) {

        $this->titre = htmlspecialchars(trim($_POST['titre']));
        $this->description = htmlspecialchars(trim($_POST['description']));
        $this->categorie_id = htmlspecialchars(trim($_POST['categorie_id']));
        $this->image = $_FILES['image']['name'];
        $this->jaime = 0;

        // Vérification des champs obligatoires
        if(empty($this->titre) || empty($this->description) || empty($this->categorie_id) || empty($this->image)) {
            $message = "Veuillez remplir tous les champs.";
            session_start();
            $_SESSION['message'] = $message;
            header("Location:../../View/admin/article/ajouter.php"); 
            return $_SESSION['message'];
        }

        // Vérification du fichier image
        $targetDir = "../../Public/image../";  // Dossier de destination pour les images
        $targetFile = $targetDir . basename($this->image);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $uploadOk = 1;

        // Vérifier si l'image est bien une image
        $check = getimagesize($_FILES['image']['tmp_name']);
        if($check === false) {
            $message = "Ce fichier n'est pas une image.";
            $_SESSION['message'] = $message;
            header("Location:../../View/admin/article/ajouter.php");
            return;
        }

        // Vérifier si le fichier existe déjà
        if (file_exists($targetFile)) {
            $message = "Désolé, l'image existe déjà.";
            session_start();
            $_SESSION['message'] = $message;
            header("Location:../../View/admin/article/ajouter.php");
            return $_SESSION['message'];
        }

        // Limite de taille de l'image (5MB ici)
        if ($_FILES['image']['size'] > 5000000) {
            $message = "Désolé, l'image est trop grande.";
            session_start();
            $_SESSION['message'] = $message;
            header("Location:../../View/admin/article/ajouter.php");
            return $_SESSION['message'];
        }

        // Autoriser certains formats de fichiers
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $message = "Désolé, seuls les fichiers JPG, JPEG, PNG & GIF sont autorisés.";
            session_start();
            $_SESSION['message'] = $message;
            header("Location:../../View/admin/article/ajouter.php");
            return $_SESSION['message'];
        }

        // Tenter de déplacer le fichier
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            // Si l'image est téléchargée avec succès, on insère l'article en base de données
            $pdo = Database::getInstance();
            $stmt = $pdo->prepare("INSERT INTO article (titre, description, categorie_id, image, jaime) VALUES (:titre, :description, :categorie_id, :image, :jaime)");
            $stmt->bindParam(':titre', $this->titre);
            $stmt->bindParam(':description', $this->description);
            $stmt->bindParam(':categorie_id', $this->categorie_id);
            $stmt->bindParam(':image', $this->image);
            $stmt->bindParam(':jaime', $this->jaime);
            $stmt->execute();

            if($stmt->rowCount() > 0) {
                session_start();
                $_SESSION['message'] = "Article ajouté avec succès.";
                header("Location:../../View/admin/article/afficher.php");
                return $_SESSION['message'];
            }
        } else {
            $message = "Désolé, une erreur est survenue lors de l'upload de l'image.";
            $_SESSION['message'] = $message;
            header("Location:../../View/admin/article/ajouter.php");
            return $_SESSION['message'];
        }
    }
}


    
  public function afficherArticles() {
    $db = Database::getInstance();
    $query = "SELECT * FROM article";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $articles = $stmt->fetchAll(PDO::FETCH_OBJ);

    if($articles) {
        return ['articles' => $articles];
    } else {
        return ['articles' => []];
    }
  }

   // fonction pour afficher une article par son id
        public static function afficherArticleParId($id) {
            $pdo = Database::getInstance();
            $stmt = $pdo->prepare("SELECT * FROM article WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $article = $stmt->fetch(PDO::FETCH_OBJ);
            return $article;
        }



           // fonction pour modifier un utilisateur
        public function modifier($id) {

            $this->titre = htmlspecialchars(trim($_POST['titre']));
            $this->description = htmlspecialchars(trim($_POST['description']));
            $this->categorie_id = htmlspecialchars(trim($_POST['categorie_id']));
            $this->image = $_FILES['image']['name'];
            // Vérification des champs obligatoires

           if(empty($this->titre) || empty($this->description) || empty($this->categorie_id) || empty($this->image)) {
               $message = "Veuillez remplir tous les champs.";
               header("Location:../../View/admin/categorie/modifier.php?modifier=$id");
               session_start();
               $_SESSION['message'] = $message;
               return $_SESSION['message'];
           }

           $pdo = Database::getInstance();
           $stmt = $pdo->prepare("UPDATE article SET titre = :titre, description = :description, categorie_id = :categorie_id, image = :image WHERE id = :id");
           $stmt->bindParam(':titre', $this->titre);
           $stmt->bindParam(':description', $this->description);
           $stmt->bindParam(':categorie_id', $this->categorie_id);
           $stmt->bindParam(':image', $this->image);
           $stmt->bindParam(':id', $id);
           $stmt->execute();
           $message = "Article modifié avec succès.";
           if($stmt->rowCount() > 0) {
                session_start();
                $_SESSION['message'] = $message;
                header("Location:../../View/admin/article/afficher.php");
                return $_SESSION['message'];
            }

        }


         // fonction pour supprimer un utilisateur
        public static function supprimer($id) {
            $pdo = Database::getInstance();
            $stmt = $pdo->prepare("DELETE FROM article WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $message = "Article supprimé avec succès.";
            session_start();
            $_SESSION['message'] = $message;
            header("Location:../../View/admin/article/afficher.php");
            exit();
            return $_SESSION['message']; 
        }


}