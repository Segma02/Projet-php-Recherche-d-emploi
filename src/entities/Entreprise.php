<?php
use Doctrine\ORM\Anotation as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity @Table(name="entreprise")
 */

class Entreprise
{
    /**
     * @Id @Column(type="integer") @GeneratedValue
     */
    private $id;

    /**
     * @Column(type="string")
     */
    private $nom;

    /**
     * @Column(type="string")
     */
    private $pays;

    /**
    *@Column(type="string")
    */

     private $adresse;

    /**
     * @Column(type="string")
     */

     private $categorie;

      /**
     * @Column(type="string")
     */

    private $photo;

    /**
     * @Column(type="string")
     */

        private $secteur;

    /**
     * @Column(type="string")
     */

    private $statut;


    /**
    * @Column(type="string")
    */
    private $taille;

   /**
    * @Column(type="string")
    */

    private $creation;



    /**
     * Entreprise peut faire plusieurs offres
     * @OneToMany(targetEntity="offre", mappedBy="entreprise")
     */
     private $offre;

     public function  __construct()
     {
         $this->offre = new ArrayCollection();
     }

     public function getId(){
         return $this->id;
     }
     public function setId($var){
         $this->id=$var;
     }

     public function getNom(){
         return $this->nom;
     }

     public function setNom(&$var){
         $this->nom = $var;
     }

    public function getPays(){
        return $this->pays;
    }

    public function setPays(&$var){
        $this->pays = $var;
    }

    public function getAdresse(){
        return $this->adresse;
    }

    public function setAdresse(&$var){
        $this->adresse = $var;
    }

    public function getImage(){
        return $this->photo;
      }
  
      public function setImage($var){
        return $this->photo = $var;
      }
  


    public function getCategorie(){
        return $this->categorie;
    }

    public function setCategorie(&$var){
        $this->categorie = $var;
    }

    public function getSecteur(){
         return $this->secteur;
    }

    public function setSecteur(&$var){
         $this->secteur = $var;
    }

    public function getStatut(){
        return $this->statut;
    }

    public function setStatut(&$var){
        $this->statut = $var;
    }

    public function getTaille(){
        return $this->taille;
    }

    public function setTaille(&$var){
        $this->taille = $var;
    }

    public function getDate(){
        return $this->creation;
    }

    public function setDate($var){
        $this->creation = $var;
    }

}
