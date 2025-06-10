<?php

include_once '../Model/utilisateur.php';

if(isset($_POST['inscription'])) {
    $utilisateur = new Utilisateur($_POST['nom'], $_POST['prenom'], $_POST['mail'], $_POST['password']);
    $message = $utilisateur->ajouter();
    echo $message; // Display the message returned by the ajouter method
}
if(isset($_POST['connexion'])) {
    $utilisateur = new Utilisateur();
    $message = $utilisateur->connecter();
    echo $message; 
}

if(isset($_POST['modifier'])) {
    $id = $_POST['id']; 
    $utilisateurm = new Utilisateur();
    $message = $utilisateurm->modifier($id);
    echo $message; // Display the message returned by the modifier method
}
if(isset($_POST['supprimer'])) {
    $id = $_POST['id'];
    $utilisateurm = new Utilisateur();
    $message = $utilisateurm->supprimer($id);
    echo $message; 
}
if(isset($_POST['deconnexion'])) {
    $utilisateur = new Utilisateur();
    $message = $utilisateur->deconnecter();
    echo $message; 
}


?>