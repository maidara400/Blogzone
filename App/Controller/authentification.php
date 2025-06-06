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
   // echo $message; 
}


?>