<?php
include_once '../Model/categorie.php';
    if(isset($_POST['ajouter'])) {
        $categorie = new Categorie();
        $message = $categorie->ajouter();
        echo $message; 
    }

    if(isset($_POST['modifier'])) {
        $id = $_POST['id'];
        $categorie = new Categorie();
        $message = $categorie->modifier($id);
        echo $message; 
    }

    if(isset($_POST['supprimer'])) {
    $id = $_POST['id'];
    $categorie = new Categorie();
    $message = $categorie->supprimer($id);
    echo $message; 
}