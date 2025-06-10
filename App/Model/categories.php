<?php

include_once '../../Migration/database.php';

//$categories = Categorie::getAll($pdo);

class Categorie{
    public $libelle;
    public $description;
    //$pdo = Database::getInstance();
    
    public function __construct($libelle, $description) {
        $this->nom = htmlspecialchars(trim($libelle));
        $this->description = htmlspecialchars(trim($description));
    }
    
    public function ajouter() {
        $pdo = Database::getInstance(); 
        $sql = "SELECT COUNT(*) FROM categorie WHERE libelle = :nom";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['nom' => $this->nom]);
        $existe = $stmt->fetchColumn();

        if ($existe > 0) {
            return "Une catégorie avec ce nom existe déjà.";
        }
        $sql = "INSERT INTO categorie (libelle, description) VALUES (:nom, :description)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'nom' => $this->nom,
            'description' => $this->description
        ]);
    }

    public function modifier(PDO $pdo, $ancienNom) {
        $sql = "UPDATE categorie SET libelle = :libelle, description = :description WHERE libelle = :ancienNom";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'libelle' => $this->nom,
            'description' => $this->description,
            'ancienNom' => $ancienNom
        ]);
    }

    public static function existe(PDO $pdo, string $libelle): bool {
        $sql = "SELECT COUNT(*) FROM categorie WHERE libelle = :libelle";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['libelle' => $libelle]);
        $count = $stmt->fetchColumn();
        return $count > 0;
}


    public static function getAll(PDO $pdo) {
        $sql = "SELECT * FROM categorie";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public static function supprimer($pdo, $nom) {
        $checkSql = "SELECT COUNT(*) FROM categorie WHERE libelle = :nom";
        $checkStmt = $pdo->prepare($checkSql);
        $checkStmt->execute(['nom' => $nom]);
        $existe = $checkStmt->fetchColumn();

        if ($existe == 0) {
            return "La catégorie '$nom' n'existe pas.";
        }
        $sql = "DELETE FROM categorie WHERE libelle = :nom";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['nom' => $nom]);
        return "Catégorie '$nom' supprimée avec succès.";
    }
}

?>

  

