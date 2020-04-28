<?php

use Doctrine\ORM\Anotation as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity @Table(name="offre")
 */

class Offre
{

    /**
     * @Id @Column(type="integer") @GeneratedValue
     */

    private $id;

    /**
     * @Column (type="string")
     */

    private $nom;

    /**
     * @Column (type="string")
     */
    private $adresse; 
    /**
     * @Column(type="string")
     */

    private $departement;

    /**
     * @Column(type="string")
     */

    private $lieu;

    /**
     * @Column(type="string")
     */
    private $contrat;

    /**
     * @Column(type="text")
     */

    private $poste;

    /**
     * @Column(type="string")
     */

     private $date;

     /**
      * @Column(type="string")
      */

      private $photo;

    /**
     * @ManyToOne(targetEntity="entreprise", inversedBy="offre")
     * @JoinColumn(name="entreprise_id", referencedColumnName="id")
     */
    private $entreprise_id;

    /**
     * @OneToMany(targetEntity="notificationa", mappedBy="offre")
     */

     private $notification;

    public function __construct(){
       $this->notification = new ArrayCollection();
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

    public function getAdresse(){
        return $this->adresse;
    }

    public function setAdresse($var){
        $this->adresse = $var;
    }

    public function getContrat(){
        return $this->contrat;
    }

    public function setContrat($var){
        $this->contrat = $var;
    }

    public function getDepartement(){
        return $this->departement;
    }

    public function setDepartement($var){
        $this->departement = $var;
    }

    public function getLieu(){
        return $this->lieu;
    }

    public function setLieu($var){
        $this->lieu = $var;
    }

    public function getPoste(){
        return $this->poste;
    }

    public function setPoste($var){
        $this->poste = $var;
    }

    public function getDate(){
        return $this->date;
    }

    public function setDate($var){
        $this->date=$var;
    }

    public function getId_entreprise(){
        return $this->entreprise_id;
    }
    public function setId_entreprise($var){
        return $this->entreprise_id = $var;
    }

    public function getNotification(){
        return $this->notification;
    }

    public function getImage(){
        return $this->photo;
      }
  
      public function setImage($var){
        return $this->photo = $var;
      }
  

    

}

