<?php 
    namespace src\model;
    use libs\system\Model;

    class FavorisRepository extends Model{
        public function __construct(){
            parent::__construct();
        }

        public function add($offre){
            if($this->db !=null){
                $this->db->persist($offre);
                $this->db->flush();
            }
        }

        public function candidat($id){
            if($this->db !=null){
                return $this->db->createQuery("SELECT c FROM Candidat c WHERE c.id=".$id)->getSingleResult();
            }
        }

        //recuperer les offres favorites en fonction du candidat

        public function Myfavoris($id){
            if($this->db!=null){
                return $this->db->createQuery("SELECT f FROM Favoris f WHERE f.candidat_id=".$id)->getResult();
            }
        }


        //compter le m=nombre de favoris

        public function nbFavoris($id){
            if($this->db!=null){
                return $this->db->createQuery("SELECT COUNT(f.id) FROM Favoris f WHERE f.candidat_id=".$id)->getSingleResult();
            }
        }



        public function delete($id){
            if($this->db!=null){
                $row = $this->db->getRepository('Favoris')->find(array('id'=>$id));

                if($row!=null){
                     $this->db->remove($row);
                     $this->db->flush();
                }else{
                    print("erreur lingne introuvable");
                }
            }
        }
    }

?>