<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;

/**
 * Class Robot
 * @Entity
 * @ORM\Table(name="Robot")
 */
class Robot
{

    /**
     * @var int
     * @ORM\Column (name="id", type="integer")
     * @ORM\GeneratedValue ()
     * @ORM\Id()
     */
    public $identifiant;

    /**
     * @var String
     * @ORM\Column (name="Name", type="string")
     */
    public $Nom;

    /**
     * @var Analyse|null
     * @ORM\ManyToOne(targetEntity="App\Entity\Analyse",fetch="EAGER")
     * @ORM\JoinColumn(name="analyse", referencedColumnName="idAnalyse")
     */
    public ?Analyse $Analyse;

    /**
     * @var Covid|null
     * @ORM\ManyToOne(targetEntity="App\Entity\Covid",fetch="EAGER")
     * @ORM\JoinColumn(name="covid",referencedColumnName="idCovid");
     */
    public ?Covid $Covid;

    /**
     * @param Marque:null
     * @ORM\ManyToOne(targetEntity="App\Entity\Marque",fetch="EAGER")
     * @ORM\JoinColumn(name="marque",referencedColumnName="idMarque")
     */
    public ?Marque $Marque;

    /**
     * Constructeur du robot
     *
     * @param string $nom
     * @param Analyse|null $analyse
     * @param Covid|null $covid
     * @param Marque|null $marque
     */
    public function __construct(string $nom , ?Analyse $analyse =null, ?Covid $covid=null,?Marque $marque=null){
        $this->Nom=$nom;
        $this->Analyse=$analyse;
        $this->Covid=$covid;
        $this->Marque=$marque;
    }

}