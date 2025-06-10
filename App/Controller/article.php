<?php
include_once '../Model/commentaire.php';

if(isset($_POST['commenter'])) {
    // ID de l'article en dur (temporairement)
    $commentaire = new Commentaire(1, $_POST['mail'], $_POST['description']);
    $commentaire->ajouter();
}
