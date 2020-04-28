<?php 

namespace src\model;
use libs\system\Model;

class NotificationARepository extends model{
    public function __construct()
    {
        parent::__construct();
    }
    public function addNotif($notA){
        if($this->db!=null){
         $this->db->persist($notA);
         $this->db->flush();
        }    
    }



    //recuperer l'offre
    public function getCv($id){
        if($this->db !=null){
            return $this->db->getRepository('Offre')->find(array('id'=>$id));
        }
    }
    //recuperation du nombre de notification A
    public function getNot_A(){
        if($this->db!=null){
           return $this->db->createQuery("SELECT COUNT(n.id) FROM NotificationA n")->getSingleResult();
        }
    }
}