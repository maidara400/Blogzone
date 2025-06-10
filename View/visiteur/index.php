<?php
    $title = "Accueil";
    session_start();
    include_once '../../App/Model/utilisateur.php';
    if(isset($_SESSION['message'])) {
        include_once 'include/composant.php';
        alert($_SESSION['message'],'danger');
        unset($_SESSION['message']);
    }
?>