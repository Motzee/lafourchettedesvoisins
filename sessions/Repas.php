<?php

class Post {
    protected $titre ;
    protected $auteur ;
    protected $date ;
    protected $moment ;
    protected $lieu ;
    protected $quicuisine ;
    protected $a_emporter ;
    protected $thematique ;
    protected $description ;
 
    function __construct(string $titre, string $auteur, $date, string $moment, string $lieu, string $quicuisine, bool $a_emporter, string $thematique, string $description) {
        $this->titre = $this->setTitre($titre);
        $this->auteur = $this->setAuteur($auteur);
        $this->date = $this->setDate($date);
        $this->moment = $this->setMoment($moment);
        $this->lieu = $this->setLieu($lieu);
        
        $this->thematique = $this->setThematique($thematique);
        $this->description = $this->setDescription($description);
    }

    
//fonctions SET 
    protected function setTitre(string $titre) {
        $this->titre = $titre;
    }

    protected function setAuteur(string $auteur) {
        $this->auteur = $auteur;
    }

    protected function setDate($date) {
        $this->date = $date;
    }

    protected function setMoment(string $moment) {
        $this->moment = $moment;
    }

    protected function setLieu(string $lieu) {
        $this->lieu = $lieu;
    }

    protected function setThematique(string $thematique) {
        $this->thematique = $thematique;
    }

    protected function setDescription(string $description) {
        $this->description = $description;
    }



//fonctions GET    
    public function getTitre():string {
        return $this->titre;
    }

    public function getAuteur():string {
        return $this->auteur;
    }

    public function getDate() {
        return $this->date;
    }

    public function getMoment():string {
        return $this->moment;
    }

    public function getLieu():string {
        return $this->lieu;
    }

    public function getThematique():string {
        return $this->thematique;
    }

    public function getDescription():string {
        return $this->description;
    }

//méthodes de classes
    
    public static function issetRepas(int $id) {
        
    }
    
     public static function recupereRepas(int $id) {
        
    }   
    
    
//autres fonctions
    
    //afficher le post
    
    
}
