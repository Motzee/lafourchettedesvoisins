<?php

class Database {

    protected $listeUsers;

    public function __construct() {
        $this->listeUsers = [];

        $cheminFichierBD = "../sessions/admin/membres.json";

        if (!file_exists($cheminFichierBD)) {
            $fichier = fopen($cheminFichierBD, 'w+');
            fwrite($fichier, $this->listeUsers);
            fclose($fichier);
        } else {

            $listeUtilisateursJSON = file_get_contents($cheminFichierBD);
            $listeUtilisateurs = json_decode($listeUtilisateursJSON, true);

            if (!is_array($listeUtilisateurs)) {
                $listeUtilisateurs = [];
            }
            foreach ($listeUtilisateurs as $membre) {
                $ide = $membre['identifiant'];
                $statut = $membre['statut'];
                $pts_fourchette = $membre['pts_fourchette'];
                $sel_mdp = $membre['sel_mdp'];
                $hash_mdp = $membre['hash_mdp'];

                $this->listeUsers[strtolower($ide)] = new User($ide, $statut, $pts_fourchette, $sel_mdp, $hash_mdp);
            }
        }
    }

    protected function setListeUsers($liste) {
        $this->listeUsers = $liste;
    }

//CREATE
    //enregistrer une liste d'utilisateurs
    private function saveListeUtilisateurs($ListeUsers) {
        $ListeUsersJSON = json_encode($ListeUsers, JSON_PRETTY_PRINT);
        file_put_contents("../sessions/admin/membres.json", $ListeUsersJSON);
    }

    //ajouter un nouvel utilisateur dans la liste des utilisateurs
    public function ajouteUtilisateur(User $objUser) {
        $id = $objUser->getIdentifiant();
        $identifiant = strtolower($id);

        $this->listeUsers[$identifiant] = $objUser;
        $this->saveListeUtilisateurs($this->listeUsers);
    }

//READ
    public function getListeUsers() {
        return $this->listeUsers;
    }

//DELETE : supprimer un utilisateur de la liste des utilisateurs
    public function supprimeUtilisateur(string $identifiant) {
        $ListeUtilisateurs = $this->getListeUsers();
        unset($ListeUtilisateurs->$identifiant);
        $this->saveListeUtilisateurs($ListeUtilisateurs);
    }

    //UPDATE : modifier un utilisateur dans la lsite des utilisateurs
    public function modifieUtilisateur(User $objUser) {
        $identifiant = $objUser->getIdentifiant();
        supprimeUtilisateur($identifiant);
        ajouteUtilisateur($objUser);
    }

}
