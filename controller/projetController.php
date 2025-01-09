<?php


class projetController {
    private ProjetModel $projetModel;

    public function __construct(ProjetModel $projetModel) {
        $this->projetModel = $projetModel;
    }

    public function afficherProjets(string $nomUtilisateur) {
        $projets = $this->projetModel->getTousLesProjets($nomUtilisateur);

        if (!empty($projets)) {
            return $projets;
        } else {
            echo "Aucun projet n'a été trouvé pour cet utilisateur.";
            return [];
        }
    }
    public function ajouterProjet(Projet $projet){
        
        $AddDataBase = new ProjetModel ;
      return  $AddDataBase->ajouterProjet($projet);

    



    }

    public function suprimerProjet(int $id){
        $suprimerprojet = new ProjetModel;
        return $suprimerprojet->suprimerProjet($id);
        
    }

}