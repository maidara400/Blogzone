<?php ob_start(); ?>
    <!-- contenu -->


<?php
    $content = ob_get_clean() ;
    $titre = "Catégorie" ;
    require_once('include/template.php') ;
?>
