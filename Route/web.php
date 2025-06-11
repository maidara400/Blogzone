<?php
session_start();
require_once __DIR__ . '/../Controller/ArticleController.php';
require_once __DIR__ . '/../Controller/UtilisateurController.php';
require_once __DIR__ . '/../Controller/CategorieController.php';
require_once __DIR__ . '/../Controller/VoteController.php';
include_once '../config.php';


$controller = new ArticleController();
$action = $_GET['action'] ?? 'index';

$categorieController = new CategorieController();

$voteController = new VoteController();

switch ($_GET['action'] ?? '') {
    case 'ajouter':
        $controller->ajouter();
        break;

    case 'modifier':
        $controller->modifier();
        break;

    case 'supprimer':
        $controller->supprimer();
        break;

    case 'afficher':
        $controller->afficher();
        break;
}