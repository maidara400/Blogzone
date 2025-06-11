<?php
require_once __DIR__ . '/../../Migration/database.php';

class Article {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection();
    }

    public function trouverParAuteur($idAuteur) {
        $idAuteur = (int) $idAuteur; // Sécurité type entier
        $stmt = $this->pdo->prepare("SELECT * FROM article WHERE id_utilisateur = ? ORDER BY date_creation DESC");
        $stmt->execute([$idAuteur]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM article ORDER BY date_creation DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add($libelle, $description, $image = '', $idAuteur, $idCategorie) {
        $stmt = $this->pdo->prepare("
            INSERT INTO article (libelle, description, image, aime, date_creation, id_utilisateur, id_categorie)
            VALUES (?, ?, ?, ?, NOW(), ?, ?)
        ");
        return $stmt->execute([$libelle, $description, $image, 0, $idAuteur, $idCategorie]);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM article WHERE id_article = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $libelle, $description, $image, $idCategorie)
    {
        $sql = "UPDATE article SET libelle = ?, description = ?, image = ?, id_categorie = ? WHERE id_article = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$libelle, $description, $image, $idCategorie, $id]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM article WHERE id_article = ?");
        $stmt->execute([$id]);
    }

    public function getTousLesArticles()
    {
        $sql = "SELECT a.*, c.libelle AS categorie, u.prenom, u.nom
                FROM article a
                LEFT JOIN categorie c ON a.id_categorie = c.id
                LEFT JOIN utilisateurs u ON a.id_utilisateur = u.id
                ORDER BY a.date_creation DESC";

        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getArticleParId($id)
    {
        $sql = "SELECT a.*, c.libelle AS categorie, u.prenom, u.nom
                FROM article a
                LEFT JOIN categorie c ON a.id_categorie = c.id
                LEFT JOIN utilisateurs u ON a.id_utilisateur = u.id
                WHERE a.id_article = :id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}