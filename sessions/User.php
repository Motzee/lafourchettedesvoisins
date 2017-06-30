<?php

class User implements JsonSerializable {
    protected $identifiant ;
    protected $statut ;
    protected $pts_fourchette ;
    protected $sel_mdp ;
    protected $hash_mdp ;
    
    public function __construct(
            string $identifiant,
            string $statut,
            int $pts_fourchette,
            string $sel_mdp,
            string $hash_mdp
        ) {
        $this -> setIdentifiant($identifiant) ;
        $this -> setStatut($statut) ;
        $this -> setPts_fourchette($pts_fourchette) ;
        $this -> setSel_mdp($sel_mdp) ;
        $this -> setHash_mdp($hash_mdp) ;
    }
 
    
    
//fonctions SET    
     function setIdentifiant(string $identifiant) {
        $this->identifiant = $identifiant;
    }

    function setStatut(string $statut) {
        $this->statut = $statut;
    }
    
    function setPts_fourchette(int $pts_fourchette) {
        $this->pts_fourchette = $pts_fourchette;
    }

    function setSel_mdp(string $sel_mdp) {
        $this->sel_mdp = $sel_mdp;
    }

    function setHash_mdp(string $hash_mdp) {
        $this->hash_mdp = $hash_mdp;
    }   
    
 //fonctions GET   
    function getIdentifiant():string {
        return $this->identifiant;
    }

    function getStatut():string {
        return $this->statut;
    }
    
    function getPts_fourchette():int {
        return $this->pts_fourchette;
    }

    function getSel_mdp():string {
        return $this->sel_mdp;
    }

    function getHash_mdp():string {
        return $this->hash_mdp;
    }

//fonctions de classe
 
    //génération d'un sel unique pour un utilisateur
    public static function generationSEL():string {
        $longueur = rand(10, 15) ;
        $plage = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789' ;
        $plagePreparee = str_shuffle($plage) ;
        $sel = substr($plagePreparee, 0, $longueur) ;
        return $sel;
    }
    
    //hachage d'un mot de passe en fonction d'un sel
    public static function hashageMDP($mdp, $sel):string {
        $mdp_sale = $mdp.$sel ;
        $mdp_cuisine = hash('sha256', $mdp_sale) ;

        return $mdp_cuisine ;
    }

    
//autres fonctions
    public function jsonSerialize() {
	return [
            'identifiant' => $this -> getIdentifiant(),
            'statut' => $this -> getStatut(),
            'pts_fourchette' => $this -> getPts_fourchette(),
            'sel_mdp' => $this -> getSel_mdp(),
            'hash_mdp' => $this -> getHash_mdp(),
	] ;
    }
    
    //chargement d'une session
    public function connexion() {
        $_SESSION['identifiant'] = $this -> identifiant ;
    }
    
    //effacer une session
    public function deconnexion() {
        $_SESSION = array(); //ou session_unset();
        session_destroy();
    }
    
    //génération d'un sel unique pour un utilisateur
    public function compareMDP(string $mdpPropose, User $user) {
        $mdp_cuisine_attendu = $user -> hash_mdp ;
        $sel = $user -> sel_mdp ;
        
        $mdp_cuisine_propose = $this::hashageMDP($mdpPropose, $sel) ; 
        return $mdp_cuisine_propose == $mdp_cuisine_attendu ? true : false ;
    }
}
