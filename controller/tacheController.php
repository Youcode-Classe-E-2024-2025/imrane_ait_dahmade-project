<?php


class tacheController{

    private TaskModel $TaskModel;
    public function __construct(TaskModel $taskModel)
    {
        $this->TaskModel = $taskModel;
    }

    public function afficherTaches(int $idProjet){
        $taches = $this->TaskModel->AffichagesTasks($idProjet);
        if(!empty($taches)){
            return $taches;
        }else{
            return [];
        }
    }
}

?>