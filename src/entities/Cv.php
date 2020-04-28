<?php 

use Doctrine\ORM\Anotation as orm;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @Entity @Table(name="cv")
 */

 class Cv{
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
        private $profession;

       /**
        * @Column(type="string")
        */
        private $photo;

        /**
         * @Column(type="string")
         */
        private $lieu;

        /**
         * @Column(type="string")
         */
        private $tel;
          /**
         * @Column(type="string")
         */
        private $adresse;

        /**
         * @Column(type="string")
         */
        private $competences;
        

        /**
         * @Column(type="text")
         */

        private $experience;

         /**
        * @Column(type="string")
        */
        private $languages;


        /**
        * @Column(type="text")
        */
        private $projets;

        /**
         * @Column(type="string")
         */

        private $date;

        /**
         * @Column(type="string")
         */

        private $destinataire;

        
        /**
         * @Column(type="string")
         */

         private $accepted;

         /**
         * @Column(type="string")
         */

        private $dateValidation;

        /**
         * @ManyToOne(targetEntity="candidat", inversedBy="cv")
         * @JoinColumn(name="candidat_id", referencedColumnName="id")
         */

        private $candidat_id;


        /**
         * @OneToMany(targetEntity="notificationb", mappedBy="offre")
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

        public function setNom($var){
            $this->nom= $var;
        }

        public function getPrenom(){
            return $this->prenom;
        }

        public function setPrenom($var){
             $this->prenom = $var;
        }

        public function getProfession(){
            return $this->profession;
        }

        public function setProfession($var){
            $this->profession = $var;
        }

        public function getPhoto(){
            return $this->photo;
        }

        public function setPhoto($var){
             $this->photo = $var;
        }

        public function getAdresse(){
            return $this->adresse;
        }

        public function setAdresse($var){
            $this->adresse = $var;
        }

        public function getLieu(){
            return $this->lieu;
        }

        public function setLieu($var){
            $this->lieu = $var;
        }

        public function getTel(){
            return $this->tel;
        }

        public function setTel($var){
            $this->tel = $var;
        }

        public function getCompetence(){
            return $this->competences;
        }

        public function setCompetence($var){
            $this->competences = $var;
        }

        public function getExperience(){
            return $this->experience;
        }

        public function setExperience($var){
            $this->experience = $var;
        }

        public function getLangages(){
            return $this->languages;
        }

        public function setLangages($var){
            $this->languages = $var;
        }

        public function getProjet(){
            return $this->projets;
        }

        public function setProjet($var){
             $this->projets = $var;
        }

        public function getCandidat(){
            return $this->candidat_id;
        }

        public function setCandidat($var){
            $this->candidat_id = $var;
        }

        public function getNotification(){
            return $this->notification;
        }

        public function getDestination(){
            return $this->destinataire;
        }
    
        public function setDestination($var){
            $this->destinataire = $var;
        }

        public function getDate(){
            return $this->date;
        } 

        public function setDate($var){
            $this->date = $var;
        }

        public function getAccepted(){
            return $this->accepted;
          }
      
          public function setAccepted($var){
            $this->accepted=$var;
          }

          public function getDateval(){
              return $this->dateValidation;
          }
          public function setDateval($var){
              $this->dateValidation = $var; 
          }


 }