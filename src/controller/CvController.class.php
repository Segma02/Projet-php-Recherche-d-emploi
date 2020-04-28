<?php

use libs\system\Controller;
use src\model\CvRepository;
use src\model\NotificationARepository;
use src\model\NotificationBRepository;


class CvController extends controller{
    public function __construct(){
        parent::__construct();
    }

    public function CV(){
        $repository = new CvRepository();
     
        $data= array('accept'=> $repository ->getMycv($_SESSION['c_id']));
        if($_GET['destinataire']){ 
            return $this->view->load("candidat/CV_candidat.html", $data);
        }else{
            
            return $this->view->load("candidat/CV_candidat.html",$data);
        }
    }


}