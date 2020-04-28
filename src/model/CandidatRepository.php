<?php


namespace src\model;
use libs\system\Model;

class CandidatRepository extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function addCandidat($candidat){
        if($this->db != null){
            $this->db->persist($candidat);
            $this->db->flush();
            return $candidat->getId();
        }
    }


    public function getCandidat($id){
        if($this->db !=null){
            return $this->db->getRepository('Candidat')->find(array('id'=>$id));
        }
    }

    public function getrow($id)
	{
		if($this->db != null)
		{
			return $this->db->createQuery("SELECT c.pays FROM Candidat c WHERE c.id = " . $id)->getSingleResult();
		}
    }
    
    public function getAdresse($id){
        if($this->db != null){
            return $this->db->createQuery("SELECT c.adresse FROM Candidat c WHERE c.id =". $id)->getSingleResult();
        }
    }

    public function getOffre(){
        if($this->db != null)
		{
			return $this->db->getRepository('Offre')->findAll();
		}
    }

    //On récupère les cv du candidat qui ont été accepté 
    //se servir pour construire un msg

     #1 lié à la function 2
    public function getCv($id){
        if($this->db!=null){
        return $this->db->createQuery("SELECT c FROM Cv c WHERE c.accepted= 'OUI' AND c.candidat_id=$id")->getResult();
        }
    }

    public function countOffre(){
        if($this->db !=null){
            return $this->db->createQuery("SELECT COUNT(o.id) FROM Offre o")->getSingleResult();
        }
    }
    //on compte le nombre de cv qui on été accepté

    #2 lié à la function 1
    public function Countcv($id){
        if($this->db!=null){
        return $this->db->createQuery("SELECT COUNT(c.id) FROM Cv c WHERE c.accepted = 'OUI' AND c.candidat_id=$id")->getSingleResult();
        }
    }

    public function Employed($nom){
        if($this->db != null){
            return $this->db->createQuery("SELECT c FROM Cv c WHERE c.accepted ='OUI' AND c.destinataire='$nom'")->getResult();
        }
    }


    // methode for chartjs

    public function chartCandidat(){
        if($this->db != null){
            return $this->db->createQuery("SELECT c.creation, c.id FROM Candidat c")->getResult();
        }
    }

    

    //verifier si le poste existe deja 
    

    public function connexion($adresse){
        if($this->db !=null){
            return $this->db->createQuery("SELECT c FROM Candidat c WHERE c.adresse='$adresse'")->getResult();
        }
    }
    public function connexion2($adresse){
            if($this->db !=null){
                return $this->db->getRepository('Candidat')->findOneBy(array('adresse'=>$adresse));
            }
    }


    public function testA($nom, $prenom, $adresse){
        if($this->db!=null){
            return $this->db->createQuery("SELECT c FROM Candidat c WHERE c.nom='$nom' AND c.prenom='$prenom' AND c.adresse='$adresse'")->getResult();
        }
    }

    public function testB($nom){
        if($this->db!=null){
            return $this->db->createQuery("SELECT c FROM Candidat c WHERE c.nom='$nom'")->getResult();
        }
    }

    public function testC($prenom){
        if($this->db!=null){
            return $this->db->createQuery("SELECT c FROM Candidat c WHERE c.prenom='$prenom'")->getResult();
        }
    }
    
    public function testD($adresse){
        if($this->db!=null){
            return $this->db->createQuery("SELECT c FROM Candidat c WHERE c.adresse='$adresse'")->getResult();
        }
    }


}
