<?php

use libs\system\Controller;
use src\model\OffreRepository;
use src\model\EntrepriseRepository;
session_start();


#Cette session est fausse au depart
#Elle permettra d'afficher l'alerte de success
$_SESSION['valid']=false;

class OffreController extends controller{
    public function __construct(){
        parent::__construct();
    }

    public function Offre(){
        $var_repository = new EntrepriseRepository();
        $data=array(
          'adresse' => $var_repository->getAdresse($_SESSION['id'])
        );
    
        $_SESSION['adresse'] = $data['adresse'];
        return $this->view->load("templates/OffreEntreprise.html", $data);
      }

     

}