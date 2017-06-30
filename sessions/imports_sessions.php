<?php   
    require_once('../sessions/User.php') ;
    require_once('../sessions/Database.php') ;
    
    $db = new Database() ;
    
    $dbListe = $db -> getListeUsers() ;
    
    if(isset($_SESSION['identifiant'])) {
        $identifiant = strtolower($_SESSION['identifiant']) ;
        
        $user = $dbListe[$identifiant] ;
    }
    /*
    echo "<pre>" ;
    var_dump($user) ;
     echo "</pre>" ;
    
*/