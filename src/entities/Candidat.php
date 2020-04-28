<?php


use Doctrine\ORM\Anotation as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity @Table(name="candidat")
 */
class Candidat
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
    private $prenom;

    /**
     * @Column(type="string")
     */
    private $pays;

    /**
     * @Column(type="string")
     */

    private $adresse;

    /**
     * @Column(type="string")
     */
    private $photo;

    /**
     * @Column(type="string")
     */
    private $creation;

 
    /**
     * @OneToMany(targetEntity="cv", mappedBy="candidat");
     */
    private $cv;

    /**
     * @OneToMany(targetEntity="favoris", mappedBy="candidat")
     */

     private $favoris;

    public function __construct()
    {
      $this->cv = new ArrayCollection();
      $this->favoris = new ArrayCollection();
    }

    public function getId(){
        return $this->id;
    }

    public function getNom(){
        return $this->nom;
    }

    public function setNom(&$var){
        $this->nom = $var;
    }

    public function getPrenom(){
        return $this->prenom;
    }

    public function setPrenom(&$var){
        $this->prenom = $var;
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

    public function setDate($var){
      $this->date = $var;
   }  

   public function getDateCompte(){
     return $this->creation;
   }

   public function setDateCompte($var){
      $this->creation = $var;
   }
    public function getCv(){
      return $this->cv;
    }




}
