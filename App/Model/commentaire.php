<?php 
    require_once __DIR__ . '../../../config.php'; 
    require_once BASE_PATH . '/Migration/database.php';
    require_once BASE_PATH . '/View/visiteur/include/composant.php'; 
class Commentaire {
    public $id;
    public $id_article;
    public $mail;
    public $description;

    public function __construct($id_article = "", $mail = "", $description = "") {
        $this->id_article = $id_article;
        $this->mail = $mail;
        $this->description = $description;
    }

     public function ajouter() {
    if (isset($_POST['commenter'])) {
        $this->id_article = $_POST['id_article'];
        $this->mail = $_POST['mail'];
        $this->description = $_POST['description'];

        if (!empty($this->id_article) && !empty($this->mail) && !empty($this->description)) {
            $db = Database::getInstance();

            // Récupérer l'auteur de l'article
            $stmt = $db->prepare("SELECT mail FROM article WHERE id = :id_article");
            $stmt->bindParam(':id_article', $this->id_article);
            $stmt->execute();
            $auteur = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($auteur && $auteur['mail'] === $this->mail) {
                session_start();
                $_SESSION['message'] = "Vous ne pouvez pas commenter votre propre article.";
                header("Location: ../../View/visiteur/article.php?id=" . $this->id_article);
                exit();
            }

            // Ajouter le commentaire
            $stmt = $db->prepare("INSERT INTO commentaire (id_article, mail, description) VALUES (:id_article, :mail, :description)");
            $stmt->bindParam(':id_article', $this->id_article);
            $stmt->bindParam(':mail', $this->mail);
            $stmt->bindParam(':description', $this->description);

            if ($stmt->execute()) {
                session_start();
                $_SESSION['message'] = "Commentaire ajouté avec succès.";
                header("Location: ../../View/visiteur/article.php?id=" . $this->id_article);
                exit();
            } else {
                session_start();
                $_SESSION['message'] = "Erreur lors de l'ajout du commentaire.";
            }
        } else {
            session_start();
            $_SESSION['message'] = "Tous les champs sont requis.";
        }
    }
}

}
