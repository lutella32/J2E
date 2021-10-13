<?php

namespace App\Entity;
use Cassandra\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;

/**
 * @Entity
 * @ORM\Table (name="Analyse")
 */
class Analyse
{
    /**
     * @var int
     * @ORM\Column(name="idAnalyse",type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue()
     */
    public $idAnalyse ;

    /**
     * @var boolean
     * @ORM\Column(name="resultatPatient",type="boolean")
     * @ORM\GeneratedValue()
     */
    public $resultat ;

    /**
     * @var string
     * @ORM\Column(name="nomPatient",type="string")
     */
    public $nomPatient ;

    /**
     * @param Collection
     * @ORM\OneToMany(targetEntity="App\Entity\Robot",mappedBy="Analyse",fetch="EAGER");
     */
    public \Doctrine\Common\Collections\Collection $listeAnalyse;

    /**
     * @var string
     * @ORM\Column (name="nomAnalyse",type="string");
     */
    public $nomAnalyse;
}