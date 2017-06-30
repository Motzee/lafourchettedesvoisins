<?php session_start(); ?>

<!DOCTYPE html>

<html lang="fr">
<?php
    require_once("template/head.html") ;
    
    require_once("../sessions/imports_sessions.php") ;


?>

<body>
<?php
    include_once("template/header.html") ; 
    
    
    //si une session existe déjà
    if(isset($identifiant)) {
        echo 'Bienvenue '.$user->getIdentifiant().', cliquez là pour vous déconnecter : <a href="deconnexion.php" title="deconnexion">[x]</a>' ;
        
    }
    
    elseif(isset($_POST['identifiant']) && isset($_POST['mdp']) && isset($_POST['authentifie'])) {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $identifiant = $_POST['identifiant'] ;
        $mdp = $_POST['mdp'] ;
        
        switch($_POST['authentifie']) {
            
            //si identification
            case "login" :
                $identifiant = strtolower($identifiant) ;
                if(isset($dbListe[$identifiant])) {
                   $user = $dbListe[$identifiant] ;
                   
                   if($user->compareMDP($mdp, $user)) {
                       $user -> connexion() ;
                    
                        header('Location:index.php') ;
                        http_response_code(200);
                        exit ;
                    } else {
                        echo "Erreur dans l'identifiant et/ou le mot de passe." ;
                        include_once("template/v_index.html") ; 
                    }
                    
                } else {
                    echo "Erreur dans l'identifiant " ;
                    include_once("template/v_index.html") ;    
                }
            break ;
            
            //si inscription
            case "signin" :
                if($dbListe != null && isset($dbListe[$identifiant])) {
                    echo "Ce pseudo est déjà pris, veuillez en choisir un autre svp" ;
                    include_once("template/v_index.html") ;
                } else {
                    $sel = User::generationSEL() ;
                    $mdp_cuisine = User::hashageMDP($mdp, $sel) ;
                    //on crée un objet et on l'enregistre dans la base de données
                    $newUser = new User($identifiant, "user", 0, $sel, $mdp_cuisine) ;
                    $db -> ajouteUtilisateur($newUser) ;
                    $newUser -> connexion() ;
                    header('Location:index.php') ;
                    http_response_code(200);
                    exit ;
                } 
            break ;
            default : echo "Erreur dans la procédure d'authentification" ;
        }
    } else {
        include_once("template/v_index.html") ;      
    }
    


    include_once("template/footer.html") ;

?>    
    
</body> 
</html>