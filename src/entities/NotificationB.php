<?php

use Doctrine\ORM\Anotation as ORM;
use  Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity @Table(name="notificationb")
 */
class NotificationB{
    /**
     * @Id @Column(type="integer") @GeneratedValue
     */
    private $id;

     /**
     * @ManyToOne(targetEntity="cv", inversedBy="notificationb")
     * @JoinColumn(name="cv_id", referencedColumnName="id")
     */
    private $cv_id;

    /**
     * @Column(type="string")
     */

     private $destination;

    public function __construct(){

    }

    public function getId(){
        return $this->id;
    }

    public function getCvid(){
        return $this->cv_id;
    }

    public function setCvid($var){
        $this->cv_id=$var;
    }

    public function getDestination(){
        return $this->destination;
    }

    public function setDestination($var){
        $this->destination = $var;
    }



}