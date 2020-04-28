<?php 

namespace src\model;
use libs\system\Model;

class CvRepository extends model{
    public function __construct(){
        parent::__construct();
    }


    public function addCv($cv){
        if($this->db !=null){
            $this->db->persist($cv);
            $this->db->flush();
            return $cv->getId();
        }
    }

    
      public function getCv($id)
      {
          if($this->db != null)
          {  
              return $this->db->getRepository('Cv')->find(array('id'=> $id));
          }
      }
  
      //cette ligne represente l'objet Candidat récupéré à l'aide de son id
      public function getCandidat($id){
          if($this->db!=null){
              return $this->db->getRepository('Candidat')->find(array('id'=>$id));
          }
      }
      
  
      //cette function represente le nombre de poste effectué par les candidats
      public function getEachcv($id){
          if($this->db!=null){
              return $this->db->createQuery("SELECT COUNT(c.id) FROM Cv c WHERE c.candidat_id=".$id)->getSingleResult();
          }
      }

      public function verifycv($id){
        if($this->db!=null){
            return $this->db->createQuery("SELECT c FROM Cv c WHERE c.candidat_id=$id")->getResult();
        }
    }

      //obtenir le derniier cv si il est destiné à une entreprise on attend la reponse de l'entreprise
      public function recupere($id){
          if($this->db!=null){
              return $this->db->getRepository('Cv')->find(array('id'=>$id));
          }
      }

      //on recupère les cv en fonction de l'id session du candidat
      public function getMycv($id){
          if($this->db!=null){
              return $this->db->createQuery("SELECT c FROM Cv c WHERE c.candidat_id=".$id)->getResult();
          }
      }

      public function editCv($id, $profession, $langue, $tel, $comp, $projet, $exp){
          if($this->db!=null){
              $cv = $this->db->find('Cv', $id);

              if($cv != null){
                  $cv->setProfession($profession);
                  $cv->setLangages($langue);
                  $cv->setTel($tel);
                  $cv->setCompetence($comp);
                  $cv->setProjet($projet);
                  $cv->setExperience($exp);
                  $this->db->flush();
              }else{
                  print("echec de la modification");
              }
          }
      }


      public function search_cv($profession, $moi){
          if($this->db != null){
              //on recherche les cv envoyés aux destinaires à partir
              return $this->db->createQuery("SELECT c FROM Cv c WHERE  c.profession LIKE '$profession%' AND c.destinataire='$moi'")->getResult();
          }
      }

      public function cv_public($profession){
        if($this->db != null){
            //on recherche les cv envoyés aux destinaires à partir
            return $this->db->createQuery("SELECT c FROM Cv c WHERE c.profession LIKE '$profession%' AND c.destinataire='Public'")->getResult();
        }
    }

}