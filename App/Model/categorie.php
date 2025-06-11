<?php 
 // chemin vers le fichier database.php
    require_once __DIR__ . '../../../config.php'; 
    require_once BASE_PATH . '/Migration/database.php';
    require_once BASE_PATH . '/View/visiteur/include/composant.php'; 

class Categorie {
    public $id;
    public $libelle;
    public $description;

    public function __construct($id ="", $libelle="", $description="") {
        $this->id = $id;
        $this->libelle = $libelle;
        $this->description = $description;
    }
    // ajouter une categorie
  public function ajouter(){
    if(isset($_POST['ajouter'])){
        $this->libelle = htmlspecialchars($_POST['libelle']);
        $this->description = htmlspecialchars($_POST['description']);
        if(!empty($this->libelle) && !empty($this->description)){
            $db = Database::getInstance();
            $query = "INSERT INTO categorie (libelle, description) VALUES (:libelle, :description)";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':libelle', $this->libelle);
            $stmt->bindParam(':description', $this->description);
            if($stmt->execute()){
                $message = "Categorie ajoutée avec succès";
                session_start();
                $_SESSION['message'] = $message;
                // Redirection vers la page de gestion des categories
                header("Location: ../../View/admin/categorie/afficher.php");
                exit();
                return $_SESSION['message'];
            } else {
                $message = "Erreur lors de l'ajout de la categorie";
                session_start();
                $_SESSION['message'] = $message;
                return $_SESSION['message'];
            }
        } else {
            return false;
        }
    }
  }

  public function afficherCategories() {
    $db = Database::getInstance();
    $query = "SELECT * FROM categorie";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if($categories) {
        return ['categories' => $categories];
    } else {
        return ['categories' => []];
    }
  }

   // fonction pour afficher une categorie par son id
        public static function afficherCategorieParId($id) {
            $pdo = Database::getInstance();
            $stmt = $pdo->prepare("SELECT * FROM categorie WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $categorie = $stmt->fetch(PDO::FETCH_OBJ);
            return $categorie;
        }

         // fonction pour modifier un utilisateur
        public function modifier($id) {
            
            $this->libelle = htmlspecialchars(trim($_POST['libelle']));
            $this->description = htmlspecialchars(trim($_POST['description']));

            if(empty($this->libelle) || empty($this->description)) {
                $message = "Veuillez remplir tous les champs.";
                header("Location:../../View/admin/categorie/modifier.php?modifier=$id"); 
                session_start();
                $_SESSION['message'] = $message;
                return $_SESSION['message'];
            }

            $pdo = Database::getInstance();
            $stmt = $pdo->prepare("UPDATE categorie SET libelle = :libelle, description = :description WHERE id = :id");
            $stmt->bindParam(':libelle', $this->libelle);
            $stmt->bindParam(':description', $this->description);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $message = "Categorie modifiée avec succès.";
            if($stmt->rowCount() > 0) {
                session_start();
                $_SESSION['message'] = $message;
                header("Location:../../View/admin/categorie/afficher.php"); 
                return $_SESSION['message'];
            }

        }

          // fonction pour supprimer un utilisateur
        public static function supprimer($id) {
            $pdo = Database::getInstance();
            $stmt = $pdo->prepare("DELETE FROM categorie WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $message = "Categorie supprimée avec succès.";
            session_start();
            $_SESSION['message'] = $message;
            header("Location:../../View/admin/categorie/afficher.php");
            exit();
            return $_SESSION['message']; 
        }
}
