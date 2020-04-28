<?php 

namespace src\model;
use libs\system\Model;

class NotificationBRepository extends model{
    public function __construct()
    {
        parent::__construct();
    }
    public function add($notB){
        if($this->db!=null){
         $this->db->persist($notB);
         $this->db->flush();
         return $notB->getId();
        }    
    }



    //recuperer le cv
    public function getCv($id){
        if($this->db !=null){
            return $this->db->getRepository('Cv')->find(array('id'=>$id));
        }
    }
    //recuperation du nombre de notification A en fonction du destinataire 
    public function getNot_B($nom){
        if($this->db!=null){
           return $this->db->createQuery("SELECT COUNT(n.id) FROM NotificationB n WHERE n.destination='$nom'")->getSingleResult();
        }
    }

    public function Allcv($nom){
        if($this->db!=null){
            return $this->db->createQuery("SELECT c FROM Cv c WHERE c.destinataire='$nom'")->getResult();
        }
    }
}