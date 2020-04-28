<?php

use Doctrine\ORM\Anotation as ORM;
use  Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity @Table(name="notificationa")
 */
class NotificationA{
    /**
     * @Id @Column(type="integer") @GeneratedValue
     */
    private $id;

    /**
     * @ManyToOne(targetEntity="offre", inversedBy="notificationa")
     * @JoinColumn(name="offre_id", referencedColumnName="id")
     */
    private $offre_id;


    public function __construct(){

    }

    public function getId(){
        return $this->id;
    }

    public function getOffre_id(){
        return $this->offre_id;
    }

    public function setOffre_id($var){
        $this->offre_id=$var;
    } 


}