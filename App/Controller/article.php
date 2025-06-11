<?php
include_once '../Model/commentaire.php';
include_once '../Model/article.php';

if(isset($_POST['commenter'])) {
    // ID de l'article en dur (temporairement)
    $commentaire = new Commentaire(10, $_POST['mail'], $_POST['description']);
    $commentaire->ajouter();
}

if(isset($_POST['ajouter'])) {
    $article = new Article();
    $message = $article->ajouter();
    echo $message; 
    
}
if(isset($_POST['modifier'])) {
    $id = htmlspecialchars(trim($_POST['id']));
    $article = new Article();
    $message = $article->modifier($id);
    echo $message; 
}

if(isset($_POST['supprimer'])) {
    $id = htmlspecialchars(trim($_POST['id']));
    $article = new Article();
    $message = $article->supprimer($id);
    echo $message; 
}
