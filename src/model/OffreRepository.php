<?php 

namespace src\model;
use libs\system\Model;
use src\model\EntrepriseRepository;
class OffreRepository extends Model{
    public function __construct(){
        parent::__construct();
    }

    public function addOffre($offre){
        if($this->db !=null){
            $this->db->persist($offre);
            $this->db->flush();
            return $offre->getId();
        }
    }


       //cette ligne represente l'objet Offre récupéré à l'aide de son id
    public function getOffre($id)
	{
		if($this->db != null)
		{  
			return $this->db->getRepository('Offre')->find(array('id' => $id));
		}
	}

    //cette ligne represente l'objet Entreprise récupéré à l'aide de son id
    public function getEntreprise($id){
        if($this->db!=null){
            return $this->db->getRepository('Entreprise')->find(array('id'=>$id));
        }
    }
    

    //cette function represente le nombre de poste effectué par une entreprise
    public function getPoste($id){
        if($this->db!=null){
            return $this->db->createQuery("SELECT COUNT(o.id) FROM Offre o WHERE o.entreprise_id=".$id)->getSingleResult();
        }
    }

    public function getAllposte($id){
        if($this->db!=null){
        return $this->db->createQuery("SELECT o FROM Offre o WHERE o.entreprise_id=". $id)->getResult();
        }
    }

    public function editOffre($id, $dep, $contrat, $poste){
        $offre= $this->db->find('Offre', $id);

        if($offre!= null){
            $offre->setDepartement($dep);
            $offre->setContrat($contrat);
            $offre->setPoste($poste);
            $this->db->flush();
        }else{
            print("echec de la modification");
        }
    }

    public function search_offre($offre){
            if($this->db!=null){
                return $this->db->createQuery("SELECT o FROM Offre o WHERE o.nom LIKE '$offre%'")->getResult();
            }
    }

}
