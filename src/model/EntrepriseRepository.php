<?php 

namespace src\model;
use libs\system\Model;
class EntrepriseRepository extends Model{
    public function __construct(){
        parent::__construct();
    }

    public function add($entreprise){
        if($this->db != null){
            $this->db->persist($entreprise);
            $this->db->flush();
            return $entreprise->getId();
        }
    }
    
    public function Entreprise($id){
        if($this->db!=null){
            return $this->db->getRepository('Entreprise')->find(array('id'=> $id));
        }
    }

    //validation par l'entreprise modifie la table cv
    public function validate($id){
        if($this->db!=null){
           $cv= $this->db->find('Cv', $id);

           if($cv!= null){
               $cv->setAccepted("OUI");
               $cv->setDateval(date("d-m-Y"));
               $this->db->flush();
           }else{
               print("echec de la modification");
           }
        }
    }

    //validation publique par l'entreprise modifie la table cv
    public function validatepublique($id, $destinataire){
        if($this->db!=null){
           $cv= $this->db->find('Cv', $id);

           if($cv!= null){
               $cv->setAccepted("OUI");
               $cv->setDestination($destinataire);
               $cv->setDateval(date("d-m-Y"));
               $this->db->flush();
           }else{
               print("echec de la modification");
           }
        }
    }

     //invalidation par l'entreprise modifie la table cv
     public function invalidate($id){
        if($this->db!=null){
           $cv= $this->db->find('Cv', $id);

           if($cv!= null){
               $cv->setAccepted("NON");
               $cv->setDateval(date("d-m-Y"));
               $this->db->flush();
           }else{
               print("echec de la modification");
           }
        }
    }


    public function invalidatepublique($id, $nom){
        if($this->db!=null){
           $cv= $this->db->find('Cv', $id);

           if($cv!= null){
               $cv->setAccepted("NON");
               $cv->setDestination($nom);
               $cv->setDateval(date("d-m-Y"));
               $this->db->flush();
           }else{
               print("echec de la modification");
           }
        }
    }


    public function getCv($id){
        if($this->db!=null){
            return $this->db->getRepository('Cv')->find(array('id'=>$id));
        }
    }

    //recuperer les cv ayant été  accepté
    public function Employed($nom){
        if($this->db != null){
            return $this->db->createQuery("SELECT c FROM Cv c WHERE c.accepted ='OUI' AND c.destinataire='$nom'")->getResult();
        }
    }

    //recuperer le nombre de cv accepté 
    public function Countemployed($nom){
        if($this->db != null){
            return $this->db->createQuery("SELECT COUNT(c.id) FROM Cv c WHERE c.accepted ='OUI' AND c.destinataire='$nom'")->getSingleResult();
        }
    }

    public function connexion($adresse){
        if($this->db !=null){
            return $this->db->createQuery("SELECT e FROM Entreprise e WHERE e.adresse='$adresse'")->getResult();
        }
    }

    public function connexion2($adresse){
        if($this->db !=null){
            return $this->db->getRepository('Entreprise')->findOneBy(array('adresse'=>$adresse));
        }
    }



    public function testA($nom,$adresse){
        if($this->db!=null){
            return $this->db->createQuery("SELECT e FROM Entreprise e WHERE e.nom='$nom' AND e.adresse='$adresse'")->getResult();
        }
    }

    public function testB($nom){
        if($this->db!=null){
            return $this->db->createQuery("SELECT e FROM Entreprise e WHERE e.nom='$nom'")->getResult();
        }
    }
    
    public function testC($adresse){
        if($this->db!=null){
            return $this->db->createQuery("SELECT e FROM Entreprise e WHERE e.adresse='$adresse'")->getResult();
        }
    }
    
}