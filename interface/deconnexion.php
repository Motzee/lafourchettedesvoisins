<?php

session_start();

require_once("../sessions/imports_sessions.php") ;

if(!isset($_SESSION['identifiant'])) {
    echo "Erreur : vous ne semblez pas identifié/e, impossible de vous déconnecter" ;
} else {

    $user -> deconnexion() ;

    header('Location:index.php') ;
    http_response_code(200);
    exit ;
}

